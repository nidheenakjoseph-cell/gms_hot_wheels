<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Get a separate database handle for branch-scope lookups. These lookups can
 * run while another Query Builder statement is being assembled.
 */
if (!function_exists('branch_scope_db')) {
    function branch_scope_db()
    {
        static $db = null;

        if ($db === null) {
            $CI =& get_instance();
            $db = $CI->load->database('default', true);
        }

        return $db;
    }
}

if (!function_exists('branch_scope_company_id')) {
    function branch_scope_company_id()
    {
        $CI =& get_instance();
        $company_id = (int) $CI->session->userdata('company_id');
        if ($company_id > 0) {
            return $company_id;
        }

        $fallback_company_id = (int) $CI->session->userdata('fallback_company_id');
        if ($fallback_company_id > 0) {
            return $fallback_company_id;
        }

        $user_id = (int) $CI->session->userdata('user_id');
        $branch_db = branch_scope_db();
        if ($user_id > 0) {
            $user_comp = $branch_db->query(
                'SELECT company_id FROM users WHERE id = ? LIMIT 1',
                [$user_id]
            )->row();

            if ($user_comp && (int) $user_comp->company_id > 0) {
                return (int) $user_comp->company_id;
            }

            $company = $branch_db->query(
                'SELECT b.company_id
                 FROM user_branch_access uba
                 JOIN branches b ON b.branch_id = uba.branch_id
                 WHERE uba.user_id = ? AND b.is_active = 1
                 ORDER BY b.is_main_branch DESC, b.branch_id ASC
                 LIMIT 1',
                [$user_id]
            )->row();

            if ($company && (int) $company->company_id > 0) {
                return (int) $company->company_id;
            }
        }

        $company = $branch_db->query(
            'SELECT company_id
             FROM branches
             WHERE is_active = 1
             ORDER BY is_main_branch DESC, branch_id ASC
             LIMIT 1'
        )->row();

        if ($company && (int) $company->company_id > 0) {
            return (int) $company->company_id;
        }

        $company = $branch_db->query(
            'SELECT company_id FROM company_master ORDER BY company_id ASC LIMIT 1'
        )->row();

        return $company ? (int) $company->company_id : 1;
    }
}

/**
 * Get active branches allowed for a specific user
 */
if (!function_exists('get_user_allowed_branches')) {
    function get_user_allowed_branches($user_id = null)
    {
        static $cache = [];

        $CI =& get_instance();
        $branch_db = branch_scope_db();
        $logged_in = $CI->session->userdata('logged_in') === TRUE || $CI->session->userdata('is_logged_in') === TRUE;

        if (!$logged_in) {
            return [];
        }

        if (empty($user_id)) {
            $user_id = $CI->session->userdata('user_id');
        }

        $cache_key = (string) ($user_id ?? 0);
        if (array_key_exists($cache_key, $cache)) {
            return $cache[$cache_key];
        }

        if (empty($user_id)) {
            $cache[$cache_key] = get_all_active_branches();
            return $cache[$cache_key];
        }

        // Check if explicit records exist for this user in user_branch_access
        $has_explicit = $branch_db->query(
            "SELECT 1 FROM user_branch_access WHERE user_id = ? LIMIT 1",
            [(int)$user_id]
        )->num_rows() > 0;

        if ($has_explicit) {
            $sql = "SELECT b.* FROM branches b 
                    INNER JOIN user_branch_access uba ON uba.branch_id = b.branch_id 
                    WHERE uba.user_id = ? AND b.is_active = 1 AND b.company_id = ?
                    ORDER BY b.is_main_branch DESC, b.branch_name ASC";
            $allowed = $branch_db->query($sql, [(int)$user_id, branch_scope_company_id()])->result();
            $cache[$cache_key] = $allowed;
            return $allowed;
        }

        // Fallback: If no explicit user_branch_access records exist, return all active branches for the company
        $cache[$cache_key] = get_all_active_branches();
        return $cache[$cache_key];
    }
}

/**
 * Get array of selected branch IDs from session or allowed scope
 */
