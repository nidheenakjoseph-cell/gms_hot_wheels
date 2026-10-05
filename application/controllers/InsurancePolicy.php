<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InsurancePolicy extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Insurance_policy_model');
        $this->load->model('InsuranceCompany_model');
        $this->load->library('form_validation');
    }

    public function policy_types()
    {
        $data['title'] = 'Policy Types';
        $data['policy_types'] = $this->Insurance_policy_model->get_policy_types();

        $data['main_content'] = 'insurance/policy/list_policy_type';
		
		$this->load->view('includes/template', $data);
    }

    public function add_policy_type()
    {
        $data['title'] = 'Add Policy Type';
        $data['main_content'] = 'insurance/policy/add_policy_type';

        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'policy_type_name',
                'Policy Type Name',
                'required|trim'
            );

            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'policy_type_name' => $this->input->post('policy_type_name'),
                    'description'      => $this->input->post('description'),
                    'status'           => $this->input->post('status'),
                );

                $this->Insurance_policy_model->insert_policy_type($data);

                $this->session->set_flashdata(
                    'success',
                    'Policy Type added!'
                );

                redirect('insurancepolicy/policy_types');
            }
            else {
                $this->session->set_flashdata(
                    'validation_error',
                    validation_errors()
                );

                $this->session->set_flashdata(
                    'policy_type_name',
                    $this->input->post('policy_type_name')
                );

                $this->session->set_flashdata(
                    'description',
                    $this->input->post('description')
                );

                $this->session->set_flashdata(
                    'status',
                    $this->input->post('status')
                );

                redirect('insurancepolicy/add_policy_type');
            }
        }

        $this->load->view('includes/template', $data);
    }

    public function edit_policy_type($id)
    {
        $data['policy_type'] =
            $this->Insurance_policy_model->get_policy_type($id);

        if (empty($data['policy_type'])) {
            $this->session->set_flashdata(
                'error',
                'Policy Type not found!'
            );

            redirect('insurancepolicy/policy_types');
        }

        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'policy_type_name',
                'Policy Type Name',
                'required|trim'
            );

            if ($this->form_validation->run() == TRUE) {

                $update = array(
                    'policy_type_name' => $this->input->post('policy_type_name'),
                    'description'      => $this->input->post('description'),
                    'status'           => $this->input->post('status'),
                );

                $this->Insurance_policy_model
                    ->update_policy_type($id, $update);

                $this->session->set_flashdata(
                    'success',
                    'Policy Type updated!'
                );

                redirect('insurancepolicy/policy_types');
            }
            else {

                $this->session->set_flashdata(
                    'validation_error',
                    validation_errors()
                );

                $this->session->set_flashdata(
                    'policy_type_name',
                    $this->input->post('policy_type_name')
                );

                $this->session->set_flashdata(
                    'description',
                    $this->input->post('description')
                );

                $this->session->set_flashdata(
                    'status',
                    $this->input->post('status')
                );

                redirect('insurancepolicy/edit_policy_type/' . $id);
            }

        }

        $data['title'] = 'Edit Policy Type';
        $data['main_content'] = 'insurance/policy/edit_policy_type';
        $this->load->view('includes/template', $data);
    }

    public function view_policy_type($policy_type_id)
    {
        $policy_type = $this->Insurance_policy_model
        ->get_policy_type_by_id($policy_type_id);

        if (!$policy_type) {
            $this->session->set_flashdata(
                'error',
                'Policy Type not found.'
            );

            redirect('insurancepolicy/policy_types');
            return;
        }

        $data['title'] = 'View Policy Type';
        $data['policy_type'] = $policy_type;

        $data['main_content'] = 'insurance/policy/view_policy_type';
		$this->load->view('includes/template', $data);
    }

    public function delete_policy_type($id)
    {
        $this->Insurance_policy_model->delete_policy_type($id);

        $this->session->set_flashdata(
            'success',
            'Policy Type deleted!'
        );

        redirect('insurancepolicy/policy_types');
    }

    public function coverage_types()
    {
        $data['title'] = 'Coverage Types';
        $data['coverage_types'] =
            $this->Insurance_policy_model->get_coverage_types();

        $data['main_content'] = 'insurance/policy/list_coverage_type';
		$this->load->view('includes/template', $data);
    }

    public function add_coverage_type()
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'coverage_type_name',
                'Coverage Name',
                'required|trim'
            );

            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'coverage_type_name' => $this->input->post('coverage_type_name'),
                    'description'        => $this->input->post('description'),
                    'status'             => $this->input->post('status'),
                );

                $this->Insurance_policy_model
                    ->insert_coverage_type($data);

                $this->session->set_flashdata(
                    'success',
                    'Coverage Type added!'
                );

                redirect('insurancepolicy/coverage_types');
            }
        }

        $data['title'] = 'Add Coverage Type';
        $data['main_content'] = 'insurance/policy/add_coverage_type';
        $this->load->view('includes/template', $data);
    }

    public function edit_coverage_type($id)
    {
        $data['coverage_type'] =
            $this->Insurance_policy_model->get_coverage_type($id);

        if (empty($data['coverage_type'])) {
            $this->session->set_flashdata(
                'error',
                'Coverage Type not found.'
            );

            redirect('insurancepolicy/coverage_types');
        }

        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'coverage_type_name',
                'Coverage Name',
                'required|trim'
            );

            if ($this->form_validation->run() == TRUE) {

                $update = array(
                    'coverage_type_name' => $this->input->post('coverage_type_name'),
                    'description'        => $this->input->post('description'),
                    'status'             => $this->input->post('status'),
                );

                $this->Insurance_policy_model
                    ->update_coverage_type($id, $update);

                $this->session->set_flashdata(
                    'success',
                    'Coverage Type updated!'
                );

                redirect('insurancepolicy/coverage_types');
            }
            else {

                $this->session->set_flashdata(
                    'validation_error',
                    validation_errors()
                );

                $this->session->set_flashdata(
                    'coverage_type_name',
                    $this->input->post('coverage_type_name')
                );

                $this->session->set_flashdata(
                    'description',
                    $this->input->post('description')
                );

                $this->session->set_flashdata(
                    'status',
                    $this->input->post('status')
                );

                redirect('insurancepolicy/edit_coverage_type/' . $id);
            }
        }

        $data['title'] = 'Edit Coverage Type';
        $data['main_content'] = 'insurance/policy/edit_coverage_type';
        $this->load->view('includes/template', $data);
    }

    public function view_coverage_type($coverage_type_id)
    {
        $coverage_type = $this->Insurance_policy_model
            ->get_coverage_type_by_id($coverage_type_id);

        if (!$coverage_type) {

            $this->session->set_flashdata(
                'error',
                'Coverage Type not found.'
            );

            redirect('insurancepolicy/coverage_types');
            return;
        }

        $data['title'] = 'View Coverage Type';
        $data['coverage_type'] = $coverage_type;

        $data['main_content'] = 'insurance/policy/view_coverage_type';
		$this->load->view('includes/template', $data);
    }

    public function delete_coverage_type($id)
    {
        $this->Insurance_policy_model->delete_coverage_type($id);

        $this->session->set_flashdata(
            'success',
            'Coverage Type deleted!'
        );

        redirect('insurancepolicy/coverage_types');
    }

    public function policy_terms()
    {
        $data['title'] = 'Policy Terms';
        $data['policy_terms'] =
            $this->Insurance_policy_model->get_policy_terms();

        $data['main_content'] = 'insurance/policy/list_policy_terms';	
		$this->load->view('includes/template', $data);
    }

    public function add_policy_term()
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'policy_term_name',
                'Policy Term Name',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'duration',
                'Duration',
                'required|trim|integer|greater_than[0]'
            );

            $this->form_validation->set_rules(
                'duration_unit',
                'Duration Unit',
                'required|trim'
            );

            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'policy_term_name'   => $this->input->post('policy_term_name', TRUE),
                    'duration'           => $this->input->post('duration', TRUE),
                    'duration_unit'      => $this->input->post('duration_unit', TRUE),
                    'description'        => $this->input->post('description', TRUE),
                    'status'             => $this->input->post('status', TRUE)
                );

                $this->Insurance_policy_model
                    ->insert_policy_term($data);

                $this->session->set_flashdata(
                    'success',
                    'Policy Term added!'
                );

                redirect('insurancepolicy/policy_terms');
            }
        }

        $data['title'] = 'Add Policy Term';

        $data['main_content'] = 'insurance/policy/add_policy_terms';
        $this->load->view('includes/template', $data);
    }

    public function edit_policy_term($id)
    {
        $data['policy_term'] =
            $this->Insurance_policy_model->get_policy_term($id);

        if (empty($data['policy_term'])) {
            $this->session->set_flashdata(
                'error',
                'Policy Term not found.'
            );

            redirect('insurancepolicy/policy_terms');
        }

        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'policy_term_name',
                'Policy Term Name',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'duration',
                'Duration',
                'required|trim|integer|greater_than[0]'
            );

            $this->form_validation->set_rules(
                'duration_unit',
                'Duration Unit',
                'required|trim'
            );

            if ($this->form_validation->run() == TRUE) {
                
                $update = array(
                    'policy_term_name'  => $this->input->post('policy_term_name', TRUE),
                    'duration'          => $this->input->post('duration', TRUE),
                    'duration_unit'     => $this->input->post('duration_unit', TRUE),
                    'description'       => $this->input->post('description', TRUE),
                    'status'            => $this->input->post('status', TRUE),
                );

                $this->Insurance_policy_model
                    ->update_policy_term($id, $update);

                $this->session->set_flashdata(
                    'success',
                    'Policy Term updated!'
                );

                redirect('insurancepolicy/policy_terms');
            }
        }

        $data['title'] = 'Edit Policy Term';

        $data['main_content'] = 'insurance/policy/edit_policy_terms';
        $this->load->view('includes/template', $data);
        
    }

    public function view_policy_term($term_id)
    {
        $policy_term = $this->Insurance_policy_model
            ->get_policy_term_by_id($term_id);

        if (!$policy_term) {

            $this->session->set_flashdata(
                'error',
                'Policy Term not found.'
            );

            redirect('insurancepolicy/policy_terms');
            return;
        }

        $data['title'] = 'View Policy Term';
        $data['policy_term'] = $policy_term;

        $data['main_content'] = 'insurance/policy/view_policy_terms';
		$this->load->view('includes/template', $data);
    }

    public function delete_policy_term($id)
    {
        $this->Insurance_policy_model->delete_policy_term($id);

        $this->session->set_flashdata(
            'success',
            'Policy Term deleted!'
        );

        redirect('insurancepolicy/policy_terms');
    }

    public function policies()
    {
        $data['title'] = 'Insurance Policies';
        $data['policies'] = $this->Insurance_policy_model->get_policies();

        $data['main_content'] = 'insurance/list_insurance_policy';
        $this->load->view('includes/template', $data);
    }

    public function view_policy($policy_id)
    {
        $data['title'] = 'Insurance Policy Details';

        $data['policy'] =
            $this->Insurance_policy_model->get_policy($policy_id);

        $data['policy_coverages'] =
            $this->Insurance_policy_model->get_policy_coverages($policy_id);

        if (empty($data['policy'])) {

            $this->session->set_flashdata(
                'error',
                'Insurance Policy not found.'
            );

            redirect('insurancepolicy/policies');
        }

        $data['policy_documents'] =
            $this->Insurance_policy_model
                ->get_policy_document($policy_id);

        $data['main_content'] = 'insurance/view_insurance_policy';
        $this->load->view('includes/template', $data);
    }

    public function add_policy()
    {
        $coverage_errors = array();

        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'customer_id',
                'Customer / Policyholder',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'vehicle_id',
                'Select Vehicle',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'policy_number',
                'Policy Number',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'insurance_company_id',
                'Insurance Company',
                'required'
            );

            $this->form_validation->set_rules(
                'policy_type_id',
                'Policy Type',
                'required'
            );

            $this->form_validation->set_rules(
                'policy_term_id',
                'Policy Term',
                'required'
            );

            $this->form_validation->set_rules(
                'start_date',
                'Start Date',
                'required'
            );

            $this->form_validation->set_rules(
                'expiry_date',
                'Expiry Date',
                'required'
            );

            $coverage_type_ids    = $this->input->post('coverage_type_id');
            $coverage_amounts     = $this->input->post('coverage_amount');
            $coverage_limit_types = $this->input->post('coverage_limit_type');

            $coverage_valid = true;

            if (
                !is_array($coverage_type_ids) ||
                count($coverage_type_ids) == 0
            ) {
                $coverage_valid = false;

                $coverage_errors[0]['coverage_type'] =
                    'At least one coverage is required.';
            } else {

                foreach ($coverage_type_ids as $i => $coverage_id) {

                    if (empty($coverage_id)) {

                        $coverage_valid = false;

                        $coverage_errors[$i]['coverage_type'] =
                            'Coverage Type is required.';
                    }

                    if (
                        !isset($coverage_amounts[$i]) ||
                        $coverage_amounts[$i] === ''
                    ) {

                        $coverage_valid = false;

                        $coverage_errors[$i]['coverage_amount'] =
                            'Coverage Amount is required.';

                    } elseif (
                        !is_numeric($coverage_amounts[$i]) ||
                        $coverage_amounts[$i] < 0
                    ) {

                        $coverage_valid = false;

                        $coverage_errors[$i]['coverage_amount'] =
                            'Coverage Amount must be a valid amount.';
                    }

                    if (
                        !isset($coverage_limit_types[$i]) ||
                        $coverage_limit_types[$i] === ''
                    ) {

                        $coverage_valid = false;

                        $coverage_errors[$i]['coverage_limit_type'] =
                            'Coverage Limit Type is required.';
                    }
                }
            }

            $validation_ok = $this->form_validation->run();

            if ($validation_ok && $coverage_valid) {

                $data = array(

                    'policy_number' => $this->input->post('policy_number'),

                    'insurance_company_id' =>
                        $this->input->post('insurance_company_id'),

                    'policy_type_id' =>
                        $this->input->post('policy_type_id'),

                    'policy_term_id' =>
                        $this->input->post('policy_term_id'),

                    'policy_status' =>
                        $this->input->post('policy_status'),

                    'start_date' =>
                        $this->input->post('start_date'),

                    'expiry_date' =>
                        $this->input->post('expiry_date'),

                    'customer_id' =>
                        $this->input->post('customer_id'),

                    'vehicle_id' =>
                        $this->input->post('vehicle_id'),

                    'sum_insured' =>
                        $this->input->post('sum_insured'),

                    'premium_amount' =>
                        $this->input->post('premium_amount'),

                    'discount_amount' =>
                        $this->input->post('discount_amount'),

                    'vat_treatment' =>
                        $this->input->post('vat_treatment'),

                    'vat_rate' =>
                        $this->input->post('vat_rate'),

                    'vat_amount' =>
                        $this->input->post('vat_amount'),

                    'total_premium' =>
                        $this->input->post('total_premium'),

                    'beneficiary' =>
                        $this->input->post('beneficiary'),

                    'policy_description' =>
                        $this->input->post('policy_description'),

                    'special_conditions' =>
                        $this->input->post('special_conditions'),

                    'exclusions' =>
                        $this->input->post('exclusions'),

                    'notes' =>
                        $this->input->post('notes'),

                    'cancellation_date' =>
                        $this->input->post('cancellation_date'),

                    'cancellation_reason' =>
                        $this->input->post('cancellation_reason'),

                    'created_at' =>
                        date('Y-m-d H:i:s')
                );

                $policy_id =
                    $this->Insurance_policy_model->insert_policy($data);

                if ($policy_id) {

                    $coverage_amounts =
                        $this->input->post('coverage_amount');

                    $coverage_limit_types =
                        $this->input->post('coverage_limit_type');

                    $deductible_amounts =
                        $this->input->post('deductible_amount');

                    $deductible_types =
                        $this->input->post('deductible_type');

                    foreach ($coverage_type_ids as $i => $coverage_id) {

                        $coverage_data = array(

                            'policy_id' =>
                                $policy_id,

                            'coverage_type_id' =>
                                $coverage_id,

                            'coverage_amount' =>
                                isset($coverage_amounts[$i])
                                    ? $coverage_amounts[$i]
                                    : 0,

                            'coverage_limit_type' =>
                                isset($coverage_limit_types[$i]) &&
                                $coverage_limit_types[$i] !== ''
                                    ? $coverage_limit_types[$i]
                                    : null,

                            'deductible_amount' =>
                                isset($deductible_amounts[$i])
                                    ? $deductible_amounts[$i]
                                    : 0,

                            'deductible_type' =>
                                isset($deductible_types[$i]) &&
                                $deductible_types[$i] !== ''
                                    ? $deductible_types[$i]
                                    : null,

                            'coverage_status' =>
                                isset($coverage_statuses[$i])
                                    ? $coverage_statuses[$i]
                                    : 1,

                            'created_at' =>
                                date('Y-m-d H:i:s')
                        );

                        $this->Insurance_policy_model
                            ->insert_policy_coverage($coverage_data);
                    }

                    $document_types =
                        $this->input->post('document_type');

                    $document_names =
                        $this->input->post('document_name');

                    if (
                        !empty($_FILES['document_file']['name']) &&
                        is_array($_FILES['document_file']['name'])
                    ) {

                        $upload_path =
                            './uploads/insurance/policies/' .
                            $policy_id . '/';


                        if (!is_dir($upload_path)) {

                            mkdir(
                                $upload_path,
                                0777,
                                true
                            );
                        }

                        $files =
                            $_FILES['document_file'];

                        foreach (
                            $files['name'] as $i => $file_name
                        ) {

                            if (empty($file_name)) {
                                continue;
                            }

                            $_FILES['single_file']['name'] =
                                $files['name'][$i];

                            $_FILES['single_file']['type'] =
                                $files['type'][$i];

                            $_FILES['single_file']['tmp_name'] =
                                $files['tmp_name'][$i];

                            $_FILES['single_file']['error'] =
                                $files['error'][$i];

                            $_FILES['single_file']['size'] =
                                $files['size'][$i];

                            $config = array();

                            $config['upload_path'] =
                                $upload_path;

                            $config['allowed_types'] =
                                'pdf|jpg|jpeg|png|doc|docx';

                            $config['max_size'] =
                                10240;

                            $config['encrypt_name'] =
                                true;

                            $this->load->library(
                                'upload',
                                $config
                            );

                            if (
                                $this->upload
                                    ->do_upload('single_file')
                            ) {

                                $upload_data =
                                    $this->upload->data();

                                $document_data = array(

                                    'policy_id' =>
                                        $policy_id,

                                    'document_type' =>
                                        isset($document_types[$i])
                                            ? $document_types[$i]
                                            : null,

                                    'document_name' =>
                                        isset($document_names[$i])
                                            ? $document_names[$i]
                                            : $file_name,

                                    'file_name' =>
                                        $upload_data['file_name'],

                                    'file_path' =>
                                        'uploads/insurance/policies/' .
                                        $policy_id . '/' .
                                        $upload_data['file_name'],

                                    'uploaded_at' =>
                                        date('Y-m-d H:i:s')
                                );

                                $this->Insurance_policy_model
                                    ->insert_policy_document(
                                        $document_data
                                    );
                            }

                            $this->upload->initialize($config);
                        }
                    }

                    $this->session->set_flashdata(
                        'success',
                        'Insurance policy added!'
                    );

                    redirect('insurancepolicy/policies');
                }
            }
        }

        $data['insurance_companies'] =
            $this->InsuranceCompany_model->get_all();

        $data['policy_types'] =
            $this->Insurance_policy_model->get_policy_types();

        $data['coverage_types'] =
            $this->Insurance_policy_model->get_coverage_types();

        $data['policy_terms'] =
            $this->Insurance_policy_model->get_policy_terms();

        $data['customers'] =
            $this->Insurance_policy_model->get_customers();

        $data['vehicles'] =
            $this->Insurance_policy_model->get_all_vehicles();

        $data['coverage_errors'] =
            $coverage_errors;

        $data['coverage_type_ids'] =
            $this->input->post('coverage_type_id');

        $data['coverage_amounts'] =
            $this->input->post('coverage_amount');

        $data['coverage_limit_types'] =
            $this->input->post('coverage_limit_type');

        $data['deductible_amounts'] =
            $this->input->post('deductible_amount');

        $data['deductible_types'] =
            $this->input->post('deductible_type');

        $data['coverage_statuses'] =
            $this->input->post('coverage_status');

        $data['title'] =
            'Add Insurance Policy';

        $data['main_content'] =
            'insurance/add_insurance_policy';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function edit_policy($id)
    {
        $coverage_errors = array();

        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'customer_id',
                'Customer / Policyholder',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'vehicle_id',
                'Select Vehicle',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'policy_number',
                'Policy Number',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'insurance_company_id',
                'Insurance Company',
                'required'
            );

            $this->form_validation->set_rules(
                'policy_type_id',
                'Policy Type',
                'required'
            );

            $this->form_validation->set_rules(
                'policy_term_id',
                'Policy Term',
                'required'
            );

            $this->form_validation->set_rules(
                'start_date',
                'Start Date',
                'required'
            );

            $this->form_validation->set_rules(
                'expiry_date',
                'Expiry Date',
                'required'
            );

            $coverage_type_ids    = $this->input->post('coverage_type_id');
            $coverage_amounts     = $this->input->post('coverage_amount');
            $coverage_limit_types = $this->input->post('coverage_limit_type');

            $coverage_valid = true;

            if (
                !is_array($coverage_type_ids) ||
                count($coverage_type_ids) == 0
            ) {
                $coverage_valid = false;

                $coverage_errors[0]['coverage_type'] =
                    'At least one coverage is required.';
            } else {

                foreach ($coverage_type_ids as $i => $coverage_id) {

                    if (empty($coverage_id)) {

                        $coverage_valid = false;

                        $coverage_errors[$i]['coverage_type'] =
                            'Coverage Type is required.';
                    }

                    if (
                        !isset($coverage_amounts[$i]) ||
                        $coverage_amounts[$i] === ''
                    ) {

                        $coverage_valid = false;

                        $coverage_errors[$i]['coverage_amount'] =
                            'Coverage Amount is required.';

                    } elseif (
                        !is_numeric($coverage_amounts[$i]) ||
                        $coverage_amounts[$i] < 0
                    ) {

                        $coverage_valid = false;

                        $coverage_errors[$i]['coverage_amount'] =
                            'Coverage Amount must be a valid amount.';
                    }

                    if (
                        !isset($coverage_limit_types[$i]) ||
                        $coverage_limit_types[$i] === ''
                    ) {

                        $coverage_valid = false;

                        $coverage_errors[$i]['coverage_limit_type'] =
                            'Coverage Limit Type is required.';
                    }
                }
            }

            $validation_ok = $this->form_validation->run();

            if ($validation_ok && $coverage_valid) {

                $update = array(

                    'policy_number' =>
                        trim($this->input->post('policy_number')),

                    'insurance_company_id' =>
                        $this->input->post('insurance_company_id'),

                    'policy_type_id' =>
                        $this->input->post('policy_type_id'),

                    'policy_term_id' =>
                        $this->input->post('policy_term_id'),

                    'policy_status' =>
                        $this->input->post('policy_status'),

                    'start_date' =>
                        $this->input->post('start_date'),

                    'expiry_date' =>
                        $this->input->post('expiry_date'),

                    'customer_id' =>
                        $this->input->post('customer_id'),

                    'vehicle_id' =>
                        $this->input->post('vehicle_id'),

                    'sum_insured' =>
                        $this->input->post('sum_insured'),

                    'premium_amount' =>
                        $this->input->post('premium_amount'),

                    'discount_amount' =>
                        $this->input->post('discount_amount'),

                    'vat_rate' =>
                        $this->input->post('vat_rate'),

                    'vat_amount' =>
                        $this->input->post('vat_amount'),

                    'vat_treatment' =>
                        $this->input->post('vat_treatment'),

                    'total_premium' =>
                        $this->input->post('total_premium'),

                    'policy_description' =>
                        $this->input->post('policy_description'),

                    'beneficiary' =>
                        $this->input->post('beneficiary'),

                    'special_conditions' =>
                        $this->input->post('special_conditions'),

                    'exclusions' =>
                        $this->input->post('exclusions'),

                    'notes' =>
                        $this->input->post('notes'),

                    'cancellation_date' =>
                        !empty($this->input->post('cancellation_date'))
                            ? $this->input->post('cancellation_date')
                            : NULL,

                    'cancellation_reason' =>
                        $this->input->post('cancellation_reason')
                );

                $updated =
                    $this->Insurance_policy_model
                        ->update_policy($id, $update);

                if ($updated) {

                    $coverage_type_ids =
                        $this->input->post('coverage_type_id');

                    $coverage_amounts =
                        $this->input->post('coverage_amount');

                    $coverage_limit_types =
                        $this->input->post('coverage_limit_type');

                    $deductible_amounts =
                        $this->input->post('deductible_amount');

                    $deductible_types =
                        $this->input->post('deductible_type');

                    $this->Insurance_policy_model
                        ->delete_policy_coverages($id);

                    if (!empty($coverage_type_ids)) {

                        foreach ($coverage_type_ids as $i => $coverage_type_id) {

                            if (empty($coverage_type_id)) {
                                continue;
                            }

                            $coverage_data = array(

                                'policy_id' =>
                                    $id,

                                'coverage_type_id' =>
                                    $coverage_type_id,

                                'coverage_amount' =>
                                    !empty($coverage_amounts[$i])
                                        ? $coverage_amounts[$i]
                                        : 0,

                                'coverage_limit_type' =>
                                    !empty($coverage_limit_types[$i])
                                        ? $coverage_limit_types[$i]
                                        : NULL,

                                'deductible_amount' =>
                                    !empty($deductible_amounts[$i])
                                        ? $deductible_amounts[$i]
                                        : 0,

                                'deductible_type' =>
                                    !empty($deductible_types[$i])
                                        ? $deductible_types[$i]
                                        : NULL,
                                        
                            );

                            $this->Insurance_policy_model
                                ->insert_policy_coverage(
                                    $coverage_data
                                );
                        }
                    }

                    $document_types =
                        $this->input->post('document_type');

                    $document_names =
                        $this->input->post('document_name');

                    if (
                        isset($_FILES['document_file']) &&
                        !empty($_FILES['document_file']['name'][0])
                    ) {

                        $upload_path =
                            './uploads/insurance/policies/' .
                            $id .
                            '/';

                        if (!is_dir($upload_path)) {

                            mkdir(
                                $upload_path,
                                0777,
                                true
                            );
                        }

                        $files =
                            $_FILES['document_file'];

                        for (
                            $i = 0;
                            $i < count($files['name']);
                            $i++
                        ) {

                            if (empty($files['name'][$i])) {
                                continue;
                            }

                            $_FILES['single_file']['name'] =
                                $files['name'][$i];

                            $_FILES['single_file']['type'] =
                                $files['type'][$i];

                            $_FILES['single_file']['tmp_name'] =
                                $files['tmp_name'][$i];

                            $_FILES['single_file']['error'] =
                                $files['error'][$i];

                            $_FILES['single_file']['size'] =
                                $files['size'][$i];

                            $config = array();

                            $config['upload_path'] =
                                $upload_path;

                            $config['allowed_types'] =
                                'pdf|jpg|jpeg|png|doc|docx';

                            $config['max_size'] =
                                10240;

                            $config['encrypt_name'] =
                                TRUE;

                            $this->load->library(
                                'upload',
                                $config
                            );

                            $this->upload->initialize(
                                $config
                            );

                            if (
                                $this->upload
                                    ->do_upload('single_file')
                            ) {

                                $upload_data =
                                    $this->upload->data();

                                $document_data = array(

                                    'policy_id' =>
                                        $id,

                                    'document_type' =>
                                        !empty($document_types[$i])
                                            ? $document_types[$i]
                                            : NULL,

                                    'document_name' =>
                                        !empty($document_names[$i])
                                            ? $document_names[$i]
                                            : $upload_data['orig_name'],

                                    'file_name' =>
                                        $upload_data['file_name'],

                                    'file_path' =>
                                        'uploads/insurance/policies/' .
                                        $id .
                                        '/' .
                                        $upload_data['file_name'],

                                );

                                $this->Insurance_policy_model
                                    ->insert_policy_document(
                                        $document_data
                                    );

                            } else {

                                log_message(
                                    'error',
                                    'Insurance policy document upload failed: ' .
                                    $this->upload->display_errors()
                                );
                            }
                        }
                    }

                    $this->session->set_flashdata(
                        'success',
                        'Insurance Policy updated!'
                    );

                    redirect(
                        'insurancepolicy/policies'
                    );
                }
            }
        }

        $data['policy'] =
            $this->Insurance_policy_model
                ->get_policy($id);

        if (empty($data['policy'])) {

            $this->session->set_flashdata(
                'error',
                'Insurance Policy not found.'
            );

            redirect(
                'insurancepolicy/policies'
            );
        }

        $data['policy_coverages'] =
            $this->Insurance_policy_model
                ->get_policy_coverages($id);

        $data['policy_documents'] =
            $this->Insurance_policy_model
                ->get_policy_document($id);

        $data['insurance_companies'] =
            $this->InsuranceCompany_model
                ->get_all();

        $data['policy_types'] =
            $this->Insurance_policy_model
                ->get_policy_types();

        $data['coverage_types'] =
            $this->Insurance_policy_model
                ->get_coverage_types();

        $data['policy_terms'] =
            $this->Insurance_policy_model
                ->get_policy_terms();

        $data['customers'] =
            $this->Insurance_policy_model
                ->get_customers();

        $data['vehicles'] =
            $this->Insurance_policy_model->get_all_vehicles();

        $data['title'] =
            'Edit Insurance Policy';

        $data['main_content'] =
            'insurance/edit_insurance_policy';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function delete_policy($id)
    {
        $this->Insurance_policy_model
            ->delete_policy($id);

        $this->session->set_flashdata(
            'success',
            'Insurance Policy deleted!'
        );

        redirect('insurancepolicy/policies');
    }

    public function delete_policy_document($id, $policy_id)
    {
        $this->Insurance_policy_model
            ->delete_policy_document($id);

        $this->session->set_flashdata(
            'success',
            'Insurance Policy document deleted!'
        );

        redirect('insurancepolicy/edit_policy/' . $policy_id);
    }

    public function get_vehicles_by_customer()
    {
        $customer_id = $this->input->post('customer_id');

        $vehicles = $this->Insurance_policy_model
            ->get_vehicles_by_customer($customer_id);

        echo json_encode($vehicles);
    }

    public function get_vehicle_customer()
    {
        $vehicle_id = $this->input->post('vehicle_id');

        if (empty($vehicle_id)) {
            echo json_encode([]);
            return;
        }

        $vehicle = $this->Insurance_policy_model
                        ->get_vehicle_with_customer($vehicle_id);

        if ($vehicle) {
            echo json_encode($vehicle);
        } else {
            echo json_encode([]);
        }
    }

    public function get_all_vehicles()
    {
        $vehicles = $this->Insurance_policy_model->get_all_vehicles();
        echo json_encode($vehicles);
    }

}