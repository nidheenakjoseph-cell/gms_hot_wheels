<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InsuranceRenewal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Insurance_renewal_model');
        $this->load->library('form_validation');
    }

    public function renewals()
    {
        $data['title'] = 'Policy Renewals';

        $data['renewals'] =
            $this->Insurance_renewal_model
            ->get_policy_renewals();

        $data['main_content'] = 'insurance/list_insurance_renewal';
		$this->load->view('includes/template', $data);
    }

    public function add_renewal()
    {
        $coverage_errors = array();

        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'policy_id',
                'Existing Policy',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'renewal_request_date',
                'Renewal Request Date',
                'required'
            );

            $this->form_validation->set_rules(
                'new_policy_number',
                'New Policy Number',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'new_start_date',
                'New Start Date',
                'required'
            );

            $this->form_validation->set_rules(
                'new_expiry_date',
                'New Expiry Date',
                'required'
            );

            $coverage_type_ids =
                $this->input->post('coverage_type_id');

            $coverage_amounts =
                $this->input->post('coverage_amount');

            $coverage_limit_types =
                $this->input->post('coverage_limit_type');

            $deductible_amounts =
                $this->input->post('deductible');

            $deductible_types =
                $this->input->post('deductible_type');

            $coverage_valid = true;

            if (
                !is_array($coverage_type_ids) ||
                count($coverage_type_ids) == 0
            ) {

                $coverage_valid = false;

                $coverage_errors[0]['coverage_type'] =
                    'At least one coverage is required.';

            } else {

                foreach (
                    $coverage_type_ids as $i => $coverage_id
                ) {

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

            $validation_ok =
                $this->form_validation->run();

            if ($validation_ok && $coverage_valid) {

                $policy_id = $this->input->post('policy_id');

                $existing_policy = 
                    $this->Insurance_renewal_model
                    ->get_policy_for_renewal($policy_id);

                $new_policy_data = array(

                    'policy_number' =>
                        $this->input->post(
                            'new_policy_number'
                        ),

                    'insurance_company_id' =>
                        $this->input->post(
                            'insurance_company_id'
                        ),

                    'policy_type_id' =>
                        $this->input->post(
                            'policy_type_id'
                        ),

                    'policy_term_id' =>
                        $this->input->post(
                            'policy_term_id'
                        ),

                    'policy_status' => 
                        $this->input->post(
                            'policy_status'
                        ),

                    'start_date' =>
                        $this->input->post(
                            'new_start_date'
                        ),

                    'expiry_date' =>
                        $this->input->post(
                            'new_expiry_date'
                        ),

                    'customer_id' =>
                        $existing_policy
                            ->customer_id,

                    'vehicle_id' =>
                        $existing_policy
                            ->vehicle_id,

                    'sum_insured' =>
                        $this->input->post(
                            'sum_insured'
                        ),

                    'premium_amount' =>
                        $this->input->post(
                            'premium_amount'
                        ),

                    'discount_amount' =>
                        $this->input->post(
                            'discount_amount'
                        ),

                    'vat_treatment' =>
                        $this->input->post(
                            'vat_treatment'
                        ),

                    'vat_rate' =>
                        $this->input->post(
                            'vat_rate'
                        ),

                    'vat_amount' =>
                        $this->input->post(
                            'vat_amount'
                        ),

                    'total_premium' =>
                        $this->input->post(
                            'total_premium'
                        ),
                );

                $new_policy_id =
                    $this->Insurance_renewal_model
                        ->insert_new_policy(
                            $new_policy_data
                        );

                if ($new_policy_id) {

                    $renewal_data = array(

                        'previous_policy_id' =>
                            $this->input->post(
                                'policy_id'
                            ),

                        'new_policy_id' =>
                            $new_policy_id,

                        'renewal_request_date' =>
                            $this->input->post(
                                'renewal_request_date'
                            ),

                        'remarks' =>
                            $this->input->post(
                                'remarks'
                            )
                    );

                    $renewal_id =
                        $this->Insurance_renewal_model
                            ->insert_policy_renewal(
                                $renewal_data
                            );

                    notify_event(
                        'insurance_renewed',
                        $renewal_id ?: $new_policy_id,
                        'Insurance policy renewed',
                        'insurancerenewal/view_renewal/' . ($renewal_id ?: $new_policy_id),
                        'InsuranceRenewal',
                        ['details' => 'New policy ID: ' . $new_policy_id]
                    );

                    foreach (
                        $coverage_type_ids
                        as $i => $coverage_id
                    ) {

                        if (empty($coverage_id)) {
                            continue;
                        }

                        $coverage_data = array(

                            'policy_id' =>
                                $new_policy_id,

                            'coverage_type_id' =>
                                $coverage_id,

                            'coverage_amount' =>
                                isset(
                                    $coverage_amounts[$i]
                                )
                                    ? $coverage_amounts[$i]
                                    : 0,

                            'coverage_limit_type' =>
                                isset(
                                    $coverage_limit_types[$i]
                                ) &&
                                $coverage_limit_types[$i] !== ''
                                    ? $coverage_limit_types[$i]
                                    : null,

                            'deductible_amount' =>
                                isset(
                                    $deductible_amounts[$i]
                                )
                                    ? $deductible_amounts[$i]
                                    : 0,

                            'deductible_type' =>
                                isset(
                                    $deductible_types[$i]
                                ) &&
                                $deductible_types[$i] !== ''
                                    ? $deductible_types[$i]
                                    : null,
                        );

                        $this->Insurance_renewal_model
                            ->insert_policy_coverage(
                                $coverage_data
                            );
                    }

                    $document_types =
                        $this->input->post(
                            'document_type'
                        );

                    $document_names =
                        $this->input->post(
                            'document_name'
                        );

                    if (
                        !empty(
                            $_FILES['document_file']['name']
                        ) &&
                        is_array(
                            $_FILES['document_file']['name']
                        )
                    ) {

                        $upload_path =
                            './uploads/insurance/policies/' .
                            $new_policy_id .
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

                        foreach (
                            $files['name']
                            as $i => $file_name
                        ) {

                            if (empty($file_name)) {
                                continue;
                            }

                            $_FILES['single_file'] = array(

                                'name' =>
                                    $files['name'][$i],

                                'type' =>
                                    $files['type'][$i],

                                'tmp_name' =>
                                    $files['tmp_name'][$i],

                                'error' =>
                                    $files['error'][$i],

                                'size' =>
                                    $files['size'][$i]
                            );

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
                                    ->do_upload(
                                        'single_file'
                                    )
                            ) {

                                $upload_data =
                                    $this->upload->data();

                                $document_data = array(

                                    'policy_id' =>
                                        $new_policy_id,

                                    'document_type' =>
                                        isset(
                                            $document_types[$i]
                                        )
                                            ? $document_types[$i]
                                            : null,

                                    'document_name' =>
                                        isset(
                                            $document_names[$i]
                                        )
                                            ? $document_names[$i]
                                            : $file_name,

                                    'file_name' =>
                                        $upload_data[
                                            'file_name'
                                        ],

                                    'file_path' =>
                                        'uploads/insurance/policies/' .
                                        $new_policy_id .
                                        '/' .
                                        $upload_data[
                                            'file_name'
                                        ],

                                    'uploaded_at' =>
                                        date(
                                            'Y-m-d H:i:s'
                                        )
                                );

                                $this->Insurance_renewal_model
                                    ->insert_policy_document(
                                        $document_data
                                    );
                            }

                            $this->upload->initialize(
                                $config
                            );
                        }
                    }
                }
                
                $this->session->set_flashdata(
                    'success',
                    'Insurance renewal added!'
                );

                redirect(
                    'insurancerenewal/renewals'
                );
            }
        }

        $data['title'] =
            'Add Insurance Policy Renewal';

        $data['policies'] =
            $this->Insurance_renewal_model
                ->get_policies_for_renewal();

        $data['coverage_types'] =
            $this->Insurance_renewal_model->get_coverage_types();

        $data['insurance_companies'] =
            $this->Insurance_renewal_model
                ->get_insurance_companies();

        $data['policy_types'] =
            $this->Insurance_renewal_model
                ->get_policy_types();

        $data['policy_terms'] =
            $this->Insurance_renewal_model
                ->get_policy_terms();

        $data['main_content'] =
            'insurance/add_insurance_renewal';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function get_policy_for_renewal()
    {
        $policy_id =
            $this->input->post('policy_id');


        if (!$policy_id) {

            echo json_encode(null);

            return;
        }

        $policy =
            $this->Insurance_renewal_model
                ->get_policy_for_renewal($policy_id);

        echo json_encode($policy);
    }

    public function get_policy_coverages()
    {
        $policy_id = $this->input->post('policy_id');

        if (!$policy_id) {
            echo json_encode([]);
            return;
        }

        $this->load->model('Insurance_renewal_model');

        $coverages = $this->Insurance_renewal_model
            ->get_policy_coverages_for_renewal($policy_id);

        echo json_encode($coverages);
    }

    public function view_renewal($renewal_id)
    {
        if (empty($renewal_id)) {
            show_404();
        }

        $renewal = $this->Insurance_renewal_model
            ->get_renewal_by_id($renewal_id);

        if (!$renewal) {
            show_404();
        }

        $data['title'] = 'View Insurance Policy Renewal';

        $data['renewal'] = $renewal;

        $data['renewal_documents'] =
            $this->Insurance_renewal_model
            ->get_renewal_documents($renewal_id);

        $data['renewal_coverages'] =
            $this->Insurance_renewal_model
            ->get_renewal_coverages($renewal_id);

        $data['main_content'] = 'insurance/view_insurance_renewal';
        $this->load->view('includes/template', $data);
    }

    public function edit_renewal($id)
    {

        $renewal =
            $this->Insurance_renewal_model
                ->get_renewal_by_id($id);

        if (!$renewal) {

            $this->session->set_flashdata(
                'error',
                'Insurance Renewal not found.'
            );

            redirect(
                'insurancerenewal/renewals'
            );

            return;
        }

        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'renewal_request_date',
                'Renewal Request Date',
                'required'
            );

            if ($this->form_validation->run() == TRUE) {

                $update = array(

                    'renewal_request_date' =>
                        $this->input->post(
                            'renewal_request_date'
                        ),

                    'remarks' =>
                        $this->input->post(
                            'remarks'
                        )
                );

                $this->Insurance_renewal_model
                    ->update_renewal(
                        $id,
                        $update
                    );

                $update_policy_data = array(

                    'policy_number' =>
                        $this->input->post(
                            'policy_number'
                        ),

                    'insurance_company_id' =>
                        $this->input->post(
                            'insurance_company_id'
                        ),

                    'policy_type_id' =>
                        $this->input->post(
                            'policy_type_id'
                        ),

                    'policy_term_id' =>
                        $this->input->post(
                            'policy_term_id'
                        ),

                    'policy_status' =>
                        $this->input->post(
                            'policy_status'
                        ),

                    'start_date' =>
                        $this->input->post(
                            'start_date'
                        ),

                    'expiry_date' =>
                        $this->input->post(
                            'expiry_date'
                        ),

                    'sum_insured' =>
                        $this->input->post(
                            'sum_insured'
                        ),

                    'premium_amount' =>
                        $this->input->post(
                            'premium_amount'
                        ),

                    'discount_amount' =>
                        $this->input->post(
                            'discount_amount'
                        ),

                    'vat_treatment' =>
                        $this->input->post(
                            'vat_treatment'
                        ),

                    'vat_rate' =>
                        $this->input->post(
                            'vat_rate'
                        ),

                    'vat_amount' =>
                        $this->input->post(
                            'vat_amount'
                        ),

                    'total_premium' =>
                        $this->input->post(
                            'total_premium'
                        )
                );

                $this->Insurance_renewal_model
                    ->update_policy(
                        $renewal->new_policy_id,
                        $update_policy_data
                    );

                $coverage_ids =
                    $this->input->post(
                        'coverage_id'
                    );

                $coverage_type_ids =
                    $this->input->post(
                        'coverage_type_id'
                    );

                $coverage_amounts =
                    $this->input->post(
                        'coverage_amount'
                    );

                $coverage_limit_types =
                    $this->input->post(
                        'coverage_limit_type'
                    );

                $deductible_amounts =
                    $this->input->post(
                        'deductible'
                    );

                $deductible_types =
                    $this->input->post(
                        'deductible_type'
                    );

                $delete_coverage_ids =
                    $this->input->post(
                        'delete_coverage_id'
                    );

                if (
                    !empty($delete_coverage_ids) &&
                    is_array($delete_coverage_ids)
                ) {

                    foreach (
                        $delete_coverage_ids
                        as $delete_coverage_id
                    ) {

                        if (
                            !empty(
                                $delete_coverage_id
                            )
                        ) {

                            $this->Insurance_renewal_model
                                ->delete_policy_coverage(
                                    $delete_coverage_id
                                );
                        }
                    }
                }

                if (
                    is_array(
                        $coverage_type_ids
                    )
                ) {

                    foreach (
                        $coverage_type_ids
                        as $i => $coverage_type_id
                    ) {

                        if (
                            empty(
                                $coverage_type_id
                            )
                        ) {
                            continue;
                        }

                        $coverage_data = array(

                            'coverage_type_id' =>
                                $coverage_type_id,

                            'coverage_amount' =>
                                isset(
                                    $coverage_amounts[$i]
                                )
                                    ? $coverage_amounts[$i]
                                    : 0,

                            'coverage_limit_type' =>
                                isset(
                                    $coverage_limit_types[$i]
                                ) &&
                                $coverage_limit_types[$i] !== ''
                                    ? $coverage_limit_types[$i]
                                    : null,

                            'deductible_amount' =>
                                isset(
                                    $deductible_amounts[$i]
                                )
                                    ? $deductible_amounts[$i]
                                    : 0,

                            'deductible_type' =>
                                isset(
                                    $deductible_types[$i]
                                ) &&
                                $deductible_types[$i] !== ''
                                    ? $deductible_types[$i]
                                    : null,

                        );

                        if (
                            isset(
                                $coverage_ids[$i]
                            ) &&
                            !empty(
                                $coverage_ids[$i]
                            )
                        ) {

                            $this->Insurance_renewal_model
                                ->update_policy_coverage(
                                    $coverage_ids[$i],
                                    $coverage_data
                                );
                        }

                        else {

                            $existing_coverage =
                                $this->Insurance_renewal_model
                                    ->get_policy_coverage_by_type(
                                        $renewal->coverage_type_id,
                                        $coverage_type_id
                                    );

                            if ($existing_coverage) {

                                $this->Insurance_renewal_model
                                    ->update_policy_coverage(
                                        $existing_coverage->policy_coverage_id,
                                        $coverage_data
                                    );
                            }

                            else {

                                $coverage_data['policy_id'] =
                                    $renewal->new_policy_id;

                                $coverage_data['created_at'] =
                                    date(
                                        'Y-m-d H:i:s'
                                    );

                                $this->Insurance_renewal_model
                                    ->insert_policy_coverage(
                                        $coverage_data
                                    );
                            }
                        }
                    }
                }

                $document_types =
                    $this->input->post(
                        'document_type'
                    );

                $document_names =
                    $this->input->post(
                        'document_name'
                    );

                if (
                    isset(
                        $_FILES['document_file']
                    ) &&
                    !empty(
                        $_FILES['document_file']['name']
                    ) &&
                    is_array(
                        $_FILES['document_file']['name']
                    )
                ) {

                    $upload_path =
                        './uploads/insurance/policies/'
                        . $renewal->new_policy_id
                        . '/';

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
                        $i < count(
                            $files['name']
                        );
                        $i++
                    ) {

                        if (
                            empty(
                                $files['name'][$i]
                            )
                        ) {
                            continue;
                        }

                        $_FILES['single_file'] = array(

                            'name' =>
                                $files['name'][$i],

                            'type' =>
                                $files['type'][$i],

                            'tmp_name' =>
                                $files['tmp_name'][$i],

                            'error' =>
                                $files['error'][$i],

                            'size' =>
                                $files['size'][$i]
                        );

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
                                ->do_upload(
                                    'single_file'
                                )
                        ) {

                            $upload_data =
                                $this->upload->data();

                            $document_data = array(

                                'policy_id' =>
                                    $renewal->new_policy_id,

                                'document_type' =>
                                    !empty(
                                        $document_types[$i]
                                    )
                                        ? $document_types[$i]
                                        : NULL,

                                'document_name' =>
                                    !empty(
                                        $document_names[$i]
                                    )
                                        ? $document_names[$i]
                                        : $upload_data[
                                            'orig_name'
                                        ],

                                'file_name' =>
                                    $upload_data[
                                        'file_name'
                                    ],

                                'file_path' =>
                                    'uploads/insurance/policies/'
                                    . $renewal->new_policy_id
                                    . '/'
                                    . $upload_data[
                                        'file_name'
                                    ]
                            );

                            $this->Insurance_renewal_model
                                ->insert_policy_document(
                                    $document_data
                                );

                        } else {

                            log_message(
                                'error',
                                'Insurance renewal document upload failed: '
                                . $this->upload->display_errors()
                            );
                        }
                    }
                }

                $this->session->set_flashdata(
                    'success',
                    'Insurance Renewal updated!'
                );

                redirect(
                    'insurancerenewal/renewals'
                );

                return;
            }
        }

        $data['renewal'] =
            $this->Insurance_renewal_model
                ->get_renewal_by_id($id);

        if (empty($data['renewal'])) {

            $this->session->set_flashdata(
                'error',
                'Insurance Renewal not found.'
            );

            redirect(
                'insurancerenewal/renewals'
            );

            return;
        }

        $data['policy'] =
            $this->Insurance_renewal_model
                ->get_policy_by_id(
                    $data['renewal']->new_policy_id
                );

        $data['coverages'] =
            $this->Insurance_renewal_model
                ->get_policy_coverages_for_renewal(
                    $data['renewal']->new_policy_id
                );

        $data['coverage_types'] =
            $this->Insurance_renewal_model
                ->get_coverage_types();

        $data['insurance_companies'] =
            $this->Insurance_renewal_model
                ->get_insurance_companies();

        $data['policy_types'] =
            $this->Insurance_renewal_model
                ->get_policy_types();

        $data['policy_terms'] =
            $this->Insurance_renewal_model
                ->get_policy_terms();

        $data['renewal_documents'] =
            $this->Insurance_renewal_model
                ->get_renewal_documents(
                    $id
                );

        $data['title'] =
            'Edit Insurance Renewal';

        $data['main_content'] =
            'insurance/edit_insurance_renewal';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function delete_document($document_id)
    {
        if (empty($document_id)) {

            $this->session->set_flashdata(
                'error',
                'Invalid document ID.'
            );

            redirect('insurancerenewal/renewals');
            return;
        }

        $document = $this->Insurance_renewal_model
            ->get_document_by_id($document_id);

        if (!$document) {

            $this->session->set_flashdata(
                'error',
                'Document not found.'
            );

            redirect('insurancerenewal/renewals');
            return;
        }

        $renewal_id = $document->renewal_id;

        if (!empty($document->file_path)) {

            $relative_path = ltrim(
                $document->file_path,
                '/\\'
            );

            $file_path = FCPATH . $relative_path;

            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        $deleted = $this->Insurance_renewal_model
            ->delete_document($document_id);

        if ($deleted) {

            $this->session->set_flashdata(
                'success',
                'Renewal document deleted successfully.'
            );

        } else {

            $this->session->set_flashdata(
                'error',
                'Unable to delete renewal document.'
            );
        }

        if (!empty($renewal_id)) {

            redirect(
                'insurancerenewal/edit_renewal/' . $renewal_id
            );

        } else {

            redirect(
                'insurancerenewal/renewals'
            );
        }
    }

    public function delete_renewal($renewal_id)
    {

        $documents = $this->Insurance_renewal_model
            ->get_renewal_documents($renewal_id);

        if (!empty($documents)) {

            foreach ($documents as $document) {

                if (!empty($document->file_path)) {

                    $file_path = FCPATH . $document->file_path;

                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
            }
        }

        $deleted = $this->Insurance_renewal_model
            ->delete_renewal($renewal_id);

        if ($deleted) {

            $this->session->set_flashdata(
                'success',
                'Insurance Renewal deleted!'
            );

        } else {

            $this->session->set_flashdata(
                'error',
                'Unable to delete Insurance Renewal.'
            );
        }

        redirect('insurancerenewal/renewals');
    }


}