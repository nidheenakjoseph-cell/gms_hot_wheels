<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_guard
{
    public function check()
    {
        $CI =& get_instance();

        if (!isset($CI->router) || !isset($CI->session)) {
            return;
        }

        $class = strtolower((string) $CI->router->class);
        $method = strtolower((string) $CI->router->method);

        $allowed = [
            'login' => ['index', 'verify_login', 'logout', 'forgot_password', 'send_reset_link', 'reset_password', 'update_password'],
        ];

        if (isset($allowed[$class]) && in_array($method, $allowed[$class], true)) {
            if ($class === 'login' && in_array($method, ['index'], true)) {
                $logged_in = $CI->session->userdata('logged_in') === TRUE || $CI->session->userdata('is_logged_in') === TRUE;
                if ($logged_in) {
                    redirect('dashboard');
                    exit;
                }
            }
            return;
        }

        if ($this->is_public_route($class, $method)) {
            return;
        }

        $logged_in = $CI->session->userdata('logged_in') === TRUE || $CI->session->userdata('is_logged_in') === TRUE;

        if (!$logged_in) {
            $CI->session->set_flashdata('error', 'Please login to continue.');
            redirect('login');
            exit;
        }

        if (function_exists('get_company_demo_status')) {
            $CI->load->helper('company');
            $demo_status = get_company_demo_status();
            if (!empty($demo_status['demo_enabled']) && !empty($demo_status['is_expired'])) {
                // Set flash BEFORE destroying the session so it survives the redirect
                $error_msg = 'Your demo access has expired. Please contact the administrator to extend access.';
                // Unset auth keys but keep the session alive so flashdata is stored
                $CI->session->unset_userdata([
                    'logged_in', 'is_logged_in', 'user_id', 'username',
                    'role', 'company_id', 'selected_branch_ids',
                ]);
                $CI->session->set_flashdata('error', $error_msg);
                redirect('login');
                exit;
            }

            if (!empty($demo_status['warning_message'])) {
                $CI->session->set_flashdata('demo_warning', $demo_status['warning_message']);
            }
        }

        $CI->load->helper('page_access');
        if (!user_can_access_page($class, $method)) {
            deny_page_access();
        }
    }

    private function is_public_route($class, $method)
    {
        return (($class === 'legal' && in_array($method, ['index', 'privacy', 'terms'], true))
            || ($class === 'access_denied' && $method === 'index'));
    }
}
