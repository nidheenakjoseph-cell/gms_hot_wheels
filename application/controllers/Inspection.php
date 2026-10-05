<?php defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;


class Inspection extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model([
			'Inspection_model',
			'Inspection_view_model',
			'Works_requested_model',
			'Inventory_status_model',
			'Service_model',
			'Customer_model',
			'Vehicle_model'
		]);
	}

	// Create inspection from appointment
	public function create($appointment_id)
	{

		$data['username'] = $this->session->userdata('username');
		$data['userid'] = $this->session->userdata('user_id');
		// Prevent duplicate inspection
		$existing = $this->Inspection_view_model->get_by_appointment($appointment_id);
		if ($existing) {
			// log_message("error","from create");
			// redirect('inspection/view/' . $existing->inspection_id);

			redirect('inspection/edit/' . $existing->inspection_id);
		}

		// Get appointment + customer + vehicle
		$appointment = $this->Inspection_view_model->get_appointment_details($appointment_id);
		if (!$appointment) show_404();

		$customer = null;
		$vehicle = null;

		if (!empty($appointment->customer_id)) {
			$customer = $this->Customer_model->get_customer($appointment->customer_id);
		}

		if (!empty($appointment->vehicle_id)) {
			$vehicle = $this->Vehicle_model->get_vehicle($appointment->vehicle_id);
		}

		// Create inspection record (DRAFT)
		$inspection_id = $this->Inspection_view_model->create_inspection([
			'branch_id'       => $appointment->branch_id ?? get_primary_branch_id(),
			'appointment_id'  => $appointment_id,
			'customer_id'     => $appointment->customer_id,
			'vehicle_id'      => $appointment->vehicle_id,
			'inspection_date' => date('Y-m-d'),
			'inspection_time' => date('H:i:s'),
			// 'km_reading'      => $appointment->km ?? 0,
			'status'          => 'Draft'
		]);
		$data['services'] = $this->Service_model->get_active_services();
		// Load masters
		$data['inspection_id'] = $inspection_id;
		$data['appointment']   = $appointment;
		$data['customer']      = $customer;
		$data['vehicle']       = $vehicle;
		$data['items']         = $this->Inspection_model->get_all_items();
		$data['works']         = $this->Works_requested_model->get_all();
		$data['inventory']     = $this->Inventory_status_model->get_all();
		$data['packages']      = $this->Inspection_model->get_all_packageitems();

		$grouped = [];
		foreach ($data['items'] as $item) {
			$grouped[$item->category][] = $item;
		}
		$data['grouped_items'] = $grouped;
		$data['title'] = "Inspection Report";
		$data['main_content'] = 'inspection/create';
		$this->load->view('includes/template', $data);
	}

	// normal Save inspection

	// public function save()
	// {
	// 	$inspection_id = $this->input->post('inspection_id');
	// 	   $create_revision = $this->input->post('create_revision');

	// 	if (!$inspection_id) {
	// 		show_error('Invalid Inspection');
	// 	}

	// 	// 1ï¸âƒ£ Update main inspection table
	// 	$inspectionData = [
	// 		'km_reading'    => $this->input->post('km_reading'),
	// 		'fuel_level'    => $this->input->post('fuel_level'),
	// 		'remarks'       => $this->input->post('remarks'),
	// 		'status'        => 'Completed',
	// 		'drivername'     => $this->input->post('driver_name'),
	// 		'driverphno' => $this->input->post('driver_mobile'),
	// 		'deliverytime' => $this->input->post('delivery_time'),
	// 		'deliverydate'       => $this->input->post('delivery_date'),
	// 		'techremarks'       => $this->input->post('tecremarks'),
	// 		'inspackage'       => $this->input->post('inspackage'),
	// 	];

	// 	$this->Inspection_model->update_inspection($inspection_id, $inspectionData);

	// 	// 2ï¸âƒ£ Save Inspection Items (A / C / S)
	// 	if ($this->input->post('item_status')) {
	// 		foreach ($this->input->post('item_status') as $item_id => $status) {
	// 			$this->Inspection_model->save_item_result(
	// 				$inspection_id,
	// 				$item_id,
	// 				$status
	// 			);
	// 		}
	// 	}

	// 	// 3ï¸âƒ£ Save Services / Description table
	// 	$service_ids     = $this->input->post('service_id') ?? [];
	// 	$custom_services = $this->input->post('custom_service') ?? [];

	// 	$this->Inspection_model->save_inspection_services(
	// 		$inspection_id,
	// 		$service_ids,
	// 		$custom_services
	// 	);

	// 	// 4ï¸âƒ£ Save Works Requested
	// 	$works = $this->input->post('works_requested') ?? [];
	// 	$this->Inspection_model->save_works_requested($inspection_id, $works);

	// 	// 5ï¸âƒ£ Save Inventory Status
	// 	$inventory = $this->input->post('inventory_status') ?? [];
	// 	$this->Inspection_model->save_inventory_status($inspection_id, $inventory);

	// 	// inspection photos

	// 	$this->Inspection_model->save_inspection_photos(
	// 		$inspection_id,
	// 		$_FILES['inspection_photos']
	// 	);


	// 	// 6ï¸âƒ£ Redirect to inspection view / preview
	// 	redirect('inspection/edit/' . $inspection_id);
	// 	// redirect('estimation/create/' . $inspection_id);
	// }
	// save with revision
	// public function save()
	// {
	// 	$inspection_id    = $this->input->post('inspection_id');
	// 	$create_revision  = $this->input->post('create_revision');

	// 	if (!$inspection_id) {
	// 		show_error('Invalid Inspection');
	// 	}

	// 	// Prepare data
	// 	$inspectionData = [
	// 		'km_reading'   => $this->input->post('km_reading'),
	// 		'fuel_level'   => $this->input->post('fuel_level'),
	// 		'remarks'      => $this->input->post('remarks'),
	// 		'status'       => 'Completed',
	// 		'drivername'   => $this->input->post('driver_name'),
	// 		'driverphno'   => $this->input->post('driver_mobile'),
	// 		'deliverytime' => $this->input->post('delivery_time'),
	// 		'deliverydate' => $this->input->post('delivery_date'),
	// 		'techremarks'  => $this->input->post('tecremarks'),
	// 		'inspackage'   => $this->input->post('inspackage'),
	// 		'updated_at'   => date('Y-m-d H:i:s')
	// 	];

	// 	// ============================================================
	// 	// REVISION MODE
	// 	// ============================================================
	// 	if ($create_revision) {
	// 		// 1ï¸âƒ£ Get original inspection
	// 		$original = $this->Inspection_view_model->get_by_inspection($inspection_id);

	// 		// 2ï¸âƒ£ Find next revision number
	// 		$next_revision = $this->Inspection_view_model->get_next_revision_no($inspection_id);

	// 		// 3ï¸âƒ£ Prepare revision data
	// 		$revisionData = array_merge((array)$original, $inspectionData);

	// 		unset($revisionData['inspection_id']); // remove PK

	// 		$revisionData['parent_inspection_id'] = $inspection_id;
	// 		$revisionData['revision_no']          = $next_revision;
	// 		$revisionData['is_revision']         = 1;
	// 		$revisionData['created_at']          = date('Y-m-d H:i:s');

	// 		// 4ï¸âƒ£ Insert revision
	// 		$new_inspection_id = $this->Inspection_view_model->insert_inspection($revisionData);

	// 		// 5ï¸âƒ£ Copy child tables
	// 		$this->Inspection_view_model->copy_items($inspection_id, $new_inspection_id);
	// 		$this->Inspection_view_model->copy_services($inspection_id, $new_inspection_id);
	// 		$this->Inspection_view_model->copy_inventory($inspection_id, $new_inspection_id);
	// 		$this->Inspection_view_model->copy_photos($inspection_id, $new_inspection_id);
	// 		$this->Inspection_view_model->copy_damage_marks($inspection_id, $new_inspection_id);

	// 		$inspection_id = $new_inspection_id;
	// 	} else {
	// 		// NORMAL UPDATE
	// 		$this->Inspection_model->update_inspection($inspection_id, $inspectionData);
	// 	}

	// 	// ============================================================
	// 	// SAVE CHILD TABLES (for revision or update)
	// 	// ============================================================

	// 	if ($this->input->post('item_status')) {
	// 		foreach ($this->input->post('item_status') as $item_id => $status) {
	// 			$this->Inspection_model->save_item_result(
	// 				$inspection_id,
	// 				$item_id,
	// 				$status
	// 			);
	// 		}
	// 	}

	// 	$service_ids     = $this->input->post('service_id') ?? [];
	// 	$custom_services = $this->input->post('custom_service') ?? [];

	// 	$this->Inspection_model->save_inspection_services(
	// 		$inspection_id,
	// 		$service_ids,
	// 		$custom_services
	// 	);

	// 	$works = $this->input->post('works_requested') ?? [];
	// 	$this->Inspection_model->save_works_requested($inspection_id, $works);

	// 	$inventory = $this->input->post('inventory_status') ?? [];
	// 	$this->Inspection_model->save_inventory_status($inspection_id, $inventory);

	// 	$this->Inspection_model->save_inspection_photos(
	// 		$inspection_id,
	// 		$_FILES['inspection_photos']
	// 	);

	// 	redirect('inspection/edit/' . $inspection_id);
	// }
