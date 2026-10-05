<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InsuranceReminder extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Insurance_reminder_model');
        $this->load->model('Insurance_policy_model');

        $this->load->library('form_validation');
        $this->load->helper(['url', 'form']);
    }

    public function index()
    {
        $data['title'] = 'Insurance Reminders';

        $data['reminders'] =
            $this->Insurance_reminder_model->get_all_reminders();

        $data['main_content'] = 'insurance/list_reminder';
		
		$this->load->view('includes/template', $data);
    }

    public function add()
    {
        $data['title'] = 'Add Insurance Reminder';
        $data['main_content'] = 'insurance/add_reminder';

        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'policy_id',
                'Policy',
                'required'
            );

            $this->form_validation->set_rules(
                'reminder_type',
                'Reminder Type',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'due_date',
                'Due Date',
                'required'
            );

            $this->form_validation->set_rules(
                'reminder_days_before',
                'Reminder Days Before',
                'required|integer|greater_than_equal_to[0]'
            );

            if ($this->form_validation->run() == TRUE) {

                $due_date = $this->input->post('due_date');
                $days_before = (int) $this->input->post('reminder_days_before');

                $reminder_date = date(
                    'Y-m-d',
                    strtotime($due_date . ' -' . $days_before . ' days')
                );

                $data = array(
                    'policy_id'            => $this->input->post('policy_id'),
                    'reminder_type'        => $this->input->post('reminder_type'),
                    'reminder_date'        => $reminder_date,
                    'due_date'             => $due_date,
                    'reminder_days_before' => $days_before,
                    'status'               => $this->input->post('status'),
                    'subject'              => $this->input->post('subject'),
                    'message'              => $this->input->post('message')
                );

                $this->Insurance_reminder_model->insert_reminder($data);

                $this->session->set_flashdata(
                    'success',
                    'Insurance Reminder added!'
                );

                redirect('insurancereminder/index');
            }
            else {

                $this->session->set_flashdata(
                    'validation_error',
                    validation_errors()
                );

                $this->session->set_flashdata(
                    'policy_id',
                    $this->input->post('policy_id')
                );

                $this->session->set_flashdata(
                    'reminder_type',
                    $this->input->post('reminder_type')
                );

                $this->session->set_flashdata(
                    'due_date',
                    $this->input->post('due_date')
                );

                $this->session->set_flashdata(
                    'reminder_days_before',
                    $this->input->post('reminder_days_before')
                );

                $this->session->set_flashdata(
                    'status',
                    $this->input->post('status')
                );

                $this->session->set_flashdata(
                    'subject',
                    $this->input->post('subject')
                );

                $this->session->set_flashdata(
                    'message',
                    $this->input->post('message')
                );

                redirect('insurancereminder/add');
            }
        }

        $data['policies'] =
            $this->Insurance_reminder_model->get_policies();

        $this->load->view('includes/template', $data);
    }

    public function view($reminder_id) 
    { 
        $data['title'] = 'View Insurance Reminder'; 
        
        $data['reminder'] = $this->Insurance_reminder_model ->get_reminder($reminder_id); 
        
        if (!$data['reminder']) { 
            show_404(); 
            return; 
        } 
        
        $data['main_content'] = 'insurance/view_reminder'; 
        
        $this->load->view( 'includes/template', $data ); 
    }

    public function edit($reminder_id)
    {
        $data['title'] = 'Edit Insurance Reminder';
        $data['main_content'] = 'insurance/edit_reminder';

        $data['reminder'] =
            $this->Insurance_reminder_model
                ->get_reminder($reminder_id);

        if (!$data['reminder']) {

            show_404();

            return;
        }

        if ($this->input->post()) {

            $this->form_validation->set_rules(
                'policy_id',
                'Policy',
                'required'
            );

            $this->form_validation->set_rules(
                'reminder_type',
                'Reminder Type',
                'required|trim'
            );

            $this->form_validation->set_rules(
                'due_date',
                'Due Date',
                'required'
            );

            $this->form_validation->set_rules(
                'reminder_days_before',
                'Reminder Days Before',
                'required|integer|greater_than_equal_to[0]'
            );

            if ($this->form_validation->run() == TRUE) {

                $due_date =
                    $this->input->post('due_date');

                $days_before =
                    (int) $this->input->post(
                        'reminder_days_before'
                    );

                $reminder_date = date(
                    'Y-m-d',
                    strtotime(
                        $due_date .
                        ' -' .
                        $days_before .
                        ' days'
                    )
                );

                $update_data = array(

                    'policy_id' =>
                        $this->input->post('policy_id'),

                    'reminder_type' =>
                        $this->input->post('reminder_type'),

                    'reminder_date' =>
                        $reminder_date,

                    'due_date' =>
                        $due_date,

                    'reminder_days_before' =>
                        $days_before,

                    'status' =>
                        $this->input->post('status'),

                    'subject' =>
                        $this->input->post('subject'),

                    'message' =>
                        $this->input->post('message')

                );

                $this->Insurance_reminder_model
                    ->update_reminder(
                        $reminder_id,
                        $update_data
                    );

                $this->session->set_flashdata(
                    'success',
                    'Insurance Reminder updated!'
                );

                redirect('insurancereminder/index');
            }
            else {

                $this->session->set_flashdata(
                    'validation_error',
                    validation_errors()
                );

                $this->session->set_flashdata(
                    'policy_id',
                    $this->input->post('policy_id')
                );

                $this->session->set_flashdata(
                    'reminder_type',
                    $this->input->post('reminder_type')
                );

                $this->session->set_flashdata(
                    'due_date',
                    $this->input->post('due_date')
                );

                $this->session->set_flashdata(
                    'reminder_days_before',
                    $this->input->post(
                        'reminder_days_before'
                    )
                );

                $this->session->set_flashdata(
                    'status',
                    $this->input->post('status')
                );

                $this->session->set_flashdata(
                    'subject',
                    $this->input->post('subject')
                );

                $this->session->set_flashdata(
                    'message',
                    $this->input->post('message')
                );

                redirect(
                    'insurancereminder/edit/'
                    . $reminder_id
                );
            }
        }

        $data['policies'] =
            $this->Insurance_reminder_model
                ->get_policies();

        $this->load->view(
            'includes/template',
            $data
        );
    }

    public function delete($reminder_id)
    {
        $this->Insurance_reminder_model
            ->delete_reminder($reminder_id);

        $this->session->set_flashdata(
            'success',
            'Insurance reminder deleted successfully!'
        );

        redirect('insurancereminder');
    }

    public function complete($reminder_id)
    {
        $this->Insurance_reminder_model
            ->mark_as_completed($reminder_id);

        $this->session->set_flashdata(
            'success',
            'Reminder marked as completed!'
        );

        redirect('insurancereminder');
    }

    public function get_due_date()
    {
        $policy_id = $this->input->post('policy_id');
        $reminder_type = $this->input->post('reminder_type');

        if (empty($policy_id) || empty($reminder_type)) {

            echo json_encode(array(
                'status' => false,
                'message' => 'Policy and reminder type are required.'
            ));

            return;
        }

        $due_date = null;

        if ($reminder_type == 'Policy Expiry') {

            $this->db->select('expiry_date');

            $this->db->from('insurance_policies');

            $this->db->where(
                'policy_id',
                $policy_id
            );

            $policy = $this->db->get()->row();

            if ($policy && !empty($policy->expiry_date)) {

                $due_date = $policy->expiry_date;
            }
        }

        elseif ($reminder_type == 'Premium Payment Due') {

            $this->db->select('due_date');

            $this->db->from('insurance_payment_records');

            $this->db->where(
                'policy_id',
                $policy_id
            );

            $this->db->where(
                'due_date IS NOT NULL',
                null,
                false
            );

            $this->db->where(
                'payment_status !=',
                'Paid'
            );

            $this->db->order_by(
                'due_date',
                'ASC'
            );

            $this->db->limit(1);

            $payment = $this->db->get()->row();

            if ($payment && !empty($payment->due_date)) {

                $due_date = $payment->due_date;
            }
        }

        if (!empty($due_date)) {

            echo json_encode(array(
                'status' => true,
                'due_date' => $due_date
            ));

        } else {

            echo json_encode(array(
                'status' => false,
                'message' => 'Due date not found for the selected policy and reminder type.'
            ));
        }
    }

}