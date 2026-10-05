<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Customer_model');
		$this->load->model('Vehicle_model');
		$this->load->helper(array('form', 'url', 'branch_helper'));
		$this->load->library('form_validation');
	}

	/* -------------------------------
       LIST CUSTOMERS
    --------------------------------*/
	// public function index()
	// {
	// 	$search = $this->input->get('search');

	// 	$data['customers'] = $this->Customer_model->get_all_customers($search);

	// 	$data['title'] = "Customers";
	// 	$data['main_content'] = 'customer/list_customers';
	// 	$this->load->view('includes/template', $data);
	// }


	public function index()
	{
		$data['customers'] = $this->Customer_model->filter_customers();
		$data['title'] = "Customers";
		$data['main_content'] = 'customer/list_customers';
		$this->load->view('includes/template', $data);
	}

	// ðŸ”´ AJAX FILTER
	public function filter_ajax()
	{
		$filters = [
			'name'  => $this->input->post('name'),
			'phone' => $this->input->post('phone'),
			'plate' => $this->input->post('plate'),
			'vin'   => $this->input->post('vin')
		];

		$data['customers'] = $this->Customer_model->filter_customers($filters);

		$this->load->view('customer/_customer_rows', $data);
	}
	/* -------------------------------
       SHOW ADD FORM
    --------------------------------*/
	public function add()
	{
		$data['form_data'] = $this->session->flashdata('form_data');
		$data['title'] = "Customers";
		$data['brands'] = $this->Vehicle_model->get_all_brands();
		$data['main_content'] = 'customer/add_customer';
		$this->load->view('includes/template', $data);
	}

	/* -------------------------------
       SHOW EDIT FORM
    --------------------------------*/
	public function edit($customer_id)
	{
		// Load customer data
		$data['customer'] = $this->Customer_model->get_customer($customer_id);
		$data['brands'] = $this->Vehicle_model->get_all_brands();
		// If customer not found
		if (!$data['customer']) {
			$this->session->set_flashdata('error', 'Customer not found!');
			redirect('customer/list');
		}

		// Load vehicles linked with this customer
		$data['vehicles'] = $this->Vehicle_model->get_vehicles_by_customer($customer_id);

		// Load the same form used for add
		// $this->load->view('customer_vehicle_form_edit', $data);
        $data['form_data'] = $this->session->flashdata('form_data');
		$data['title'] = "Edit Customers";
		$data['main_content'] = 'customer/customer_vehicle_form_edit';
		$this->load->view('includes/template', $data);
	}


	/* -------------------------------
       SAVE 
    --------------------------------*/
