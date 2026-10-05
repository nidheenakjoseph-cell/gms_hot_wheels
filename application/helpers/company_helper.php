<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('resolve_company_id')) {
    function resolve_company_id($user_id = null)
    {
        $CI =& get_instance();
        $logged_in = $CI->session->userdata('logged_in') === TRUE || $CI->session->userdata('is_logged_in') === TRUE;

        if (!$logged_in && empty($user_id)) {
            return 1;
        }

        $user_id = (int) ($user_id ?: $CI->session->userdata('user_id'));

        if ($user_id > 0) {
            // 1. Direct company_id from users table
            $CI->db->reset_query();
            if ($CI->db->field_exists('company_id', 'users')) {
                $user = $CI->db
                    ->select('company_id, branch_id')
                    ->where('id', $user_id)
                    ->get('users')
                    ->row();

                if ($user && (int) $user->company_id > 0) {
                    return (int) $user->company_id;
                }

                // Fallback to user's assigned branch's company
                if ($user && (int) $user->branch_id > 0) {
                    $b = $CI->db
                        ->select('company_id')
                        ->where('branch_id', (int) $user->branch_id)
                        ->get('branches')
                        ->row();
                    if ($b && (int) $b->company_id > 0) {
                        return (int) $b->company_id;
                    }
                }
            }

            // 2. From user_branch_access
            $CI->db->reset_query();
            $company = $CI->db
                ->select('b.company_id', false)
                ->from('user_branch_access uba')
                ->join('branches b', 'b.branch_id = uba.branch_id')
                ->where('uba.user_id', $user_id)
                ->where('b.is_active', 1)
                ->order_by('b.is_main_branch', 'DESC')
                ->order_by('b.branch_id', 'ASC')
                ->limit(1)
                ->get()
                ->row();

            if ($company && (int) $company->company_id > 0) {
                return (int) $company->company_id;
            }
        }

        $CI->db->reset_query();
        $branch = $CI->db
            ->select('branches.company_id', false)
            ->where('is_active', 1)
            ->order_by('is_main_branch', 'DESC')
            ->order_by('branch_id', 'ASC')
            ->limit(1)
            ->get('branches')
            ->row();

        if ($branch && (int) $branch->company_id > 0) {
            return (int) $branch->company_id;
        }

        $CI->db->reset_query();
        $company = $CI->db
            ->select('company_master.company_id', false)
            ->order_by('company_id', 'ASC')
            ->limit(1)
            ->get('company_master')
            ->row();

        return $company ? (int) $company->company_id : 1;
    }
}

if (!function_exists('get_current_company_id')) {
    function get_current_company_id()
    {
        $CI =& get_instance();
        $logged_in = $CI->session->userdata('logged_in') === TRUE || $CI->session->userdata('is_logged_in') === TRUE;

        if (!$logged_in) {
            return 1;
        }

        $company_id = (int) $CI->session->userdata('company_id');

        if ($company_id > 0) {
            return $company_id;
        }

        $fallback_company_id = (int) $CI->session->userdata('fallback_company_id');
        if ($fallback_company_id > 0) {
            return $fallback_company_id;
        }

        return resolve_company_id();
    }
}

if (!function_exists('get_current_company_details')) {
    function get_current_company_details($company_id = null)
    {
        $CI =& get_instance();
        $company_id = (int) ($company_id ?: get_current_company_id());
        static $company_cache = [];

        if ($company_id <= 0) {
            return null;
        }

        if (array_key_exists($company_id, $company_cache)) {
            return $company_cache[$company_id];
        }

        $company_cache[$company_id] = $CI->db
            ->where('company_id', $company_id)
            ->get('company_master')
            ->row();
        return $company_cache[$company_id];
    }
}

if (!function_exists('get_current_company_logo_url')) {
    function get_current_company_logo_url($fallback = 'public/images/logoauto1.png', $company = null)
    {
        $company = $company ?: get_current_company_details();
        $logo_path = !empty($company->company_logo) ? $company->company_logo : $fallback;
        return base_url($logo_path);
    }
}

if (!function_exists('calculate_demo_expiry_date')) {
    function calculate_demo_expiry_date($start_date, $duration_days)
    {
        $start = trim((string) ($start_date ?? ''));
        $days = (int) ($duration_days ?? 0);

        if ($start === '' || $days <= 0) {
            return null;
        }

        try {
            $dt = new DateTime($start);
            $dt->modify('+' . $days . ' days');
            return $dt->format('Y-m-d');
        } catch (Exception $e) {
            return null;
        }
    }
}

