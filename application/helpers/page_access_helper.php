<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('user_can_access_page')) {
    function user_can_access_page($class, $method)
    {
        $CI =& get_instance();
        $user_id = (int) $CI->session->userdata('user_id');

        if ($user_id <= 0) {
            return false;
        }

        $role = strtolower(trim((string) $CI->session->userdata('role')));
        if ($user_id === 6 || in_array($role, ['super admin', 'superadmin', 'super_admin'], true)) {
            return true;
        }

        $route = strtolower(trim($class . '/' . $method, '/'));
        $controller_route = strtolower(trim($class, '/'));
        $index_route = $controller_route . '/index';

        $page_permission_routes = [
            'menucontroller/get_user_access' => 'menucontroller/access_control',
            'menucontroller/save_user_access' => 'menucontroller/access_control',
            'setup/add_user' => 'setup/list_users',
            'setup/add_user_data' => 'setup/list_users',
            'setup/edit_user' => 'setup/list_users',
            'setup/edit_user_data' => 'setup/list_users',
            'setup/delete_user' => 'setup/list_users',
        ];
        if (isset($page_permission_routes[$route])) {
            $route = $page_permission_routes[$route];
        }

        if ($route === 'dashboard' || $route === 'dashboard/index') {
            return true;
        }

        $notification_routes = [
            'notification',
            'notification/index',
            'notification/unread_count',
            'notification/mark_as_read',
            'notification/mark_all_as_read',
        ];
        if (in_array($route, $notification_routes, true)) {
            return true;
        }

        $CI->load->database();
        $menus = $CI->db
            ->select('m.menu_url, uma.can_view')
            ->from('menus m')
            ->join('user_menu_access uma', 'uma.menu_id = m.menu_id AND uma.user_id = ' . $CI->db->escape($user_id), 'left')
            ->where_in('LOWER(TRIM(m.menu_url))', [$route, $controller_route, $index_route])
            ->where('m.is_active', 1)
            ->get()
            ->result();

        $controller_access = false;
        $has_controller_permission = false;
        $index_access = false;
        $has_index_permission = false;
        foreach ($menus as $menu) {
            $menu_route = strtolower(trim((string) $menu->menu_url, '/'));
            $has_access = (int) $menu->can_view === 1;

            if ($menu_route === $route) {
                return $has_access;
            }

            if ($menu_route === $controller_route) {
                $controller_access = $has_access;
                $has_controller_permission = true;
            }

            if ($menu_route === $index_route) {
                $index_access = $has_access;
                $has_index_permission = true;
            }
        }

        if ($has_controller_permission) {
            return $controller_access;
        }

        return $has_index_permission && $index_access;
    }
}

if (!function_exists('deny_page_access')) {
    function deny_page_access()
    {
        $CI =& get_instance();
        $CI->output->set_status_header(403);

        if ($CI->input->is_ajax_request() || strpos((string) $CI->input->get_request_header('Accept'), 'application/json') !== false) {
            $CI->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'You do not have permission to access this page.']));
        } else {
            redirect('access_denied');
        }

        exit;
    }
}