public function save()
{
    // =====================================================
    // COLLECT CUSTOMER DATA
    // =====================================================

    $name      = trim($this->input->post('name'));

    if ($name === '') {
        $this->session->set_flashdata('error', 'Customer name is required.');
        redirect('customer/add');
        return;
    }

    $phone     = trim($this->input->post('phone'));
    $email     = trim($this->input->post('email'));
    $address   = trim($this->input->post('address'));
    $emirate   = $this->input->post('emirate');
    $trn       = trim($this->input->post('trn'));
    $branch_id = $this->input->post('branch_id');

    $validation_errors = [];

    if ($email !== '') {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validation_errors[] = 'Please enter a valid email address.';
        }
    }

    if ($trn !== '') {
        if (!preg_match('/^\d{15}$/', $trn)) {
            $validation_errors[] = 'TRN must contain exactly 15 digits.';
        }
    }

    if (!empty($validation_errors)) {

        $this->session->set_flashdata(
            'error',
            implode("\n", $validation_errors)
        );

        $this->session->set_flashdata(
            'form_data',
            [
                'name'      => $name,
                'phone'     => $phone,
                'email'     => $email,
                'address'   => $address,
                'emirate'   => $emirate,
                'trn'       => $trn,
                'branch_id' => $branch_id
            ]
        );

        redirect('customer/add');
        return;
    }


    // =====================================================
    // COLLECT VEHICLE DATA
    // =====================================================

    $reg_no     = $this->input->post('vehicle_registration_no');
    $brand_ids  = $this->input->post('brand_id');
    $model_ids  = $this->input->post('model_id');
    $variant    = $this->input->post('vehicle_variant');
    $year        = $this->input->post('vehicle_year');
    $year_custom = $this->input->post('vehicle_year_custom');
    $color      = $this->input->post('vehicle_color');
    $chassis_no = $this->input->post('vehicle_chassis_no');
    $engine_no  = $this->input->post('vehicle_engine_no');


    // =====================================================
    // MAKE SURE ARRAYS EXIST
    // =====================================================
    $reg_no      = is_array($reg_no) ? $reg_no : [];
    $brand_ids   = is_array($brand_ids) ? $brand_ids : [];
    $model_ids   = is_array($model_ids) ? $model_ids : [];
    $variant     = is_array($variant) ? $variant : [];
    $year        = is_array($year) ? $year : [];
    $year_custom = is_array($year_custom) ? $year_custom : [];
    $color       = is_array($color) ? $color : [];
    $chassis_no  = is_array($chassis_no) ? $chassis_no : [];
    $engine_no   = is_array($engine_no) ? $engine_no : [];

    // =====================================================
    // FORM DATA FOR RETAINING AFTER ERROR
    // =====================================================

    $formData = [
        'name'      => $name,
        'phone'     => $phone,
        'email'     => $email,
        'address'   => $address,
        'emirate'   => $emirate,
        'trn'       => $trn,
        'branch_id' => $branch_id,

        'vehicle_registration_no' => $reg_no,
        'brand_id'                => $brand_ids,
        'model_id'                => $model_ids,
        'vehicle_variant'         => $variant,
        'vehicle_year'            => $year,
        'vehicle_color'           => $color,
        'vehicle_chassis_no'      => $chassis_no,
        'vehicle_engine_no'       => $engine_no
    ];


    // =====================================================
    // CHECK AT LEAST ONE VEHICLE
    // =====================================================

    $validVehicleCount = 0;

    foreach ($reg_no as $i => $registration) {

        $registration = trim($registration);

        // You can use registration as the minimum requirement
        if ($registration !== '') {
            $validVehicleCount++;
        }
    }


    if ($validVehicleCount < 1) {

        $this->session->set_flashdata(
            'error',
            'Please add at least one vehicle before saving the customer.'
        );

        $this->session->set_flashdata(
            'form_data',
            $formData
        );

        redirect('customer/add');
        return;
    }


    // =====================================================
    // CHECK DUPLICATE VIN / ENGINE
    // =====================================================

    $used_vins    = [];
    $used_engines = [];


    for ($i = 0; $i < count($reg_no); $i++) {

        $registration = trim($reg_no[$i] ?? '');

        // Ignore completely empty vehicle rows
        if ($registration === '') {
            continue;
        }

        $vin = trim($chassis_no[$i] ?? '');
        $engine = trim($engine_no[$i] ?? '');


        // =================================================
        // VIN CHECK
        // =================================================

        if ($vin !== '') {

            $vin_lower = strtolower($vin);

            // Duplicate in submitted form
            if (in_array($vin_lower, $used_vins)) {

                $this->session->set_flashdata(
                    'error',
                    'Duplicate VIN number "' . $vin . '" entered for multiple vehicles.'
                );

                $this->session->set_flashdata(
                    'form_data',
                    $formData
                );

                redirect('customer/add');
                return;
            }

            $used_vins[] = $vin_lower;


            // Duplicate in database
            $vin_exists = $this->db
                ->where('chassis_no', $vin)
                ->count_all_results('vehicles');

            if ($vin_exists > 0) {

                $this->session->set_flashdata(
                    'error',
                    'VIN number "' . $vin . '" already exists.'
                );

                $this->session->set_flashdata(
                    'form_data',
                    $formData
                );

                redirect('customer/add');
                return;
            }
        }


        // =================================================
        // ENGINE CHECK
        // =================================================

        if ($engine !== '') {

            $engine_lower = strtolower($engine);

            // Duplicate in submitted form
            if (in_array($engine_lower, $used_engines)) {

                $this->session->set_flashdata(
                    'error',
                    'Duplicate engine number "' . $engine . '" entered for multiple vehicles.'
                );

                $this->session->set_flashdata(
                    'form_data',
                    $formData
                );

                redirect('customer/add');
                return;
            }

            $used_engines[] = $engine_lower;


            // Duplicate in database
            $engine_exists = $this->db
                ->where('engine_no', $engine)
                ->count_all_results('vehicles');

            if ($engine_exists > 0) {

                $this->session->set_flashdata(
                    'error',
                    'Engine number "' . $engine . '" already exists.'
                );

                $this->session->set_flashdata(
                    'form_data',
                    $formData
                );

                redirect('customer/add');
                return;
            }
        }
    }


    // =====================================================
    // START DATABASE TRANSACTION
    // =====================================================

    $this->db->trans_begin();


    // =====================================================
    // INSERT CUSTOMER
    // =====================================================

    $customerData = [
        'name'      => $name,
        'phone'     => $phone,
        'email'     => $email,
        'address'   => $address,
        'emirates'  => $emirate,
        'trn'       => $trn,
        'branch_id' => $branch_id
    ];


    $this->db->insert('customers', $customerData);

    if ($this->db->affected_rows() <= 0) {

        $this->db->trans_rollback();

        $this->session->set_flashdata(
            'error',
            'Unable to save customer.'
        );

        $this->session->set_flashdata(
            'form_data',
            $formData
        );

        redirect('customer/add');
        return;
    }


    $customer_id = $this->db->insert_id();


    // =====================================================
    // INSERT VEHICLES
    // =====================================================

    $savedVehicleCount = 0;


    for ($i = 0; $i < count($reg_no); $i++) {

        $registration = trim($reg_no[$i] ?? '');

        // Skip empty vehicle rows
        if ($registration === '') {
            continue;
        }
        $vehicle_year = trim($year[$i] ?? '');
        $custom_year  = trim($year_custom[$i] ?? '');

        if ($custom_year !== '') {
            $vehicle_year = $custom_year;
        }

        /* Look up brand and model names from their IDs */
        $brand_row = $this->Vehicle_model->get_brand_by_id($brand_ids[$i] ?? null);
        $model_row = $this->Vehicle_model->get_model_by_id($model_ids[$i] ?? null);

        $vehicleData = [
            'customer_id'   => $customer_id,
            'registration_no' => $registration,
            'brand_id'      => $brand_ids[$i] ?? null,
            'brand'         => $brand_row ? $brand_row->brand_name : null,
            'model_id'      => $model_ids[$i] ?? null,
            'model'         => $model_row ? $model_row->model_name : null,
            'variant'       => $variant[$i] ?? null,
            'year'  => $vehicle_year !== '' ? $vehicle_year : null,
            'color'         => $color[$i] ?? null,
            'chassis_no'    => $chassis_no[$i] ?? null,
            'engine_no'     => $engine_no[$i] ?? null
        ];


        $this->db->insert('vehicles', $vehicleData);


        // IMPORTANT:
        // If even ONE vehicle fails, rollback everything.
        if ($this->db->affected_rows() <= 0) {

            $this->db->trans_rollback();

            $this->session->set_flashdata(
                'error',
                'Unable to save vehicle. Customer was not saved.'
            );

            $this->session->set_flashdata(
                'form_data',
                $formData
            );

            redirect('customer/add');
            return;
        }


        $savedVehicleCount++;
    }


    // =====================================================
    // FINAL SAFETY CHECK
    // =====================================================

    if ($savedVehicleCount < 1) {

        $this->db->trans_rollback();

        $this->session->set_flashdata(
            'error',
            'Customer must have at least one vehicle. Customer was not saved.'
        );

        $this->session->set_flashdata(
            'form_data',
            $formData
        );

        redirect('customer/add');
        return;
    }


    // =====================================================
    // COMMIT TRANSACTION
    // =====================================================

    if ($this->db->trans_status() === FALSE) {

        $this->db->trans_rollback();

        $this->session->set_flashdata(
            'error',
            'Unable to save customer and vehicles.'
        );

        $this->session->set_flashdata(
            'form_data',
            $formData
        );

        redirect('customer/add');
        return;
    }

		// =========================ledger entry
        $exists = $this->db->where('customer_id', $customer_id)
				->get('general_ledger')
				->row();

        if ($exists) {
            $prifix = 'CUST';
            $digit = sprintf("%1$04d", $customer_id);
            $Code = $prifix . $digit;
            
            $grp_no = 30;
            $data1 = array(
                'account_name' => $this->input->post('name') . ' ' . $Code,
                'group_no' => $grp_no,
                'customer_id' => $customer_id,
                'opening_bal_type' => 'Dr',
            ); 
            $this->db->where('customer_id', $customer_id);
            $this->db->update('general_ledger', $data1);
        }else{
            $prifix = 'CUST';
            $digit = sprintf("%1$04d", $customer_id);
            $Code = $prifix . $digit;
            
            $grp_no = 30;
            $data1 = array(
                'account_name' => $this->input->post('name') . ' ' . $Code,
                'group_no' => $grp_no,
                'customer_id' => $customer_id,
                'opening_bal_type' => 'Dr',
            ); 
            $this->db->insert('general_ledger', $data1);
        }
		
		// =========================ledger entry


    $this->db->trans_commit();


    // =====================================================
    // SUCCESS
    // =====================================================

    $this->session->set_flashdata(
        'success',
        'Customer and vehicles added successfully!'
    );

    if ($this->input->post('from') === 'vehicle') {
        redirect('Vehicle/list');
    } else {
        redirect('customer');
    }
}

