<?php
require_once FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

use function Complex\log10;

class Jobcard extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Jobcard_model");
		$this->load->model("Appointment_model");
		$this->load->model("SpareParts_model");
		$this->load->model("Service_model");
		$this->load->model("Estimation_model");
		$this->load->model("Inspection_view_model");
		$this->load->model("Quotation_model");
		$this->load->model("Employee_model");
		$this->load->model('Customer_model');
		$this->load->model('Vehicle_model');
		$this->load->model('Purchase_Model');
	}

	private function generate_jobcard_no()
	{
		$year = date('Y');

		$last = $this->db
			->like('jobcard_no', "JC-$year-", 'after')
			->order_by('jobcard_id', 'DESC')
			// ->order_by("CAST(SUBSTRING_INDEX(jobcard_no,'-',-1) AS UNSIGNED)", "DESC")
			->limit(1)
			->get('job_cards')
			->row();

		if ($last) {
			$last_no = intval(substr($last->jobcard_no, -4));
			$new_no  = str_pad($last_no + 1, 4, '0', STR_PAD_LEFT);
		} else {
			$new_no = '0001';
		}

		return "JC-$year-$new_no";
	}


	public function create($appointment_id)
	{
		$data['username'] = $this->session->userdata('username');
		$data['userid'] = $this->session->userdata('user_id');

		// 1ï¸âƒ£ Prevent duplicate jobcard
		$existing = $this->Jobcard_model->get_by_appointment($appointment_id);
		if ($existing) {
			log_message("error", $existing->status);
			redirect('jobcard/edit/' . $existing->jobcard_id);
		}

		// 3ï¸âƒ£ Get estimation (jobcard MUST come after estimation)
		$estimation = $this->Estimation_model->get_by_appointment($appointment_id);
		if (!$estimation) {
			$this->session->set_flashdata(
				'error',
				'Please complete inspection before creating estimation.'
			);
			redirect('appointment');
		}

		$inspection = $this->Inspection_view_model->get_by_appointment($appointment_id);

		$estimation_id = $estimation->estimation_id;
		// 2ï¸âƒ£ Get appointment + customer + vehicle
		$appointment = $this->Estimation_model->get_appointment_details($appointment_id);
		if (!$appointment) show_404();

		$quotation = $this->Quotation_model->get_quotation_details($appointment_id);
		$quotation_id  = $quotation->quotation_id;
		// 1ï¸âƒ£ Create Job Card record
		$jobcard_no = $this->generate_jobcard_no();

		$jobcard_id = $this->Jobcard_model->create_jobcard([
			'branch_id'     => $estimation->branch_id ?? $inspection->branch_id ?? get_primary_branch_id(),
			'estimation_id' => $estimation_id,
			'customer_id'   => $appointment->customer_id,
			'vehicle_id'    => $appointment->vehicle_id,
			'appointment_id' => $appointment->appointment_id,
			'jobcard_date'  => date('Y-m-d'),
			'jobcard_time'  => date('H:i:s'),
			'status'        => 'Pending',
			'quotation_id'   => $quotation_id,
			'jobcard_no' => $jobcard_no
		]);
		notify_event(
			'jobcard_created',
			$jobcard_id,
			'Job card ' . $jobcard_no . ' created',
			'jobcard/edit/' . $jobcard_id,
			'Jobcard',
			['details' => 'A new job card is ready for processing.']
		);

        $customer = $this->Customer_model
			->get_customer($appointment->customer_id);
		$vehicle = $this->Vehicle_model
			->get_vehicle($appointment->vehicle_id);
		// 2ï¸âƒ£ Appointment + customer + vehicle
		$appointment = $this->Estimation_model
			->get_appointment_details($estimation->appointment_id);

		// 3ï¸âƒ£ Sub tables
		$job_descriptions = $this->Estimation_model
			->get_job_descriptions($estimation_id);

		$parts_used = $this->Quotation_model
			->get_parts($quotation_id);

		$services_used = $this->Quotation_model
			->get_services($quotation_id);

		$jobcardstatus = $this->Jobcard_model->get_jobcard_status_by_id($jobcard_id);

		$data['kms'] = $inspection->km_reading ?? null;

		$job_descriptions_quotation = $this->Quotation_model
			->get_job_descriptions($quotation_id);

		$parts_used_quotation = $this->Quotation_model
			->get_parts($quotation_id);

		$services_used_quotation = $this->Quotation_model->get_services($quotation_id);


		$jobcard_services_map = [];
		foreach ($services_used as $js) {
			$jobcard_services_map[$js->service_id] = $js;
		}

		// Convert quotation services to array indexed by service_id
		$quotation_services_map = [];
		foreach ($services_used_quotation as $qs) {
			$quotation_services_map[$qs->service_id] = $qs;
		}

		$data['jobcard_services_map']   = $jobcard_services_map;
		$data['quotation_services_map'] = $quotation_services_map;

		// Convert jobcard parts to array indexed by part_id
		$jobcard_parts_map = [];
		foreach ($parts_used as $jp) {
			$jobcard_parts_map[$jp->part_id] = $jp;
		}

		// Convert quotation parts to array indexed by part_id
		$quotation_parts_map = [];
		foreach ($parts_used_quotation as $qp) {
			$quotation_parts_map[$qp->part_id] = $qp;
		}

		$data['jobcard_parts_map']   = $jobcard_parts_map;
		$data['quotation_parts_map'] = $quotation_parts_map;

		// Convert jobcard parts to array indexed by part_id
		$jobcard_description_map = [];
		foreach ($job_descriptions as $js) {
			$jobcard_description_map[$js->description] = $js;
		}

		// Convert quotation services to array indexed by service_id
		$quotation_description_map = [];
		foreach ($job_descriptions_quotation as $qs) {
			$quotation_description_map[$qs->description] = $qs;
		}

		$data['jobcard_description_map']   = $jobcard_description_map;
		$data['quotation_description_map'] = $quotation_description_map;


		$data['jobcard_id'] = $jobcard_id;
		$data['jobcard_no'] = $jobcard_no;
		$data['jobcardstatus'] = $jobcardstatus;

		// 4ï¸âƒ£ Masters (dropdown data)
		$data['parts']           = $this->SpareParts_model->get_all_parts();
		$data['services_master'] = $this->Service_model->get_active_services();
		$data['technicians'] = $this->Employee_model->get_active_technicians();
		// 5ï¸âƒ£ Send data to view
		$data['estimation']       = $estimation;
		$data['appointment']      = $appointment;
		$data['job_descriptions'] = $job_descriptions;
		$data['parts_used']       = $parts_used;
		$data['services_used']    = $services_used;

		$data['estimation_id'] = $estimation_id;
		$data['estimation_no'] = $estimation->estimation_no;

		$data['vehicle_id'] = $appointment->vehicle_id;
		$data['customer']      = $customer;
		$data['vehicle']      = $vehicle;

		$data['title'] = 'job card creation';
		$data['main_content'] = 'jobcard/create'; // SAME PAGE

		$this->load->view('includes/template', $data);
	}

	public function save()
	{
		$jobcard_id = $this->input->post('jobcard_id');

		if (!$jobcard_id) {
			show_error('Invalid Jobcard');
		}

		// ---------------------------
		// 1ï¸âƒ£ SAVE MAIN ESTIMATION
		// ---------------------------
		// $jobcardData = [
		// 	'subtotal'        => $this->input->post('subtotal'),
		// 	'tax_amount'      => $this->input->post('tax_amount'),
		// 	'discount'        => $this->input->post('discount'),
		// 	'grand_total'     => $this->input->post('grand_total'),
		// 	'status'          => 'In Progress'
		// ];

		$current_jobcard = $this->db->where('jobcard_id', $jobcard_id)->get('job_cards')->row();
		$expected_delivery_date = $this->input->post('estdate');
		$completion_time = $this->input->post('ctime');
		$remarks = $this->input->post('remarks');
		$km_in = $this->input->post('kmin');

		$jobcardData = [
			'branch_id'       => $this->input->post('branch_id') ?: ($current_jobcard->branch_id ?? null) ?: get_primary_branch_id(),
			'status'          => 'In Progress',
			'remarks' => $remarks,
			'km_in' => $km_in,
			'expected_delivery_date' => $expected_delivery_date,
			'completion_time' => $completion_time
		];

		$updated = $this->Jobcard_model->update_jobcard($jobcard_id, $jobcardData);
		if ($updated !== false && $current_jobcard) {
			$jobcard_no = (string) ($current_jobcard->jobcard_no ?? $jobcard_id);
			$new_status = (string) $this->input->post('status');
			if ($new_status !== (string) ($current_jobcard->status ?? '')) {
				notify_event(
					$new_status === 'Service Completed' ? 'jobcard_completed' : 'jobcard_status_changed',
					$jobcard_id,
					'Job card ' . $jobcard_no . ' status changed to ' . $new_status,
					'jobcard/edit/' . $jobcard_id,
					'Jobcard',
					['details' => 'Previous status: ' . ($current_jobcard->status ?? 'Unknown')]
				);
			}
		}

		if ($current_jobcard && !empty($current_jobcard->estimation_id)) {
			$this->db->where('estimation_id', $current_jobcard->estimation_id)
				->update('estimations', [
					'est_delivery_date' => $expected_delivery_date,
					'est_completion_time' => $completion_time,
					'remarks' => $remarks,
					'kmin' => $km_in,
				]);
		}

		if ($updated !== false) {
			$this->session->set_flashdata('success', 'Job card saved successfully.');
		} else {
			$this->session->set_flashdata('error', 'Unable to save job card.');
		}

		// ---------------------------
		// 2ï¸âƒ£ JOB DESCRIPTIONS
		// ---------------------------
		$job_descriptions = $this->input->post('sublet') ?? [];
		$service_amt = $this->input->post('service_amt') ?? [];
		$this->Jobcard_model->save_job_descriptions($jobcard_id, $job_descriptions, $service_amt);

		// ---------------------------
		// 3ï¸âƒ£ PARTS USED
		// ---------------------------
		$this->Jobcard_model->save_parts(
			$jobcard_id,
			$this->input->post('part_id') ?? [],
			$this->input->post('part_type') ?? [],
			$this->input->post('part_qty') ?? [],
			$this->input->post('part_sellprice') ?? [],
			$this->input->post('part_sellprice') ?? [],
			$this->input->post('part_totalprice') ?? [],
			$this->input->post('part_disamt') ?? [],

		);

		// ---------------------------
		// 4ï¸âƒ£ SERVICES / LABOUR
		// ---------------------------
		$this->Jobcard_model->save_services(
			$jobcard_id,
			$this->input->post('service_name') ?? [],
			$this->input->post('technician_id') ?? [],
			$this->input->post('service_amt') ?? [],
		);

		// ---------------------------
		// 5ï¸âƒ£ REDIRECT
		// ---------------------------
		redirect('jobcard/edit/' . $jobcard_id);
	}

	public function updatejobcard()
	{
		// log_message('error', '--- update_controller called ---');
		// log_message('error', 'POST DATA: ' . print_r($this->input->post(), true));

		$jobcard_id = $this->input->post('jobcard_id');

		if (!$jobcard_id) {
			show_error('Invalid Jobcard');
		}

		$current_jobcard = $this->db->where('jobcard_id', $jobcard_id)->get('job_cards')->row();
		$expected_delivery_date = $this->input->post('estdate');
		$completion_time = $this->input->post('ctime');
		$remarks = $this->input->post('remarks');
		$km_in = $this->input->post('kmin');
		$jobcardData = [
			'branch_id'       => $this->input->post('branch_id') ?: ($current_jobcard->branch_id ?? null) ?: get_primary_branch_id(),
			// 'status'          => 'Scheduled',
			'status'          => $this->input->post('status'),
			'remarks' => $remarks,
			'km_in' => $km_in,
			'vehicle_id' => $this->input->post('vehicle_id'),
			'expected_delivery_date' => $expected_delivery_date,
			'completion_time' => $completion_time,
			'jobcard_date'=> $this->input->post('jobcard_date')
		];

		$updated = $this->Jobcard_model->update_jobcard($jobcard_id, $jobcardData);

		if ($current_jobcard && !empty($current_jobcard->estimation_id)) {
			$this->db->where('estimation_id', $current_jobcard->estimation_id)
				->update('estimations', [
					'est_delivery_date' => $expected_delivery_date,
					'est_completion_time' => $completion_time,
					'remarks' => $remarks,
					'kmin' => $km_in,
				]);
		}

		if ($updated !== false) {
			$this->session->set_flashdata('success', 'Job card updated successfully.');
		} else {
			$this->session->set_flashdata('error', 'Unable to update job card.');
		}

		$new_status = $this->input->post('status');
		if ($new_status === 'Service Completed') {
			$this->load->model('Service_reminder_model');
			$jobcard_row = $this->db->where('jobcard_id', $jobcard_id)->get('job_cards')->row();
			if ($jobcard_row) {
				$this->Service_reminder_model->generate_reminder(
					$jobcard_id,
					(int) ($jobcard_row->vehicle_id ?? 0),
					(int) ($jobcard_row->customer_id ?? 0),
					date('Y-m-d')
				);
			}
		}

		// ---------------------------
		// 4ï¸âƒ£ SERVICES / LABOUR
		// ---------------------------
		$this->Jobcard_model->update_services(
			$jobcard_id,
			$this->input->post('service_name') ?? [],
			$this->input->post('technician_id') ?? [],
			$this->input->post('service_estcost') ?? [],
			$this->input->post('service_esttime') ?? [],
			$this->input->post('service_amt') ?? [],

		);

		$jobcard_row = $this->db->where('jobcard_id', $jobcard_id)->get('job_cards')->row();
		$selected_vehicle_id = $this->input->post('vehicle_id') ?: ($jobcard_row->vehicle_id ?? null);
		$selected_kmin = $this->input->post('kmin');

		if ($jobcard_row) {
			$this->db->where('jobcard_id', $jobcard_id)
				->update('job_cards', [
					'vehicle_id' => $selected_vehicle_id,
					'km_in' => $selected_kmin
				]);

			if (!empty($jobcard_row->quotation_id)) {
				$this->db->where('quotation_id', $jobcard_row->quotation_id)
					->update('quotations', [
						'vehicle_id' => $selected_vehicle_id
					]);
			}

			if (!empty($jobcard_row->estimation_id)) {
				$this->db->where('estimation_id', $jobcard_row->estimation_id)
					->update('estimations', [
						'vehicle_id' => $selected_vehicle_id,
						'kmin' => $selected_kmin
					]);
			}
            
			$estimation_id = $jobcard_row->estimation_id;
			$estimate_data = $this->db
			->where('estimation_id', $estimation_id)
			->get('estimations')
			->row();

			if ($estimate_data) {
				$this->db->where('inspection_id ', $estimate_data->inspection_id)
			    ->update('inspections', ['km_reading' => $selected_kmin, 'vehicle_id ' => $estimate_data->vehicle_id]);
      
			}
		}

		// ---------------------------
		// 4ï¸âƒ£ parts
		// ---------------------------
		$this->Jobcard_model->update_parts(
			$jobcard_id,
			$this->input->post('part_id') ?? [],
			$this->input->post('part_type') ?? [],
			$this->input->post('part_qty') ?? [],
			$this->input->post('part_sellprice') ?? [],
			$this->input->post('part_sellprice') ?? [],
			$this->input->post('part_totalprice') ?? [],
			$this->input->post('part_disamt') ?? [],

		);
		// ---------------------------
		// 4ï¸âƒ£ sublet
		// ---------------------------
		$this->Jobcard_model->update_sublet(
			$jobcard_id,
			$this->input->post('sublet') ?? [],
			$this->input->post('jobservice_amt') ?? []

		);

		// ---------------------------
		// 5ï¸âƒ£ REDIRECT
		// ---------------------------
		redirect('jobcard/edit/' . $jobcard_id);
	}


	public function edit($jobcard_id)
	{
		$data['username'] = $this->session->userdata('username');
		$data['userid'] = $this->session->userdata('user_id');
		// 1ï¸âƒ£ Get estimation header
		$jobcard = $this->Jobcard_model->get_jobcard_by_id($jobcard_id);
		if (!$jobcard) show_404();

		// 2ï¸âƒ£ Appointment + customer + vehicle
		if ($jobcard->appointment_id) {
			$appointment = $this->Estimation_model
				->get_appointment_details($jobcard->appointment_id);

			$appointment_id = $appointment->appointment_id;
			$data['appointment']      = $appointment;
		}
		// Customer from inspection
		$customer = $this->Customer_model
			->get_customer($jobcard->customer_id);

		// 3ï¸âƒ£ Get estimation (jobcard MUST come after estimation)
		if ($jobcard->appointment_id) {
			$estimation = $this->Estimation_model->get_by_appointment($appointment_id);
		} else {
			$estimation = $this->Estimation_model->get_by_estimation($jobcard->estimation_id);
		}
		if (!$estimation) {
			$this->session->set_flashdata(
				'error',
				'Please complete inspection before creating estimation.'
			);
			redirect('appointment');
		}

		$estimation_id = $estimation->estimation_id;
		// log_message('error', print_r($jobcard->estimation_id));

        // Vehicle from inspection
        if($jobcard->vehicle_id == 0 || $jobcard->vehicle_id == null) {
			$vehicle_id = $estimation->vehicle_id ?? null;
			// echo "vehicle id from estimation: " . $vehicle_id; exit;
		} else {
			$vehicle_id = $jobcard->vehicle_id;
			// echo "vehicle id from jobcard: " . $vehicle_id;exit;
		}
 
		$vehicle = $this->Vehicle_model
			->get_vehicle($vehicle_id);

		// log_message('error',print_r($inspection));
		// 3ï¸âƒ£ Sub tables
		$job_descriptions = $this->Jobcard_model
			->get_job_descriptions($jobcard_id);

		$parts_used = $this->Jobcard_model
			->get_parts($jobcard_id);

		$services_used = $this->Jobcard_model->get_services($jobcard_id);

		$jobcardstatus = $this->Jobcard_model->get_jobcard_status_by_id($jobcard_id);
        $data['purchased_spareparts'] = $this->Purchase_Model->get_purchased_spareparts($jobcard_id);

		// 4ï¸âƒ£ Masters (dropdown data)
		$data['all_vehicles'] = $this->Vehicle_model->get_vehicles_by_customer($jobcard->customer_id);
		$data['vehicle_brands'] = $this->Vehicle_model->get_all_brands();
		$data['parts']           = $this->SpareParts_model->get_all_parts();
		$data['services_master'] = $this->Service_model->get_active_services();
		$data['technicians'] = $this->Employee_model->get_active_technicians();
		// 5ï¸âƒ£ Send data to view
		$data['jobcard']       = $jobcard;
		$data['estimation']       = $estimation;
		// 
		$data['job_descriptions'] = $job_descriptions;
		$data['parts_used']       = $parts_used;
		$data['services_used']    = $services_used;
		$data['kms'] = $jobcard->km_in ??  $estimation->kmin;
		$data['expected_delivery_date'] = $jobcard->expected_delivery_date ?? ($estimation->est_delivery_date ?? '');
		$data['completion_time'] = $jobcard->completion_time ?? ($estimation->est_completion_time ?? '');
		$data['customer']      = $customer;
		$data['vehicle']      = $vehicle;

		$data['jobcard_id'] = $jobcard_id;
		$data['jobcard_no'] = $jobcard->jobcard_no;
		$data['jobcardstatus'] = $jobcardstatus->status;
		$data['estimation_id'] = $estimation_id;
		$data['estimation_nos'] = $estimation->estimation_no;
		// echo "kkk";
// print_r($estimation->estimation_no);exit;
		$data['title'] = 'Edit Jobcard';
		$data['main_content'] = 'jobcard/edit'; // SAME PAGE

		$this->load->view('includes/template', $data);
	}

	public function edit_by_quotationold($quotation_id)
	{
		// 1ï¸âƒ£ Get estimation header
		// 1ï¸âƒ£ Get jobcard by quotation
		$jobcard = $this->Jobcard_model->get_jobcard_by_qid($quotation_id);
		$appointment_id = null;
		$estimation_id = $jobcard->estimation_id;

		if (!$jobcard) {

			$this->session->set_flashdata(
				'error',
				'Please save the quotation first before opening the jobcard.'
			);

			// Redirect back to quotation edit page
			redirect('quotation/edit/' . $quotation_id);
			return;
		}

		$jobcard_id = $jobcard->jobcard_id;

		// Customer from inspection
		$customer = $this->Customer_model
			->get_customer($jobcard->customer_id);

		// Vehicle from inspection
		$vehicle = $this->Vehicle_model
			->get_vehicle($jobcard->vehicle_id);


		if ($jobcard->appointment_id !== null) {
			// 2ï¸âƒ£ Appointment + customer + vehicle
			$appointment = $this->Estimation_model
				->get_appointment_details($jobcard->appointment_id);

			$appointment_id = $appointment->appointment_id;
		}

		// 3ï¸âƒ£ Get estimation (jobcard MUST come after estimation)
		// $estimation = $this->Estimation_model->get_by_appointment($appointment_id);
		$estimation = $this->Estimation_model->get_estimation_by_id($estimation_id);
		if (!$estimation) {
			$this->session->set_flashdata(
				'error',
				'Please complete inspection before creating estimation.'
			);
			redirect('appointment');
		}

		$estimation_id = $estimation->estimation_id;

		// $inspection = $this->Inspection_view_model->get_by_appointment($appointment_id);
		// $inspection = $this->Inspection_view_model->get_by_inspection($jobcard->inspection_id);
		// 3ï¸âƒ£ Sub tables
		$job_descriptions = $this->Jobcard_model
			->get_job_descriptions($jobcard_id);

		$parts_used = $this->Jobcard_model
			->get_parts($jobcard_id);

		$services_used = $this->Jobcard_model->get_services($jobcard_id);
		// 
		$jobcardstatus = $this->Jobcard_model->get_jobcard_status_by_id($jobcard_id);

		// 4ï¸âƒ£ Masters (dropdown data)
		$data['parts']           = $this->SpareParts_model->get_all_parts();
		$data['services_master'] = $this->Service_model->get_active_services();
		$data['technicians'] = $this->Employee_model->get_active_technicians();
		// 5ï¸âƒ£ Send data to view
		$data['estimation']       = $estimation;
		$data['appointment'] = $appointment ?? null;
		$data['job_descriptions'] = $job_descriptions;
		$data['parts_used']       = $parts_used;
		$data['services_used']    = $services_used;
		$data['kms'] =  $estimation->kmin;
		$data['customer']      = $customer;
		$data['vehicle']      = $vehicle;

		$data['jobcard_id'] = $jobcard_id;
		$data['jobcard_no'] = $jobcard->jobcard_no;
		$data['jobcardstatus'] = $jobcardstatus->status;
		$data['estimation_id'] = $estimation_id;
		$data['estimation_no'] = $estimation->estimation_no;

		$data['title'] = 'Edit Jobcard';
		$data['main_content'] = 'jobcard/create'; // SAME PAGE

		$this->load->view('includes/template', $data);
	}

	public function edit_by_quotation($quotation_id, $estimation_id)
	{
		// 1ï¸âƒ£ Get estimation header
		// 1ï¸âƒ£ Get jobcard by quotation
		// 3ï¸âƒ£ Get estimation (jobcard MUST come after estimation)
		// $estimation = $this->Estimation_model->get_by_appointment($appointment_id);
$data['vehicle_id'] ="";
		// log_message('error', "check this function");
		$estimation = $this->Estimation_model->get_estimation_by_id($estimation_id);
		if (!$estimation) {
			$this->session->set_flashdata(
				'error',
				'Please complete inspection before creating estimation.'
			);
			redirect('appointment');
		}

		$estimation_id = $estimation->estimation_id;
		$parent_estimation_id = $estimation->parent_estimation_id;
		// log_message('error', "check this " . $parent_estimation_id);
		// log_message('error', "estimation_id this " . $estimation_id);

		if (!empty($parent_estimation_id)) {
			$jobcard = $this->Jobcard_model->get_jobcard_by_eid($parent_estimation_id);
		} else {
			$jobcard = $this->Jobcard_model->get_jobcard_by_eid($estimation_id);
		}

		$appointment_id = null;
		

		if (!$jobcard) {
			// ==================if jobcard not created, check quotation is saved or not. if saved create jobcard using quotation and move forward.
			//  otherwise show the save msg
			$quote = $this->Quotation_model->get_quotation($quotation_id);
			if (!$quote) {

				$this->session->set_flashdata(
					'error',
					'Please save the quotation first before opening the jobcard.'
				);
				// Redirect back to quotation edit page
				redirect('quotation/edit/' . $quotation_id);
				return;
			} else {
				$jobcard_id = $this->Quotation_model->create_jobcard_from_quotation($quotation_id);
				$jobcard = $this->Jobcard_model->get_jobcard_by_id($jobcard_id);
			}
		}
		$estimation_id = $jobcard->estimation_id;
		$jobcard_id = $jobcard->jobcard_id;

		// Customer from inspection
		$customer = $this->Customer_model
			->get_customer($jobcard->customer_id);

		// Vehicle from inspection
		$vehicle = $this->Vehicle_model
			->get_vehicle($jobcard->vehicle_id);

		$data['vehicle_id'] = $jobcard->vehicle_id;

		if ($jobcard->appointment_id !== null) {
			// 2ï¸âƒ£ Appointment + customer + vehicle
			$appointment = $this->Estimation_model
				->get_appointment_details($jobcard->appointment_id);

			$appointment_id = $appointment->appointment_id;
		}



		// ====================now get the jocard created for parent estimation id  and add extra items or delete items from it======

		$job_descriptions_quotation = $this->Quotation_model
			->get_job_descriptions($quotation_id);

		$parts_used_quotation = $this->Quotation_model
			->get_parts($quotation_id);

		$services_used_quotation = $this->Quotation_model->get_services($quotation_id);



		// $inspection = $this->Inspection_view_model->get_by_appointment($appointment_id);
		// $inspection = $this->Inspection_view_model->get_by_inspection($jobcard->inspection_id);
		// 3ï¸âƒ£ Sub tables
		$job_descriptions = $this->Jobcard_model
			->get_job_descriptions($jobcard_id);

		$parts_used = $this->Jobcard_model
			->get_parts($jobcard_id);

		$services_used = $this->Jobcard_model->get_services($jobcard_id);

		$jobcardstatus = $this->Jobcard_model->get_jobcard_status_by_id($jobcard_id);

		// 4ï¸âƒ£ Masters (dropdown data)
		$data['parts']           = $this->SpareParts_model->get_all_parts();
		$data['services_master'] = $this->Service_model->get_active_services();
		$data['technicians'] = $this->Employee_model->get_active_technicians();
		// 5ï¸âƒ£ Send data to view
		$data['estimation']       = $estimation;
		$data['appointment'] = $appointment ?? null;

		$data['job_descriptions'] = $job_descriptions;
		$data['parts_used']       = $parts_used;
		$data['services_used']    = $services_used;

		$data['job_descriptions_quotation'] = $job_descriptions_quotation;
		$data['parts_used_quotation']       = $parts_used_quotation;
		$data['services_used_quotation']    = $services_used_quotation;


		$data['kms'] =  $estimation->kmin;
		$data['customer']      = $customer;
		$data['vehicle']      = $vehicle;

		$data['jobcard_id'] = $jobcard_id;
		$data['jobcard_no'] = $jobcard->jobcard_no;
		$data['jobcardstatus'] = $jobcardstatus->status;
		$data['estimation_id'] = $estimation_id;
		$data['estimation_no'] = $estimation->estimation_no;

		// ==========================revison procedure starts ======================
		// Convert jobcard services to array indexed by service_id
		$jobcard_services_map = [];
		foreach ($services_used as $js) {
			$jobcard_services_map[$js->service_id] = $js;
		}

		// Convert quotation services to array indexed by service_id
		$quotation_services_map = [];
		foreach ($services_used_quotation as $qs) {
			$quotation_services_map[$qs->service_id] = $qs;
		}

		$data['jobcard_services_map']   = $jobcard_services_map;
		$data['quotation_services_map'] = $quotation_services_map;


		// ==========================revison procedure Ends ======================
		// ========================== PART REVISION PROCEDURE ======================

		// Convert jobcard parts to array indexed by part_id
		$jobcard_parts_map = [];
		foreach ($parts_used as $jp) {
			$jobcard_parts_map[$jp->part_id] = $jp;
		}

		// Convert quotation parts to array indexed by part_id
		$quotation_parts_map = [];
		foreach ($parts_used_quotation as $qp) {
			$quotation_parts_map[$qp->part_id] = $qp;
		}

		$data['jobcard_parts_map']   = $jobcard_parts_map;
		$data['quotation_parts_map'] = $quotation_parts_map;
		// ========================== PART REVISION PROCEDURE ======================

		// ========================== sublet REVISION PROCEDURE ======================

		// Convert jobcard parts to array indexed by part_id
		$jobcard_description_map = [];
		foreach ($job_descriptions as $js) {
			$jobcard_description_map[$js->description] = $js;
		}

		// Convert quotation services to array indexed by service_id
		$quotation_description_map = [];
		foreach ($job_descriptions_quotation as $qs) {
			$quotation_description_map[$qs->description] = $qs;
		}

		$data['jobcard_description_map']   = $jobcard_description_map;
		$data['quotation_description_map'] = $quotation_description_map;
		// ========================== sublet REVISION PROCEDURE ======================
          
		
		$data['title'] = 'Edit Jobcard';
		$data['main_content'] = 'jobcard/create'; // SAME PAGE

		$this->load->view('includes/template', $data);
	}



	public function view($jobcard_id)
	{
		$data['username'] = $this->session->userdata('username');
		$data['userid'] = $this->session->userdata('user_id');
		$data['jobcard']  = $this->Jobcard_model->get_jobcard($jobcard_id);
		$data['services'] = $this->Jobcard_model->get_jobcard_servicesnew($jobcard_id);
		$data['parts']    = $this->Jobcard_model->get_jobcard_parts($jobcard_id);
		$data['technicians'] = $this->Employee_model->get_active_technicians();
		$data['job_descriptions'] = $this->Jobcard_model->get_job_descriptions($jobcard_id);
		$data['purchased_spareparts'] = $this->Purchase_Model->get_purchased_spareparts($jobcard_id);
		$data['jobcard_total'] = $this->get_jobcard_total($data['purchased_spareparts']);

		$data['title'] = "Job Card #" . $jobcard_id;
		$data['main_content'] = "jobcard/jobcard_view";
		$this->load->view("includes/template", $data);
	}


	public function pdf($jobcard_id)
	{
		// âœ… Load Model FIRST
		$this->load->model('Jobcard_model');

		// âœ… Get Job Card with Full Details
		$jobcard = $this->Jobcard_model->get_jobcard_with_details($jobcard_id);

		if (!$jobcard) {
			show_404();
		}
		$jobcard->display_total = $this->get_jobcard_total($this->Purchase_Model->get_purchased_spareparts($jobcard_id));

		// âœ… Load HTML from View
		$data['jobcard'] = $jobcard;
		$html = $this->load->view('jobcard/jobcard_pdf', $data, TRUE);

		// âœ… Dompdf Configuration
		$options = new Options();
		$options->set('isRemoteEnabled', true);

		$dompdf = new Dompdf($options);
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

		// âœ… Force Download
		$dompdf->stream("jobcard_{$jobcard_id}.pdf", [
			"Attachment" => true
		]);
	}
 
	public function send_email($jobcard_id)
	{
		$jobcard = $this->Jobcard_model->get_jobcard_with_details($jobcard_id);
		if (!$jobcard) return $this->email_response(false, 'Job card not found.');
		$jobcard_total = $this->get_jobcard_total($this->Purchase_Model->get_purchased_spareparts($jobcard_id));
		$jobcard->display_total = $jobcard_total;
		$recipient = trim($this->input->post('email')) ?: ($jobcard->customer_email ?? '');
		if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) return $this->email_response(false, 'Please enter a valid email address.');

		$options = new Options(); $options->set('isRemoteEnabled', true); $dompdf = new Dompdf($options);
		$dompdf->loadHtml($this->load->view('jobcard/jobcard_pdf', ['jobcard' => $jobcard], true)); $dompdf->setPaper('A4', 'portrait'); $dompdf->render();
		$cache_dir = FCPATH . 'application/cache/';
		if (!is_dir($cache_dir)) { mkdir($cache_dir, 0755, true); }
		$pdf_path = $cache_dir . 'jobcard_' . $jobcard_id . '_' . uniqid() . '.pdf'; file_put_contents($pdf_path, $dompdf->output());
		$this->load->library('gms_mailer');
		$company_id   = get_current_company_id();
		$company_name = $this->gms_mailer->get_company_name($company_id);
		$result = $this->gms_mailer->send_notification($recipient, 'jobcard_created', [
			'{customer_name}' => $jobcard->customer_name, '{vehicle_no}' => $jobcard->registration_no, '{jobcard_no}' => $jobcard->jobcard_no,
			'{date}' => date('d/m/Y', strtotime($jobcard->jobcard_date)), '{company_name}' => $company_name,
			'{amount}' => number_format($jobcard_total, 2), '{jobcard_amount}' => number_format($jobcard_total, 2),
		], $pdf_path, $company_id);
		@unlink($pdf_path); return $this->email_response($result['status'], $result['message']);
	}

	private function get_jobcard_total($purchased_spareparts)
	{
		$invoice_totals = [];

		foreach ($purchased_spareparts as $item) {
			$invoice_no = (string) $item->supplier_ref;
			if (!array_key_exists($invoice_no, $invoice_totals)) {
				$invoice_totals[$invoice_no] = (float) $item->grand_total;
			}
		}

		return array_sum($invoice_totals);
	}

	private function email_response($status, $message)
	{
		$this->output->set_content_type('application/json')->set_output(json_encode(['status' => (bool) $status, 'message' => $message]));
	}

	public function index()
	{
		$data['title'] = 'Job Cards';
		$data['jobcards'] = $this->Jobcard_model->get_all_jobcards();
		$company_id = get_current_company_id();
		$wa_settings = $this->db->get_where('whatsapp_settings', ['company_id' => $company_id])->row();
		$data['whatsapp_enabled'] = !empty($wa_settings->whatsapp_enabled);

		$data['main_content'] = 'jobcard/list';
		$this->load->view('includes/template', $data);
	}

	public function delete($jobcard_id)
	{
		$this->Jobcard_model->delete_jobcard($jobcard_id);
		redirect('jobcard');
	}

	public function timesheet($jobcard_id)
	{
		$data['jobcard'] = $this->Jobcard_model->get_jobcard_basic($jobcard_id);
		$data['descriptions'] = $this->Jobcard_model->get_jobcard_descriptions_with_employee($jobcard_id);
		log_message(
			'Error',
			'Jobcard Descriptions: ' . json_encode($data['descriptions'])
		);

		// status
		$logs = $this->Jobcard_model->get_latest_work_status($jobcard_id);
		$statusMap = [];
		foreach ($logs as $l) {
			$statusMap[$l->jobcard_service_id] = $l->status;
		}

		// NEW: times
		$data['timeMap'] = $this->Jobcard_model->get_jobcard_work_times($jobcard_id);
		$data['statusMap'] = $statusMap;

		$data['title'] = 'Time Sheet';
		$data['main_content'] = 'jobcard/timesheet';
		$this->load->view('includes/template', $data);
	}


	// public function log_work_time1()
	// {
	// 	$data = [
	// 		'jobcard_id' => $this->input->post('jobcard_id'),
	// 		'jobcard_description_id' => $this->input->post('description_id'),
	// 		'employee_id' => $this->input->post('employee_id'),
	// 		'status' => $this->input->post('status'),
	// 		'log_time' => date('Y-m-d H:i:s')
	// 	];

	// 	$this->db->insert('jobcard_work_logs', $data);

	// 	echo json_encode(['status' => 'success']);
	// }


	// public function log_work_time()
	// {
	// 	$jobcard_id = $this->input->post('jobcard_id');
	// 	$description_id = $this->input->post('description_id');
	// 	$employee_id = $this->input->post('employee_id');
	// 	$status = $this->input->post('status');

	// 	// âŒ Prevent START more than once
	// 	if ($status === 'START') {
	// 		$alreadyStarted = $this->db
	// 			->where('jobcard_service_id', $description_id)
	// 			->where('status', 'START')
	// 			->get('jobcard_work_logs')
	// 			->row();

	// 		if ($alreadyStarted) {
	// 			echo json_encode(['status' => 'already_started']);
	// 			return;
	// 		}
	// 	}

	// 	$data = [
	// 		'jobcard_id' => $jobcard_id,
	// 		'jobcard_service_id' => $description_id,
	// 		'employee_id' => $employee_id,
	// 		'status' => $status,
	// 		'log_time' => date('Y-m-d H:i:s')
	// 	];

	// 	$this->db->insert('jobcard_work_logs', $data);

	// 	echo json_encode(['status' => 'success']);
	// }

	public function log_work_time()
	{
		$jobcard_id     = $this->input->post('jobcard_id');
		$service_id     = $this->input->post('description_id'); // jobcard_service_id
		$employee_id    = $this->input->post('employee_id');
		$status         = $this->input->post('status');

		// âŒ Prevent START more than once
		if ($status === 'START') {
			$alreadyStarted = $this->db
				->where('jobcard_service_id', $service_id)
				->where('status', 'START')
				->get('jobcard_work_logs')
				->row();

			if ($alreadyStarted) {
				echo json_encode(['status' => 'already_started']);
				return;
			}


			// 2ï¸âƒ£ Update jobcard status to Inprogress
			$this->db->where('jobcard_id', $jobcard_id)
				->update('job_cards', [
					'status'     => 'In Progress',
					// 'updated_at' => date('Y-m-d H:i:s')
				]);
		}

		// âœ… Insert log
		$this->db->insert('jobcard_work_logs', [
			'jobcard_id'          => $jobcard_id,
			'jobcard_service_id'  => $service_id,
			'employee_id'         => $employee_id,
			'status'              => $status,
			'log_time'            => date('Y-m-d H:i:s')
		]);

		// =====================================================
		// âœ… JOB CARD COMPLETION LOGIC (ONLY ON STOP)
		// =====================================================
		if ($status === 'STOP') {

			// 1ï¸âƒ£ Total services under this jobcard
			$totalServices = $this->db
				->where('jobcard_id', $jobcard_id)
				->count_all_results('jobcard_services');

			// 2ï¸âƒ£ Services which have at least ONE STOP log
			$stoppedServices = $this->db
				->select('COUNT(DISTINCT jobcard_service_id) AS total')
				->where('jobcard_id', $jobcard_id)
				->where('status', 'STOP')
				->get('jobcard_work_logs')
				->row()
				->total;

			// 3ï¸âƒ£ If all services stopped â†’ complete jobcard
			if ($totalServices > 0 && $totalServices == $stoppedServices) {

				$this->db
					->where('jobcard_id', $jobcard_id)
					->update('job_cards', [
						'status'        => 'Finished',
						'completion_time' => date('H:i:s')
					]);
			}
		}

		echo json_encode(['status' => 'success']);
	}



	public function create_from_quotation($quotation_id)
	{

		// 1. Get quotation
		$quotation = $this->Quotation_model->get_quotation($quotation_id);
		if (!$quotation || $quotation->status !== 'Approved') {
			show_error('Quotation not approved');
		}

		// 2. Check if jobcard already exists
		$existing = $this->Jobcard_model->get_by_quotation($quotation_id);
		if ($existing) {
			redirect('jobcard/edit/' . $existing->jobcard_id);
		}

		// 3. Create jobcard

		$jobcard_id = $this->Jobcard_model->create_from_quotation($quotation_id);

		redirect('jobcard/edit/' . $jobcard_id);
	}

	public function list_by_status($status)
	{
		$map = [
			'pending'     => 'Pending',
			'in-progress' => 'In Progress',
			'completed'   => 'Completed'
		];

		$status = strtolower($status);

		if (!isset($map[$status])) {
			show_error('Invalid Job Status');
		}

		$db_status = $map[$status];

		$data['page_title'] = $db_status . ' Job Cards';
		$data['jobcards']   = $this->Jobcard_model->get_jobcards_by_status($db_status);





		$data['title'] = 'job card list';
		$data['main_content'] = 'jobcard/jobcard_status_list'; // SAME PAGE

		$this->load->view('includes/template', $data);
	}
}

