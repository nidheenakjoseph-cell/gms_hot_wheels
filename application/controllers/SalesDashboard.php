<?php defined('BASEPATH') or exit('No direct script access allowed');

class SalesDashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('SalesDashboard_model');

        $this->load->helper([
            'company_helper',
            'branch_helper',
            'menu_helper'
        ]);
    }

    /**
     * Sales Dashboard
     */
    public function index()
    {
        $data['title'] = 'Sales Dashboard';

        $user_id = (int) ($this->session->userdata('user_id') ?? 0);
        $user_role = strtolower(
            (string) ($this->session->userdata('role') ?? '')
        );

        $is_admin = ($user_role === 'admin');

        $company_id = (int) get_current_company_id();

        $data['username'] = $this->session->userdata('username');
        $data['userid']   = $user_id;

        $data['can_view_reports'] =
            $is_admin ||
            has_view_access($user_id, 'Reports/revenue');

        $data['can_view_customers'] =
            $is_admin ||
            has_view_access($user_id, 'customer');

        $company = $this->db
            ->select('company_name')
            ->where('company_id', $company_id)
            ->get('company_master')
            ->row();

        $data['company_name'] = $company
            ? $company->company_name
            : 'GMS';


        $data['allowed_branches'] = get_user_allowed_branches();

        $this->db
            ->select('customer_id, name')
            ->from('customers')
            ->where('company_id', $company_id)
            ->order_by('name', 'ASC');

        $data['customers'] = $this->db
            ->get()
            ->result();

        $data['main_content'] = 'sales_dashboard.php';

        $this->load->view('includes/template', $data);
    }


    /**
     * AJAX - Get Dashboard Data
     */
  
public function get_data()
{
    header('Content-Type: application/json; charset=utf-8');

    try {

        $start_date  = $this->input->post('start_date', true);
        $end_date    = $this->input->post('end_date', true);
        $branch_id   = $this->input->post('branch_id', true);
        $customer_id = $this->input->post('customer_id', true);
        $status      = $this->input->post('status', true);

        if (empty($start_date)) {
            $start_date = date('Y-m-01');
        }

        if (empty($end_date)) {
            $end_date = date('Y-m-d');
        }

        $filters = [
            'start_date'  => $start_date . ' 00:00:00',
            'end_date'    => $end_date . ' 23:59:59',
            'branch_id'   => !empty($branch_id) ? $branch_id : 'all',
            'customer_id' => !empty($customer_id) ? $customer_id : 'all',
            'status'      => !empty($status) ? $status : 'all'
        ];

        log_message('error', 'SalesDashboard filters: ' . print_r($filters, true));

        $response = [
            'status' => true,
            'kpis' => $this->SalesDashboard_model->get_kpis($filters),
            'charts' => [
                'trend' => $this->SalesDashboard_model->get_sales_trend_chart($filters),
                'collection_trend' => $this->SalesDashboard_model->get_collection_trend_chart($filters),
                'top_services' => $this->SalesDashboard_model->get_top_services($filters),
                'top_parts' => $this->SalesDashboard_model->get_top_parts($filters),
                'payment_status' => $this->SalesDashboard_model->get_payment_status_chart($filters)
            ],
            'recent_sales' => $this->SalesDashboard_model->get_recent_sales($filters),
            'customer_summary' => $this->SalesDashboard_model->get_customer_sales_summary($filters),
            'payment_summary' => $this->SalesDashboard_model->get_payment_collection_summary($filters)
        ];

        echo json_encode($response);

    } catch (Throwable $e) {

        log_message(
            'error',
            'SalesDashboard ERROR: ' .
            $e->getMessage() .
            ' | File: ' . $e->getFile() .
            ' | Line: ' . $e->getLine()
        );

        http_response_code(500);

        echo json_encode([
            'status' => false,
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
    }

    exit;
}


    /**
     * JSON Response
     */
    private function json_response($data, $http_status = 200)
    {
        return $this->output
            ->set_status_header($http_status)
            ->set_content_type('application/json')
            ->set_output(
                json_encode(
                    $data,
                    JSON_UNESCAPED_UNICODE |
                    JSON_UNESCAPED_SLASHES
                )
            );
    }
}