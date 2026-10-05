<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServiceReminder extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_reminder_model');
        $this->load->helper(['url', 'form', 'company', 'branch']);
    }

    // ---------------------------------------------------------------
    // INDEX — list all reminders
    // ---------------------------------------------------------------

    public function index($status = null)
    {
        $status = $status ?: $this->input->get('status');

        $data['title']           = 'Service Reminders';
        $data['selected_status'] = $status;
        $data['reminders']       = $this->Service_reminder_model->get_all_reminders($status);
        $data['main_content']    = 'service_reminder/list';

        $this->load->view('includes/template', $data); 
    }

    // ---------------------------------------------------------------
    // SETTINGS — view & save
    // ---------------------------------------------------------------

    public function settings()
    {
        $data['title']           = 'Service Reminder Settings';
        $data['current_setting'] = $this->Service_reminder_model->get_reminder_setting();

        if ($this->input->post()) {
            $months        = max(1, (int) $this->input->post('reminder_period_months'));
            $remind_months = max(0, (int) $this->input->post('reminder_date_months'));
            $remind_weeks  = max(0, (int) $this->input->post('reminder_date_weeks'));

            $this->Service_reminder_model->update_reminder_setting(
                $months,
                $remind_months,
                $remind_weeks
            );

            $this->session->set_flashdata('success', 'Service reminder settings updated successfully.');
            redirect('ServiceReminder/settings');
        }

        $data['main_content'] = 'service_reminder/settings';
        $this->load->view('includes/template', $data);
    }

    // ---------------------------------------------------------------
    // NOTIFY — WhatsApp
    // ---------------------------------------------------------------

    public function notify_whatsapp($id)
    {
        $id = (int) $id;

        if ($id <= 0) {
            redirect('ServiceReminder/index');
        }

        $reminder = $this->Service_reminder_model->get_reminder($id);

        if (!$reminder || $reminder->status === 'Closed') {
            $this->session->set_flashdata('error', 'Reminder not found or already closed.');
            redirect('ServiceReminder/index');
        }

        $phone = trim($reminder->customer_phone ?? '');

        if (empty($phone)) {
            $this->Service_reminder_model->log_notification($id, 'whatsapp', '', 'failed', 'Customer has no phone number.');
            $this->session->set_flashdata('error', 'Customer has no phone number on record.');
            redirect('ServiceReminder/index');
        }

        // Get company_id from session (fall back to 1)
        $company_id = (int) get_current_company_id();

        $template = $this->db
            ->where('company_id', $company_id)
            ->where('template_type', 'service_reminder')
            ->where('is_active', 1)
            ->get('whatsapp_template')
            ->row();

        $message_template = $template->template_body ?? "Dear {customer_name},\n\n"
            . "This is a friendly reminder that your vehicle {vehicle_no} is due for its next service.\n\n"
            . "Next Service Date: {next_service_date}\n"
            . "Last Service Date: {last_service_date}\n\n"
            . "Please book your appointment at your earliest convenience.\n\n"
            . "Thank you!";

        $message = strtr($message_template, [
            '{customer_name}'     => $reminder->customer_name ?? '',
            '{vehicle_no}'        => $reminder->vehicle_no ?? '',
            '{last_service_date}' => !empty($reminder->last_service_date) ? date('d-m-Y', strtotime($reminder->last_service_date)) : '',
            '{next_service_date}' => !empty($reminder->next_service_date) ? date('d-m-Y', strtotime($reminder->next_service_date)) : '',
            '{reminder_date}'     => !empty($reminder->reminder_date) ? date('d-m-Y', strtotime($reminder->reminder_date)) : '',
            '{status}'             => $reminder->status ?? '',
        ]);

        $this->load->library('Whatsapp_library');

        $result = $this->whatsapp_library->send_message($company_id, $phone, $message);

        if (!empty($result['success'])) {
            $this->Service_reminder_model->log_notification($id, 'whatsapp', $phone, 'success');
            $this->session->set_flashdata('success', "WhatsApp reminder sent to {$reminder->customer_name} ({$phone}).");
        } else {
            $note = $result['message'] ?? 'Unknown error';
            $this->Service_reminder_model->log_notification($id, 'whatsapp', $phone, 'failed', $note);
            $this->session->set_flashdata('error', 'WhatsApp send failed: ' . $note);
        }

        redirect('ServiceReminder/index');
    }

    public function notify_email($id)
    {
        $id = (int) $id;

        if ($id <= 0) {
            redirect('ServiceReminder/index');
        }

        $reminder = $this->Service_reminder_model->get_reminder($id);

        if (!$reminder || $reminder->status === 'Closed') {
            $this->session->set_flashdata('error', 'Reminder not found or already closed.');
            redirect('ServiceReminder/index');
        }

        $email = trim($reminder->customer_email ?? '');

        if (empty($email)) {
            $this->Service_reminder_model->log_notification($id, 'email', '', 'failed', 'Customer has no email address.');
            $this->session->set_flashdata('error', 'Customer has no email address on record.');
            redirect('ServiceReminder/index');
        }

        $company_id   = (int) get_current_company_id();
        $this->load->library('Gms_mailer');

        $company_name = $this->gms_mailer->get_company_name($company_id);

        $placeholders = [
            '{customer_name}'     => $reminder->customer_name    ?? 'Customer',
            '{vehicle_no}'        => $reminder->vehicle_no       ?? '-',
            '{last_service_date}' => $reminder->last_service_date ?? '-',
            '{next_service_date}' => $reminder->next_service_date ?? '-',
            '{company_name}'      => $company_name,
        ];

        $result = $this->gms_mailer->send_notification(
            $email,
            'service_reminder',
            $placeholders,
            null,
            $company_id
        );

        if (!empty($result['status'])) {
            $this->Service_reminder_model->log_notification($id, 'email', $email, 'success');
            $this->session->set_flashdata('success', "Email reminder sent to {$reminder->customer_name} ({$email}).");
        } else {
            $note = $result['message'] ?? 'Unknown error';
            $this->Service_reminder_model->log_notification($id, 'email', $email, 'failed', $note);
            $this->session->set_flashdata('error', 'Email send failed: ' . $note);
        }

        redirect('ServiceReminder/index');
    }

    // ---------------------------------------------------------------
    // NOTIFICATION HISTORY modal data (AJAX)
    // ---------------------------------------------------------------

    public function history($id)
    {
        $id   = (int) $id;
        $logs = $this->Service_reminder_model->get_notification_logs($id);

        header('Content-Type: application/json');
        echo json_encode($logs);
        exit;
    }

    // ---------------------------------------------------------------
    // CLOSE / DELETE
    // ---------------------------------------------------------------

    public function close($id)
    {
        $id = (int) $id;

        if ($id > 0) {
            $this->Service_reminder_model->close_reminder($id);
            $this->session->set_flashdata('success', 'Reminder closed successfully.');
        }

        redirect('ServiceReminder/index');
    }

    public function delete($id)
    {
        $id = (int) $id;

        if ($id > 0) {
            // Verify the reminder belongs to the current company before deleting
            $reminder = $this->Service_reminder_model->get_reminder($id);
            if ($reminder) {
                $this->db->where('reminder_id', $id)->delete('service_reminders');
                $this->db->where('reminder_id', $id)->delete('service_reminder_logs');
                $this->session->set_flashdata('success', 'Reminder deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Reminder not found or access denied.');
            }
        }

        redirect('ServiceReminder/index');
    }
}