public function update()
{

    $customer_id = (int)$this->input->post('customer_id');

    if (!$customer_id) {

        $this->session->set_flashdata(
            'error',
            'Invalid customer.'
        );

        redirect('customer');
        return;
    }


    /* =====================================================
       GET POST DATA
    ===================================================== */

    $existing_ids =
        $this->input->post('vehicle_id_existing');

    $existing_reg =
        $this->input->post('vehicle_registration_no_existing');

    $brand_ids_exist =
        $this->input->post('brand_id_existing');

    $model_ids_exist =
        $this->input->post('model_id_existing');

    $existing_variant =
        $this->input->post('vehicle_variant_existing');

    $existing_year =
        $this->input->post('vehicle_year_existing');

    $existing_custom_year =
        $this->input->post('vehicle_year_custom_existing');

    $existing_color =
        $this->input->post('vehicle_color_existing');

    $existing_chassis =
        $this->input->post('vehicle_chassis_no_existing');

    $existing_engine =
        $this->input->post('vehicle_engine_no_existing');


    /* =====================================================
       CHECK DUPLICATES BEFORE UPDATING ANYTHING
    ===================================================== */

    $used_vins = [];
    $used_engines = [];


    if (!empty($existing_ids)) {

        for (
            $i = 0;
            $i < count($existing_ids);
            $i++
        ) {

            $vehicle_id =
                (int)$existing_ids[$i];


            /* =============================================
               VIN
            ============================================= */

            $vin =
                trim(
                    $existing_chassis[$i] ?? ''
                );


            if ($vin !== '') {

                $vin_key =
                    strtolower($vin);


                /*
                 * Check duplicate within
                 * submitted vehicles.
                 */

                if (
                    in_array(
                        $vin_key,
                        $used_vins,
                        true
                    )
                ) {

                    $this->session->set_flashdata(
                        'error',
                        'Duplicate VIN number "' .
                        $vin .
                        '" entered for multiple vehicles.'
                    );

                    redirect(
                        'customer/edit/' . $customer_id
                    );

                    return;
                }


                $used_vins[] =
                    $vin_key;


                /*
                 * Check database.
                 *
                 * Exclude current vehicle ID.
                 */

                $vin_exists =
                    $this->db
                        ->where(
                            'chassis_no',
                            $vin
                        )
                        ->where(
                            'vehicle_id !=',
                            $vehicle_id
                        )
                        ->count_all_results(
                            'vehicles'
                        );


                if ($vin_exists > 0) {

                    $this->session->set_flashdata(
                        'error',
                        'VIN number "' .
                        $vin .
                        '" already exists.'
                    );

                    redirect(
                        'customer/edit/' . $customer_id
                    );

                    return;
                }

            }


            /* =============================================
               ENGINE NUMBER
            ============================================= */

            $engine =
                trim(
                    $existing_engine[$i] ?? ''
                );


            if ($engine !== '') {

                $engine_key =
                    strtolower($engine);


                /*
                 * Check duplicate within
                 * submitted vehicles.
                 */

                if (
                    in_array(
                        $engine_key,
                        $used_engines,
                        true
                    )
                ) {

                    $this->session->set_flashdata(
                        'error',
                        'Duplicate engine number "' .
                        $engine .
                        '" entered for multiple vehicles.'
                    );

                    redirect(
                        'customer/edit/' . $customer_id
                    );

                    return;
                }


                $used_engines[] =
                    $engine_key;


                /*
                 * Check database.
                 *
                 * Exclude current vehicle.
                 */

                $engine_exists =
                    $this->db
                        ->where(
                            'engine_no',
                            $engine
                        )
                        ->where(
                            'vehicle_id !=',
                            $vehicle_id
                        )
                        ->count_all_results(
                            'vehicles'
                        );


                if ($engine_exists > 0) {

                    $this->session->set_flashdata(
                        'error',
                        'Engine number "' .
                        $engine .
                        '" already exists.'
                    );

                    redirect(
                        'customer/edit/' . $customer_id
                    );

                    return;
                }

            }

        }

    }



    /* =====================================================
       START DATABASE TRANSACTION
    ===================================================== */

    $this->db->trans_start();



    /* =====================================================
       1. UPDATE CUSTOMER
    ===================================================== */

    $customerData = [

        'name' =>
            $this->input->post('name'),

        'phone' =>
            $this->input->post('phone'),

        'email' =>
            $this->input->post('email'),

        'address' =>
            $this->input->post('address'),

        'trn' =>
            $this->input->post('trn'),

        'emirates' =>
            $this->input->post('emirate'),

        'branch_id' =>
            $this->input->post('branch_id')
                ? (int)$this->input->post('branch_id')
                : get_primary_branch_id(),

    ];


    $this->Customer_model->update_customer(
        $customer_id,
        $customerData
    );

    	// =========================ledger entry
        $exists = $this->db->where('customer_id', $customer_id)
				->get('general_ledger')
				->row();

        if ($exists) {
            $prifix = 'CUST';
            $digit = sprintf("%1$04d", $customer_id);
            $Code = $prifix . $digit;
            
            $grp_no = 30;
            $data1 = array(
                'account_name' => $this->input->post('name') . ' ' . $Code,
                'group_no' => $grp_no,
                'customer_id' => $customer_id,
                'opening_bal_type' => 'Dr',
            ); 
            $this->db->where('customer_id', $customer_id);
            $this->db->update('general_ledger', $data1);
        }else{
            $prifix = 'CUST';
            $digit = sprintf("%1$04d", $customer_id);
            $Code = $prifix . $digit;
            
            $grp_no = 30;
            $data1 = array(
                'account_name' => $this->input->post('name') . ' ' . $Code,
                'group_no' => $grp_no,
                'customer_id' => $customer_id,
                'opening_bal_type' => 'Dr',
            ); 
            $this->db->insert('general_ledger', $data1);
        }
		
		// =========================ledger entry




    /* =====================================================
       2. DELETE REMOVED VEHICLES
    ===================================================== */

    $vehiclesToDelete =
        $this->input->post(
            'vehicles_to_delete'
        );


    if (!empty($vehiclesToDelete)) {

        $deleteArray =
            json_decode(
                $vehiclesToDelete,
                true
            );


        if (is_array($deleteArray)) {

            foreach (
                $deleteArray as $vehicle_id
            ) {

                $vehicle_id =
                    (int)$vehicle_id;


                if ($vehicle_id > 0) {

                    $this->Vehicle_model
                        ->delete_vehicle(
                            $vehicle_id
                        );

                }

            }

        }

    }



    /* =====================================================
       3. UPDATE EXISTING VEHICLES
    ===================================================== */

    if (!empty($existing_ids)) {

        for (
            $i = 0;
            $i < count($existing_ids);
            $i++
        ) {

            $vehicle_id =
                (int)$existing_ids[$i];


            /*
             * Skip invalid IDs.
             */

            if ($vehicle_id <= 0) {
                continue;
            }


            /* =============================================
               BRAND
            ============================================= */

            $brand_id =
                isset(
                    $brand_ids_exist[$i]
                )
                    ? (int)$brand_ids_exist[$i]
                    : 0;


            $brand =
                $this->Vehicle_model
                    ->get_brand_by_id(
                        $brand_id
                    );


            /* =============================================
               MODEL
            ============================================= */

            $model_id =
                isset(
                    $model_ids_exist[$i]
                )
                    ? (int)$model_ids_exist[$i]
                    : 0;


            $model =
                $this->Vehicle_model
                    ->get_model_by_id(
                        $model_id
                    );


            /* =============================================
               YEAR
            ============================================= */

            $year =
                trim(
                    $existing_year[$i] ?? ''
                );


            /*
             * If custom year exists,
             * use custom year.
             */

            $customYear =
                trim(
                    $existing_custom_year[$i] ?? ''
                );


            if ($customYear !== '') {
                $year = $customYear;
            }


            /* =============================================
               VEHICLE DATA
            ============================================= */

            $vehicleData = [

                'registration_no' =>
                    trim(
                        $existing_reg[$i] ?? ''
                    ),

                'brand_id' =>
                    $brand_id,

                'brand' =>
                    $brand
                        ? $brand->brand_name
                        : null,

                'model_id' =>
                    $model_id,

                'model' =>
                    $model
                        ? $model->model_name
                        : null,

                'variant' =>
                    trim(
                        $existing_variant[$i] ?? ''
                    ),

                'year' =>
                    $year,

                'color' =>
                    trim(
                        $existing_color[$i] ?? ''
                    ),

                'chassis_no' =>
                    trim(
                        $existing_chassis[$i] ?? ''
                    ),

                'engine_no' =>
                    trim(
                        $existing_engine[$i] ?? ''
                    ),

            ];


            /*
             * Update vehicle.
             */

            $this->Vehicle_model
                ->update_vehicle(
                    $vehicle_id,
                    $vehicleData
                );

        }

    }



    /* =====================================================
       COMPLETE TRANSACTION
    ===================================================== */

    $this->db->trans_complete();



    /* =====================================================
       CHECK TRANSACTION
    ===================================================== */

    if (
        $this->db->trans_status() === FALSE
    ) {

        $this->session->set_flashdata(
            'error',
            'Unable to update customer and vehicles. Please try again.'
        );


        redirect(
            'customer/edit/' . $customer_id
        );

        return;
    }



    /* =====================================================
       SUCCESS
    ===================================================== */

    $this->session->set_flashdata(
        'success',
        'Customer and vehicles updated successfully!'
    );


    // redirect('customer');
    if ($this->input->post('from') === 'vehicle') {
        redirect('Vehicle/list');
    } else {
        redirect('customer');
    }
}
	/* -------------------------------
       DELETE CUSTOMER
    --------------------------------*/
	public function delete($customer_id)
	{
		$this->Customer_model->delete_customer($customer_id);
		$this->session->set_flashdata('success', 'Customer deleted successfully!');
		redirect('customer');
	}
	// ================================================================================

	public function add_spot_popup()
	{
		$data['brands'] = $this->Vehicle_model->get_all_brands();
		$this->load->view('customer/add_customer_spot_popup', $data);
	}

	public function get_models_by_brand($brand_id)
	{
		$this->load->model('Vehicle_model');
		echo json_encode($this->Vehicle_model->get_models_by_brand($brand_id));
	}

	public function get_years_by_model($model_id)
	{
		$this->load->model('Vehicle_model');
		$years = $this->Vehicle_model->get_years_by_model($model_id);

		echo json_encode($years);
	}

	public function get_models_by_brand_edit($brand_id)
	{
		// Safety check
		if (!$brand_id) {
			echo json_encode([]);
			return;
		}

		$models = $this->Vehicle_model->get_models_by_brand($brand_id);

		// VERY IMPORTANT: return JSON only
		header('Content-Type: application/json');
		echo json_encode($models);
	}

	public function save_spot_ajax()
	{
		$this->db->trans_start();

		/* CUSTOMER */
		$customer = [
			'name'    => $this->input->post('name'),
			'branch_id'    => $this->input->post('branch_id'),
			'phone'   => $this->input->post('phone'),
			'email'   => $this->input->post('email'),
			'address' => $this->input->post('address'),
			'emirates' => $this->input->post('emirate'),
		];
		$this->db->insert('customers', $customer);
		$customer_id = $this->db->insert_id();

		// =========================ledger entry
		$prifix = 'CUST';

		$digit = sprintf("%1$04d", $customer_id);
		$Code = $prifix . $digit;

		$grp_no = 30;
		$data1 = array(
			'account_name' => $this->input->post('name') . ' ' . $Code,
			'group_no' => $grp_no,
			'customer_id' => $customer_id,
			'opening_bal_type' => 'Dr',
		); 
		$this->db->insert('general_ledger', $data1);
		// return $this->db->insert_id(); // return customer_id
		// =========================ledger entry
		$brand_id = $this->input->post('brand_id');
		$model_id = $this->input->post('model_id');

		/* Fetch brand name */
		$brand = $this->db
			->get_where('vehicle_brands', ['brand_id' => $brand_id])
			->row();

		/* Fetch model name */
		$model = $this->db
			->get_where('vehicle_models', ['model_id' => $model_id])
			->row();

		/* VEHICLE */
		$vehicle = [
			'customer_id'     => $customer_id,
			'registration_no' => $this->input->post('registration_no'),
			'brand_id'        => $this->input->post('brand_id'),
			'brand'      => $brand ? $brand->brand_name : null,
			'model_id'        => $this->input->post('model_id'),
			'model'      => $model ? $model->model_name : null,

		];

		$this->db->insert('vehicles', $vehicle);
		$vehicle_id = $this->db->insert_id();

		$this->db->trans_complete();

		// echo json_encode([
		// 	'status' => 'success',
		// 	'customer' => [
		// 		'customer_id' => $customer_id,
		// 		'name'  => $customer['name'],
		// 		'phone' => $customer['phone']
		// 	],
		// 	'vehicle' => [
		// 		'vehicle_id' => $vehicle_id,
		// 		'registration_no' => $vehicle['registration_no'],
		// 		'brand' => $vehicle['brand'],
		// 		'model' => $vehicle['model'],
		// 		'chassis_no' => $vehicle['chassis_no'],
		// 		'engine_no' => $vehicle['engine_no']
		// 	]
		// ]);

		echo json_encode([
			'status' => 'success',
			'customer' => [
				'customer_id' => $customer_id,
				'name' => $customer['name'],
				'phone' => $customer['phone']
			],
			'vehicle' => [
				'vehicle_id' => $vehicle_id,
				'registration_no' => $vehicle['registration_no'],
				'brand_name' => $this->db
					->get_where('vehicle_brands', ['brand_id' => $this->input->post('brand_id')])
					->row()->brand_name,
				'model_name' => $this->db
					->get_where('vehicle_models', ['model_id' => $this->input->post('model_id')])
					->row()->model_name,

			]
		]);
		exit;
	}

	// ======================== two functions for direct ledger creation page display and cretaion process =====================
	public function customers_to_ledger()
	{
		$data['title'] = "customers_to_ledger";
		$data['main_content'] = 'customer/customer_list_gl_create';
		$this->load->view('includes/template', $data);
	}


	public function sync_customers_to_ledger()
	{
		$result = $this->Customer_model->sync_customers_to_ledger();

		echo json_encode([
			'status'  => 'success',
			'message' => $result . ' customers added to General Ledger'
		]);
	}
	// ======================function to list customers who is not having ledger account ===
	public function create_customer_ledgers()
	{


		$count = $this->Customer_model->create_missing_customer_ledgers();

		echo $count . " customer ledger accounts created.";
	}

	/* ===============================
	   SAVE VEHICLE VIA AJAX (from estimation/edit)
	   ============================== */
	public function save_vehicle_ajax()
	{
		$customer_id = $this->input->post('customer_id');
		$brand_id = $this->input->post('brand_id');
		$model_id = $this->input->post('model_id');

		// Validation
		if (!$customer_id || !$brand_id || !$this->input->post('registration_no')) {
			echo json_encode([
				'status' => 'error',
				'message' => 'Customer, Brand, and Registration No are required'
			]);
			exit;
		}

		// Fetch brand and model names
		$brand = $this->Vehicle_model->get_brand_by_id($brand_id);
		$model = $this->Vehicle_model->get_model_by_id($model_id);

		// Prepare vehicle data
		$vehicleData = [
			'customer_id'     => $customer_id,
			'registration_no' => $this->input->post('registration_no'),
			'brand_id'        => $brand_id,
			'brand'           => $brand ? $brand->brand_name : null,
			'model_id'        => $model_id,
			'model'           => $model ? $model->model_name : null,
			'variant'         => $this->input->post('variant'),
			'year'            => $this->input->post('year'),
			'color'           => $this->input->post('color'),
			'chassis_no'      => $this->input->post('chassis_no'),
			'engine_no'       => $this->input->post('engine_no'),
		];

		// Insert vehicle
		$vehicle_id = $this->Vehicle_model->insert_vehicle($vehicleData);

		if ($vehicle_id) {
			echo json_encode([
				'status'  => 'success',
				'message' => 'Vehicle added successfully',
				'vehicle_id' => $vehicle_id
			]);
		} else {
			echo json_encode([
				'status'  => 'error',
				'message' => 'Failed to add vehicle'
			]);
		}
		exit;
	}

	public function check_customers_without_ledger()
	{


		// Get customers without ledger
		$data['customers'] = $this->Customer_model->get_customers_without_ledger();

		// Count
		$data['count'] = count($data['customers']);

		// Load view (recommended)
		// $this->load->view('ledger/customers_without_ledger', $data);

		// OR simple print for testing

		echo "<h3>Customers without ledger: " . $data['count'] . "</h3>";

		if ($data['count'] > 0) {
			echo "<pre>";
			print_r($data['customers']);
			echo "</pre>";
		} else {
			echo "All customers have ledger accounts.";
		}
	}


	// ======================== Fleet Customers Logic =====================

	public function add_fleet_customer()
	{
		$data['title']        = "Add Fleet Customer";
		$data['brands']       = $this->Vehicle_model->get_all_brands();
		$data['main_content'] = 'customer/fleet_customer/add_fleet_customer';
		$this->load->view('includes/template', $data);
	}

	// Save fleet customer
	public function save_fleet()
	{
		$customerData = [
			'name'                   => $this->input->post('name'),
			'phone'                  => $this->input->post('phone'),
			'email'                  => $this->input->post('email'),
			'address'                => $this->input->post('address'),
			'trn'                    => $this->input->post('trn'),
			'emirates'               => $this->input->post('emirate'),
			'customer_type'          => 'fleet',
			'company_contact_person' => $this->input->post('company_contact_person'),
			'credit_limit'           => $this->input->post('credit_limit') ?: 0.00,
			'payment_terms'          => $this->input->post('payment_terms') ?: 0,
			'branch_id'              => $this->input->post('branch_id') ? (int)$this->input->post('branch_id') : get_primary_branch_id(),
		];

		$this->db->trans_start();

		$customer_id = $this->Customer_model->insert_customer($customerData);

		$reg_no     = $this->input->post('vehicle_registration_no');
		$brand_ids  = $this->input->post('brand_id');
		$model_ids  = $this->input->post('model_id');
		$variant    = $this->input->post('vehicle_variant');
		$year       = $this->input->post('vehicle_year');
		$color      = $this->input->post('vehicle_color');
		$chassis_no = $this->input->post('vehicle_chassis_no');
		$engine_no  = $this->input->post('vehicle_engine_no');

		if (!empty($reg_no)) {
			for ($i = 0; $i < count($reg_no); $i++) {

				if (trim($reg_no[$i]) == '') continue;

				$brand = $this->Vehicle_model->get_brand_by_id($brand_ids[$i]);
				$model = $this->Vehicle_model->get_model_by_id($model_ids[$i]);

				$vehicleData = [
					'customer_id'     => $customer_id,
					'registration_no' => $reg_no[$i],
					'brand_id'        => $brand_ids[$i],
					'brand'           => $brand ? $brand->brand_name : null,
					'model_id'        => $model_ids[$i],
					'model'           => $model ? $model->model_name : null,
					'variant'         => $variant[$i],
					'year'            => $year[$i],
					'color'           => $color[$i],
					'chassis_no'      => $chassis_no[$i],
					'engine_no'       => $engine_no[$i],
				];

				$this->Vehicle_model->insert_vehicle($vehicleData);
			}
		}

    	// =========================ledger entry
        $exists = $this->db->where('customer_id', $customer_id)
				->get('general_ledger')
				->row();

        if ($exists) {
            $prifix = 'CUST';
            $digit = sprintf("%1$04d", $customer_id);
            $Code = $prifix . $digit;
            
            $grp_no = 30;
            $data1 = array(
                'account_name' => $this->input->post('name') . ' ' . $Code,
                'group_no' => $grp_no,
                'customer_id' => $customer_id,
                'opening_bal_type' => 'Dr',
            ); 
            $this->db->where('customer_id', $customer_id);
            $this->db->update('general_ledger', $data1);
        }else{
            $prifix = 'CUST';
            $digit = sprintf("%1$04d", $customer_id);
            $Code = $prifix . $digit;
            
            $grp_no = 30;
            $data1 = array(
                'account_name' => $this->input->post('name') . ' ' . $Code,
                'group_no' => $grp_no,
                'customer_id' => $customer_id,
                'opening_bal_type' => 'Dr',
            ); 
            $this->db->insert('general_ledger', $data1);
        }
		
		// =========================ledger entry

		$this->db->trans_complete();

		$this->session->set_flashdata('success', 'Fleet customer and vehicles added successfully!');
		redirect('customer/fleet_list');
	}


	// List fleet customers
	public function fleet_list()
	{
		$data['customers']    = $this->Customer_model->filter_fleet_customers();
		$data['title']        = "Fleet Customers";
		$data['main_content'] = 'customer/fleet_customer/list_fleet_customers';
		$this->load->view('includes/template', $data);
	}

	// AJAX filter for fleet list
	public function filter_fleet_ajax()
	{
		$filters = [
			'name'  => $this->input->post('name'),
			'phone' => $this->input->post('phone'),
			'plate' => $this->input->post('plate'),
			'vin'   => $this->input->post('vin'),
		];

		$data['customers'] = $this->Customer_model->filter_fleet_customers($filters);
		$this->load->view('customer/_fleet_customer_rows', $data);
	}

	public function edit_fleet($customer_id)
	{
		$data['customer']     = $this->Customer_model->get_customer($customer_id);
		$data['vehicles']     = $this->Vehicle_model->get_vehicles_by_customer($customer_id);
		$data['brands']       = $this->Vehicle_model->get_all_brands();
		$data['title']        = "Edit Fleet Customer";
		$data['main_content'] = 'customer/fleet_customer/edit_fleet_customer';
		$this->load->view('includes/template', $data);
	}

	public function update_fleet()
	{
		$customer_id = $this->input->post('customer_id');


		$customerData = [
			'name'                   => $this->input->post('name'),
			'phone'                  => $this->input->post('phone'),
			'email'                  => $this->input->post('email'),
			'address'                => $this->input->post('address'),
			'trn'                    => $this->input->post('trn'),
			'emirates'               => $this->input->post('emirate'),
			'company_contact_person' => $this->input->post('company_contact_person'),
			'credit_limit'           => $this->input->post('credit_limit') ?: 0.00,
			'payment_terms'          => $this->input->post('payment_terms') ?: 0,
			'branch_id'              => $this->input->post('branch_id') ? (int)$this->input->post('branch_id') : get_primary_branch_id(),
		];

		$this->Customer_model->update_customer($customer_id, $customerData);


		$vehiclesToDelete = $this->input->post('vehicles_to_delete');
		if (!empty($vehiclesToDelete)) {
			$deleteArray = json_decode($vehiclesToDelete, true);
			if (is_array($deleteArray)) {
				foreach ($deleteArray as $vid) {
					$this->Vehicle_model->delete_vehicle($vid);
				}
			}
		}

		$existing_ids     = $this->input->post('vehicle_id_existing');
		$existing_reg     = $this->input->post('vehicle_registration_no_existing');
		$brand_ids_exist  = $this->input->post('brand_id_existing');
		$model_ids_exist  = $this->input->post('model_id_existing');
		$existing_variant = $this->input->post('vehicle_variant_existing');
		$existing_year    = $this->input->post('vehicle_year_existing');
		$existing_color   = $this->input->post('vehicle_color_existing');
		$existing_chassis = $this->input->post('vehicle_chassis_no_existing');
		$existing_engine  = $this->input->post('vehicle_engine_no_existing');

		if (!empty($existing_ids)) {
			for ($i = 0; $i < count($existing_ids); $i++) {
				$brand = $this->Vehicle_model->get_brand_by_id($brand_ids_exist[$i]);
				$model = $this->Vehicle_model->get_model_by_id($model_ids_exist[$i]);

				$vehicleData = [
					'registration_no' => $existing_reg[$i],
					'brand_id'        => $brand_ids_exist[$i],
					'brand'           => $brand ? $brand->brand_name : null,
					'model_id'        => $model_ids_exist[$i],
					'model'           => $model ? $model->model_name : null,
					'variant'         => $existing_variant[$i],
					'year'            => $existing_year[$i],
					'color'           => $existing_color[$i],
					'chassis_no'      => $existing_chassis[$i],
					'engine_no'       => $existing_engine[$i],
				];

				$this->Vehicle_model->update_vehicle($existing_ids[$i], $vehicleData);
			}
		}

		$new_reg       = $this->input->post('vehicle_registration_no_new');
		$brand_ids_new = $this->input->post('brand_id_new');
		$model_ids_new = $this->input->post('model_id_new');
		$new_variant   = $this->input->post('vehicle_variant_new');
		$new_year      = $this->input->post('vehicle_year_new');
		$new_color     = $this->input->post('vehicle_color_new');
		$new_chassis   = $this->input->post('vehicle_chassis_no_new');
		$new_engine    = $this->input->post('vehicle_engine_no_new');

		if (!empty($new_reg)) {
			for ($i = 0; $i < count($new_reg); $i++) {
				if (empty($new_reg[$i]) && empty($brand_ids_new[$i])) continue;

				$brand = $this->Vehicle_model->get_brand_by_id($brand_ids_new[$i]);
				$model = $this->Vehicle_model->get_model_by_id($model_ids_new[$i]);

				$vehicleData = [
					'customer_id'     => $customer_id,
					'registration_no' => $new_reg[$i],
					'brand_id'        => $brand_ids_new[$i],
					'brand'           => $brand ? $brand->brand_name : null,
					'model_id'        => $model_ids_new[$i],
					'model'           => $model ? $model->model_name : null,
					'variant'         => $new_variant[$i],
					'year'            => $new_year[$i],
					'color'           => $new_color[$i],
					'chassis_no'      => $new_chassis[$i],
					'engine_no'       => $new_engine[$i],
				];

				$this->Vehicle_model->insert_vehicle($vehicleData);
			}
		}

		$this->session->set_flashdata('success', 'Fleet customer updated successfully!');
		redirect('customer/fleet_list');
	}

	public function delete_fleet($customer_id)
	{
		$this->Customer_model->delete_vehicles_by_customer($customer_id);
		$this->Customer_model->delete_customer($customer_id);

		$this->session->set_flashdata('success', 'Fleet customer deleted successfully!');
		redirect('customer/fleet_list');
	}
	private function store_update_form_data()
	{
		$formData = $this->input->post();

		$this->session->set_flashdata(
			'form_data',
			$formData
		);
	}
}