if (!function_exists('get_company_demo_settings')) {
    function get_company_demo_settings($company_id = null)
    {
        $CI =& get_instance();
        $company_id = (int) ($company_id ?: get_current_company_id());

        $defaults = [
            'demo_enabled' => 0,
            'demo_start_date' => null,
            'demo_expiry_date' => null,
            'demo_duration_days' => 0,
        ];

        if ($company_id <= 0 || !$CI->db || !method_exists($CI->db, 'field_exists')) {
            return $defaults;
        }

        if (!$CI->db->field_exists('demo_enabled', 'company_master')) {
            return $defaults;
        }

        $row = $CI->db
            ->select('demo_enabled, demo_start_date, demo_expiry_date, demo_duration_days')
            ->where('company_id', $company_id)
            ->get('company_master')
            ->row();

        if (!$row) {
            return $defaults;
        }

        return [
            'demo_enabled' => (int) ($row->demo_enabled ?? 0),
            'demo_start_date' => !empty($row->demo_start_date) ? $row->demo_start_date : null,
            'demo_expiry_date' => !empty($row->demo_expiry_date) ? $row->demo_expiry_date : null,
            'demo_duration_days' => (int) ($row->demo_duration_days ?? 0),
        ];
    }
}

if (!function_exists('get_company_demo_status')) {
    function get_company_demo_status($company_id = null)
    {
        $company_id = (int) ($company_id ?: get_current_company_id());
        $settings = get_company_demo_settings($company_id);

        $demo_enabled = ((int) ($settings['demo_enabled'] ?? 0)) === 1;
        $expiry_date = $settings['demo_expiry_date'] ?? null;
        $warning_message = null;
        $is_expired = false;

        if (!$demo_enabled) {
            return [
                'demo_enabled' => false,
                'is_expired' => false,
                'warning_message' => null,
                'company_id' => $company_id,
                'demo_expiry_date' => null,
            ];
        }

        if (empty($expiry_date)) {
            $is_expired = true;
            $warning_message = 'Your demo access has expired. Please contact the administrator to extend access.';
            return [
                'demo_enabled' => true,
                'is_expired' => true,
                'warning_message' => $warning_message,
                'company_id' => $company_id,
                'demo_expiry_date' => null,
            ];
        }

        $now = new DateTime('now');
        $expiry_dt = new DateTime($expiry_date . ' 23:59:59');
        $remaining_days = (int) floor(($expiry_dt->getTimestamp() - $now->getTimestamp()) / 86400);

        if ($now > $expiry_dt) {
            $is_expired = true;
            $warning_message = 'Your demo access has expired. Please contact the administrator to extend access.';
        } elseif ($remaining_days <= 2 && $remaining_days >= 0) {
            if ($remaining_days === 0) {
                $warning_message = 'Your demo access expires today.';
            } elseif ($remaining_days === 1) {
                $warning_message = 'Your demo access expires tomorrow.';
            } else {
                $warning_message = 'Your demo access expires in ' . $remaining_days . ' days.';
            }
        }

        return [
            'demo_enabled' => true,
            'is_expired' => $is_expired,
            'warning_message' => $warning_message,
            'company_id' => $company_id,
            'demo_expiry_date' => $expiry_date,
        ];
    }
}

if (!function_exists('is_super_admin')) {
    function is_super_admin($user_id = null)
    {
        $CI =& get_instance();
        if ($user_id === null) {
            $user_id = (int) $CI->session->userdata('user_id');
            $role = (string) $CI->session->userdata('role');
            if (in_array(strtolower(trim($role)), ['super admin', 'superadmin', 'super_admin'], true)) {
                return true;
            }
            if ($user_id === 6) {
                return true;
            }
        }

        $user_id = (int) $user_id;
        if ($user_id <= 0) {
            return false;
        }

        if ($user_id === 6) {
            return true;
        }

        $row = $CI->db->select('id, role')->where('id', $user_id)->get('users')->row();
        if ($row) {
            if (in_array(strtolower(trim((string)$row->role)), ['super admin', 'superadmin', 'super_admin'], true)) {
                return true;
            }
        }

        return false;
    }
}

