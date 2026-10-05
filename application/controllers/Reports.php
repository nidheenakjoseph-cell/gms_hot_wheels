<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Customer_model');
		$this->load->model('Vehicle_model');
		$this->load->model('Supplier_model');
		$this->load->model('Setup_model');
		$this->load->model('Reports_model');
		$this->load->model('SpareParts_model');

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	public function daily_jobs()
	{
		$this->load->model('Reports_model');

		$date = $this->input->get('date');
		if (empty($date)) {
			$date = date('Y-m-d');
		}

		$data['title'] = 'Daily Job Report';
		$data['date']  = $date;

		$from = $this->input->get('from') ?? date('Y-m-01');
		$to   = $this->input->get('to') ?? date('Y-m-d');
		$customer_id = $this->input->get('customer_id');

		$data['from']  = $from;
		$data['to']    = $to;
		$data['customers'] = $this->Customer_model->get_all_customers();
		$data['customer_id'] = $customer_id;

		if (!empty($customer_id)) {
			$customer = $this->Customer_model->get_customer($customer_id);
			$data['customer_name'] = $customer ? $customer->name : '';
		}

		$data['jobs']  = $this->Reports_model->get_daily_job_report($date, $customer_id);

		$data['main_content'] = 'reports/daily_jobs';
		$this->load->view('includes/template', $data);
	}

	public function over_stay_report()
	{
		$this->load->model('Reports_model');

		$date = $this->input->get('date') ?? date('Y-m-d');

		$data['title'] = 'Over Stay Report';
		$data['date']  = $date;


		// $from = $this->input->get('from') ?? date('Y-m-01');
		// $to   = $this->input->get('to') ?? date('Y-m-d');
		// $customer_id = $this->input->get('customer_id');

		// $data['from']  = $from;
		// $data['to']    = $to;
		// $data['customers'] = $this->Customer_model->get_all_customers();


		$data['jobs']  = $this->Reports_model->get_over_stay_report($date);

		$data['main_content'] = 'reports/over_stay_report';
		$this->load->view('includes/template', $data);
	}


	public function overnight_report()
	{
		$this->load->model('Reports_model');

		$date = $this->input->get('date') ?? date('Y-m-d');

		$data['title'] = 'Over Night Report';
		$data['date']  = $date;


		
		$data['jobs']  = $this->Reports_model->get_over_night_report($date);

		$data['main_content'] = 'reports/overnight_report';
		$this->load->view('includes/template', $data);
	}

	public function revenue()
	{
		$this->load->model('Reports_model');

		if (!user_can_access_page('Reports', 'revenue')) {
			deny_page_access();
			return;
		}

		$can_view_job_card = user_can_access_page('Jobcard', 'index');
		$can_view_scrap = user_can_access_page('Scrap', 'index');

		if (!$can_view_job_card && !$can_view_scrap) {
			deny_page_access();
			return;
		}

		$allowed_report_types = [];
		if ($can_view_job_card) {
			$allowed_report_types[] = 'job_card';
		}
		if ($can_view_scrap) {
			$allowed_report_types[] = 'scrap';
		}

		$from = $this->input->get('from') ?? date('Y-m-01');
		$to   = $this->input->get('to') ?? date('Y-m-d');
		$report_type = $this->input->get('report_type') ?? 'job_card';
		if (!in_array($report_type, $allowed_report_types, true)) {
			$report_type = $allowed_report_types[0] ?? null;
		}

		$status = $this->input->get('status') ?? $this->input->get('payment_status');
		$status = strtolower(trim((string)$status));
		$allowed_statuses = ['all', 'pending', 'unpaid', 'paid'];
		if (!in_array($status, $allowed_statuses, true)) {
			$status = '';
		}

		$data['title'] = 'Revenue Report';
		$data['from']  = $from;
		$data['to']    = $to;
		$data['report_type'] = $report_type;
		$data['status'] = $status;
		$data['can_view_job_card'] = $can_view_job_card;
		$data['can_view_scrap'] = $can_view_scrap;
		$data['has_revenue_report_access'] = !empty($allowed_report_types);
		$data['show_revenue_summary'] = ($can_view_job_card && $can_view_scrap && empty($status));

		$status_prefix = ($status === 'pending' || $status === 'unpaid')
			? 'Pending '
			: ($status === 'paid' ? 'Paid ' : '');

		$data['report_label'] = $report_type === 'scrap'
			? $status_prefix . 'Scrap Report'
			: ($report_type === 'job_card' ? $status_prefix . 'Job Card Report' : $status_prefix . 'Revenue Report');

		$job_card_reports = $can_view_job_card
			? $this->Reports_model->get_revenue_report($from, $to, 'job_card')
			: [];
		$scrap_reports = $can_view_scrap
			? $this->Reports_model->get_revenue_report($from, $to, 'scrap')
			: [];

		if ($status === 'pending' || $status === 'unpaid') {
			$job_card_reports = array_values(array_filter($job_card_reports, function ($r) {
				return ($r->payment_status ?? '') !== 'Paid';
			}));
			$scrap_reports = array_values(array_filter($scrap_reports, function ($r) {
				return ($r->payment_status ?? '') !== 'Paid';
			}));
		} elseif ($status === 'paid') {
			$job_card_reports = array_values(array_filter($job_card_reports, function ($r) {
				return ($r->payment_status ?? '') === 'Paid';
			}));
			$scrap_reports = array_values(array_filter($scrap_reports, function ($r) {
				return ($r->payment_status ?? '') === 'Paid';
			}));
		}

		$data['reports'] = $report_type === 'job_card'
			? $job_card_reports
			: ($report_type === 'scrap' ? $scrap_reports : []);
 
		// Calculate totals for current report type
		$data['total_revenue'] = array_sum(array_column($data['reports'], 'grand_total'));
		$data['total_tax']     = array_sum(array_column($data['reports'], 'tax_amount'));

		// Calculate revenue by type
		$data['job_card_revenue'] = array_sum(array_column($job_card_reports, 'grand_total'));
		$data['scrap_revenue']    = array_sum(array_column($scrap_reports, 'grand_total'));
		$data['combined_revenue'] = $data['job_card_revenue'] + $data['scrap_revenue'];

		// Calculate tax by type
		$data['job_card_tax'] = array_sum(array_column($job_card_reports, 'tax_amount'));
		$data['scrap_tax']    = array_sum(array_column($scrap_reports, 'tax_amount'));

		$data['main_content'] = 'reports/revenue';
		$this->load->view('includes/template', $data);
	}

	public function inventory_usage()
	{
		$this->load->model('Reports_model');

		$from = $this->input->get('from') ?? date('Y-m-01');
		$to   = $this->input->get('to') ?? date('Y-m-d');

		$data['title'] = 'Inventory Usage Report';
		$data['from']  = $from;
		$data['to']    = $to;

		$data['items'] = $this->Reports_model->get_inventory_usage_report($from, $to);


		$data['main_content'] = 'reports/inventory_usage';
		$this->load->view('includes/template', $data);
	}

	public function customer_visits()
	{
		$this->load->model('Reports_model');
		$this->load->model('Customer_model');

		$from = $this->input->get('from') ?? date('Y-m-01');
		$to   = $this->input->get('to') ?? date('Y-m-d');
		$customer_id = $this->input->get('customer_id');

		$data['title'] = 'Customer Visit History';
		$data['from']  = $from;
		$data['to']    = $to;

		$data['customers'] = $this->Customer_model->get_all_customers();
		$data['visits'] = $this->Reports_model
			->get_customer_visit_history($from, $to, $customer_id);


		$data['main_content'] = 'reports/customer_visits';
		$this->load->view('includes/template', $data);
	}
	// ============================================
	///////////////  RFQ Report ////////////////////
	function rfq_report()
	{
		$data['from'] = date('Y-m-01');
		$data['to'] = date('Y-m-d');
		$data['status'] = "";
		$data['title'] = "RFQ Report";
		$data['records'] = array();
		$data['supplier_id'] = "";
		$data['user_list'] = $this->Setup_model->get_all_users();
		$data['supplier_records'] = $this->Supplier_model->get_active_supplier_list();
		$data['main_content'] = 'reports/Purchase/rfq_report.php';
		$this->load->view('includes/template.php', $data);
	}
	function get_rfq_report()
	{
		$data['from'] = $this->input->post('from_date');
		$data['to'] = $this->input->post('to_date');
		$data['title'] = "RFQ Report";
		$data['created_by'] = $this->input->post('created_by');
		$data['supplier_id'] = $this->input->post('supplier_id');

		$data['supplier_records'] = $this->Supplier_model->get_active_supplier_list();
		$data['records'] = $this->Reports_model->get_rfq_report_records();
		$data['main_content'] = 'reports/Purchase/rfq_report.php';
		$this->load->view('includes/template.php', $data);
	}
	public function print_rfq_report()
	{
		$from_date = $this->input->get('from_date');
		$to_date = $this->input->get('to_date');
		$supplier_id = $this->input->get('supplier_id');
		$data['from'] = $from_date;
		$data['to'] = $to_date;
		$data['supplier_id'] = $supplier_id;
		// Fetch filtered records again
		$data['records'] = $this->Reports_model->get_rfq_report_records();

		$data['supplier_id'] = $supplier_id;

		$this->load->view('reports/Purchase/Print/print_rfq_report', $data);
	}


	///////////////  PO Report ////////////////////
	function po_report()
	{
		$data['from'] = date('Y-m-01');
		$data['to'] = date('Y-m-d');
		$data['status'] = "";
		$data['title'] = "Purchase Order Report";
		$data['supplier_id'] = "";
		$data['brand_id'] = "";
		$data['records'] = array();
		$data['user_list'] = $this->Setup_model->get_all_users();
		$data['supplier_records'] = $this->Supplier_model->get_active_supplier_list();
		$data['all_brands'] = $this->SpareParts_model->get_all_parts();
		$data['main_content'] = 'reports/Purchase/po_report.php';
		$this->load->view('includes/template.php', $data);
	}
	function get_po_report()
	{
		$data['from'] = $this->input->post('from_date');
		$data['to'] = $this->input->post('to_date');
		$data['title'] = "Purchase Order Report";
		$data['brand_id'] = $this->input->post('brand_id');
		$data['created_by'] = $this->input->post('created_by');
		$data['supplier_id'] = $this->input->post('supplier_id');
		$data['all_brands'] = $this->SpareParts_model->get_all_parts();
		$data['supplier_records'] = $this->Supplier_model->get_active_supplier_list();
		$data['records'] = $this->Reports_model->get_po_report_records();
		$data['main_content'] = 'reports/Purchase/po_report.php';
		$this->load->view('includes/template.php', $data);
	}

	public function export_po_excel()
	{
		$from_date = $this->input->get('from_date');
		$to_date   = $this->input->get('to_date');
		$supplier  = $this->input->get('supplier');

		// Convert to Y-m-d
		$from_date = !empty($from_date) ? date('Y-m-d', strtotime($from_date)) : '';
		$to_date   = !empty($to_date) ? date('Y-m-d', strtotime($to_date)) : '';
		log_message('error', 'FROM: ' . $from_date);
		log_message('error', 'TO: ' . $to_date);
		log_message('error', 'SUPPLIER: ' . $supplier);

		$po_list = $this->Reports_model->get_po_report($from_date, $to_date, $supplier);
		log_message('error', 'PO Report Data: ' . print_r($po_list, true));
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=PO_Report_" . date('Ymd') . ".xls");

		echo "<table border='1'>";
		echo "<tr>
            <th>Sr No</th>
            <th>PO Code</th>
            <th>PO Date</th>
            <th>Supplier</th>
            <th>Grand Total</th>
          </tr>";

		$i = 1;
		foreach ($po_list as $row) {
			echo "<tr>
                <td>" . $i++ . "</td>
                <td>" . $row->po_code . "</td>
                <td>" . date('d-M-Y', strtotime($row->po_date)) . "</td>
                <td>" . $row->supplier_name . "</td>
                <td>" . $row->grand_total . "</td>
              </tr>";
		}

		echo "</table>";
	}

	public function print_po_report()
	{
		$from_date = $this->input->get('from_date');
		$to_date = $this->input->get('to_date');
		$supplier_id = $this->input->get('supplier_id');
		// $brand_id = $this->input->get('brand_id');
		$data['from'] = $from_date;
		$data['to'] = $to_date;
		$data['supplier_id'] = $supplier_id;
		// $data['brand_id'] = $brand_id;
		// Fetch filtered records again
		$data['records'] = $this->Reports_model->get_po_report_records();

		$data['supplier_id'] = $supplier_id;

		$this->load->view('reports/Purchase/Print/print_po_report', $data);
	}
	///////////////  GRN Report ////////////////////
	function grn_report()
	{
		$data['from'] = date('Y-m-01');
		$data['to'] = date('Y-m-d');
		$data['status'] = "";
		$data['title'] = "Goods Received Note Report";
		$data['supplier_id'] = "";
		$data['records'] = array();
		$data['user_list'] = $this->Setup_model->get_all_users();
		$data['supplier_records'] = $this->Supplier_model->get_active_supplier_list();
		$data['main_content'] = 'reports/Purchase/grn_report.php';
		$this->load->view('includes/template.php', $data);
	}
	function get_grn_report()
	{
		$data['from'] = $this->input->post('from_date');
		$data['to'] = $this->input->post('to_date');
		$data['title'] = "Goods Received Note Report";
		$data['created_by'] = $this->input->post('created_by');
		$data['supplier_id'] = $this->input->post('supplier_id');

		$data['supplier_records'] = $this->Supplier_model->get_active_supplier_list();
		$data['records'] = $this->Reports_model->get_grn_report_records();
		$data['main_content'] = 'reports/Purchase/grn_report.php';
		$this->load->view('includes/template.php', $data);
	}
	public function print_grn_report()
	{
		$from_date = $this->input->get('from_date');
		$to_date = $this->input->get('to_date');
		$supplier_id = $this->input->get('supplier_id');
		$data['from'] = $from_date;
		$data['to'] = $to_date;
		$data['supplier_id'] = $supplier_id;
		// Fetch filtered records again
		$data['records'] = $this->Reports_model->get_grn_report_records();

		$data['supplier_id'] = $supplier_id;

		$this->load->view('reports/Purchase/Print/print_grn_report', $data);
	}

	// ================================================

	public function employee_report()
	{
		$this->load->model('Employee_model');
		$this->load->model('Setup_model');

		// Dropdowns
		$data['user_records'] = $this->Employee_model->get_all_employees();
		$data['departments'] = $this->Employee_model->get_departments();
		$data['designations'] = $this->Employee_model->get_designations_with_department();

		// Initialize filters and records
		$data['user_id'] = '';
		$data['selected_dept'] = '';
		$data['selected_desig'] = '';
		$data['records'] = [];
		$data['is_generated'] = false;  // Initialize flag

		// Check if form is submitted
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$user_id = $this->input->post('user_id');
			$dept_id = $this->input->post('department_id');
			$desig_id = $this->input->post('designation_id');

			$filters = [];

			// âœ… PRIORITY: Employee filter
			if (!empty($user_id)) {
				$filters['user_id'] = $user_id;
			} else {
				// Only apply these if employee NOT selected
				if (!empty($dept_id)) {
					$filters['department_id'] = $dept_id;
				}

				if (!empty($desig_id)) {
					$filters['designation_id'] = $desig_id;
				}
			}

			// Fetch filtered data
			$data['records'] = $this->Employee_model->get_filtered_employees($filters);
			$data['user_id'] = $user_id;
			$data['selected_dept'] = $dept_id;
			$data['selected_desig'] = $desig_id;
			$data['is_generated'] = true;
		}

		$data['title'] = 'Employee Master Report';
		$data['main_content'] = 'reports/employee_report.php';
		$this->load->view('includes/template.php', $data);
	}


	public function print_employee_report()
	{
		$this->load->model('Employee_model');
		$this->load->model('Setup_model');

		// Fetch filters from POST
		$user_id = $this->input->post('user_id');
		$dept_id = $this->input->post('department_id');
		$desig_id = $this->input->post('designation_id');
		$is_generated = $this->input->post('is_generated');

		// Set filters array
		$filters = [
			'user_id' => $user_id,
			'department_id' => $dept_id,
			'designation_id' => $desig_id,
		];

		// Ensure print only if report was generatedprint_employee_report
		if ($is_generated !== '1') {
			$data['records'] = [];  // Show "No records found"
		} else {
			$data['records'] = $this->Employee_model->get_filtered_employees($filters);
		}

		// Other data
		$data['title'] = 'Employee Master Report';
		$data['filters'] = $filters;
		$data['user_id'] = $user_id;
		$data['departments'] = $this->Employee_model->get_departments();
		$data['designations'] = $this->Employee_model->get_designations_with_department();
		$data['user_records'] = $this->Setup_model->get_all_users();

		// Load print view
		$this->load->view('Print/print_employee_report', $data);
	}

	public function export_employee_report()
	{

		$this->load->model('Employee_model');
		$this->load->model('Setup_model');

		// Fetch filters from POST
		$user_id = $this->input->post('user_id');
		$dept_id = $this->input->post('department_id');
		$desig_id = $this->input->post('designation_id');
		$is_generated = $this->input->post('is_generated');

		// Set filters array
		$filters = [
			'user_id' => $user_id,
			'department_id' => $dept_id,
			'designation_id' => $desig_id,
		];
		// Only load data if report was generated
		if ($is_generated !== '1') {
			$data['records'] = [];
		} else {
			$data['records'] = $this->Employee_model->get_filtered_employees($filters);
		}
		// Pass data to view
		$data['title'] = 'Employee Master Report';
		$data['filters'] = $filters;
		$data['user_id'] = $user_id;
		$data['departments'] = $this->Employee_model->get_departments();
		$data['designations'] = $this->Employee_model->get_designations_with_department();
		$data['user_records'] = $this->Setup_model->get_all_users();

		$this->load->view('excel_reports/export_employee_report', $data);
	}


	public function monthly_leave_report()
	{
		$this->load->model('Hr_model');
		$this->load->model('Setup_model');

		// Default filters
		$month = $this->input->post('month') ?? date('Y-m');
		$dept_id = $this->input->post('department_id') ?? '';

		// Fetch dropdown data
		$this->load->model('Employee_model');
		$data['departments'] = $this->Employee_model->get_departments();

		// Fetch leave report
		$data['records'] = $this->Hr_model->get_monthly_leave_report($month, $dept_id);

		// Filters for reuse in view
		$data['selected_month'] = $month;
		$data['selected_dept'] = $dept_id;

		// Page details
		$data['title'] = 'Monthly Leave Report';
		$data['main_content'] = 'reports/monthly_leave_report.php';
		$this->load->view('includes/template', $data); // Corrected template load
	}


	public function print_monthly_leave_report()
	{
		$this->load->model('Hr_model');
		$this->load->model('Setup_model');

		$month = $this->input->post('month');
		$dept_id = $this->input->post('department_id');

		$data['records'] = $this->Hr_model->get_monthly_leave_report($month, $dept_id);
		$data['selected_month'] = $month;
		$data['selected_dept'] = $dept_id;
		$data['departments'] = $this->Setup_model->get_department_list();

		$this->load->view('Print/print_monthly_leave_report', $data);
	}

	public function export_monthly_leave_report()
	{
		$this->load->model('Hr_model');
		$this->load->model('Setup_model');

		$month = $this->input->post('month');
		$dept_id = $this->input->post('department_id');

		$data['records'] = $this->Hr_model->get_monthly_leave_report($month, $dept_id);
		$data['selected_month'] = $month;

		if (!empty($dept_id)) {
			$dept = $this->Setup_model->get_department_by_id($dept_id);
			$data['selected_dept_name'] = $dept->dept_name ?? 'Unknown';
		} else {
			$data['selected_dept_name'] = 'All';
		}

		$this->load->view('excel_reports/export_monthly_leave_report', $data);
	}

	public function monthly_attendance_report()
	{
		$this->load->model('Hr_model');
		$this->load->model('Setup_model');

		// $data['departments'] = $this->Setup_model->get_department_list();
		$this->load->model('Employee_model');
		$data['departments'] = $this->Employee_model->get_departments();

		$data['records'] = [];
		$data['from_date'] = '';
		$data['to_date'] = '';
		$data['selected_dept'] = '';

		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$from_date = $this->input->post('from_date');
			$to_date   = $this->input->post('to_date');
			$dept_id = $this->input->post('department_id');



			$data['records'] = $this->Hr_model->get_monthly_attendance_summary($from_date, $to_date, $dept_id);
			$data['from_date'] = $from_date;
			$data['to_date'] = $to_date;
			$data['selected_dept'] = $dept_id;
		}

		$data['title'] = 'Monthly Attendance Report';
		$data['main_content'] = 'reports/monthly_attendance_report.php';
		$this->load->view('includes/template.php', $data);
	}


	public function print_monthly_attendance_report()
	{
		$this->load->model('Hr_model');
		$this->load->model('Setup_model');

		// Accept POST or GET
		$from_date = $this->input->post('from_date') ?? $this->input->get('from_date');
		$to_date   = $this->input->post('to_date') ?? $this->input->get('to_date');
		$dept_id   = $this->input->post('department_id') ?? $this->input->get('department_id');

		$data['records'] = [];
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;
		$data['selected_dept'] = $dept_id;
		$data['departments'] = $this->Setup_model->get_department_list();

		if (!empty($from_date) && !empty($to_date)) {
			$data['records'] = $this->Hr_model->get_monthly_attendance_summary(
				$from_date,
				$to_date,
				$dept_id
			);
		}

		$this->load->view('Print/print_monthly_attendance_report', $data);
	}


	public function export_monthly_attendance_report()
	{
		$this->load->model('Hr_model');
		$this->load->model('Setup_model');

		$from_date = $this->input->post('from_date');
		$to_date   = $this->input->post('to_date');
		$dept_id = $this->input->post('department_id');
		// Set basic data
		$data['records'] = [];
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;
		$data['selected_dept'] = $dept_id;
		$data['departments'] = $this->Setup_model->get_department_list();

		// Fetch only if month is posted (i.e., report was generated)
		if (!empty($from_date) && !empty($to_date)) {
			$data['records'] = $this->Hr_model->get_monthly_attendance_summary($from_date, $to_date, $dept_id);
		}


		$this->load->view('excel_reports/export_monthly_attendance_report', $data);
	}

	public function monthly_payroll_report()
	{
		$this->load->model('Hr_model');
		$this->load->model('Users_model');
		$this->load->model('Setup_model');

		$selected_month = $this->input->post('month') ?? date('Y-m');
		$selected_dept = $this->input->post('department_id') ?? '';
		$user_id = $this->input->post('user_id') ?? '';
		$generate = (int) ($this->input->post('generate') ?? 0);

		// Clear session when page is loaded without Generate
		if ($this->input->server('REQUEST_METHOD') === 'GET' || $generate !== 1) {
			$this->session->unset_userdata('payroll_filters');
		}

		$data = [
			'selected_month' => $selected_month,
			'selected_dept' => $selected_dept,
			'user_id' => $user_id,
			'departments' => $this->Setup_model->get_department_list(),
			'user_records' => $this->Users_model->get_user_list(),
			'records' => null,
			'days_in_month' => null,
			'holiday_count' => null,
			'generate' => $generate,
			'title' => 'Monthly Payroll Report',
			'main_content' => 'Reports/monthly_payroll_report.php',
		];

		if ($generate === 1 && !empty($selected_month)) {
			$days_in_month = date('t', strtotime($selected_month));

			// Store to session when generated
			$this->session->set_userdata('payroll_filters', [
				'month' => $selected_month,
				'department_id' => $selected_dept,
				'user_id' => $user_id,
				'generate' => true
			]);

			$data['days_in_month'] = $days_in_month;
			$filters = [
				'month' => $selected_month,
				'department_id' => $selected_dept,
				'user_id' => $user_id,
			];
			$data['records'] = $this->Hr_model->get_monthly_payroll_report($filters);
			$data['holiday_count'] = $this->Hr_model->get_emp_holiday_count();

			foreach ($data['records'] as &$record) {
				$record->days_in_month = $days_in_month;
				$record->selected_month = $selected_month;
				$record->holiday_count = $data['holiday_count'];
			}
		}

		$this->load->view('includes/template', $data);
	}


	public function print_monthly_payroll_report()
	{
		$this->load->model('Hr_model');
		$this->load->model('Users_model');
		$this->load->model('Setup_model');

		// Get filters from session
		$filters = $this->session->userdata('payroll_filters');

		$selected_month = $filters['month'] ?? '';
		$selected_dept = $filters['department_id'] ?? '';
		$user_id = $filters['user_id'] ?? '';
		$is_generated = isset($filters['generate']) && $filters['generate'] === true;

		$data = [
			'selected_month' => $selected_month,
			'selected_dept' => $selected_dept,
			'user_id' => $user_id,
			'departments' => $this->Setup_model->get_department_list(),
			'user_records' => $this->Users_model->get_user_list(),
			'days_in_month' => 0,
			'records' => [],
			'holiday_count' => $this->Hr_model->get_emp_holiday_count(),
			'generate_flag' => $is_generated,
		];

		if ($is_generated && !empty($selected_month)) {
			$data['days_in_month'] = date('t', strtotime($selected_month));
			$filter_data = [
				'month' => $selected_month,
				'department_id' => $selected_dept,
				'user_id' => $user_id,
			];
			$data['records'] = $this->Hr_model->get_monthly_payroll_report($filter_data);
		}

		$this->load->view('Print/print_monthly_payroll_report', $data);
	}


	public function export_monthly_payroll_report()
	{
		$this->load->model('Hr_model');
		$this->load->model('Users_model');
		$this->load->model('Setup_model');

		$filters = $this->session->userdata('payroll_filters') ?? [];

		$selected_month = $filters['month'] ?? '';
		$selected_dept = $filters['department_id'] ?? '';
		$user_id = $filters['user_id'] ?? '';
		$is_generated = !empty($filters['generate']);

		$data = [
			'selected_month' => $selected_month,
			'selected_dept' => $selected_dept,
			'user_id' => $user_id,
			'departments' => $this->Setup_model->get_department_list(),
			'user_records' => $this->Users_model->get_user_list(),
			'days_in_month' => 0,
			'records' => [],
			'holiday_count' => $this->Hr_model->get_emp_holiday_count(),
			'generate_flag' => $is_generated,
		];

		if ($is_generated && !empty($selected_month) && strtotime($selected_month) !== false) {
			$data['days_in_month'] = date('t', strtotime($selected_month));
			$filter_data = [
				'month' => $selected_month,
				'department_id' => $selected_dept,
				'user_id' => $user_id,
			];
			$data['records'] = $this->Hr_model->get_monthly_payroll_report($filter_data);
		}

		$this->load->view('excel_reports/export_monthly_payroll_report', $data);
	}
	
	//fleet_service_reports

	
	public function fleet_soa()
	{
		$customer_id  = $this->input->get('customer_id');
		$from         = $this->input->get('from');
		$to           = $this->input->get('to');
		$vehicle_id   = $this->input->get('vehicle_id');
		$aging_filter   = $this->input->get('aging_filter');
		$payment_filter = null;

		$data['title']            = 'Fleet Statement of Account';
		$data['from']             = $from;
		$data['to']               = $to;
		$data['customer_id']      = $customer_id;
		$data['vehicle_id']       = $vehicle_id;
		$data['aging_filter']     = $aging_filter;
		$data['payment_filter']   = $payment_filter;
		$data['fleet_customers'] = $this->Reports_model->get_fleet_customers();
		$data['soa']             = [];
		$data['summary']         = [];
		$data['customer']        = null;
		$data['customer_vehicles']    = [];
		$data['vehicles_with_inv']    = [];

		if (!empty($customer_id)) {
			$data['soa']               = $this->Reports_model->get_fleet_soa($customer_id, $from, $to, $vehicle_id, $aging_filter, null, $payment_filter);
			$data['summary']           = $this->Reports_model->get_fleet_soa_summary($customer_id, $from, $to, $vehicle_id, $aging_filter, null, $payment_filter);
			$data['customer']          = $this->Reports_model->get_customer_by_id($customer_id);
			$data['customer_vehicles'] = $this->Reports_model->get_vehicles_by_customer($customer_id);
			$data['vehicles_with_inv'] = $this->Reports_model->get_vehicles_with_invoice_summary($customer_id, $from, $to, $vehicle_id, $aging_filter, null, $payment_filter);
		}

		$data['main_content'] = 'reports/fleet_soa';
		$this->load->view('includes/template', $data);
	}

    public function print_fleet_soa()
    {
        $customer_id  = $this->input->get('customer_id');
        $from         = $this->input->get('from');
        $to           = $this->input->get('to');
        $vehicle_id   = $this->input->get('vehicle_id');
        $aging_filter = $this->input->get('aging_filter');

        if (empty($customer_id)) {
            show_error('Customer not specified');
        }

        $payment_filter = null;

        $data['customer']       = $this->Reports_model->get_customer_by_id($customer_id);
        $data['soa']            = $this->Reports_model->get_fleet_soa($customer_id, $from, $to, $vehicle_id, $aging_filter, null, $payment_filter);
       	$data['summary']        = $this->Reports_model->get_fleet_soa_summary($customer_id, $from, $to, $vehicle_id, $aging_filter, null, $payment_filter);
        $data['from']           = $from;
        $data['to']             = $to;
        $data['customer_id']    = $customer_id;
        $data['vehicle_id']     = $vehicle_id;
        $data['aging_filter']   = $aging_filter;
        $data['payment_filter'] = $payment_filter;

        $this->load->model('Setup_model');
        $data['company']   = $this->db->get('company_master')->row();

        $this->load->view('reports/print/print_fleet_soa', $data);
    }

	public function total_sales()
	{
		$from = $this->input->get('from') ?: date('Y-m-d');
		$to   = $this->input->get('to') ?: date('Y-m-d');

		$data['title']      = 'Total Sales Report';
		$data['from']       = $from;
		$data['to']         = $to;
		$data['from_date']  = $from;
		$data['to_date']    = $to;
		$data['customers']  = $this->Customer_model->get_all_customers();

		$data['main_content'] = 'reports/total_sales';
		$this->load->view('includes/template', $data);
	}
	public function total_sales_data()
	{
		$this->load->model('Reports_model');

		$from_date = $this->input->post('from_date');
		$to_date   = $this->input->post('to_date');

		$branch_id      = $this->input->post('branch_id');
		$customer_id    = $this->input->post('customer_id');
		$payment_status = $this->input->post('payment_status');
		$invoice_no     = $this->input->post('invoice_no');

		if (empty($from_date)) {
			$from_date = date('Y-m-d');
		}

		if (empty($to_date)) {
			$to_date = date('Y-m-d');
		}

		if ($from_date > $to_date) {
			$this->output
				->set_status_header(422)
				->set_content_type('application/json')
				->set_output(json_encode(array(
					'status'  => false,
					'message' => 'The start date cannot be after the end date.'
				)));
			return;
		}

		$filters = array(
			'from_date'      => $from_date,
			'to_date'        => $to_date,
			'branch_id'      => $branch_id,
			'customer_id'    => $customer_id,
			'payment_status' => $payment_status,
			'invoice_no'     => $invoice_no
		);

		$summary = $this->Reports_model->get_total_sales_summary($filters);
		$details = $this->Reports_model->get_total_sales_details($filters);
		$daily   = $this->Reports_model->get_daily_sales_summary($filters);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array(
			'status'  => true,
			'summary' => $summary,
			'details' => $details,
			'daily'   => $daily
		)));
	}
}