public function save()
{
	
    $inspection_id    = $this->input->post('inspection_id');
    $create_revision  = $this->input->post('create_revision');

    if (!$inspection_id) {
        show_error('Invalid Inspection');
    }

    /* ============================================================
    1ï¸âƒ£ GET ORIGINAL INSPECTION
    ============================================================ */

    $original = $this->Inspection_view_model
        ->get_by_inspection($inspection_id);

    if (!$original) {
        show_error('Inspection not found');
    }

    /* ============================================================
    2ï¸âƒ£ PREPARE DATA FROM FORM (POST DATA)
    ============================================================ */

    $inspectionData = [
        'branch_id'    => $this->input->post('branch_id') ?: get_primary_branch_id(),

        'km_reading'   => $this->input->post('km_reading'),
        'fuel_level'   => $this->input->post('fuel_level'),
        'remarks'      => $this->input->post('remarks'),

        'status'       => 'Completed',

        'drivername'   => $this->input->post('driver_name'),
        'driverphno'   => $this->input->post('driver_mobile'),

        'deliverytime' => $this->input->post('delivery_time'),
        'deliverydate' => $this->input->post('delivery_date'),

        'techremarks'  => $this->input->post('tecremarks'),
        'inspackage'   => $this->input->post('inspackage'),

        'updated_at'   => date('Y-m-d H:i:s')

    ];


    /* ============================================================
    3ï¸âƒ£ REVISION MODE
    ============================================================ */

    if ($create_revision)
    {

        // determine parent
        $parent_id = $original->parent_inspection_id
            ? $original->parent_inspection_id
            : $original->inspection_id;


        // get next revision number
        $max_revision = $this->db
            ->select_max('revision_no')
            ->where("(inspection_id = $parent_id OR parent_inspection_id = $parent_id)")
            ->get('inspections')
            ->row()
            ->revision_no;

        $new_revision_no = ($max_revision !== null)
            ? $max_revision + 1
            : 1;


        // insert NEW inspection revision
        $revisionData = array_merge($inspectionData, [

            'appointment_id' => $original->appointment_id,
            'customer_id'    => $original->customer_id,
            'vehicle_id'     => $original->vehicle_id,

            'parent_inspection_id' => $parent_id,
            'revision_no'          => $new_revision_no,
            'is_revision'          => 1,

            'inspection_date' => date('Y-m-d'),
            'inspection_time' => date('H:i:s'),

            'created_at'      => date('Y-m-d H:i:s')

        ]);


        $this->db->insert('inspections', $revisionData);

        // IMPORTANT: switch to new revision id
        $inspection_id = $this->db->insert_id();

        // Copy child tables to the new revision so they aren't lost
        $this->Inspection_view_model->copy_items($original->inspection_id, $inspection_id);
        $this->Inspection_view_model->copy_inventory($original->inspection_id, $inspection_id);
        $this->Inspection_view_model->copy_photos($original->inspection_id, $inspection_id);
		$this->Inspection_view_model->copy_report_photos($original->inspection_id, $inspection_id);
        $this->Inspection_view_model->copy_damage_marks($original->inspection_id, $inspection_id);
    }
    else 
    {

        // NORMAL UPDATE
        $this->Inspection_model
            ->update_inspection($inspection_id, $inspectionData);


        // delete old child rows before saving new ones
        $this->Inspection_model->delete_item_results($inspection_id);
        $this->Inspection_model->delete_services($inspection_id);
        $this->Inspection_model->delete_inventory_status($inspection_id);
        $this->Inspection_model->delete_works_requested($inspection_id);
		$this->Inspection_model->delete_photos($inspection_id);

    }


    /* ============================================================
    4ï¸âƒ£ SAVE CHILD TABLES (POST DATA ONLY)
    ============================================================ */

    // ITEMS
    if ($this->input->post('item_status'))
    {
        foreach ($this->input->post('item_status') as $item_id => $status)
        {
            $this->Inspection_model->save_item_result(
                $inspection_id,
                $item_id,
                $status
            );
        }
    }


    // SERVICES
    $service_ids     = $this->input->post('service_id') ?? [];
    $custom_services = $this->input->post('custom_service') ?? [];

    $this->Inspection_model->save_inspection_services(
        $inspection_id,
        $service_ids,
        $custom_services
    );


    // WORKS REQUESTED
    $works = $this->input->post('works_requested') ?? [];

    $this->Inspection_model->save_works_requested(
        $inspection_id,
        $works
    );


    // INVENTORY
    $inventory = $this->input->post('inventory_status') ?? [];

    $this->Inspection_model->save_inventory_status(
        $inspection_id,
        $inventory
    );
// echo "before photos";

   /* ============================================================
4ï¸âƒ£ SAVE PHOTOS
============================================================ */

/*
|--------------------------------------------------------------------------
| Allowed image types
|--------------------------------------------------------------------------
*/
$allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];
$max_file_size = 5 * 1024 * 1024; // 5 MB


