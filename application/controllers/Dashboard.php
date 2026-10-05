<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        $this->load->helper(['company_helper', 'branch_helper']);

        /* Session */
        $data['username'] = $this->session->userdata('username');
        $data['userid']   = $this->session->userdata('user_id');

        $can_view_job_card = user_can_access_page('Jobcard', 'index');
        $can_view_scrap    = user_can_access_page('Scrap', 'index');
        $can_view_reports  = user_can_access_page('Reports', 'revenue') && ($can_view_job_card || $can_view_scrap);

        $data['can_view_reports'] = $can_view_reports;
        $data['can_view_jobcards'] = $can_view_job_card;
        $data['can_view_scrap'] = $can_view_scrap;
        $data['can_view_purchase'] = user_can_access_page('Purchase', 'purchase_order_list');
        $data['can_view_customers'] = user_can_access_page('customer', 'index');
        $data['can_view_inventory'] = user_can_access_page('spareparts', 'index');
        $data['can_view_estimations'] = user_can_access_page('estimation', 'index');
        $data['can_view_inspections'] = user_can_access_page('inspection', 'index');
        $data['can_view_accounts'] = user_can_access_page('Accounts', 'index');

        /* Header information from the active company and branch scope */
        $this->db->reset_query();
        $company = $this->db
            ->select('company_master.company_name', false)
            ->where('company_id', (int) get_current_company_id())
            ->get('company_master')
            ->row();
        $data['company_name'] = $company ? $company->company_name : null;

        $selected_branch_ids = get_selected_branch_ids();
        $allowed_branches = get_user_allowed_branches();
        $branch_names = [];
        if ($selected_branch_ids === 'all') {
            $data['selected_branch_name'] = 'All Branches';
        } else {
            foreach ($allowed_branches as $branch) {
                if (in_array((int) $branch->branch_id, $selected_branch_ids, true)) {
                    $branch_names[] = $branch->branch_name;
                }
            }
            $data['selected_branch_name'] = count($branch_names) === count($allowed_branches) && count($allowed_branches) > 1
                ? 'All Branches'
                : (count($branch_names) > 1
                    ? count($branch_names) . ' Branches Selected'
                    : ($branch_names[0] ?? 'All Branches'));
        }

        /* Executive summary */
        $data['dashboard_summary'] = $this->Dashboard_model->get_dashboard_summary($can_view_job_card, $can_view_scrap);
        $data['dashboard_notifications'] = $this->Dashboard_model->get_dashboard_notifications();

        /* Job cards */
        $data['active_job_cards'] = $this->Dashboard_model->get_active_job_cards();
        $data['Scheduled_job_cards_count'] = $this->Dashboard_model->get_Scheduled_job_cards_count();
        $data['active_job_cards_count'] = $this->Dashboard_model->get_active_job_cards_count();
        $data['InProgress_job_cards_count'] = $this->Dashboard_model->get_inprogress_job_cards_count();
        $data['finished_job_cards_count'] = $this->Dashboard_model->get_finished_job_cards_count();

        /* Purchase */
        $data['total_purchase_amount'] = $this->Dashboard_model->get_total_purchase_amount();
        $data['parts_po'] = $this->Dashboard_model->get_parts_po_summary();
        $data['service_po'] = $this->Dashboard_model->get_service_po_summary();

        /* Customer / vehicle */
        $data['customer_count'] = $this->Dashboard_model->get_customers_count();
        $data['vehicles_count'] = $this->Dashboard_model->get_vehicles_count();

        /* Existing operational widgets */
        $data['recent_estimations'] = $this->Dashboard_model->get_recent_estimations();
        $data['low_stock_items'] = $this->Dashboard_model->get_low_stock_items();
        $data['recent_inspections'] = $this->Dashboard_model->get_recent_inspections();
        $data['jobcardProgress'] = $this->Dashboard_model->get_jobcard_job_completion();
        $data['total_revenue'] = $this->Dashboard_model->get_total_revenue($can_view_job_card, $can_view_scrap);
        $data['balances'] = $this->Dashboard_model->get_cash_bank_balances();

        /* Revenue summary for current financial/dashboard period */
        $from_date = date('Y-m-01');
        $to_date   = date('Y-m-d');
        $data['revenueSummary'] = $this->Dashboard_model->get_revenue_summary($from_date, $to_date, $can_view_job_card, $can_view_scrap);

        /* Revenue chart filter */
        $revenue_filter = $this->input->get('revenue_filter', TRUE);
        $allowed_revenue_filters = [
            'last_week', 'last_month', '6_months', '12_months', 'full_revenue'
        ];

        if (!in_array($revenue_filter, $allowed_revenue_filters, TRUE)) {
            $revenue_filter = '12_months';
        }

        $data['revenue_filter'] = $revenue_filter;
        $data['revenue_collection_chart'] =
            $this->Dashboard_model->get_revenue_collection_chart($revenue_filter, $can_view_job_card, $can_view_scrap);

        /* Job card chart filter */
        $jobcard_status_filter = $this->input->get('jobcard_status_filter', TRUE);
        $allowed_jobcard_filters = [
            'last_week', 'last_month', '6_months', '12_months', 'full_jobcards'
        ];

        if (!in_array($jobcard_status_filter, $allowed_jobcard_filters, TRUE)) {
            $jobcard_status_filter = 'full_jobcards';
        }

        $data['jobcard_status_filter'] = $jobcard_status_filter;
        $data['jobcard_status_chart'] =
            $this->Dashboard_model->get_jobcard_status_chart($jobcard_status_filter);

        /* Quick actions */
        $quick_actions = [];
        if ($data['can_view_customers']) {
            $quick_actions[] = ['title' => 'New Customer', 'icon' => '👤', 'url' => base_url('index.php/customer/add')];
            $quick_actions[] = ['title' => 'New Vehicle', 'icon' => '🚗', 'url' => base_url('index.php/customer/add?from=vehicle')];
        }
        if ($data['can_view_jobcards']) {
            $quick_actions[] = ['title' => 'Job Card List', 'icon' => '📝', 'url' => base_url('index.php/Jobcard')];
        }
        if ($data['can_view_estimations']) {
            $quick_actions[] = ['title' => 'Estimation List', 'icon' => '📋', 'url' => base_url('index.php/estimation')];
        }
        if ($data['can_view_reports'] && $can_view_job_card) {
            $quick_actions[] = ['title' => 'New Invoice', 'icon' => '🧾', 'url' => base_url('index.php/invoice/generate')];
        }
        if ($data['can_view_purchase']) {
            $quick_actions[] = ['title' => 'Purchase Order', 'icon' => '📦', 'url' => base_url('index.php/Purchase/direct_po')];
        }
        $data['quick_actions'] = $quick_actions;

        $data['main_content'] = 'dashboard.php';
        $this->load->view('includes/template', $data);
    }
}
