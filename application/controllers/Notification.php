<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Notification_model');
    }

    public function index()
    {
        $this->Notification_model->create_insurance_expiry_notifications();
        $this->respond([
            'notifications' => $this->Notification_model->get_user_notifications($this->current_user_id()),
            'unread_count' => $this->Notification_model->count_unread($this->current_user_id()),
        ]);
    }

    public function unread_count()
    {
        $this->respond([
            'count' => $this->Notification_model->count_unread($this->current_user_id()),
        ]);
    }

    public function mark_as_read($msg_id = 0)
    {
        $this->Notification_model->mark_as_read($msg_id, $this->current_user_id());
        $this->respond(['success' => true]);
    }

    public function mark_all_as_read()
    {
        $this->db
            ->where('user_id', $this->current_user_id())
            ->where('read_flag', 0)
            ->update('notification', [
                'read_flag' => 1,
                'read_date' => date('Y-m-d H:i:s'),
            ]);

        $this->respond(['success' => true]);
    }

    private function current_user_id()
    {
        return (int) $this->session->userdata('user_id');
    }

    private function respond(array $payload)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($payload));
    }
}