/*
|--------------------------------------------------------------------------
| Validate normal inspection photos
|--------------------------------------------------------------------------
*/
if (
    isset($_FILES['inspection_photos']) &&
    !empty($_FILES['inspection_photos']['name'][0])
) {
    foreach ($_FILES['inspection_photos']['name'] as $key => $filename) {

        if (empty($filename)) {
            continue;
        }

        $extension = strtolower(
            pathinfo($filename, PATHINFO_EXTENSION)
        );

        $file_size = $_FILES['inspection_photos']['size'][$key];
        $error     = $_FILES['inspection_photos']['error'][$key];

        // Upload error
        if ($error !== UPLOAD_ERR_OK) {

            $this->session->set_flashdata(
                'inspection_upload_error',
                'One of the vehicle photos could not be uploaded. Please try again.'
            );

            redirect('inspection/edit/' . $inspection_id);
            return;
        }

        // File extension
        if (!in_array($extension, $allowed_extensions)) {

            $this->session->set_flashdata(
                'inspection_upload_error',
                'Invalid vehicle photo format. Please upload JPG, JPEG, PNG or WEBP images only.'
            );

            redirect('inspection/edit/' . $inspection_id);
            return;
        }

        // File size
        if ($file_size > $max_file_size) {

            $this->session->set_flashdata(
                'inspection_upload_error',
                'Vehicle photo "' . $filename . '" is too large. Maximum allowed size is 5 MB.'
            );

            redirect('inspection/edit/' . $inspection_id);
            return;
        }
    }


    // Save only after validation passes
    $this->Inspection_model->save_inspection_photos(
        $inspection_id,
        $_FILES['inspection_photos']
    );
}


/*
|--------------------------------------------------------------------------
| Validate Report Photos
|--------------------------------------------------------------------------
*/
if (isset($_FILES['report_photos'])) {

    foreach ($_FILES['report_photos']['name'] as $photo_type => $files) {

        if (!isset($files) || !is_array($files)) {
            continue;
        }

        foreach ($files as $key => $filename) {

            if (empty($filename)) {
                continue;
            }

            $extension = strtolower(
                pathinfo($filename, PATHINFO_EXTENSION)
            );

            $file_size = $_FILES['report_photos']['size'][$photo_type][$key];
            $error     = $_FILES['report_photos']['error'][$photo_type][$key];

            // Upload error
            if ($error !== UPLOAD_ERR_OK) {

                $this->session->set_flashdata(
                    'inspection_upload_error',
                    'The image "' . $filename . '" could not be uploaded. Please try again.'
                );

                redirect('inspection/edit/' . $inspection_id);
                return;
            }

            // Invalid extension
            if (!in_array($extension, $allowed_extensions)) {

                $this->session->set_flashdata(
                    'inspection_upload_error',
                    'Invalid image "' . $filename . '". Please upload JPG, JPEG, PNG or WEBP images only.'
                );

                redirect('inspection/edit/' . $inspection_id);
                return;
            }

            // File too large
            if ($file_size > $max_file_size) {

                $this->session->set_flashdata(
                    'inspection_upload_error',
                    'The image "' . $filename . '" is too large. Maximum allowed size is 5 MB.'
                );

                redirect('inspection/edit/' . $inspection_id);
                return;
            }
        }
    }


    // Save report photos only after validation
    $this->Inspection_model->save_report_photos(
        $inspection_id,
        $_FILES['report_photos']
    );
}


/* ============================================================
5ï¸âƒ£ REDIRECT
============================================================ */

$this->session->set_flashdata(
    'inspection_success',
    'Inspection updated successfully.'
);

