<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		// $this->load->model('Notification_model');
		$this->load->model('Dashboard_model');
	}


	public function index()
	{
		$data['title'] 	 = "Dashboard";
		// Get session data
		$data['username'] = $this->session->userdata('username');
		$data['userid'] = $this->session->userdata('user_id');


		// Active Job Cards
		$data['active_job_cards'] = $this->Dashboard_model->get_active_job_cards();
		$data['Scheduled_job_cards_count'] = $this->Dashboard_model->get_Scheduled_job_cards_count();
		$data['active_job_cards_count'] = $this->Dashboard_model->get_active_job_cards_count();
		$data['InProgress_job_cards_count'] = $this->Dashboard_model->get_inprogress_job_cards_count();
		$data['finished_job_cards_count'] = $this->Dashboard_model->get_finished_job_cards_count();

		// $data['purchase_order_count'] = $this->Dashboard_model->get_purchase_order_count();
		$data['total_purchase_amount'] = $this->Dashboard_model->get_total_purchase_amount();
		$data['parts_po']   = $this->Dashboard_model->get_parts_po_summary();
		$data['service_po'] = $this->Dashboard_model->get_service_po_summary();
		// $data['grn_count'] = $this->Dashboard_model->get_grn_count();
		// $data['purchase_return_count'] = $this->Dashboard_model->get_purchase_return_count();

		$data['customer_count'] = $this->Dashboard_model->get_customers_count();
		$data['vehicles_count'] = $this->Dashboard_model->get_vehicles_count();

		$data['recent_estimations'] = $this->Dashboard_model->get_recent_estimations();
		$data['low_stock_items'] =  $this->Dashboard_model->get_low_stock_items();
		$data['recent_inspections'] =  $this->Dashboard_model->get_recent_inspections();
		$data['jobcardProgress'] = $this->Dashboard_model->get_jobcard_job_completion();
		// $data['revenueSummary'] = $this->Dashboard_model->get_revenue_summary();
		$data['total_revenue'] = $this->Dashboard_model->get_total_revenue();
		$data['balances'] = $this->Dashboard_model->get_cash_bank_balances();

		$from_date = '2020-01-01';
		$to_date   = date('Y-m-d');

		$data['revenueSummary'] =
			$this->Dashboard_model->get_revenue_summary($from_date, $to_date);
		// log_message('error', print_r($data['balances'], true));

// =========================================================
// REVENUE FILTER
// =========================================================

$revenue_filter = $this->input->get('revenue_filter');

// Default filter
if (empty($revenue_filter)) {

    $revenue_filter = '12_months';
}

// Allowed revenue filters
$allowed_filters = [
    'last_week',
    'last_month',
    '6_months',
    '12_months',
    'full_revenue'
];

// Validate filter
if (!in_array($revenue_filter, $allowed_filters, true)) {

    $revenue_filter = '12_months';
}

// Send selected filter to view
$data['revenue_filter'] = $revenue_filter;


// Get revenue chart data
$data['revenue_collection_chart'] =
    $this->Dashboard_model->get_revenue_collection_chart(
        $revenue_filter
    );


// =========================================================
// JOB CARD STATUS FILTER
// =========================================================

$jobcard_status_filter =
    $this->input->get('jobcard_status_filter');

// Default filter
if (empty($jobcard_status_filter)) {

    $jobcard_status_filter = '12_months';
}


// Allowed Job Card filters
$allowed_jobcard_filters = [
    'last_week',
    'last_month',
    '6_months',
    '12_months',
    'full_jobcards'
];


// Validate filter
if (
    !in_array(
        $jobcard_status_filter,
        $allowed_jobcard_filters,
        true
    )
) {

    $jobcard_status_filter = '12_months';
}


// Send selected filter to view
$data['jobcard_status_filter'] =
    $jobcard_status_filter;


// Get Job Card Status chart data
$data['jobcard_status_chart'] =
    $this->Dashboard_model->get_jobcard_status_chart(
        $jobcard_status_filter
    );

		$data['main_content'] = 'dashboard.php';
		$this->load->view('includes/template', $data);
	}


	// ==============================================
	// ðŸ”¸ Function: Get latest notifications
	// ==============================================
	// public function get_notifications()
	// {
	//     $user_id = $this->session->userdata('user_id');
	//     if (!$user_id) {
	//         echo json_encode([]);
	//         return;
	//     }

	//     $notifications = $this->Notification_model->get_user_notifications($user_id);
	//     echo json_encode($notifications);
	// }

	// ==============================================
	// ðŸ”¸ Function: Get unread notification count
	// ==============================================
	// public function unread_count()
	// {
	//     $user_id = $this->session->userdata('user_id');
	//     if (!$user_id) {
	//         echo json_encode(['count' => 0]);
	//         return;
	//     }

	//     $count = $this->Notification_model->count_unread($user_id);
	//     echo json_encode(['count' => $count]);
	// }

	// ==============================================
	// ðŸ”¸ Function: Mark a notification as read
	// ==============================================
	// public function mark_as_read($msg_id)
	// {
	//     $this->Notification_model->mark_as_read($msg_id);
	// }
}
