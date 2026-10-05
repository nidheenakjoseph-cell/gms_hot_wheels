<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class DirectQuotation extends MY_Controller
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


		$this->load->model('Supplier_model');
		$this->load->model('Direct_quotation_model');
		$this->load->model('Service_model');
	}

	/**
	 * Quotation listing page
	 */
	public function index()

	{
		$data['title'] = 'Direct Quotation List';


		////////////////////////////////start quotations code//////////////////


		$year = date('Y');

		$last = $this->db
			->like('quotation_no', "QTD-$year-", 'after')
			->order_by('quotation_id', 'DESC')
			->limit(1)
			->get('direct_quotations')
			->row();

		if ($last) {
			$last_no = intval(substr($last->quotation_no, -4));
			$new_no  = str_pad($last_no + 1, 4, '0', STR_PAD_LEFT);
		} else {
			$new_no = '0001';
		}

		$data['Quotation_code'] = "QTD-$year-$new_no";
		/////////////////////////////////////////////





		$data['username'] = $this->session->userdata('username');
		$data['userid'] = $this->session->userdata('user_id');


		$this->load->model('Direct_quotation_model');
		$data['services_master'] = $this->Direct_quotation_model->get_all_services();


		$data['parts'] = $this->SpareParts_model->get_all_parts();
		$data['brands'] = $this->SpareParts_model->get_all_brands();
		$data['unit_records'] = $this->Supplier_model->get_units();
		$data['Newparts'] = $this->SpareParts_model
			->get_parts_by_part_type("New Parts");

		$data['afterparts'] = $this->SpareParts_model
			->get_parts_by_part_type("Aftermarket Parts");

		$data['usedparts'] = $this->SpareParts_model
			->get_parts_by_part_type("Used Parts");

		// print_r($data['brands']);
		// exit;





		$data['main_content'] = 'direct_quotation/add_direct_quotations';
		$this->load->view('includes/template', $data);
	}




	public function add_quotations()
	{
		$post = $this->input->post();

		$data = [




			// Header
			'subtotal'            => $post['subtotal'] ?? 0,
			'tax_amount'          => $post['tax_amount'] ?? 0,
			'tdiscount'           => $post['tdiscount'] ?? 0,
			'grand_total'         => $post['grand_total'] ?? 0,
			'remarks'             => $post['remarks'] ?? '',
			'status'              => 'Approved',

			'srvice_discount'     => $post['service_discount'] ?? 0,
			'sublet_discount'     => $post['sublet_discount'] ?? 0,
			'branch_id'           => $post['branch_id'] ?? get_primary_branch_id(),
			'quotation_date'      => $post['edate'] ?? date('Y-m-d'),

			'est_delivery_date'   => $post['estdeldate'] ?? null,
			'est_completion_time' => $post['completiontime'] ?? null,
			'customer_estimated_price' => $post['customer_estimated_price'] ?? 0,

			// Parts
			'part_id'             => $post['part_id'] ?? [],
			'part_qty'            => $post['part_qty'] ?? [],
			'unit_price'          => $post['unit_price'] ?? [],
			'selling_price'       => $post['selling_price'] ?? [],
			'total_price'         => $post['total_price'] ?? [],
			'discount'            => $post['discount'] ?? [],
			'discountamt'         => $post['discountamt'] ?? [],
			'part_type'           => $post['part_type'] ?? [],
			'customer_selected'   => $post['customer_selected'] ?? [],
			'partremarks'         => $post['part_warrenty'] ?? [],

			// Services
			'service_id'          => $post['service_id'] ?? [],
			'service_time'        => $post['service_time'] ?? [],
			'service_cost'        => $post['service_cost'] ?? [],
			'total_cost'          => $post['total_cost'] ?? [],

			// Sublet
			'job_description'     => $post['job_description'] ?? [],
			'job_amount'          => $post['job_amount'] ?? [],



			// 'remarks'             => $post['remarks'] ?? '',
			'kmin'                => $post['kmin'] ?? '',
			'completiontime'      => $post['completiontime'] ?? '',
			'estdeldate'          => $post['estdeldate'] ?? '',

			'vehicle_vinNo'       => $post['vehicle_vinNo'] ?? '',
			'vehicle_numberPlate' => $post['vehicle_numberPlate'] ?? '',
			'vehicle_model'       => $post['vehicle_model'] ?? '',

			'quotation_time'       => $post['quotation_time'] ?? '',
			'quotation_no'       => $post['quotation_no'] ?? '',

			'customer_name'       => $post['customer_name'] ?? '',
			'customer_contact'    => $post['customer_contact'] ?? '',
			'customer_email'      => $post['customer_email'] ?? '',

			'customer_approval'      => $post['customer_approval'] ?? '',


		];

		$result = $this->Direct_quotation_model->saveQuotation($data);

		if ($result) {

			$this->session->set_flashdata(
				'success',
				'Quotation Added Successfully'
			);

			redirect('DirectQuotation/quotation_list/');
		} else {

			$this->session->set_flashdata(
				'error',
				'Failed to Save'
			);

			redirect('DirectQuotation/');
		}
	}


	public function quotation_list()
	{

		$data['title'] = 'Direct Quotation List';
		$data['quotations'] = $this->Direct_quotation_model->get_all_quotations();
		$company_id = get_current_company_id();
		$wa_settings = $this->db->get_where('whatsapp_settings', ['company_id' => $company_id])->row();
		$data['whatsapp_enabled'] = !empty($wa_settings->whatsapp_enabled);



		$data['main_content'] = 'direct_quotation/list_direct_quotations';
		$this->load->view('includes/template', $data);
	}



	// public function edit($quotation_id)
	// {

	// 	$data['username'] = $this->session->userdata('username');
	// 	$data['userid'] = $this->session->userdata('user_id');
	// 	$data['quotation'] = $this->Direct_quotation_model->get_quotation($quotation_id);

	// 	if (!$data['quotation']) {
	// 		show_404();
	// 	}

	// 	// 3ï¸âƒ£ Sub tables
	//$job_descriptions = $this->Estimation_model->get_job_descriptions($data['quotation']->estimation_id);



	// 	$parts_used_new = $this->Direct_quotation_model
	// 		->get_parts_type_forquote($data['quotation']->estimation_id, "New Parts");

	// 	$parts_used_after = $this->Direct_quotation_model
	// 		->get_parts_type_forquote($data['quotation']->estimation_id, "Aftermarket Parts");

	// 	$parts_used_used = $this->Direct_quotation_model
	// 		->get_parts_type_forquote($data['quotation']->estimation_id, "Used Parts");



	// 	$data['parts_used_new']       = $parts_used_new;
	// 	$data['parts_used_after']       = $parts_used_after;
	// 	$data['parts_used_used']       = $parts_used_used;




	// 	if ($data['quotation']->status == 'Approved') {
	// 		$services_used = $this->Direct_quotation_model->get_services($data['quotation']->quotation_id);
	// 	}

	// 	$inspection = $this->Inspection_view_model->get_by_inspection($data['quotation']->inspection_id);
	// 	$data['parts'] = $this->SpareParts_model->get_all_parts();
	// 	$data['brands'] = $this->SpareParts_model->get_all_brands();
	// 	$data['services_master'] = $this->db->where('status', 'Active')->get('services_master')->result();



	// 	$data['services_used']    = $services_used;



	// 	$data['usedbrands'] = $this->SpareParts_model->get_brands_by_part_type("Used Parts");
	// 	$data['newbrands'] = $this->SpareParts_model->get_brands_by_part_type("New Parts");
	// 	$data['afterbrands'] = $this->SpareParts_model->get_brands_by_part_type("Aftermarket Parts");

	// 	$data['Newparts'] = $this->SpareParts_model->get_parts_by_part_type("New Parts");

	// 	$data['afterparts'] = $this->SpareParts_model->get_parts_by_part_type("Aftermarket Parts");
	// 	$data['usedparts'] = $this->SpareParts_model->get_parts_by_part_type("Used Parts");





	// 	$data['parts']    = $this->Quotation_model->get_parts($quotation_id);
	// 	$data['services'] = $this->Quotation_model->get_services($quotation_id);

	// 	$data['locked'] = ($data['quotation']->status === 'Approved');

	// 	$data['title'] = 'Quotation Edit';

	// 	$data['main_content'] = 'direct_quotation/edit_direct_quotations';

	// 	$this->load->view('includes/template', $data);
	// }

	public function edit($quotation_id)
	{

		$data['username'] = $this->session->userdata('username');
		$data['userid'] = $this->session->userdata('user_id');

		// 1ï¸âƒ£ Get estimation header
		$data['quotation'] = $this->Direct_quotation_model->get_quotation($quotation_id);
		if (!($data['quotation'])) show_404();


		// print_r($data['quotation'] );
		// exit;
		// get customer and vehicle details

		// Customer from inspection
		// $customer = $this->Customer_model
		// 	->get_customer($estimation->customer_id);

		// Vehicle from inspection
		// $vehicle = $this->Vehicle_model
		// 	->get_vehicle($estimation->vehicle_id);


		// 2ï¸âƒ£ Appointment + customer + vehicle
		// $appointment = $this->Estimation_model
		// 	->get_appointment_details($estimation->appointment_id);

		// 3ï¸âƒ£ Sub tables
		// $job_descriptions = $this->Estimation_model
		// 	->get_job_descriptions($estimation_id);

		// $parts_used = $this->Estimation_model
		// 	->get_parts($estimation_id);

		// $parts_used_new = $this->Estimation_model
		// 	->get_parts_type($estimation_id, "New Parts");

		// $parts_used_after = $this->Estimation_model
		// 	->get_parts_type($estimation_id, "Aftermarket Parts");

		// $parts_used_used = $this->Estimation_model
		// 	->get_parts_type($estimation_id, "Used Parts");


		$parts_used_new = $this->Direct_quotation_model
			->get_parts_type_forquote($data['quotation']->quotation_id, "New Parts");

		$parts_used_after = $this->Direct_quotation_model
			->get_parts_type_forquote($data['quotation']->quotation_id, "Aftermarket Parts");

		$parts_used_used = $this->Direct_quotation_model
			->get_parts_type_forquote($data['quotation']->quotation_id, "Used Parts");

		$services_used = $this->Direct_quotation_model
			->get_services($quotation_id);


		$job_descriptions = $this->Direct_quotation_model
			->get_job_descriptions($quotation_id);


		// 4ï¸âƒ£ Masters (dropdown data)
		$data['parts'] = $this->SpareParts_model->get_all_parts();
		$data['brands'] = $this->SpareParts_model->get_all_brands();


		$data['services_master'] = $this->db->where('status', 'Active')
			->get('services_master')
			->result();




		// $inspection = $this->Inspection_view_model->get_by_inspection($estimation->inspection_id);
		// $data['kms'] = $inspection->km_reading ?? $estimation->kmin;
		// $data['estdate'] = $inspection->deliverytime ?? $estimation->est_completion_time;



		// $data['technicians'] = $this->Employee_model->get_active_technicians();
		$data['service_discount'] = $estimation->service_discount ?? null;
		$data['sublet_discount'] = $estimation->sublet_discount ?? null;

		$data['unit_records'] = $this->Supplier_model->get_units();

		$data['usedbrands'] = $this->SpareParts_model
			->get_brands_by_part_type("Used Parts");
		$data['newbrands'] = $this->SpareParts_model
			->get_brands_by_part_type("New Parts");
		$data['afterbrands'] = $this->SpareParts_model
			->get_brands_by_part_type("Aftermarket Parts");

		$data['Newparts'] = $this->SpareParts_model
			->get_parts_by_part_type("New Parts");

		$data['afterparts'] = $this->SpareParts_model
			->get_parts_by_part_type("Aftermarket Parts");
		$data['usedparts'] = $this->SpareParts_model
			->get_parts_by_part_type("Used Parts");

		// 5ï¸âƒ£ Send data to view
		// $data['estimation']       = $estimation;
		// $data['appointment']      = $appointment;

		// $data['customer']      = $customer;
		// $data['vehicle']      = $vehicle;
		// $data['parts_used']       = $parts_used;
		$data['parts_used_new']       = $parts_used_new;
		$data['parts_used_after']       = $parts_used_after;
		$data['parts_used_used']       = $parts_used_used;
		$data['services_used']    = $services_used;
		$data['job_descriptions'] = $job_descriptions;


		// $data['estimation_id'] = $estimation_id;
		// $data['estimation_no'] = $estimation->estimation_no;

		$data['title'] = 'Quotation Edit';

		$data['main_content'] = 'direct_quotation/edit_direct_quotations';

		$this->load->view('includes/template', $data);
	}

	public function send_email($quotation_id)
	{
		$quotation = $this->Direct_quotation_model->get_quotation($quotation_id);
		if (!$quotation) return $this->email_response(false, 'Direct quotation not found.');
		$recipient = trim($this->input->post('email')) ?: ($quotation->customer_email ?? '');
		if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) return $this->email_response(false, 'Please enter a valid email address.');

		$data = [
			'document_type' => 'Direct Quotation', 'document_no' => $quotation->quotation_no, 'document_date' => $quotation->quotation_date,
			'customer_name' => $quotation->customer_name, 'vehicle_no' => $quotation->vehicle_numberPlate,
			'items' => array_merge($this->Direct_quotation_model->get_services($quotation_id), $this->Direct_quotation_model->get_parts_type_forquote($quotation_id, 'New Parts'), $this->Direct_quotation_model->get_parts_type_forquote($quotation_id, 'Aftermarket Parts'), $this->Direct_quotation_model->get_parts_type_forquote($quotation_id, 'Used Parts'), $this->Direct_quotation_model->get_job_descriptions($quotation_id)),
			'total' => $quotation->grand_total,
		];
		$pdf_path = $this->create_email_pdf($data, 'direct_quotation_' . $quotation_id);
		$this->load->library('gms_mailer');
		$company_id   = get_current_company_id();
		$company_name = $this->gms_mailer->get_company_name($company_id);
		$result = $this->gms_mailer->send_notification($recipient, 'quotation_sent', [
			'{customer_name}' => $quotation->customer_name, '{vehicle_no}' => $quotation->vehicle_numberPlate,
			'{quotation_no}' => $quotation->quotation_no,
			'{amount}' => number_format((float) $quotation->grand_total, 2),
			'{quotation_amount}' => number_format((float) $quotation->grand_total, 2),
			'{date}' => date('d/m/Y', strtotime($quotation->quotation_date)), '{company_name}' => $company_name,
		], $pdf_path, $company_id);
		@unlink($pdf_path);
		return $this->email_response($result['status'], $result['message']);
	}

	private function create_email_pdf($data, $filename)
	{
		$options = new Options(); $options->set('isRemoteEnabled', true); $dompdf = new Dompdf($options);
		$dompdf->loadHtml($this->load->view('email/document_pdf', $data, true)); $dompdf->setPaper('A4', 'portrait'); $dompdf->render();
		$cache_dir = FCPATH . 'application/cache/';
		if (!is_dir($cache_dir)) { mkdir($cache_dir, 0755, true); }
		$path = $cache_dir . $filename . '_' . uniqid() . '.pdf'; file_put_contents($path, $dompdf->output()); return $path;
	}

	private function email_response($status, $message)
	{
		$this->output->set_content_type('application/json')->set_output(json_encode(['status' => (bool) $status, 'message' => $message]));
	}

	public function delete($quotation_id)
	{
		$this->Direct_quotation_model->delete_quotation($quotation_id);
		redirect('DirectQuotation/quotation_list');
	}


	// public function update()
	// {
	// 	$data['username'] = $this->session->userdata('username');
	// 	$data['userid']   = $this->session->userdata('user_id');


	// 	print_r($_POST);
	// 	exit;

	// 	$quotation_id    = $this->input->post('quotation_id');
	// 	$create_revision  = $this->input->post('create_revision');

	// 	if (!$quotation_id) {
	// 		show_error('Invalid Estimation');
	// 	}

	// 	/* =====================================================
	// 		1ï¸âƒ£ GET ORIGINAL ESTIMATION
	// 		===================================================== */

	// 	$original = $this->db
	// 		->where('quotation_id', $quotation_id)
	// 		->get('direct_quotations')
	// 		->row();

	// 	if (!$original) {
	// 		show_error('direct quotations is not found');
	// 	}

	// 	/* ===================================================== 
	// 		2ï¸âƒ£ PREPARE ESTIMATION DATA
	// 		===================================================== */

	// 	$estimationData = [

	// 		'subtotal'        => $this->input->post('subtotal'),
	// 		'tax_amount'      => $this->input->post('tax_amount'),
	// 		'discount'        => $this->input->post('tdiscount'),
	// 		'grand_total'     => $this->input->post('grand_total'),

	// 		'status'          =>  $this->input->post('custapproval'),

	// 		'customer_approval' => $this->input->post('custapproval'),
	// 		'customer_estimated_price' => $this->input->post('estimatedprice'),
	// 		'est_delivery_date' => $this->input->post('estdeldate'),
	// 		'est_completion_time' => $this->input->post('completiontime'),
	// 		'estimation_date' => $this->input->post('edate'),

	// 		'remarks'         => $this->input->post('remarks'),
	// 		'kmin'            => $this->input->post('kmin'),
	// 		'service_discount' => $this->input->post('service_discount'),
	// 		'sublet_discount' => $this->input->post('sublet_discount'),
	// 	];

	// 	/* =====================================================
	// 		3ï¸âƒ£ REVISION LOGIC
	// 		===================================================== */

	// 	if ($create_revision) {

	// 		// determine parent
	// 		$parent_id = $original->parent_quotation_id
	// 			? $original->parent_quotation_id
	// 			: $original->quotation_id;

	// 		$parent_est  = $this->db
	// 			->select('quotation_no')
	// 			->where('quotation_id', $parent_id)
	// 			->get('estimations')
	// 			->row();

	// 		$base_est = $parent_est->estimation_no;

	// 		// get next revision number
	// 		$max_revision = $this->db
	// 			->select_max('revision_no')
	// 			->where("(quotation_id = $parent_id OR parent_quotation_id = $parent_id)")
	// 			->get('estimations')
	// 			->row()
	// 			->revision_no;

	// 		$new_revision_no = ($max_revision !== null)
	// 			? $max_revision + 1
	// 			: 1;


	// 		// mark old revisions not latest
	// 		$this->db->where("(quotation_id = $parent_id OR parent_quotation_id = $parent_id)")
	// 			->update('direct_quotations', ['is_latest' => 0]);


	// 		// get base estimation number
	// 		// $base_est = preg_replace('/-REV-\d+$/', '', $original->estimation_no);

	// 		// create new estimation revision
	// 		$newData = array_merge($estimationData, [

	// 			'appointment_id' => $original->appointment_id,
	// 			'inspection_id'  => $original->inspection_id,
	// 			'customer_id'    => $original->customer_id,
	// 			'vehicle_id'     => $original->vehicle_id,
	// 			'estimation_date'     => $original->estimation_date,

	// 			'parent_estimation_id' => $parent_id,
	// 			'revision_no'          => $new_revision_no,
	// 			'is_latest'            => 1,

	// 			'estimation_no' => $base_est . '-REV-' . $new_revision_no,

	// 			'created_at'    => date('Y-m-d H:i:s')

	// 		]);


	// 		$this->db->insert('direct_quotations', $newData);

	// 		// IMPORTANT: use new estimation id
	// 		$estimation_id = $this->db->insert_id();
	// 	} else {

	// 		// normal update
	// 		$this->Direct_quotation_model->update_direct_quotation(
	// 			$quotation_id,
	// 			$estimationData
	// 		);

	// 		// delete old child rows before saving updated ones
	// 		// $this->Estimation_model->delete_jobs($estimation_id);
	// 		// $this->Estimation_model->delete_parts($estimation_id);
	// 		// $this->Estimation_model->delete_services($estimation_id);
	// 	}


	// 	/* =====================================================
	// 	4ï¸âƒ£ SAVE JOB DESCRIPTIONS (POST DATA ONLY)
	// 	===================================================== */

	// 	$this->Direct_quotation_model->save_job_descriptions(
	// 		$quotation_id,
	// 		$this->input->post('job_description') ?? [],
	// 		$this->input->post('job_amount') ?? [],
	// 		$this->input->post('sublet_discount')
	// 	);


	// 	/* =====================================================
	// 	5ï¸âƒ£ SAVE PARTS (POST DATA ONLY)
	// 	===================================================== */

	// 	$this->Direct_quotation_model->save_parts(
	// 		$quotation_id,
	// 		$this->input->post('part_id') ?? [],
	// 		$this->input->post('part_qty') ?? [],
	// 		$this->input->post('unit_price') ?? [],
	// 		$this->input->post('selling_price') ?? [],
	// 		$this->input->post('total_price') ?? [],
	// 		$this->input->post('markup') ?? [],
	// 		$this->input->post('discount') ?? [],
	// 		$this->input->post('discountamt') ?? [],
	// 		$this->input->post('part_type') ?? [],
	// 		$this->input->post('brand_id') ?? [],
	// 		$this->input->post('customer_selected') ?? [],
	// 		$this->input->post('part_warrenty') ?? []
	// 	);


	// 	/* =====================================================
	// 		6ï¸âƒ£ SAVE SERVICES (POST DATA ONLY)
	// 		===================================================== */

	// 	$this->Direct_quotation_model->save_services(
	// 		$quotation_id,
	// 		$this->input->post('service_id') ?? [],
	// 		$this->input->post('service_time') ?? [],
	// 		$this->input->post('service_cost') ?? [],
	// 		$this->input->post('total_cost') ?? [],
	// 		$this->input->post('service_discount')
	// 	);


	// 	/* =====================================================
	// 		7ï¸âƒ£ REDIRECT
	// 		===================================================== */

	// 	redirect('DirectQuotation/edit/' . $quotation_id);
	// }

	public function update()
	{
		$quotation_id   = $this->input->post('quotation_id');
		$create_revision = $this->input->post('create_revision');

		if (!$quotation_id) {
			show_error('Invalid Quotation');
		}

		/* =====================================================
        1. GET ORIGINAL QUOTATION
    ===================================================== */

		$original = $this->db
			->where('quotation_id', $quotation_id)
			->get('direct_quotations')
			->row();

		if (!$original) {
			show_error('Quotation not found');
		}

		/* =====================================================
        2. MAIN QUOTATION DATA
    ===================================================== */

		$quotationData = [

			'subtotal'      => $this->input->post('subtotal'),
			'tax_amount'    => $this->input->post('tax_amount'),
			'discount'      => $this->input->post('tdiscount'),
			'grand_total'   => $this->input->post('grand_total'),

			// enum values must match DB
			'status' => $this->input->post('custapproval')
				? ucfirst(strtolower($this->input->post('custapproval')))
				: 'Draft',

			'customer_approval'        => $this->input->post('custapproval'),
			'customer_estimated_price' => $this->input->post('estimatedprice'),

			// correct column names
			'est_delivery_date'   => $this->input->post('estdeldate'),
			'est_completion_time' => $this->input->post('completiontime'),
			'quotation_date'      => $this->input->post('edate'),

			'remarks' => $this->input->post('remarks'),
			'kmin'    => $this->input->post('kmin'),

			// correct DB columns
			'srvice_discount' => $this->input->post('service_discount'),
			'sublet_discount' => $this->input->post('sublet_discount'),
		];

		/* =====================================================
        3. REVISION LOGIC
    ===================================================== */

		if ($create_revision) {

			$parent_id = $original->parent_quotation_id
				? $original->parent_quotation_id
				: $original->quotation_id;

			// get parent quotation
			$parent = $this->db
				->where('quotation_id', $parent_id)
				->get('direct_quotations')
				->row();

			$base_quotation_no = preg_replace(
				'/-REV-\d+$/',
				'',
				$parent->quotation_no
			);

			// get next revision number
			$max_revision = $this->db
				->select_max('revision_no')
				->group_start()
				->where('quotation_id', $parent_id)
				->or_where('parent_quotation_id', $parent_id)
				->group_end()
				->get('direct_quotations')
				->row()
				->revision_no;

			$new_revision_no = $max_revision
				? $max_revision + 1
				: 1;

			// old revisions not latest
			$this->db
				->group_start()
				->where('quotation_id', $parent_id)
				->or_where('parent_quotation_id', $parent_id)
				->group_end()
				->update('direct_quotations', [
					'is_latest' => 0
				]);

			// create new revision
			$newData = array_merge($quotationData, [

				'quotation_no' => $base_quotation_no . '-REV-' . $new_revision_no,

				'estimation_id' => $original->estimation_id,
				'appointment_id' => $original->appointment_id,
				'inspection_id' => $original->inspection_id,
				'customer_id' => $original->customer_id,
				'vehicle_id' => $original->vehicle_id,

				'parent_quotation_id' => $parent_id,
				'revision_no' => $new_revision_no,

				'created_at' => date('Y-m-d H:i:s')
			]);

			$this->db->insert('direct_quotations', $newData);

			$quotation_id = $this->db->insert_id();
		} else {

			// normal update
			$this->Direct_quotation_model
				->update_direct_quotation(
					$quotation_id,
					$quotationData
				);
		}

		/* =====================================================
        4. SAVE JOBS
    ===================================================== */

		$this->Direct_quotation_model->save_job_descriptions(
			$quotation_id,
			$this->input->post('job_description') ?? [],
			$this->input->post('job_amount') ?? [],
			$this->input->post('sublet_discount')
		);

		/* =====================================================
        5. SAVE PARTS
    ===================================================== */

		$this->Direct_quotation_model->save_parts(
			$quotation_id,
			$this->input->post('part_id') ?? [],
			$this->input->post('part_qty') ?? [],
			$this->input->post('unit_price') ?? [],
			$this->input->post('selling_price') ?? [],
			$this->input->post('total_price') ?? [],
			$this->input->post('markup') ?? [],
			$this->input->post('discount') ?? [],
			$this->input->post('discountamt') ?? [],
			$this->input->post('part_type') ?? [],
			$this->input->post('brand_id') ?? [],
			$this->input->post('customer_selected') ?? [],
			$this->input->post('part_warrenty') ?? []
		);

		/* =====================================================
        6. SAVE SERVICES
    ===================================================== */

		$this->Direct_quotation_model->save_services(
			$quotation_id,
			$this->input->post('service_id') ?? [],
			$this->input->post('service_time') ?? [],
			$this->input->post('service_cost') ?? [],
			$this->input->post('total_cost') ?? [],
			$this->input->post('service_discount')
		);

		redirect('DirectQuotation/edit/' . $quotation_id);
	}
}