redirect('inspection/edit/' . $inspection_id);

}
	public function update()
	{
		$inspection_id = $this->input->post('inspection_id');

		if (!$inspection_id) {
			show_error('Invalid Inspection');
		}

		// 1ï¸âƒ£ Update main inspection table
		$inspectionData = [
			'branch_id'     => $this->input->post('branch_id') ?: get_primary_branch_id(),
			'branch_id'     => $this->input->post('branch_id') ?: get_primary_branch_id(),
			'km_reading'    => $this->input->post('km_reading'),
			'fuel_level'    => $this->input->post('fuel_level'),
			'remarks'       => $this->input->post('remarks'),
			'status'        => 'Completed',
			'drivername'     => $this->input->post('driver_name'),
			'driverphno' => $this->input->post('driver_mobile'),
			'deliverytime' => $this->input->post('delivery_time'),
			'deliverydate'       => $this->input->post('delivery_date'),
			'techremarks'       => $this->input->post('tecremarks'),
			'inspackage'       => $this->input->post('inspackage'),
		];

		$this->Inspection_model->update_inspection($inspection_id, $inspectionData);

		// 2ï¸âƒ£ Save Inspection Items (A / C / S)
		if ($this->input->post('item_status')) {
			foreach ($this->input->post('item_status') as $item_id => $status) {
				$this->Inspection_model->save_item_result(
					$inspection_id,
					$item_id,
					$status
				);
			}
		}

		// 3ï¸âƒ£ Save Services / Description table
		$service_ids     = $this->input->post('service_id') ?? [];
		$custom_services = $this->input->post('custom_service') ?? [];

		$this->Inspection_model->save_inspection_services(
			$inspection_id,
			$service_ids,
			$custom_services
		);

		// 4ï¸âƒ£ Save Works Requested
		$works = $this->input->post('works_requested') ?? [];
		$this->Inspection_model->save_works_requested($inspection_id, $works);

		// 5ï¸âƒ£ Save Inventory Status
		$inventory = $this->input->post('inventory_status') ?? [];
		$this->Inspection_model->save_inventory_status($inspection_id, $inventory);

		// inspection photos

		$this->Inspection_model->save_inspection_photos(
			$inspection_id,
			$_FILES['inspection_photos']
		);


		// 6ï¸âƒ£ Redirect to inspection view / preview
		redirect('inspection/edit/' . $inspection_id);
		// redirect('estimation/create/' . $inspection_id);
	}



	public function saveDamageMark()
	{
		$data = json_decode(file_get_contents("php://input"), true);

		$insert = [
			'inspection_id' => $data['inspection_id'],
			'x_coordinate'  => $data['x'],
			'y_coordinate'  => $data['y']
		];

		$this->db->insert('inspection_damage_marks', $insert);

		echo json_encode([
			'id' => $this->db->insert_id()
		]);
	}
	public function deleteDamageMark()
	{
		$data = json_decode(file_get_contents("php://input"), true);

		$this->db->where('id', $data['id'])
			->delete('inspection_damage_marks');

		echo json_encode(['success' => true]);
	}

	public function edit($inspection_id,$type = 1)
	{
 
	    $data['type'] = $type;	
	    $data['username'] = $this->session->userdata('username');
		$data['userid'] = $this->session->userdata('user_id');
		// Get inspection
		$inspection = $this->Inspection_model->get_by_id($inspection_id);
		// ðŸ” Safety check
		if (!$inspection) {
			show_error('Inspection not found', 404);
		 }

		// Appointment based inspection
		if (!empty($inspection->appointment_id)) {

			// log_message('error', 'FLOW: Appointment based inspection');
			// log_message('error', 'Appointment ID: ' . $inspection->appointment_id);

			$appointment = $this->Inspection_view_model
				->get_appointment_details($inspection->appointment_id);
			// log_message('error', 'APPOINTMENT DATA: ' . print_r($appointment, true));
			// Extra safety (appointment deleted case)
			if ($appointment) {
				$customer = $this->Customer_model
					->get_customer($appointment->customer_id);
				// log_message('error', 'CUSTOMER DATA: ' . print_r($customer, true));
				$vehicle = $this->Vehicle_model
					->get_vehicle($appointment->vehicle_id);
				// log_message('error', 'VEHICLE DATA: ' . print_r($vehicle, true));
			} else {

				// log_message('error', 'Appointment NOT FOUND for appointment_id: ' . $inspection->appointment_id);
				$customer = null;
				$vehicle  = null;
				$appointment = null;
			}
		} else {
			// log_message('error', 'FLOW: Direct inspection (NO appointment)');

			if (!empty($inspection->customer_id)) {
				// log_message('error', 'Fetching CUSTOMER from inspection: ' . $inspection->customer_id);
				$customer = $this->Customer_model->get_customer($inspection->customer_id);
				// log_message('error', 'CUSTOMER DATA: ' . print_r($customer, true));
			} else {
				// log_message('error', 'Inspection customer_id is EMPTY');
				$customer = null;
			}

			if (!empty($inspection->vehicle_id)) {
				// log_message('error', 'Fetching VEHICLE from inspection: ' . $inspection->vehicle_id);
				$vehicle = $this->Vehicle_model->get_vehicle($inspection->vehicle_id);
				// log_message('error', 'VEHICLE DATA: ' . print_r($vehicle, true));
			} else {
				// log_message('error', 'Inspection vehicle_id is EMPTY');
				$vehicle = null;
			}

			$appointment = null;
		}


		$data['inspection_photos'] = $this->db
			->get_where('inspection_photos', [
				'inspection_id' => $inspection_id
			])->result();

			$data['report_photos'] = [];

			$photos = $this->db
				->where('inspection_id', $inspection_id)
				->get('inspection_report_photos')
				->result();

			foreach($photos as $photo)
			{
				$data['report_photos'][$photo->photo_type][] = $photo;
			}

		// Load saved data
		$data['customer']      = $customer;
		$data['vehicle']      = $vehicle;
		$data['inspection']      = $inspection;
		$data['inspection_id']   = $inspection_id;
		$data['appointment']     = $appointment;

		// Masters
		$data['items']     = $this->Inspection_model->get_all_items();
		$data['works']     = $this->Works_requested_model->get_all();
		$data['inventory'] = $this->Inventory_status_model->get_all();
		$data['services']  = $this->Service_model->get_active_services();
		$data['packages']     = $this->Inspection_model->get_all_packageitems();

		
		////////////////////  nidheena//////////////////
		$grouped = [];
		foreach ($data['items'] as $item) {
			$grouped[$item->category][] = $item;
		}

		$data['grouped_items'] = $grouped;
		///////////////// nidheena end//////////////////

		$service_map = [];
		foreach ($data['services'] as $s) {
			$service_map[$s->master_service_id] = $s->service_name;
		}

		$data['service_map'] = $service_map;

		// Saved values
		$data['item_results'] = $this->Inspection_model
			->get_item_results($inspection_id);

		$data['selected_works'] = $this->Inspection_model
			->get_selected_works($inspection_id);

		$data['selected_inventory'] = $this->Inspection_model
			->get_selected_inventory($inspection_id);

		$data['saved_services'] = $this->Inspection_model
			->get_saved_services($inspection_id);

		$data['damage_marks'] = $this->Inspection_model
			->get_damage_marks($inspection_id);

		$data['title'] = "Edit Inspection";
		$data['main_content'] = 'inspection/edit';
		$this->load->view('includes/template', $data);
	}

 	public function view($inspection_id)
{
    $data['username'] = $this->session->userdata('username');
    $data['userid']   = $this->session->userdata('user_id');

    $inspection = $this->Inspection_model->get_by_id($inspection_id);

    if (!$inspection)
    {
        show_404();
    }

    /* ----------------------------------------------------
       APPOINTMENT / DIRECT INSPECTION
    ---------------------------------------------------- */

    if (!empty($inspection->appointment_id))
    {
        $appointment = $this->Inspection_view_model
            ->get_appointment_details($inspection->appointment_id);

        if ($appointment)
        {
            $customer = $this->Customer_model
                ->get_customer($appointment->customer_id);

            $vehicle = $this->Vehicle_model
                ->get_vehicle($appointment->vehicle_id);
        }
        else
        {
            $customer = null;
            $vehicle = null;
            $appointment = null;
        }
    }
    else
    {
        $customer = !empty($inspection->customer_id)
            ? $this->Customer_model->get_customer($inspection->customer_id)
            : null;

        $vehicle = !empty($inspection->vehicle_id)
            ? $this->Vehicle_model->get_vehicle($inspection->vehicle_id)
            : null;

        $appointment = null;
    }

    /* ----------------------------------------------------
       REPORT PHOTOS
    ---------------------------------------------------- */

    $data['report_photos'] = [];

	$photos = $this->db
		->where('inspection_id', $inspection_id)
		->order_by('id', 'ASC')
		->get('inspection_report_photos')
		->result();

	foreach ($photos as $photo)
	{
		$data['report_photos'][$photo->photo_type][] = $photo;
	}

    /* ----------------------------------------------------
       NORMAL PHOTOS
    ---------------------------------------------------- */

    $data['inspection_photos'] = $this->db
        ->get_where('inspection_photos', [
            'inspection_id' => $inspection_id
        ])
        ->result();

    /* ----------------------------------------------------
       MAIN DATA
    ---------------------------------------------------- */

    $data['customer']      = $customer;
    $data['vehicle']       = $vehicle;
    $data['inspection']    = $inspection;
    $data['inspection_id'] = $inspection_id;
    $data['appointment']   = $appointment;

    /* ----------------------------------------------------
       MASTERS
    ---------------------------------------------------- */

    $data['items']      = $this->Inspection_model->get_all_items();
    $data['works']      = $this->Works_requested_model->get_all();
    $data['inventory']  = $this->Inventory_status_model->get_all();
    $data['services']   = $this->Service_model->get_active_services();
    $data['packages']   = $this->Inspection_model->get_all_packageitems();

    /* ----------------------------------------------------
       GROUP ITEMS BY CATEGORY
    ---------------------------------------------------- */

    $grouped = [];

    foreach ($data['items'] as $item)
    {
        $grouped[$item->category][] = $item;
    }

    $data['grouped_items'] = $grouped;

    /* ----------------------------------------------------
       SERVICE MAP
    ---------------------------------------------------- */

    $service_map = [];

    foreach ($data['services'] as $s)
    {
        $service_map[$s->master_service_id] = $s->service_name;
    }

    $data['service_map'] = $service_map;

    /* ----------------------------------------------------
       SAVED VALUES
    ---------------------------------------------------- */

    $data['item_results'] = $this->Inspection_model
        ->get_item_results($inspection_id);

    $data['selected_works'] = $this->Inspection_model
        ->get_selected_works($inspection_id);

    $data['selected_inventory'] = $this->Inspection_model
        ->get_selected_inventory($inspection_id);

    $data['saved_services'] = $this->Inspection_model
        ->get_saved_services($inspection_id);

    $data['damage_marks'] = $this->Inspection_model
        ->get_damage_marks($inspection_id);

    /* ----------------------------------------------------
       CATEGORY PERCENTAGES
    ---------------------------------------------------- */

    $categoryPercentages = [];

    foreach ($grouped as $category => $items)
    {
        $score = 0;
        $maxScore = count($items) * 100;

        foreach ($items as $item)
        {
            $status = $data['item_results'][$item->item_id] ?? '';

            if ($status == 'A')
			{
                $score += 100;
            }
            elseif ($status == 'C')
            {
                $score += 50;
            }
        }

        $categoryPercentages[$category] =
            $maxScore > 0
                ? round(($score / $maxScore) * 100)
                : 0;
    }

    $data['categoryPercentages'] = $categoryPercentages;

    /* ----------------------------------------------------
       TITLE
    ---------------------------------------------------- */

    $data['title'] =
        'Inspection_' .
        ($appointment->doc_no ?? ('VIN-' . str_pad($inspection_id, 6, '0', STR_PAD_LEFT))) . '_' .
        preg_replace(
            '/[^A-Za-z0-9\-]/',
            '_',
            $appointment->registration_no ?? $vehicle->registration_no ?? ''
        ) . '_' .
        preg_replace(
            '/[^A-Za-z0-9\-]/',
            '_',
            $appointment->customer_name ?? $customer->name ?? ''
        ) . '_' .
        date('d-m-Y');

    $data['main_content'] = 'inspection/view';

    $this->load->view('includes/template', $data);
}

