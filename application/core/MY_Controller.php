<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Controller
 *
 * Base controller that all GMS controllers extend.
 * Provides a centralised helper for catching financial-year / business-rule
 * RuntimeExceptions and redirecting back with a proper flash message.
 */
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        if (isset($this->router) && strtolower((string) $this->router->class) !== 'login') {
            $logged_in = $this->session->userdata('logged_in') === TRUE || $this->session->userdata('is_logged_in') === TRUE;

            if (!$logged_in) {
                $this->session->set_flashdata('error', 'Please login to continue.');
                redirect('login');
                exit;
            }

            if (function_exists('get_company_demo_status')) {
                $demo_status = get_company_demo_status();
                if (!empty($demo_status['demo_enabled']) && !empty($demo_status['is_expired'])) {
                    $error_msg = 'Your demo access has expired. Please contact the administrator to extend access.';
                    $this->session->unset_userdata([
                        'logged_in', 'is_logged_in', 'user_id', 'username',
                        'role', 'company_id', 'selected_branch_ids',
                    ]);
                    $this->session->set_flashdata('error', $error_msg);
                    redirect('login');
                    exit;
                }
            }

            $this->load->helper('page_access');
            if (!user_can_access_page($this->router->class, $this->router->method)) {
                deny_page_access();
            }
        }
    }

    protected function require_login(): void
    {
        $logged_in = $this->session->userdata('logged_in') === TRUE || $this->session->userdata('is_logged_in') === TRUE;

        if (!$logged_in) {
            $this->session->set_flashdata('error', 'Please login to continue.');
            redirect('login');
            exit;
        }

        if (function_exists('get_company_demo_status')) {
            $demo_status = get_company_demo_status();
            if (!empty($demo_status['demo_enabled']) && !empty($demo_status['is_expired'])) {
                $error_msg = 'Your demo access has expired. Please contact the administrator to extend access.';
                $this->session->unset_userdata([
                    'logged_in', 'is_logged_in', 'user_id', 'username',
                    'role', 'company_id', 'selected_branch_ids',
                ]);
                $this->session->set_flashdata('error', $error_msg);
                redirect('login');
                exit;
            }
        }
    }

    /**
     * Executes $callback inside a DB transaction with try/catch for RuntimeException.
     *
     * - Calls $this->db->trans_begin() before the callback.
     * - Commits on success.
    * - Rolls back AND sets a general error flash + redirects on RuntimeException.
     *
     * Usage in any controller method:
     *
     *   return $this->safe_accounting(function() use ($id) {
     *       $this->Some_model->do_accounting_work($id);
     *   }, site_url('Purchase/purchase_grn_list'));
     *
     *   // Only continue if true:
     *   if ($ok) { redirect('success_page'); }
     *
     * @param callable $callback      The code to execute inside the transaction.
     * @param string   $redirect_url  Where to redirect on RuntimeException error.
     * @return bool  TRUE if callback succeeded and was committed, FALSE if rolled back.
     */
    protected function safe_accounting(callable $callback, string $redirect_url): bool
    {
        $this->db->trans_begin();
        try {
            $callback();
            $this->db->trans_commit();
            return true;
        } catch (RuntimeException $e) {
            $this->db->trans_rollback();
            log_message('error', '[ACCOUNTING] ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
            $this->session->set_flashdata('error', $e->getMessage());
            redirect($redirect_url);
            return false;
        }
    }
}