if (!function_exists('get_selected_branch_ids')) {
    function get_selected_branch_ids()
    {
        $CI =& get_instance();
        $logged_in = $CI->session->userdata('logged_in') === TRUE || $CI->session->userdata('is_logged_in') === TRUE;

        if (!$logged_in) {
            return 'all';
        }

        $allowed_branches = get_user_allowed_branches();
        $allowed_ids = array_map(function ($b) {
            return (int) $b->branch_id;
        }, $allowed_branches);

        $selected = $CI->session->userdata('selected_branch_ids');

        if (empty($selected) || $selected === 'all' || $selected === ['all']) {
            return !empty($allowed_ids) ? $allowed_ids : 'all';
        }

        if (is_string($selected)) {
            $selected = explode(',', $selected);
        }

        if (is_array($selected)) {
            $cleaned = array_filter(array_map('intval', $selected));
            $valid = array_values(array_intersect($cleaned, $allowed_ids));
            return !empty($valid) ? $valid : (!empty($allowed_ids) ? $allowed_ids : 'all');
        }

        return !empty($allowed_ids) ? $allowed_ids : 'all';
    }
}

/**
 * Get primary single branch ID for newly created records
 */
if (!function_exists('get_primary_branch_id')) {
    function get_primary_branch_id()
    {
        $selected = get_selected_branch_ids();
        if (is_array($selected) && !empty($selected)) {
            return (int) $selected[0];
        }

        $allowed = get_user_allowed_branches();
        if (!empty($allowed)) {
            return (int) $allowed[0]->branch_id;
        }

        return 1; // Default to Main Branch (id = 1)
    }
}

/**
 * Apply branch filter to CodeIgniter Database Query Builder
 */
if (!function_exists('apply_branch_filter')) {
    function apply_branch_filter($table_prefix = '')
    {
        $CI =& get_instance();
        $selected = get_selected_branch_ids();

        if ($selected === 'all') {
            return;
        }

        $ref = new ReflectionProperty(get_class($CI->db), 'qb_from');
        $ref->setAccessible(true);
        $from = $ref->getValue($CI->db);

        if (empty($from)) {
            return;
        }

        $col = !empty($table_prefix) ? rtrim($table_prefix, '.') . '.branch_id' : 'branch_id';

        if (is_array($selected)) {
            if (count($selected) === 1) {
                $CI->db->where($col, (int) $selected[0]);
            } else {
                $CI->db->where_in($col, $selected);
            }
        }
    }
}

/**
 * Get all active branches from database
 */
if (!function_exists('get_all_active_branches')) {
    function get_all_active_branches()
    {
        static $cache = null;
        if ($cache !== null) {
            return $cache;
        }

        $CI =& get_instance();
        $branch_db = branch_scope_db();
        $company_id = branch_scope_company_id();
        $sql = "SELECT b.* FROM branches b WHERE b.is_active = 1 AND b.company_id = ? ORDER BY b.is_main_branch DESC, b.branch_name ASC";
        $branches = $branch_db->query($sql, [$company_id])->result();
        $cache = $branches;

        return $branches;
    }
}

/**
 * Render standard HTML Branch Selector Dropdown for Add/Edit forms
 */
if (!function_exists('render_branch_select_dropdown')) {
    function render_branch_select_dropdown($name = 'branch_id', $selected_branch_id = null, $extra_classes = '', $required = true, $extra_attrs = '')
    {
        $allowed_branches = get_user_allowed_branches();
        if (empty($selected_branch_id)) {
            $selected_branch_id = get_primary_branch_id();
        }

        $req_attr = $required ? 'required' : '';
        $html = '<select name="' . htmlspecialchars($name) . '" id="' . htmlspecialchars($name) . '" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white ' . htmlspecialchars($extra_classes) . '" ' . $req_attr . ' ' . $extra_attrs . '>';
        
        foreach ($allowed_branches as $b) {
            $isSelected = ((int)$b->branch_id === (int)$selected_branch_id) ? 'selected' : '';
            $main_badge = $b->is_main_branch ? ' (Main Branch)' : '';
            $html .= '<option value="' . $b->branch_id . '" ' . $isSelected . '>' . htmlspecialchars($b->branch_name . $main_badge) . '</option>';
        }

        $html .= '</select>';
        return $html;
    }
}

if (!function_exists('insert_voucher_transaction')) {
    function insert_voucher_transaction($data)
    {
        $CI =& get_instance();
        if (!isset($data['branch_id']) || $data['branch_id'] === '' || $data['branch_id'] === null) {
            $data['branch_id'] = get_primary_branch_id();
        }
        return $CI->db->insert('voucher_transaction', $data);
    }
}

if (!function_exists('ensure_branch_in_data')) {
    function ensure_branch_in_data(array &$data)
    {
        if (!isset($data['branch_id']) || $data['branch_id'] === '' || $data['branch_id'] === null) {
            $data['branch_id'] = get_primary_branch_id();
        }
        return $data;
    }
}