public function deleteReportPhoto()
{
    $data = json_decode(file_get_contents('php://input'));

    $photo_id = $data->photo_id ?? 0;

    $photo = $this->db
        ->where('id', $photo_id)
        ->get('inspection_report_photos')
        ->row();

    if(!$photo)
    {
        echo json_encode([
            'success' => false
        ]);
        return;
    }

    if(file_exists(FCPATH . $photo->image_path))
    {
        unlink(FCPATH . $photo->image_path);
    }

    $this->db
        ->where('id', $photo_id)
        ->delete('inspection_report_photos');

    echo json_encode([
        'success' => true
    ]);
}

/**
 * Send WhatsApp message for inspection
 */
public function sendWhatsappMessage()
{
    $inspection_id = $this->input->post('inspection_id');

    if (!$inspection_id) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid inspection'
        ]);
        return;
    }

    // Get inspection with customer details
    $inspection = $this->db
        ->select('i.*, c.name as customer_name, c.phone as customer_phone, v.registration_no, v.brand, v.model')
        ->from('inspections i')
        ->join('customers c', 'c.customer_id = i.customer_id')
        ->join('vehicles v', 'v.vehicle_id = i.vehicle_id')
        ->where('i.inspection_id', $inspection_id)
        ->get()
        ->row();

    if (!$inspection) {
        echo json_encode([
            'success' => false,
            'message' => 'Inspection not found'
        ]);
        return;
    }

    // Check if phone number exists
    if (empty($inspection->customer_phone)) {
        echo json_encode([
            'success' => false,
            'message' => 'Customer phone number not found'
        ]);
        return;
    }

    // Load WhatsApp library
    $this->load->library('Whatsapp');

    // Get company_id from session (adjust based on your session setup)
	$company_id = get_current_company_id();
    $wa_settings = $this->db->get_where('whatsapp_settings', ['company_id' => $company_id])->row();

    if (empty($wa_settings) || empty($wa_settings->whatsapp_enabled)) {
        echo json_encode([
            'success' => false,
            'message' => 'WhatsApp messaging is disabled.'
        ]);
        return;
    }

    $template = $this->db
        ->where('company_id', $company_id)
        ->where('template_type', 'inspection')
        ->where('is_active', 1)
        ->get('whatsapp_template')
        ->row();

    $template_body = !empty($template->template_body)
        ? $template->template_body
        : (!empty($wa_settings->whatsapp_template)
            ? $wa_settings->whatsapp_template
            : "Hi {customer_name},\n\nYour inspection report is ready.\n\nVehicle: {brand} {model}\nRegistration: {registration_no}\nDate: {inspection_date}\nStatus: {status}\n\nPlease view your report.\nThank you!");

    $message = str_replace(
        [
            '{customer_name}',
            '{brand}',
            '{model}',
            '{registration_no}',
            '{inspection_date}',
            '{status}'
        ],
        [
            !empty($inspection->customer_name) ? $inspection->customer_name : '',
            !empty($inspection->brand) ? $inspection->brand : '',
            !empty($inspection->model) ? $inspection->model : '',
            !empty($inspection->registration_no) ? $inspection->registration_no : '',
            !empty($inspection->inspection_date) ? date('d-m-Y', strtotime($inspection->inspection_date)) : '',
            !empty($inspection->status) ? $inspection->status : ''
        ],
        $template_body
    );

    // Normalize phone number (remove + and spaces, ensure it starts with country code)
    $phone = preg_replace('/[^0-9]/', '', $inspection->customer_phone);
    
    // Add country code if not present (adjust 91 to your country code)
    if (strlen($phone) == 10) {
        $phone = '91' . $phone;
    }

    // Send WhatsApp message
    try {
        $result = $this->whatsapp->send_message(
            $company_id,
            $phone,
            $message
        );

        if ($result && isset($result['response']['messages'][0]['id'])) {
            // Update inspection status
            $this->db->where('inspection_id', $inspection_id)->update('inspections', [
                'whatsapp_sent' => 1,
                'whatsapp_sent_at' => date('Y-m-d H:i:s')
            ]);

            echo json_encode([
                'success' => true,
                'message' => 'WhatsApp message sent successfully'
            ]);
        } else {
            $error_msg = 'Failed to send WhatsApp message';
            if (isset($result['response']['error']['message'])) {
                $error_msg = $result['response']['error']['message'];
            }
            
            echo json_encode([
                'success' => false,
                'message' => $error_msg
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
}

	// public function view($inspection_id)
	// {

	// 	$data['username'] = $this->session->userdata('username');
	// 	$data['userid'] = $this->session->userdata('user_id');
	// 	// Get inspection
	// 	$inspection = $this->Inspection_model->get_by_id($inspection_id);
	// 	if (!$inspection) show_404();


	// 	if ($inspection->appointment_id <> "") {
	// 		// Get appointment details
	// 		$appointment = $this->Inspection_view_model
	// 			->get_appointment_details($inspection->appointment_id);

	// 		// Customer & Vehicle from appointment
	// 		$customer = $this->Customer_model
	// 			->get_customer($appointment->customer_id);

	// 		$vehicle = $this->Vehicle_model
	// 			->get_vehicle($appointment->vehicle_id);
	// 	} else {

	// 		// âœ… Direct inspection (NO appointment)

	// 		// Customer from inspection
	// 		$customer = $this->Customer_model
	// 			->get_customer($inspection->customer_id);

	// 		// Vehicle from inspection
	// 		$vehicle = $this->Vehicle_model
	// 			->get_vehicle($inspection->vehicle_id);

	// 		// Appointment is NULL
	// 		$appointment = null;
	// 	}

	// 	// Load saved data
	// 	$data['customer']      = $customer;
	// 	$data['vehicle']      = $vehicle;
	// 	$data['inspection']      = $inspection;
	// 	$data['inspection_id']   = $inspection_id;
	// 	$data['appointment']     = $appointment;

	// 	// Masters
	// 	$data['items']     = $this->Inspection_model->get_all_items();
	// 	$data['works']     = $this->Works_requested_model->get_all();
	// 	$data['inventory'] = $this->Inventory_status_model->get_all();
	// 	$data['services']  = $this->Service_model->get_active_services();
	// 	$data['packages']     = $this->Inspection_model->get_all_packageitems();

	// 	$service_map = [];
	// 	foreach ($data['services'] as $s) {
	// 		$service_map[$s->master_service_id] = $s->service_name;
	// 	}

	// 	$data['service_map'] = $service_map;

	// 	// Saved values
	// 	$data['item_results'] = $this->Inspection_model
	// 		->get_item_results($inspection_id);

	// 	$data['selected_works'] = $this->Inspection_model
	// 		->get_selected_works($inspection_id);

	// 	$data['selected_inventory'] = $this->Inspection_model
	// 		->get_selected_inventory($inspection_id);

	// 	$data['saved_services'] = $this->Inspection_model
	// 		->get_saved_services($inspection_id);

	// 	$data['damage_marks'] = $this->Inspection_model
	// 		->get_damage_marks($inspection_id);

	// 	$data['inspection_photos'] = $this->db
	// 		->get_where('inspection_photos', [
	// 			'inspection_id' => $inspection_id
	// 		])->result();

	// 	// $data['title'] = "View Inspection";
	// 	$data['title'] =
	// 		'Inspection_' .
	// 		($appointment->doc_no ?? ('VIN-' . str_pad($inspection_id, 6, '0', STR_PAD_LEFT))) . '_' .
	// 		preg_replace('/[^A-Za-z0-9\-]/', '_', $appointment->registration_no ?? $vehicle->registration_no ?? '') . '_' .
	// 		preg_replace('/[^A-Za-z0-9\-]/', '_', $appointment->customer_name ?? $customer->name ?? '') . '_' .
	// 		date('d-m-Y');


	// 	$data['main_content'] = 'inspection/view';
	// 	$this->load->view('includes/template', $data);
	// }
 
	/**
	 * Inspection listing page
	 */
	public function index()
	{
		$data['title'] = 'Inspection List';
		$data['customers'] = $this->Customer_model->get_all();
		$data['vehicles']    = $this->Vehicle_model->get_all_vehicles();

		$data['inspections'] = $this->Inspection_model->get_all_inspections();
		$company_id = get_current_company_id();
		$wa_settings = $this->db->get_where('whatsapp_settings', ['company_id' => $company_id])->row();
		$data['whatsapp_enabled'] = !empty($wa_settings->whatsapp_enabled);

		$data['main_content'] = 'inspection/list';
		$this->load->view('includes/template', $data);
	}

	/**
	 * Delete inspection
	 */
	public function delete($inspection_id)
	{
		$this->Inspection_model->delete_inspection($inspection_id);
		redirect('inspection');
	}

	public function deletePhoto()
	{
		$data = json_decode(file_get_contents("php://input"), true);
		$photo_id = $data['photo_id'];

		$photo = $this->db
			->get_where('inspection_photos', ['photo_id' => $photo_id])
			->row();

		if ($photo) {

			if (file_exists(FCPATH . $photo->image_path)) {
				unlink(FCPATH . $photo->image_path);
			}

			$this->db->delete('inspection_photos', [
				'photo_id' => $photo_id
			]);

			echo json_encode(['success' => true]);
			return;
		}

		echo json_encode(['success' => false]);
	}
	// =========================== not needed fns =================
	public function chkindex()
	{
		$data['title'] = 'Inspection List';


		$data['main_content'] = 'inspection/chk';
		$this->load->view('includes/template', $data);
	}

	public function check_mobile()
	{
		$mobile = $this->input->post('mobile');

		// Validate mobile
		// if (!preg_match('/^[6-9]\d{9}$/', $mobile)) {
		// 	$this->session->set_flashdata('error', 'Invalid mobile number');
		// 	redirect('inspection');
		// }

		// Check customer
		$customer = $this->Customer_model->getCustomerByMobile($mobile);

		// ðŸ”µ CASE 1: CUSTOMER NOT FOUND
		if (!$customer) {

			$this->session->set_flashdata('walkin_mobile', $mobile);
			$this->session->set_flashdata('show_quick_form', true);
			$this->session->set_flashdata(
				'info',
				'Customer not found. Please add customer details to continue inspection.'
			);

			redirect('inspection'); // listing / dashboard page
		}

		// ðŸŸ¢ CASE 2: CUSTOMER FOUND
		$vehicles = $this->Vehicle_model->getVehiclesByCustomer($customer->customer_id);

		$this->session->set_flashdata('customer_popup', [
			'customer' => $customer,
			'vehicles' => $vehicles
		]);

		redirect('inspection');
	}

	public function save_walkin_customer()
	{
		$customer_id = $this->Customer_model->create([
			'customer_name' => $this->input->post('name'),
			'mobile'        => $this->input->post('phone')
		]);

		$vehicle_id = $this->Vehicle_model->create([
			'customer_id' => $customer_id,
			'vehicle_no'  => $this->input->post('registration_no'),
			'model'       => $this->input->post('model')
		]);

		redirect('inspection/create?customer_id=' . $customer_id . '&vehicle_id=' . $vehicle_id . '&source=WALKIN');
	}
	// =========================== not needed fns =================
	// ===========================================direct inspection ==================
	public function create_direct()
	{
		$this->load->model('Inspection_model');
		$this->load->model('Customer_model');
		$this->load->model('Vehicle_model');

		$customer_id = $this->input->post('customer_id');
		$vehicle_id  = $this->input->post('vehicle_id');

		/* ===============================
       1ï¸âƒ£ CREATE CUSTOMER (IF NEW)
       =============================== */
		if ($customer_id === 'new') {

			$cust_name  = $this->input->post('cust_name');
			$cust_phone = $this->input->post('cust_phone');

			if (!$cust_name || !$cust_phone) {
				echo json_encode([
					'status' => 'error',
					'message' => 'Customer name and phone are required'
				]);
				return;
			}

			$customer_id = $this->Customer_model->create([
				'name' => $cust_name,
				'phone' => $cust_phone,
				'email' => $this->input->post('cust_email'),
				'address' => $this->input->post('cust_address')
			]);
		}

		if (!$customer_id) {
			echo json_encode([
				'status' => 'error',
				'message' => 'Customer required'
			]);
			return;
		}

		/* ===============================
       2ï¸âƒ£ CREATE VEHICLE (IF NEEDED)
       =============================== */
		if (!$vehicle_id) {

			$plate_no = $this->input->post('plate_no');
			$brand    = $this->input->post('brand');
			$model    = $this->input->post('model');

			if (!$plate_no || !$brand || !$model) {
				echo json_encode([
					'status' => 'error',
					'message' => 'Vehicle details are required'
				]);
				return;
			}

			$vehicle_id = $this->Vehicle_model->create([
				'customer_id' => $customer_id,
				'registration_no'    => $plate_no,
				'brand'       => $brand,
				'model'       => $model,
				'chassis_no'      => $this->input->post('vin_no')
			]);
		}

		/* ===============================
       3ï¸âƒ£ CREATE INSPECTION
       =============================== */
		$inspection_id = $this->Inspection_model->create([
			'customer_id'     => $customer_id,
			'vehicle_id'      => $vehicle_id,
			'appointment_id'  => NULL, // direct inspection
			'inspection_date' => date('Y-m-d'),
			'status'          => 'IN_PROGRESS'
		]);

		echo json_encode([
			'status' => 'success',
			'inspection_id' => $inspection_id
		]);
	}

	public function get_customer_vehicles()
	{
		$customer_id = $this->input->post('customer_id');

		if (!$customer_id) {
			echo json_encode([]);
			return;
		}

		$vehicles = $this->db
			->select('vehicle_id, registration_no, brand, model, chassis_no')
			->where('customer_id', $customer_id)
			->order_by('vehicle_id', 'DESC')
			->get('vehicles')
			->result();

		echo json_encode($vehicles);
	}

	public function get_by_chassis()
	{
		$chassis = $this->input->post('chassis_no');

		$data = $this->db
			->select('v.*, c.customer_id')
			->from('vehicles v')
			->join('customers c', 'c.customer_id = v.customer_id')
			->where('v.chassis_no', $chassis)
			->get()
			->row();

		echo json_encode($data);
	}

	public function get_by_plateno()
	{
		$plate_no = $this->input->post('plate_no');

		$data = $this->db
			->select('v.*, c.customer_id')
			->from('vehicles v')
			->join('customers c', 'c.customer_id = v.customer_id')
			->where('v.registration_no', $plate_no)
			->get()
			->row();

		echo json_encode($data);
	}

	// ------------------------------------------------------------------
	// Email — send inspection report as PDF attachment
	// ------------------------------------------------------------------

	/**
	 * POST (AJAX) — Generate inspection PDF and email it to the customer.
	 *
	 * URL: Inspection/send_email/{inspection_id}
	 */
	public function send_email($inspection_id)
	{
		$inspection = $this->Inspection_model->get_by_id($inspection_id);
		if (!$inspection) return $this->email_response(false, 'Inspection not found.');

		// Resolve customer & vehicle
		if (!empty($inspection->appointment_id)) {
			$appointment = $this->Inspection_view_model->get_appointment_details($inspection->appointment_id);
			$customer    = $appointment ? $this->Customer_model->get_customer($appointment->customer_id) : null;
			$vehicle     = $appointment ? $this->Vehicle_model->get_vehicle($appointment->vehicle_id)   : null;
		} else {
			$appointment = null;
			$customer    = !empty($inspection->customer_id) ? $this->Customer_model->get_customer($inspection->customer_id) : null;
			$vehicle     = !empty($inspection->vehicle_id)  ? $this->Vehicle_model->get_vehicle($inspection->vehicle_id)    : null;
		}

		// Recipient — prefer POST override, fall back to customer email
		$recipient = trim($this->input->post('email')) ?: ($customer->email ?? '');
		if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
			return $this->email_response(false, 'Please enter a valid email address.');
		}

		// Build view data (same as view() method)
		$grouped = [];
		$items   = $this->Inspection_model->get_all_items();
		foreach ($items as $item) { $grouped[$item->category][] = $item; }

		$view_data = [
			'inspection'          => $inspection,
			'inspection_id'       => $inspection_id,
			'appointment'         => $appointment,
			'customer'            => $customer,
			'vehicle'             => $vehicle,
			'items'               => $items,
			'grouped_items'       => $grouped,
			'works'               => $this->Works_requested_model->get_all(),
			'inventory'           => $this->Inventory_status_model->get_all(),
			'services'            => $this->Service_model->get_active_services(),
			'packages'            => $this->Inspection_model->get_all_packageitems(),
			'item_results'        => $this->Inspection_model->get_item_results($inspection_id),
			'selected_works'      => $this->Inspection_model->get_selected_works($inspection_id),
			'selected_inventory'  => $this->Inspection_model->get_selected_inventory($inspection_id),
			'saved_services'      => $this->Inspection_model->get_saved_services($inspection_id),
			'damage_marks'        => $this->Inspection_model->get_damage_marks($inspection_id),
			'report_photos'       => [],
			'inspection_photos'   => $this->db->get_where('inspection_photos', ['inspection_id' => $inspection_id])->result(),
			'categoryPercentages' => [],
			'service_map'         => [],
		];

		// Generate PDF
		$options = new Options();
		$options->set('isRemoteEnabled', true);
		$dompdf = new Dompdf($options);
		$dompdf->loadHtml($this->load->view('inspection/view', $view_data, true));
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

		$cache_dir = FCPATH . 'application/cache/';
		if (!is_dir($cache_dir)) { mkdir($cache_dir, 0755, true); }
		$pdf_path = $cache_dir . 'inspection_' . $inspection_id . '_' . uniqid() . '.pdf';
		file_put_contents($pdf_path, $dompdf->output());

		// Send via Gms_mailer
		$this->load->library('gms_mailer');
		$company_id   = get_current_company_id();
		$company_name = $this->gms_mailer->get_company_name($company_id);

		$result = $this->gms_mailer->send_notification($recipient, 'inspection_report', [
			'{customer_name}'   => $appointment->customer_name ?? ($customer->name ?? ''),
			'{vehicle_no}'      => $appointment->registration_no ?? ($vehicle->registration_no ?? ''),
			'{inspection_no}'   => $inspection->doc_no ?? ('INS-' . str_pad($inspection_id, 6, '0', STR_PAD_LEFT)),
			'{inspection_date}' => date('d/m/Y', strtotime($inspection->inspection_date)),
			'{company_name}'    => $company_name,
		], $pdf_path, $company_id);

		@unlink($pdf_path);
		return $this->email_response($result['status'], $result['message']);
	}

	/**
	 * Output a JSON email response.
	 */
	private function email_response($status, $message)
	{
		$this->output->set_content_type('application/json')
			->set_output(json_encode(['status' => (bool) $status, 'message' => $message]));
	}
}

