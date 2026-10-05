<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InsurancePayment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Insurance_payment_model');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function payments()
    {
        $data['title'] = 'Insurance Payments';

        $data['payments'] =
            $this->Insurance_payment_model->get_payments();

        $data['main_content'] =
            'insurance/list_insurance_payment';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function add_payment()
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'policy_id',
                'Insurance Policy',
                'required|trim|integer'
            );

            $this->form_validation->set_rules(
                'payment_status',
                'Payment Status',
                'required|trim'
            );

            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'policy_id'          => $this->input->post('policy_id', TRUE),
                    'installment_number' => $this->input->post('installment_number', TRUE),
                    'total_premium'       => $this->input->post('total_premium', TRUE),
                    'amount_paid'       => $this->input->post('amount_paid', TRUE),
                    'balance_amount'       => $this->input->post('balance_amount', TRUE),
                    'payment_date'       => $this->input->post('payment_date', TRUE),
                    'due_date'       => $this->input->post('due_date', TRUE),
                    'payment_status'     => $this->input->post('payment_status', TRUE),
                    'payment_method'     => $this->input->post('payment_method', TRUE),
                    'payment_reference'  => $this->input->post('payment_reference', TRUE),
                    'remarks'            => $this->input->post('remarks', TRUE)
                );

                if (!empty($_FILES['payment_receipt']['name'])) {

                    $upload_path = FCPATH . 'uploads/insurance_payments/';

                    if (!is_dir($upload_path)) {
                        mkdir($upload_path, 0777, TRUE);
                    }

                    $config['upload_path']   = $upload_path;
                    $config['allowed_types'] = 'pdf|jpg|jpeg|png|doc|docx';
                    $config['max_size']      = 5120;
                    $config['encrypt_name']  = TRUE;

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('payment_receipt')) {

                        $upload_data = $this->upload->data();

                        $data['payment_receipt'] =
                            $upload_data['file_name'];

                    } else {

                        $this->session->set_flashdata(
                            'error',
                            $this->upload->display_errors('', '')
                        );

                        redirect('insurancepayment/add_payment');
                        return;
                    }
                }

                $this->Insurance_payment_model
                    ->insert_payment($data);

                $this->session->set_flashdata(
                    'success',
                    'Insurance Payment added successfully.'
                );

                redirect('insurancepayment/payments');
            }
        }

        $data['title'] = 'Add Insurance Payment';

        $data['policies'] =
            $this->Insurance_payment_model->get_policies();

        $data['main_content'] =
            'insurance/add_insurance_payment';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function view_payment($id)
    {
        $payment = $this->Insurance_payment_model
            ->get_payment($id);

        if (empty($payment)) {

            $this->session->set_flashdata(
                'error',
                'Insurance payment not found.'
            );

            redirect('insurancepayment/payments');
            return;
        }

        $data['title'] = 'View Insurance Payment';

        $data['payment'] = $payment;

        $data['main_content'] =
            'insurance/view_insurance_payment';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function edit_payment($id)
    {
        $data['payment'] =
            $this->Insurance_payment_model->get_payment($id);

        if (empty($data['payment'])) {

            $this->session->set_flashdata(
                'error',
                'Insurance Payment not found.'
            );

            redirect('insurancepayment/payments');
        }

        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'payment_status',
                'Payment Status',
                'required'
            );

            $payment_status = $this->input->post(
                'payment_status',
                TRUE
            );

            if (
                in_array(
                    $payment_status,
                    array('Paid', 'Partially Paid')
                )
            ) {
                $this->form_validation->set_rules(
                    'payment_date',
                    'Payment Date',
                    'required'
                );
            }

            if ($this->form_validation->run() == TRUE) {

                $payment_date = $this->input->post(
                    'payment_date',
                    TRUE
                );

                if (empty($payment_date)) {
                    $payment_date = NULL;
                }

                $update = array(

                    'balance_amount'       =>$this->input->post(
                        'balance_amount',
                        TRUE
                    ),
                    'amount_paid'       =>$this->input->post(
                        'amount_paid',
                        TRUE
                    ),
                    'payment_date'       => $payment_date,
                    'due_date'     => $this->input->post(
                        'due_date',
                        TRUE
                    ),
                    'payment_status'     => $payment_status,
                    'payment_method'     => $this->input->post(
                        'payment_method',
                        TRUE
                    ),
                    'payment_reference'  => $this->input->post(
                        'payment_reference',
                        TRUE
                    ),
                    'remarks'            => $this->input->post(
                        'remarks',
                        TRUE
                    )
                );

                if (!empty($_FILES['payment_receipt']['name'])) {

                    $upload_path =
                        FCPATH . 'uploads/insurance_payments/';

                    if (!is_dir($upload_path)) {
                        mkdir($upload_path, 0777, TRUE);
                    }

                    $config = array(
                        'upload_path'   => $upload_path,
                        'allowed_types' => 'pdf|jpg|jpeg|png|doc|docx',
                        'max_size'      => 5120,
                        'encrypt_name'  => TRUE
                    );

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('payment_receipt')) {

                        $upload_data =
                            $this->upload->data();

                        $update['payment_receipt'] =
                            $upload_data['file_name'];

                    } else {

                        $this->session->set_flashdata(
                            'error',
                            $this->upload->display_errors('', '')
                        );

                        redirect(
                            'insurancepayment/edit_payment/' . $id
                        );

                        return;
                    }
                }

                $updated =
                    $this->Insurance_payment_model
                        ->update_payment($id, $update);

                if ($updated) {

                    if (
                        isset($update['payment_receipt']) &&
                        !empty($data['payment']->payment_receipt)
                    ) {

                        $old_file =
                            FCPATH .
                            'uploads/insurance_payments/' .
                            $data['payment']->payment_receipt;

                        if (
                            file_exists($old_file)
                        ) {
                            unlink($old_file);
                        }
                    }

                    $this->session->set_flashdata(
                        'success',
                        'Insurance Payment updated successfully.'
                    );

                    redirect(
                        'insurancepayment/payments'
                    );
                } else {

                    $this->session->set_flashdata(
                        'error',
                        'Failed to update Insurance Payment.'
                    );

                    redirect(
                        'insurancepayment/edit_payment/' . $id
                    );
                }
            }
        }

        $data['policies'] =
            $this->Insurance_payment_model->get_policies();

        $data['title'] = 'Edit Insurance Payment';

        $data['main_content'] =
            'insurance/edit_insurance_payment';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function delete_payment($id)
    {
        $payment = $this->Insurance_payment_model
            ->get_payment($id);

        if (empty($payment)) {

            $this->session->set_flashdata(
                'error',
                'Insurance Payment not found.'
            );

            redirect('insurancepayment/payments');
            return;
        }

        $deleted = $this->Insurance_payment_model
            ->delete_payment($id);

        if ($deleted) {

            if (!empty($payment->payment_receipt)) {

                $receipt_file =
                    FCPATH .
                    'uploads/insurance_payments/' .
                    $payment->payment_receipt;

                if (file_exists($receipt_file)) {
                    unlink($receipt_file);
                }
            }

            $this->session->set_flashdata(
                'success',
                'Insurance Payment deleted successfully.'
            );

        } else {

            $this->session->set_flashdata(
                'error',
                'Failed to delete Insurance Payment.'
            );
        }

        redirect('insurancepayment/payments');
    }

    public function get_policy_details()
    {
        $policy_id = $this->input->post('policy_id');

        if (empty($policy_id)) {

            echo json_encode(array(
                'status' => false,
                'message' => 'Policy ID is required.'
            ));

            return;
        }

        $this->db->select('
            p.policy_id,
            p.total_premium,
            pt.policy_term_name
        ');

        $this->db->from('insurance_policies p');

        $this->db->join(
            'insurance_policy_terms pt',
            'pt.policy_term_id = p.policy_term_id',
            'left'
        );

        $this->db->where(
            'p.policy_id',
            $policy_id
        );

        $policy = $this->db->get()->row();

        if (!$policy) {

            echo json_encode(array(
                'status' => false,
                'message' => 'Policy not found.'
            ));

            return;
        }

        $this->db->select('installment_number');

        $this->db->from('insurance_payment_records');

        $this->db->where(
            'policy_id',
            $policy_id
        );

        $this->db->order_by(
            'installment_number',
            'DESC'
        );

        $this->db->limit(1);

        $payment = $this->db->get()->row();

        $installment_number = 1;

        if ($payment) {

            $installment_number =
                ((int) $payment->installment_number) + 1;
        }

        echo json_encode(array(
            'status' => true,

            'policy_term_name' =>
                $policy->policy_term_name ?? '',

            'total_premium' =>
                $policy->total_premium ?? 0,

            'installment_number' =>
                $installment_number
        ));
    }

}