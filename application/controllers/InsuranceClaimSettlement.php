<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InsuranceClaimSettlement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(
            'Insurance_claim_settlement_model'
        );

        $this->load->library(
            'form_validation'
        );

        $this->load->helper(
            array('url', 'form')
        );
    }

    public function settlements()
    {
        $data['title'] = 'Claim Settlements';

        $data['settlements'] =
            $this->Insurance_claim_settlement_model
                 ->get_settlements();

        $data['main_content'] =
            'insurance/list_claim_settlement';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function add_settlement()
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'claim_id',
                'Claim',
                'required'
            );

            $this->form_validation->set_rules(
                'settlement_date',
                'Settlement Date',
                'required'
            );

            $this->form_validation->set_rules(
                'settlement_amount',
                'Settlement Amount',
                'required|numeric'
            );

            $this->form_validation->set_rules(
                'settlement_status',
                'Settlement Status',
                'required'
            );

            if ($this->form_validation->run() == TRUE) {

                $data = array(

                    'claim_id' =>
                        $this->input->post('claim_id'),

                    'settlement_reference' =>
                        trim(
                            $this->input->post(
                                'settlement_reference'
                            )
                        ),

                    'claim_amount' =>
                        !empty(
                            $this->input->post('claim_amount')
                        )
                            ? $this->input->post('claim_amount')
                            : 0,

                    'approved_amount' =>
                        !empty(
                            $this->input->post('approved_amount')
                        )
                            ? $this->input->post('approved_amount')
                            : 0,

                    'deducted_amount' =>
                        !empty(
                            $this->input->post('deducted_amount')
                        )
                            ? $this->input->post('deducted_amount')
                            : 0,

                    'settlement_amount' =>
                        !empty(
                            $this->input->post('settlement_amount')
                        )
                            ? $this->input->post('settlement_amount')
                            : 0,

                    'settlement_date' =>
                        $this->input->post(
                            'settlement_date'
                        ),

                    'settlement_method' =>
                        $this->input->post(
                            'settlement_method'
                        ),

                    'payment_reference' =>
                        $this->input->post(
                            'payment_reference'
                        ),

                    'settlement_status' =>
                        $this->input->post(
                            'settlement_status'
                        ),

                    'settlement_details' =>
                        $this->input->post(
                            'settlement_details'
                        ),

                    'remarks' =>
                        $this->input->post(
                            'remarks'
                        ),

                );

                $settlement_id =
                    $this->Insurance_claim_settlement_model
                        ->insert_settlement($data);


                if ($settlement_id) {

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
                            $_FILES['document_file']['name'][0]
                        )
                    ) {

                        $upload_path =
                            './uploads/insurance/claim_settlements/'
                            . $settlement_id
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
                            $i < count($files['name']);
                            $i++
                        ) {

                            if (
                                empty(
                                    $files['name'][$i]
                                )
                            ) {
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

                                    'settlement_id' =>
                                        $settlement_id,

                                    'document_type' =>
                                        !empty(
                                            $document_types[$i]
                                        )
                                            ? $document_types[$i]
                                            : 'Other',

                                    'document_name' =>
                                        !empty(
                                            $document_names[$i]
                                        )
                                            ? $document_names[$i]
                                            : $upload_data['orig_name'],

                                    'document_file' =>
                                        'uploads/insurance/claim_settlements/'
                                        . $settlement_id
                                        . '/'
                                        . $upload_data['file_name']

                                );

                                $this->Insurance_claim_settlement_model
                                    ->insert_settlement_document(
                                        $document_data
                                    );
                            }
                        }
                    }

                    if (
                        $this->input->post(
                            'settlement_status'
                        ) == 'Settled'
                    ) {

                        $this->Insurance_claim_settlement_model
                            ->update_claim_status(
                                $this->input->post('claim_id'),
                                'Settled'
                            );
                    }

                    $this->session->set_flashdata(
                        'success',
                        'Claim Settlement added successfully.'
                    );

                    redirect(
                        'insuranceclaimsettlement/settlements'
                    );
                }
            }
        }

        $data['claims'] =
            $this->Insurance_claim_settlement_model
                ->get_claims_for_settlement();

        $data['title'] =
            'Add Claim Settlement';

        $data['main_content'] =
            'insurance/add_claim_settlement';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function get_claim_for_settlement()
    {
        $claim_id = $this->input->post('claim_id');

        if (empty($claim_id)) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Claim ID is required.'
            ));
            return;
        }

        $claim = $this->Insurance_claim_settlement_model
            ->get_claim_for_settlement($claim_id);

        if (!$claim) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Claim not found.'
            ));
            return;
        }

        $approved_amount = !empty($claim->approved_amount)
            ? (float) $claim->approved_amount
            : 0;

        $deducted_amount = !empty($claim->deducted_amount)
            ? (float) $claim->deducted_amount
            : 0;

        echo json_encode(array(

            'status' => true,

            'claim_number' =>
                $claim->claim_number,

            'policy_number' =>
                $claim->policy_number,

            'company_name' =>
                $claim->company_name,

            'policy_type_name' =>
                $claim->policy_type_name,

            'customer_name' =>
                !empty($claim->customer_name)
                    ? $claim->customer_name
                    : '',

            'customer_id' =>
                !empty($claim->customer_id)
                    ? $claim->customer_id
                    : '',

            'vehicle_brand' =>
                !empty($claim->vehicle_brand)
                    ? $claim->vehicle_brand
                    : '',

            'vehicle_registration_no' =>
                !empty($claim->vehicle_registration_no)
                    ? $claim->vehicle_registration_no
                    : '',

            'claim_date' =>
                $claim->claim_date,

            'claim_status' =>
                $claim->claim_status,

            'claim_amount' =>
                (float) $claim->claim_amount,

            'approved_amount' =>
                $approved_amount,

            'deducted_amount' =>
                $deducted_amount,

            'settlement_amount' =>
                $approved_amount
        ));
    }

    public function view_settlement($settlement_id)
    {
        if (empty($settlement_id)) {

            $this->session->set_flashdata(
                'error',
                'Invalid settlement ID.'
            );

            redirect(
                'insuranceclaimsettlement/settlements'
            );

            return;
        }

        $settlement =
            $this->Insurance_claim_settlement_model
                ->get_settlement($settlement_id);

        if (!$settlement) {

            $this->session->set_flashdata(
                'error',
                'Claim Settlement not found.'
            );

            redirect(
                'insuranceclaimsettlement/settlements'
            );

            return;
        }

        $data['settlement'] = $settlement;

        $data['settlement_documents'] =
            $this->Insurance_claim_settlement_model
                ->get_settlement_documents(
                    $settlement_id
                );

        $data['title'] =
            'View Claim Settlement';

        $data['main_content'] =
            'insurance/view_claim_settlement';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function edit_settlement($id)
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'settlement_date',
                'Settlement Date',
                'required'
            );

            $this->form_validation->set_rules(
                'settlement_amount',
                'Settlement Amount',
                'required|numeric'
            );

            $this->form_validation->set_rules(
                'settlement_status',
                'Settlement Status',
                'required'
            );

            if ($this->form_validation->run() == TRUE) {

                $claim_id =
                    $this->input->post('claim_id');

                $claim = $this->db
                    ->select('claim_amount')
                    ->from('insurance_claims')
                    ->where('claim_id', $claim_id)
                    ->get()
                    ->row();

                $claim_amount = !empty($claim->claim_amount)
                    ? $claim->claim_amount
                    : 0;

                $approved_amount =
                    !empty($this->input->post('approved_amount'))
                    ? $this->input->post('approved_amount')
                    : 0;

                $deducted_amount =
                    !empty($this->input->post('deducted_amount'))
                    ? $this->input->post('deducted_amount')
                    : 0;

                $settlement_amount =
                    !empty($this->input->post('settlement_amount'))
                    ? $this->input->post('settlement_amount')
                    : 0;

                $update = array(

                    'claim_id' =>
                        $claim_id,

                    'settlement_reference' =>
                        trim(
                            $this->input->post(
                                'settlement_reference'
                            )
                        ),

                    'claim_amount' =>
                        $claim_amount,

                    'approved_amount' =>
                        $approved_amount,

                    'deducted_amount' =>
                        $deducted_amount,

                    'settlement_amount' =>
                        $settlement_amount,

                    'settlement_date' =>
                        $this->input->post(
                            'settlement_date'
                        ),

                    'settlement_method' =>
                        $this->input->post(
                            'settlement_method'
                        ),

                    'payment_reference' =>
                        $this->input->post(
                            'payment_reference'
                        ),

                    'settlement_status' =>
                        $this->input->post(
                            'settlement_status'
                        ),

                    'settlement_details' =>
                        $this->input->post(
                            'settlement_details'
                        ),

                    'remarks' =>
                        $this->input->post(
                            'remarks'
                        )
                );

                $updated =
                    $this->Insurance_claim_settlement_model
                        ->update_settlement(
                            $id,
                            $update
                        );

                if ($updated) {

                    $document_types =
                        $this->input->post(
                            'document_type'
                        );

                    $document_names =
                        $this->input->post(
                            'document_name'
                        );

                    if (
                        isset($_FILES['document_file']) &&
                        !empty(
                            $_FILES['document_file']['name'][0]
                        )
                    ) {

                        $upload_path =
                            './uploads/insurance/claim_settlements/'
                            . $id
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
                            $i < count($files['name']);
                            $i++
                        ) {

                            if (
                                empty(
                                    $files['name'][$i]
                                )
                            ) {
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
                                10240; // 10 MB

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

                                    'settlement_id' =>
                                        $id,

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
                                        : $upload_data['orig_name'],

                                    'document_file' =>
                                        'uploads/insurance/claim_settlements/'
                                        . $id
                                        . '/'
                                        . $upload_data['file_name']
                                );

                                $this->Insurance_claim_settlement_model
                                    ->insert_settlement_document(
                                        $document_data
                                    );

                            } else {

                                log_message(
                                    'error',
                                    'Insurance settlement document upload failed: '
                                    . $this->upload->display_errors()
                                );
                            }
                        }
                    }

                    if (
                        $this->input->post(
                            'settlement_status'
                        ) == 'Settled'
                    ) {

                        $this->Insurance_claim_settlement_model
                            ->update_claim_status(
                                $claim_id,
                                'Settled'
                            );
                    }

                    $this->session->set_flashdata(
                        'success',
                        'Claim Settlement updated successfully.'
                    );

                    redirect(
                        'insuranceclaimsettlement/settlements'
                    );

                    return;
                }
            }
        }

        $data['settlement'] =
            $this->Insurance_claim_settlement_model
                ->get_settlement($id);

        if (empty($data['settlement'])) {

            $this->session->set_flashdata(
                'error',
                'Claim Settlement not found.'
            );

            redirect(
                'insuranceclaimsettlement/settlements'
            );

            return;
        }

        $data['settlement_documents'] =
            $this->Insurance_claim_settlement_model
                ->get_settlement_documents($id);

        $data['claims'] =
            $this->Insurance_claim_settlement_model
                ->get_claims_for_settlement();

        $data['title'] =
            'Edit Claim Settlement';

        $data['main_content'] =
            'insurance/edit_claim_settlement';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function delete_settlement_document($document_id, $settlement_id)
    {
        if (empty($document_id) || empty($settlement_id)) {

            $this->session->set_flashdata(
                'error',
                'Invalid document or settlement ID.'
            );

            redirect(
                'insuranceclaimsettlement/edit_settlement/'
                . $settlement_id
            );

            return;
        }

        $document =
            $this->Insurance_claim_settlement_model
                ->get_settlement_document_by_id(
                    $document_id
                );

        if (!$document) {

            $this->session->set_flashdata(
                'error',
                'Settlement document not found.'
            );

            redirect(
                'insuranceclaimsettlement/edit_settlement/'
                . $settlement_id
            );

            return;
        }

        if (!empty($document->document_file)) {

            $file_path =
                FCPATH . $document->document_file;

            if (file_exists($file_path)) {

                unlink($file_path);
            }
        }

        $deleted =
            $this->Insurance_claim_settlement_model
                ->delete_settlement_document(
                    $document_id
                );

        if ($deleted) {

            $this->session->set_flashdata(
                'success',
                'Settlement document deleted successfully.'
            );

        } else {

            $this->session->set_flashdata(
                'error',
                'Unable to delete settlement document.'
            );
        }

        redirect(
            'insuranceclaimsettlement/edit_settlement/'
            . $settlement_id
        );
    }

    public function delete_settlement($id)
    {
        if (empty($id)) {

            $this->session->set_flashdata(
                'error',
                'Invalid settlement ID.'
            );

            redirect(
                'insuranceclaimsettlement/settlements'
            );

            return;
        }

        $settlement =
            $this->Insurance_claim_settlement_model
                ->get_settlement($id);

        if (empty($settlement)) {

            $this->session->set_flashdata(
                'error',
                'Claim Settlement not found.'
            );

            redirect(
                'insuranceclaimsettlement/settlements'
            );

            return;
        }

        $documents =
            $this->Insurance_claim_settlement_model
                ->get_settlement_documents($id);

        if (!empty($documents)) {

            foreach ($documents as $document) {

                if (!empty($document->document_file)) {

                    $file_path =
                        FCPATH . $document->document_file;

                    if (file_exists($file_path)) {

                        unlink($file_path);
                    }
                }
            }
        }

        $deleted =
            $this->Insurance_claim_settlement_model
                ->delete_settlement($id);

        if ($deleted) {

            $upload_path =
                FCPATH
                . 'uploads/insurance/claim_settlements/'
                . $id
                . '/';

            if (is_dir($upload_path)) {

                @rmdir($upload_path);
            }

            $this->session->set_flashdata(
                'success',
                'Claim Settlement deleted successfully.'
            );

        } else {

            $this->session->set_flashdata(
                'error',
                'Unable to delete Claim Settlement.'
            );
        }

        redirect(
            'insuranceclaimsettlement/settlements'
        );
    }

}