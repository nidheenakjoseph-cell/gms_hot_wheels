<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Quotation extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Quotation_model');
		$this->load->model('Estimation_model');
		$this->load->model('Inspection_view_model');
		$this->load->model('SpareParts_model');
		$this->load->model('Customer_model');
		$this->load->model('Vehicle_model');
		$this->load->model('Jobcard_model');
		$this->load->helper('amount');
	}

	/**
	 * Quotation listing page
	 */
	public function index()
	{
		$data['title'] = 'Quotation List';
		$data['quotations'] = $this->Quotation_model->get_all_quotations();
		$company_id = get_current_company_id();
		$wa_settings = $this->db->get_where('whatsapp_settings', ['company_id' => $company_id])->row();
		$data['whatsapp_enabled'] = !empty($wa_settings->whatsapp_enabled);

		$data['main_content'] = 'quotation/list';
		$this->load->view('includes/template', $data);
	}

	/**
	 * Create jobcard from quotation
	 */
	public function create_jobcard($quotation_id)
	{

		$data['username'] = $this->session->userdata('username');
		$data['userid'] = $this->session->userdata('user_id');
		$jobcard_id = $this->Quotation_model->create_jobcard_from_quotation($quotation_id);

		if ($jobcard_id) {
			redirect('jobcard/view/' . $jobcard_id);
		} else {
			show_error('Unable to create job card');
		}
	}


	/* =====================================================
       AUTO CREATE QUOTATION AFTER ESTIMATION APPROVAL
       ===================================================== */
	public function create_from_estimation($estimation_id)
	{

		// 1. Fetch estimation
		$estimation = $this->Estimation_model->get_estimation_by_id($estimation_id);

		if (!$estimation) {
			show_error('Estimation not found');
		}

		// 2. Allow only approved estimation
		if ($estimation->status !== 'Approved') {
			$this->session->set_flashdata(
				'error',
				'Quotation can be created only after customer approval'
			);
			redirect('estimation/view/' . $estimation_id);
		}

		// 3. Create quotation
		$quotation_id = $this->Quotation_model
			->create_from_estimation($estimation_id);

		if (!$quotation_id) {
			show_error('Failed to create quotation');
		}

		// 4. Update estimation status (optional but recommended)
		$this->db
			->where('estimation_id', $estimation_id)
			->update('estimations', [
				'status' => 'Converted'
			]);

		// 5. Redirect to quotation edit page
		redirect('quotation/edit/' . $quotation_id);
	}

	/* =========================
       EDIT QUOTATION PAGE
       ========================= */
	public function edit($quotation_id)
	{

		$data['username'] = $this->session->userdata('username');
		$data['userid'] = $this->session->userdata('user_id');
		$data['quotation'] = $this->Quotation_model->get_quotation($quotation_id);

		if (!$data['quotation']) {
			show_404();
		}


		// 1ï¸âƒ£ Get estimation header
		$estimation = $this->Estimation_model->get_estimation_by_id($data['quotation']->estimation_id);
		if (!$estimation) show_404();
		// Customer from inspection
		$customer = $this->Customer_model->get_customer($data['quotation']->customer_id);
        $inspection = $this->Inspection_view_model->get_by_inspection($data['quotation']->inspection_id);

			if($data['quotation']->vehicle_id == 0 || $data['quotation']->vehicle_id == null) {
				$vehicle_id = $estimation->vehicle_id??$inspection->vehicle_id??null;
			} else {
				$vehicle_id = $data['quotation']->vehicle_id;
			}
		// Vehicle from inspection
		$vehicle = $this->Vehicle_model->get_vehicle($vehicle_id);

		// Get all vehicles for this customer
		$all_vehicles = $this->Vehicle_model
			->get_vehicles_by_customer($data['quotation']->customer_id);

		// 2ï¸âƒ£ Appointment + customer + vehicle
		$appointment = $this->Estimation_model->get_appointment_details($data['quotation']->appointment_id);

		// 3ï¸âƒ£ Sub tables
		$job_descriptions = $this->Quotation_model->get_job_descriptions($quotation_id);



		$parts_used_new = $this->Quotation_model
			->get_parts_type($quotation_id, "New Parts");

		$parts_used_after = $this->Quotation_model
			->get_parts_type($quotation_id, "Aftermarket Parts");

		$parts_used_used = $this->Quotation_model
			->get_parts_type($quotation_id, "Used Parts");
		// $parts_used_new = $this->Quotation_model->get_parts_type($quotation_id, "New Parts");

		// $parts_used_after = $this->Quotation_model->get_parts_type($quotation_id, "Aftermarket Parts");

		// $parts_used_used = $this->Quotation_model->get_parts_type($quotation_id, "Used Parts");

		// log_message('error', 'New Parts: ' . print_r($parts_used_new, true));
		// log_message('error', 'Aftermarket Parts: ' . print_r($parts_used_after, true));
		// log_message('error', 'Used Parts: ' . print_r($parts_used_used, true));
		// =============================================
		
		// if ($data['quotation']->status == 'Approved') {
		// 	$services_used = $this->Quotation_model->get_services($data['quotation']->quotation_id);
		// } else {
			$services_used = $this->Quotation_model->get_services($quotation_id);
		// }

		$inspection = $this->Inspection_view_model->get_by_inspection($data['quotation']->inspection_id);
		$data['parts'] = $this->SpareParts_model->get_all_parts();
		$data['brands'] = $this->SpareParts_model->get_all_brands();
		$data['vehicle_brands'] = $this->Vehicle_model->get_all_brands();
		$data['services_master'] = $this->db->where('status', 'Active')->get('services_master')->result();
		$data['kms'] = $inspection->km_reading ?? $estimation->kmin;
		$data['service_discount'] = $data['quotation']->srvice_discount ?? null;
		$data['sublet_discount'] = $data['quotation']->sublet_discount ?? null;
		$data['estimation']       = $estimation;
		$data['appointment']      = $appointment;
		$data['job_descriptions'] = $job_descriptions;

		$data['customer']      = $customer;
		$data['vehicle']      = $vehicle;
		$data['all_vehicles'] = $all_vehicles;

		$data['parts_used_new']       = $parts_used_new;
		$data['parts_used_after']       = $parts_used_after;
		$data['parts_used_used']       = $parts_used_used;

		// log_message('error', 'DATA parts_used_new: ' . print_r($data['parts_used_new'], true));
		// log_message('error', 'DATA parts_used_after: ' . print_r($data['parts_used_after'], true));
		// log_message('error', 'DATA parts_used_used: ' . print_r($data['parts_used_used'], true));

		$data['services_used']    = $services_used;

		$data['usedbrands'] = $this->SpareParts_model->get_brands_by_part_type("Used Parts");
		$data['newbrands'] = $this->SpareParts_model->get_brands_by_part_type("New Parts");
		$data['afterbrands'] = $this->SpareParts_model->get_brands_by_part_type("Aftermarket Parts");

		$data['Newparts'] = $this->SpareParts_model->get_parts_by_part_type("New Parts");

		$data['afterparts'] = $this->SpareParts_model->get_parts_by_part_type("Aftermarket Parts");
		$data['usedparts'] = $this->SpareParts_model->get_parts_by_part_type("Used Parts");


		$data['estimation_id'] = $estimation->estimation_id;
		$data['estimation_no'] = $estimation->estimation_no;


		$data['parts']    = $this->Quotation_model->get_parts($quotation_id);
		$data['services'] = $this->Quotation_model->get_services($quotation_id);

		$data['locked'] = ($data['quotation']->status === 'Approved');

		$data['title'] = 'Quotation Edit';

		// âœ… FIX IS HERE
		$data['main_content'] = 'quotation/edit';

		$this->load->view('includes/template', $data);
	}

	public function edit_by_estimation($estimation_id)
	{
		// 1. Check estimation exists
		$estimation = $this->db
			->where('estimation_id', $estimation_id)
			->get('estimations')
			->row();

		if (!$estimation) {
			show_404();
		}


		// 2. Check if quotation already exists
		$quotation = $this->db
			->where('estimation_id', $estimation_id)
			// ->where('revision_no', 1)
			->get('quotations')
			->row();

		// 3. If NOT exists â†’ create quotation
		if (!$quotation) {

			// âœ… Customer approval check
			if ($estimation->customer_approval !== 'APPROVED') {

				$this->session->set_flashdata(
					'error',
					'Customer approval is not done yet. Please get approval before creating quotation.'
				);

				redirect('Estimation/edit/' . $estimation_id);
				return;
			}

			// âœ… Spare parts selection check (ONLY if parts exist)
			$total_parts_count = $this->db
				->where('estimation_id', $estimation_id)
				->count_all_results('estimation_parts');

			if ($total_parts_count > 0) {
				log_message('error', $total_parts_count);

				$selected_parts_count = $this->db
					->where('estimation_id', $estimation_id)
					->where('selected', 1)
					->count_all_results('estimation_parts');

				if ($selected_parts_count == 0) {

					$this->session->set_flashdata(
						'error',
						'Please select which spare parts are being used before proceeding to quotation.'
					);

					redirect('Estimation/edit/' . $estimation_id);
					return;
				}
			}

			// âœ… Safe to create quotation
			$quotation_id = $this->Quotation_model
				->create_from_estimation($estimation_id);
		} else {




			log_message('error', "quotation exist");
			$quotation_id = $quotation->quotation_id;
		}


		// 4. Redirect to quotation edit page
		redirect('Quotation/edit/' . $quotation_id);
	}


	/* =========================
       UPDATE QUOTATION
       ========================= */


	public function update()
	{

		$data['username'] = $this->session->userdata('username');
		$data['userid'] = $this->session->userdata('user_id');
		$quotation_id = $this->input->post('quotation_id');
		$status       = $this->input->post('quotation_status');

		// $this->Quotation_model->update_quotation($quotation_id, [
		// 	'status' => $status
		// ]);

		$post = $this->input->post();

		$this->Quotation_model->update_quotation($quotation_id, [
			'subtotal'    => $post['subtotal'],
			'tax_amount'  => $post['tax_amount'],
			'tdiscount'    => $post['totdiscount'],
			'grand_total' => $post['grand_total'],
			'remarks'     => $post['remarks'],
			'status' => "Approved",
			'srvice_discount'     => $this->input->post('service_discount'),
			'sublet_discount' => $this->input->post('sublet_discount'),
			'quotation_date' => $this->input->post('quote_date'),
			'vehicle_id'   => $this->input->post('vehicle_id'),
			'kmin'         => $this->input->post('kmin'),
            'branch_id'    => $this->input->post('branch_id') ?: get_primary_branch_id(),
			// parts
			'part_id'        => $post['part_id'] ?? [],
			'part_qty'       => $post['part_qty'] ?? [],
			'unit_price'     => $post['unit_price'] ?? [],
			'selling_price'  => $post['selling_price'] ?? [],
			'total_price'    => $post['total_price'] ?? [],
			'discount'       => $post['discount'] ?? [],
			'discountamt'    => $post['discountamt'] ?? [],
			'part_type'      => $post['part_type'] ?? [],
			'customer_selected' => $post['customer_selected'] ?? [],
			'partremarks' => $post['part_warrenty'] ?? [],


			// services
			'service_id'     => $post['service_id'] ?? [],
			'service_time'   => $post['service_time'] ?? [],
			'service_cost'   => $post['service_cost'] ?? [],
			'total_cost'     => $post['total_cost'] ?? [],

			// sublet services
			'job_description'     => $post['job_description'] ?? [],
			'job_amount'   => $post['job_amount'] ?? [],

		]);


		$quotation_row = $this->db->where('quotation_id', $quotation_id)->get('quotations')->row();
		$selected_vehicle_id = $this->input->post('vehicle_id') ?: ($quotation_row->vehicle_id ?? null);
		$selected_kmin = $this->input->post('kmin');

		if ($quotation_row) {
			$this->db->where('estimation_id', $quotation_row->estimation_id)
				->update('estimations', [
					'vehicle_id' => $selected_vehicle_id,
					'kmin' => $selected_kmin
				]);

			if (!empty($quotation_row->inspection_id)) {
				$this->db->where('inspection_id', $quotation_row->inspection_id)
					->update('inspections', [
						'vehicle_id' => $selected_vehicle_id,
						'km_reading' => $selected_kmin
					]);
			}

			$this->db->where('quotation_id', $quotation_id)
				->update('job_cards', [
					'vehicle_id' => $selected_vehicle_id,
					'km_in' => $selected_kmin
				]);
		}

		// If approved â†’ create job card
		// If approved â†’ create job card ONLY IF NOT EXISTS
		if ($status === 'Approved') {



			$parent_quote_id = $this->Quotation_model->get_by_quotation_parentid($quotation_id);

			if ($parent_quote_id) {
				$existing_jobcard = $this->Jobcard_model->get_by_quotation_id($parent_quote_id);
			} else {
				$existing_jobcard = $this->Jobcard_model->get_by_quotation_id($quotation_id);
			}


			if (!$existing_jobcard) {
				// $jobcard_id = $this->Jobcard_model->create_from_quotation($quotation_id);
			}
		}


		redirect('quotation/edit/' . $quotation_id);
	}



	public function viewold($quotation_id)
	{

		$data['username'] = $this->session->userdata('username');
		$data['userid'] = $this->session->userdata('user_id');
		$data['quotation'] = $this->Quotation_model->get_quotation($quotation_id);

		if (!$data['quotation']) {
			show_404();
		}


		// 1ï¸âƒ£ Get estimation header
		$estimation = $this->Estimation_model->get_estimation_by_id($data['quotation']->estimation_id);
		if (!$estimation) show_404();

		// Customer from inspection
		$customer = $this->Customer_model->get_customer($data['quotation']->customer_id);

		// Vehicle from inspection
		$vehicle = $this->Vehicle_model->get_vehicle($data['quotation']->vehicle_id);

		// 2ï¸âƒ£ Appointment + customer + vehicle
		$appointment = $this->Estimation_model->get_appointment_details($data['quotation']->appointment_id);

		// 3ï¸âƒ£ Sub tables
		$job_descriptions = $this->Estimation_model->get_job_descriptions($data['quotation']->estimation_id);

		// $parts_used = $this->Estimation_model
		// 	->get_parts($estimation_id);

		$total_parts_count = $this->db
			->where('quotation_id', $quotation_id)
			->count_all_results('quotation_parts');


		// $parts_used_new = $this->Quotation_model->get_parts_type($quotation_id, "New Parts");

		// $parts_used_after = $this->Quotation_model->get_parts_type($quotation_id, "Aftermarket Parts");

		// $parts_used_used = $this->Quotation_model->get_parts_type($quotation_id, "Used Parts");
		$parts_used_new = $this->Estimation_model
			->get_parts_type_forquote($data['quotation']->estimation_id, "New Parts");

		$parts_used_after = $this->Estimation_model
			->get_parts_type_forquote($data['quotation']->estimation_id, "Aftermarket Parts");

		$parts_used_used = $this->Estimation_model
			->get_parts_type_forquote($data['quotation']->estimation_id, "Used Parts");

		$services_used = $this->Quotation_model->get_services($data['quotation']->quotation_id);

		$total_job_descriptions = is_array($job_descriptions)
			? count($job_descriptions)
			: count($job_descriptions->result());

		$total_services_used = is_array($services_used)
			? count($services_used)
			: count($services_used->result());


		$inspection = $this->Inspection_view_model->get_by_appointment($data['quotation']->appointment_id);
		$data['parts'] = $this->SpareParts_model->get_all_parts();
		$data['brands'] = $this->SpareParts_model->get_all_brands();
		$data['services_master'] = $this->db->where('status', 'Active')
			->get('services_master')->result();
		$data['kms'] = $estimation->kmin;
		$data['estimation']       = $estimation;
		$data['appointment']      = $appointment;
		$data['job_descriptions'] = $job_descriptions;
		$data['customer']      = $customer;
		$data['vehicle']      = $vehicle;

		$data['total_parts_count']       = $total_parts_count;
		$data['total_job_descriptions']       = $total_job_descriptions;
		$data['total_services_used']       = $total_services_used;

		$data['parts_used_new']       = $parts_used_new;
		$data['parts_used_after']       = $parts_used_after;
		$data['parts_used_used']       = $parts_used_used;
		$data['services_used']    = $services_used;

		$data['estimation_id'] = $estimation->estimation_id;
		$data['estimation_no'] = $estimation->estimation_no;


		$data['parts']    = $this->Quotation_model->get_parts($quotation_id);
		$data['services'] = $this->Quotation_model->get_services($quotation_id);

		$data['locked'] = ($data['quotation']->status === 'Approved');


		// $data['amount_in_words'] = $this->number_to_words_aed($data['estimation']->grand_total);

		$data['title'] = 'View Quotation';
		$data['main_content'] = 'quotation/view';

		$this->load->view('includes/template', $data);
	}



	public function view($quotation_id)
	{

		$data['username'] = $this->session->userdata('username');
		$data['userid'] = $this->session->userdata('user_id');
		$data['quotation'] = $this->Quotation_model->get_quotation($quotation_id);

		if (!$data['quotation']) {
			show_404();
		}


		// 1ï¸âƒ£ Get estimation header
		$estimation = $this->Estimation_model->get_estimation_by_id($data['quotation']->estimation_id);
		if (!$estimation) show_404();

		// Customer from inspection
		$customer = $this->Customer_model->get_customer($data['quotation']->customer_id);

		// Vehicle from inspection
		$vehicle = $this->Vehicle_model->get_vehicle($data['quotation']->vehicle_id);

		// 2ï¸âƒ£ Appointment + customer + vehicle
		$appointment = $this->Estimation_model->get_appointment_details($data['quotation']->appointment_id);

		// 3ï¸âƒ£ Sub tables
		$job_descriptions = $this->Estimation_model->get_job_descriptions($data['quotation']->estimation_id);

		// $parts_used = $this->Estimation_model
		// 	->get_parts($estimation_id);

		$total_parts_count = $this->db
			->where('quotation_id', $quotation_id)
			->count_all_results('quotation_parts');


		$parts_used_new = $this->Quotation_model->get_parts_type($quotation_id, "New Parts");
		$parts_used_after = $this->Quotation_model->get_parts_type($quotation_id, "Aftermarket Parts");
		$parts_used_used = $this->Quotation_model->get_parts_type($quotation_id, "Used Parts");

		$services_used = $this->Quotation_model->get_services($data['quotation']->quotation_id);

		$total_job_descriptions = is_array($job_descriptions)
			? count($job_descriptions)
			: count($job_descriptions->result());

		$total_services_used = is_array($services_used)
			? count($services_used)
			: count($services_used->result());


		$inspection = $this->Inspection_view_model->get_by_appointment($data['quotation']->appointment_id);
		$data['parts'] = $this->SpareParts_model->get_all_parts();
		$data['brands'] = $this->SpareParts_model->get_all_brands();
		$data['services_master'] = $this->db->where('status', 'Active')
			->get('services_master')->result();
		$data['kms'] = $estimation->kmin;
		$data['estimation']       = $estimation;
		$data['appointment']      = $appointment;
		$data['job_descriptions'] = $job_descriptions;
		$data['customer']      = $customer;
		$data['vehicle']      = $vehicle;

		$data['total_parts_count']       = $total_parts_count;
		$data['total_job_descriptions']       = $total_job_descriptions;
		$data['total_services_used']       = $total_services_used;

		$data['parts_used_new']       = $parts_used_new;
		$data['parts_used_after']       = $parts_used_after;
		$data['parts_used_used']       = $parts_used_used;
		$data['services_used']    = $services_used;

		$data['estimation_id'] = $estimation->estimation_id;
		$data['estimation_no'] = $estimation->estimation_no;


		$data['parts']    = $this->Quotation_model->get_parts($quotation_id);
		$data['services'] = $this->Quotation_model->get_services($quotation_id);

		$data['locked'] = ($data['quotation']->status === 'Approved');


		// $data['amount_in_words'] = $this->number_to_words_aed($data['estimation']->grand_total);

		// $data['title'] = 'View Quotation';
		$data['title'] =
			'Quotation_' .
			($appointment->doc_no ?? ('VIN-' . str_pad($quotation_id, 6, '0', STR_PAD_LEFT))) . '_' .
			preg_replace('/[^A-Za-z0-9\-]/', '_', $appointment->registration_no ?? $vehicle->registration_no ?? '') . '_' .
			preg_replace('/[^A-Za-z0-9\-]/', '_', $appointment->customer_name ?? $customer->name ?? '') . '_' .
			date('d-m-Y');
		$data['main_content'] = 'quotation/viewnew';

		$this->load->view('includes/template', $data);
	}


	public function send_email($quotation_id)
	{
		$quotation = $this->Quotation_model->get_quotation($quotation_id);
		if (!$quotation) return $this->email_response(false, 'Quotation not found.');
		$estimation = $this->Estimation_model->get_estimation_by_id($quotation->estimation_id);
		$customer = $this->Customer_model->get_customer($quotation->customer_id);
		$vehicle = $this->Vehicle_model->get_vehicle($quotation->vehicle_id);
		$recipient = trim($this->input->post('email')) ?: ($customer->email ?? '');
		if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) return $this->email_response(false, 'Please enter a valid email address.');

		$appointment = $this->Estimation_model->get_appointment_details($quotation->appointment_id);
		$job_descriptions = $this->Estimation_model->get_job_descriptions($estimation->estimation_id);
		$services_used = $this->Quotation_model->get_services($quotation_id);
		$data = [
			'quotation' => $quotation, 'estimation' => $estimation, 'appointment' => $appointment, 'customer' => $customer, 'vehicle' => $vehicle,
			'job_descriptions' => $job_descriptions, 'parts_used_new' => $this->Quotation_model->get_parts_type($quotation_id, 'New Parts'),
			'parts_used_after' => $this->Quotation_model->get_parts_type($quotation_id, 'Aftermarket Parts'), 'parts_used_used' => $this->Quotation_model->get_parts_type($quotation_id, 'Used Parts'),
			'services_used' => $services_used, 'total_parts_count' => $this->db->where('quotation_id', $quotation_id)->count_all_results('quotation_parts'),
			'total_job_descriptions' => is_array($job_descriptions) ? count($job_descriptions) : count($job_descriptions->result()),
			'total_services_used' => is_array($services_used) ? count($services_used) : count($services_used->result()), 'kms' => $estimation->kmin,
			'is_pdf' => true, 'username' => '',
		];
		$options = new Options(); $options->set('isRemoteEnabled', true); $dompdf = new Dompdf($options);
		$dompdf->loadHtml($this->load->view('quotation/viewnew', $data, true)); $dompdf->setPaper('A4', 'portrait'); $dompdf->render();
		$cache_dir = FCPATH . 'application/cache/';
		if (!is_dir($cache_dir)) { mkdir($cache_dir, 0755, true); }
		$pdf_path = $cache_dir . 'quotation_' . $quotation_id . '_' . uniqid() . '.pdf'; file_put_contents($pdf_path, $dompdf->output());
		$this->load->library('gms_mailer');
		$company_id   = get_current_company_id();
		$company_name = $this->gms_mailer->get_company_name($company_id);
		$result = $this->gms_mailer->send_notification($recipient, 'quotation_sent', [
			'{customer_name}' => $appointment->customer_name ?? $customer->name, '{vehicle_no}' => $appointment->registration_no ?? $vehicle->registration_no,
			'{quotation_no}' => $quotation->quotation_no,
			'{amount}' => number_format((float) $quotation->grand_total, 2),
			'{quotation_amount}' => number_format((float) $quotation->grand_total, 2),
			'{date}' => date('d/m/Y', strtotime($quotation->quotation_date)), '{company_name}' => $company_name,
		], $pdf_path, $company_id);
		@unlink($pdf_path); return $this->email_response($result['status'], $result['message']);
	}

	private function email_response($status, $message)
	{
		$this->output->set_content_type('application/json')->set_output(json_encode(['status' => (bool) $status, 'message' => $message]));
	}

	public function delete($quotation_id)
	{
		$this->Quotation_model->delete_quotation($quotation_id);
		redirect('Quotation');
	}
}

