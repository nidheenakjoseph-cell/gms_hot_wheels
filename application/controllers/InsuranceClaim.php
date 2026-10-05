<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class InsuranceClaim extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Insurance_claim_model');
        $this->load->model('Insurance_policy_model');
        $this->load->library('form_validation');
    }

    public function claims()
    {
        $data['title'] = 'Insurance Claims';

        $data['claims'] =
            $this->Insurance_claim_model->get_all_claims();

        $data['main_content'] = 'insurance/list_insurance_claim';
		$this->load->view('includes/template', $data);
    }

    public function add_claim()
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'policy_id',
                'Policy',
                'required'
            );

            $this->form_validation->set_rules(
                'claim_date',
                'Claim Date',
                'required'
            );

            $this->form_validation->set_rules(
                'claim_type',
                'Claim Type',
                'required'
            );

            $this->form_validation->set_rules(
                'claim_status',
                'Claim Status',
                'required'
            );

            if ($this->form_validation->run() == TRUE) {

                $data = array(

                    'claim_number' =>
                        trim($this->input->post('claim_number')),

                    'policy_id' =>
                        $this->input->post('policy_id'),

                    'claim_date' =>
                        $this->input->post('claim_date'),

                    'incident_date' =>
                        !empty($this->input->post('incident_date'))
                            ? $this->input->post('incident_date')
                            : NULL,

                    'claim_type' =>
                        $this->input->post('claim_type'),

                    'claim_reason' =>
                        $this->input->post('claim_reason'),

                    'incident_description' =>
                        $this->input->post('incident_description'),

                    'claim_amount' =>
                        !empty($this->input->post('claim_amount'))
                            ? $this->input->post('claim_amount')
                            : 0,

                    'approved_amount' =>
                        !empty($this->input->post('approved_amount'))
                            ? $this->input->post('approved_amount')
                            : 0,

                    'deducted_amount' =>
                        !empty($this->input->post('deducted_amount'))
                            ? $this->input->post('deducted_amount')
                            : 0,

                    'claim_status' =>
                        $this->input->post('claim_status'),

                    'action_taken' =>
                        $this->input->post('action_taken'),

                    'rejection_reason' =>
                        $this->input->post('rejection_reason'),

                    'remarks' =>
                        $this->input->post('remarks')

                );

                $claim_id =
                    $this->Insurance_claim_model
                        ->insert_claim($data);

                if ($claim_id) {

                    $document_types =
                        $this->input->post('document_type');

                    $document_names =
                        $this->input->post('document_name');


                    if (!empty($_FILES['document_file']['name'][0])) {

                        $upload_path =
                            './uploads/insurance/claims/'
                            . $claim_id
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

                            $this->upload->initialize($config);

                            if (
                                $this->upload
                                    ->do_upload('single_file')
                            ) {

                                $upload_data =
                                    $this->upload->data();


                                $document_data = array(
                                    'claim_id' => $claim_id,
                                    'document_type' => !empty($document_types[$i])
                                        ? $document_types[$i]
                                        : 'Other',
                                    'document_name' => !empty($document_names[$i])
                                        ? $document_names[$i]
                                        : $upload_data['orig_name'],
                                    'document_path' => 'uploads/insurance/claims/'
                                        . $claim_id
                                        . '/'
                                        . $upload_data['file_name']
                                );

                                $this->Insurance_claim_model->insert_claim_document($document_data);

                            }
                        }
                    }

                    $this->session->set_flashdata(
                        'success',
                        'Insurance Claim added!'
                    );

                    redirect('insuranceclaim/claims');
                }
            }
        }

        $data['policies'] =
            $this->Insurance_policy_model
                ->get_policies();

        $data['claim_number'] =
            $this->Insurance_claim_model
                ->generate_claim_number();

        $data['title'] =
            'Add Insurance Claim';

        $data['main_content'] =
            'insurance/add_insurance_claim';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function get_policy_for_claim()
    {
        $policy_id = $this->input->post('policy_id');

        if (empty($policy_id)) {
            echo json_encode([]);
            return;
        }

        $policy = $this->Insurance_policy_model
                ->get_policy($policy_id);

        echo json_encode($policy);
    }

    private function upload_claim_documents($claim_id)
    {
        $files = $_FILES['document_file'];

        $document_types =
            $this->input->post('document_type');

        $document_names =
            $this->input->post('document_name');

        $upload_path =
            FCPATH . 'uploads/insurance_claims/';

        if (!is_dir($upload_path)) {

            mkdir(
                $upload_path,
                0777,
                true
            );
        }

        for ($i = 0; $i < count($files['name']); $i++) {

            if (empty($files['name'][$i])) {
                continue;
            }

            $_FILES['claim_file']['name'] =
                $files['name'][$i];

            $_FILES['claim_file']['type'] =
                $files['type'][$i];

            $_FILES['claim_file']['tmp_name'] =
                $files['tmp_name'][$i];

            $_FILES['claim_file']['error'] =
                $files['error'][$i];

            $_FILES['claim_file']['size'] =
                $files['size'][$i];

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

            if ($this->upload->do_upload('claim_file')) {

                $upload_data =
                    $this->upload->data();

                $document_data = array(

                    'claim_id' =>
                        $claim_id,

                    'document_name' =>
                        !empty($document_names[$i])
                            ? $document_names[$i]
                            : $upload_data['client_name'],

                    'document_type' =>
                        !empty($document_types[$i])
                            ? $document_types[$i]
                            : 'Other',

                    'file_path' =>
                        'uploads/insurance_claims/'
                        . $upload_data['file_name']
                );

                $this->Insurance_claim_model
                     ->insert_claim_document(
                         $document_data
                     );
            }
        }
    }

    public function view_claim($claim_id)
    {
        if (empty($claim_id)) {

            $this->session->set_flashdata(
                'error',
                'Insurance Claim not found.'
            );

            redirect('insuranceclaim/claims');
        }

        $claim = $this->Insurance_claim_model->get_claim_by_id($claim_id);

        if (empty($claim)) {

            $this->session->set_flashdata(
                'error',
                'Insurance Claim not found.'
            );

            redirect('insuranceclaim/claims');
        }

        $data['title'] = 'Claim Details';
        $data['claim'] = $claim;

        $data['claim_documents'] =
            $this->Insurance_claim_model->get_claim_documents($claim_id);

        $data['main_content'] = 'insurance/view_insurance_claim';
        $this->load->view('includes/template', $data);
    }

    public function edit_claim($id)
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'policy_id',
                'Policy',
                'required'
            );

            $this->form_validation->set_rules(
                'claim_date',
                'Claim Date',
                'required'
            );

            $this->form_validation->set_rules(
                'claim_type',
                'Claim Type',
                'required'
            );

            $this->form_validation->set_rules(
                'claim_status',
                'Claim Status',
                'required'
            );

            if ($this->form_validation->run() == TRUE) {

                $policy_id = $this->input->post('policy_id');

                $incident_date =
                    $this->input->post('incident_date');

                $settlement_date =
                    $this->input->post('settlement_date');

                $update = array(

                    'policy_id' =>
                        $policy_id,

                    'claim_date' =>
                        $this->input->post('claim_date'),

                    'incident_date' =>
                        !empty($incident_date)
                        ? $incident_date
                        : NULL,

                    'claim_type' =>
                        $this->input->post('claim_type'),

                    'claim_reason' =>
                        $this->input->post('claim_reason'),

                    'incident_description' =>
                        $this->input->post('incident_description'),

                    'claim_amount' =>
                        !empty($this->input->post('claim_amount'))
                        ? $this->input->post('claim_amount')
                        : 0,

                    'claim_status' =>
                        $this->input->post('claim_status'),

                    'approved_amount' =>
                        !empty($this->input->post('approved_amount'))
                        ? $this->input->post('approved_amount')
                        : 0,

                    'deducted_amount' =>
                        !empty($this->input->post('deducted_amount'))
                        ? $this->input->post('deducted_amount')
                        : 0,

                    'action_taken' =>
                        $this->input->post('action_taken'),

                    'rejection_reason' =>
                        $this->input->post('rejection_reason'),

                    'remarks' =>
                        $this->input->post('remarks')
                );

                $updated =
                    $this->Insurance_claim_model
                        ->update_claim($id, $update);

                if ($updated) {

                    $document_types =
                        $this->input->post('document_type');

                    $document_names =
                        $this->input->post('document_name');

                    if (
                        isset($_FILES['document_file']) &&
                        !empty($_FILES['document_file']['name'][0])
                    ) {

                        $upload_path =
                            './uploads/insurance/claims/'
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
                                    ->do_upload('single_file')
                            ) {

                                $upload_data =
                                    $this->upload->data();

                                $document_data = array(

                                    'claim_id' =>
                                        $id,

                                    'document_type' =>
                                        !empty($document_types[$i])
                                        ? $document_types[$i]
                                        : NULL,

                                    'document_name' =>
                                        !empty($document_names[$i])
                                        ? $document_names[$i]
                                        : $upload_data['orig_name'],

                                    'document_path' =>
                                        'uploads/insurance/claims/'
                                        . $id
                                        . '/'
                                        . $upload_data['file_name']
                                );

                                $this->Insurance_claim_model
                                    ->insert_claim_document(
                                        $document_data
                                    );

                            } else {

                                log_message(
                                    'error',
                                    'Insurance claim document upload failed: '
                                    . $this->upload->display_errors()
                                );
                            }
                        }
                    }

                    $this->session->set_flashdata(
                        'success',
                        'Insurance Claim updated successfully.'
                    );

                    redirect(
                        'insuranceclaim/claims'
                    );
                }
            }
        }

        $data['claim'] =
            $this->Insurance_claim_model
                ->get_claim_by_id($id);

        if (empty($data['claim'])) {

            $this->session->set_flashdata(
                'error',
                'Insurance Claim not found.'
            );

            redirect(
                'insuranceclaim/claims'
            );
        }

        $data['claim_documents'] =
            $this->Insurance_claim_model
                ->get_claim_documents($id);

        $data['policies'] =
            $this->Insurance_policy_model
                ->get_policies();

        $data['title'] =
            'Edit Insurance Claim';

        $data['main_content'] =
            'insurance/edit_insurance_claim';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function send_email($claim_id)
    {
        $claim = $this->Insurance_claim_model->get_claim_by_id($claim_id);
        if (!$claim) {
            return $this->email_response(false, 'Insurance claim not found.');
        }

        $recipient = trim($this->input->post('email')) ?: ($claim->customer_email ?? '');
        if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            return $this->email_response(false, 'Please enter a valid email address.');
        }

        $documents = $this->Insurance_claim_model->get_claim_documents($claim_id);
        $pdf_data = [
            'claim' => $claim,
            'claim_documents' => $documents,
        ];

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($this->load->view('insurance/claim_email_pdf', $pdf_data, true));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $cache_dir = FCPATH . 'application/cache/';
        if (!is_dir($cache_dir)) {
            mkdir($cache_dir, 0755, true);
        }
        $pdf_path = $cache_dir . 'insurance_claim_' . $claim_id . '_' . uniqid() . '.pdf';
        file_put_contents($pdf_path, $dompdf->output());

        $attachments = [$pdf_path];
        foreach ($documents as $document) {
            $document_path = FCPATH . ltrim((string) ($document->document_path ?? $document->file_path ?? ''), '/\\');
            if (is_file($document_path)) {
                $attachments[] = $document_path;
            }
        }

        $this->load->library('gms_mailer');
        $company_id = get_current_company_id();
        $company_name = $this->gms_mailer->get_company_name($company_id);
        $result = $this->gms_mailer->send_notification($recipient, 'insurance_claim_sent', [
            '{customer_name}' => $claim->customer_name ?? '',
            '{policy_no}' => $claim->policy_number ?? '',
            '{claim_no}' => $claim->claim_number ?? '',
            '{claim_amount}' => number_format((float) ($claim->claim_amount ?? 0), 2),
            '{approved_amount}' => number_format((float) ($claim->approved_amount ?? 0), 2),
            '{date}' => date('d/m/Y', strtotime($claim->claim_date)),
            '{company_name}' => $company_name,
        ], $attachments, $company_id);

        @unlink($pdf_path);
        return $this->email_response($result['status'], $result['message']);
    }

    private function email_response($status, $message)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode([
            'status' => (bool) $status,
            'message' => $message,
        ]));
    }

    public function delete_claim_document($document_id, $claim_id)
    {
        $document = $this->Insurance_claim_model
            ->get_claim_document($document_id);

        if ($document) {

            if (!empty($document->document_path)) {

                $file_path = FCPATH . $document->document_path;

                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            $deleted = $this->Insurance_claim_model
                ->delete_claim_document($document_id);

            if (!$deleted) {
                $this->session->set_flashdata(
                    'error',
                    'Failed to delete document from database.'
                );
            }
        } else {

            $this->session->set_flashdata(
                'error',
                'Document not found.'
            );
        }

        redirect(
            'insuranceclaim/edit_claim/' . $claim_id
        );
    }

    public function delete_claim($id)
    {
        if (empty($id)) {

            $this->session->set_flashdata(
                'error',
                'Invalid Insurance Claim.'
            );

            redirect('insuranceclaim/claims');
        }

        $claim =
            $this->Insurance_claim_model
                ->get_claim_by_id($id);

        if (empty($claim)) {

            $this->session->set_flashdata(
                'error',
                'Insurance Claim not found.'
            );

            redirect('insuranceclaim/claims');
        }

        $documents =
            $this->Insurance_claim_model
                ->get_claim_documents($id);

        if (!empty($documents)) {

            foreach ($documents as $document) {

                if (!empty($document->document_path)) {

                    $file_path =
                        FCPATH . $document->document_path;

                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }

                if (!empty($document->file_path)) {

                    $file_path =
                        FCPATH . $document->file_path;

                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
            }
        }

        $this->Insurance_claim_model
            ->delete_claim_document($id);

        $deleted =
            $this->Insurance_claim_model
                ->delete_claim($id);


        if ($deleted) {

            $upload_path =
                FCPATH
                . 'uploads/insurance/claims/'
                . $id
                . '/';

            if (is_dir($upload_path)) {

                $files = glob($upload_path . '*');

                if (!empty($files)) {

                    foreach ($files as $file) {

                        if (is_file($file)) {
                            unlink($file);
                        }
                    }
                }

                rmdir($upload_path);
            }

            $this->session->set_flashdata(
                'success',
                'Insurance Claim deleted successfully.'
            );

        } else {

            $this->session->set_flashdata(
                'error',
                'Failed to delete Insurance Claim.'
            );
        }

        redirect(
            'insuranceclaim/claims'
        );
    }

}
