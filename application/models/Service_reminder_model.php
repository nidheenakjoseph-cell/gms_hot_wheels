<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_reminder_model extends CI_Model
{
    private $has_reminder_company_id;
    private $has_settings_company_id;

    public function __construct()
    {
        parent::__construct();
    }

    private function reminder_has_company_id()
    {
        if ($this->has_reminder_company_id === null) {
            $this->has_reminder_company_id = $this->db->field_exists('company_id', 'service_reminders');
        }

        return $this->has_reminder_company_id;
    }

    private function settings_has_company_id()
    {
        if ($this->has_settings_company_id === null) {
            $this->has_settings_company_id = $this->db->field_exists('company_id', 'service_reminder_settings');
        }

        return $this->has_settings_company_id;
    }

    public function get_reminder_setting()
    {
        $company_id = (int) get_current_company_id();

        $this->db->from('service_reminder_settings');
        if ($this->settings_has_company_id()) {
            $this->db->where('company_id', $company_id);
        }
        $row = $this->db->order_by('setting_id', 'DESC')->limit(1)->get()->row();

        if (!$row) {
            $default = new stdClass();
            $default->reminder_period_months = 3;
            $default->reminder_date_months   = 0;
            $default->reminder_date_weeks    = 1;
            return $default;
        }

        return $row;
    }

    public function update_reminder_setting($months, $remind_months = 0, $remind_weeks = 1)
    {
        $months        = max(1, (int) $months);
        $remind_months = max(0, (int) $remind_months);
        $remind_weeks  = max(0, (int) $remind_weeks);
        $company_id    = (int) get_current_company_id();

        $this->db->from('service_reminder_settings');
        if ($this->settings_has_company_id()) {
            $this->db->where('company_id', $company_id);
        }
        $existing = $this->db->order_by('setting_id', 'DESC')->limit(1)->get()->row();

        $data = [
            'reminder_period_months' => $months,
            'reminder_date_months'   => $remind_months,
            'reminder_date_weeks'    => $remind_weeks,
            'updated_at'             => date('Y-m-d H:i:s'),
        ];

        if ($existing) {
            return $this->db->where('setting_id', $existing->setting_id)
                ->update('service_reminder_settings', $data);
        }

        if ($this->settings_has_company_id()) {
            $data['company_id'] = $company_id;
        }
        return $this->db->insert('service_reminder_settings', $data);
    }

    private function _compute_reminder_date($next_service_date, $remind_months, $remind_weeks)
    {
        $ts = strtotime($next_service_date);

        if ($remind_months > 0) {
            $ts = strtotime('-' . $remind_months . ' months', $ts);
        }

        if ($remind_weeks > 0) {
            $ts = strtotime('-' . $remind_weeks . ' weeks', $ts);
        }

        return date('Y-m-d', $ts);
    }

    public function generate_reminder($jobcard_id, $vehicle_id, $customer_id, $service_date = null)
    {
        $jobcard_id  = (int) $jobcard_id;
        $vehicle_id  = (int) $vehicle_id;
        $customer_id = (int) $customer_id;

        if (!$jobcard_id || !$vehicle_id || !$customer_id) {
            return false;
        }

        $this->db->where('vehicle_id', $vehicle_id)->where('status', 'Pending');
        if ($this->reminder_has_company_id()) {
            $this->db->where('company_id', (int) get_current_company_id());
        }
        $this->db->update('service_reminders', [
            'status'    => 'Closed',
            'closed_at' => date('Y-m-d H:i:s'),
        ]);

        $settings          = $this->get_reminder_setting();
        $last_service_date = $service_date ?: date('Y-m-d');
        $months            = (int) ($settings->reminder_period_months ?? 3);
        $remind_months     = (int) ($settings->reminder_date_months ?? 0);
        $remind_weeks      = (int) ($settings->reminder_date_weeks ?? 1);
        $next_service_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($last_service_date)) . ' + ' . $months . ' months'));
        $reminder_date     = $this->_compute_reminder_date($next_service_date, $remind_months, $remind_weeks);

        $data = [
            'jobcard_id'             => $jobcard_id,
            'vehicle_id'             => $vehicle_id,
            'customer_id'            => $customer_id,
            'last_service_date'      => $last_service_date,
            'next_service_date'      => $next_service_date,
            'reminder_date'          => $reminder_date,
            'reminder_period_months' => $months,
            'status'                 => 'Pending',
            'created_at'             => date('Y-m-d H:i:s'),
            'closed_at'              => null,
        ];
        if ($this->reminder_has_company_id()) {
            $data['company_id'] = (int) get_current_company_id();
        }

        $this->db->insert('service_reminders', $data);
        return $this->db->insert_id();
    }

    public function get_all_reminders($status = null)
    {
        $company_id = (int) get_current_company_id();

        $this->db->select('sr.*, c.name AS customer_name, c.phone AS customer_phone, c.email AS customer_email, v.registration_no AS vehicle_no');
        $this->db->select('COUNT(srl.log_id) AS notify_count', false);
        $this->db->from('service_reminders sr');
        $this->db->join('customers c', 'c.customer_id = sr.customer_id', 'left');
        $this->db->join('vehicles v', 'v.vehicle_id = sr.vehicle_id', 'left');
        $this->db->join('service_reminder_logs srl', 'srl.reminder_id = sr.reminder_id', 'left');
        if ($this->reminder_has_company_id()) {
            $this->db->where('sr.company_id', $company_id);
        }
        apply_branch_filter('c');
        if ($status) {
            $this->db->where('sr.status', $status);
        }

        $this->db->group_by('sr.reminder_id');
        $this->db->order_by('sr.reminder_date', 'DESC');
        $this->db->order_by('sr.reminder_id', 'DESC');
        return $this->db->get()->result();
    }

    public function get_reminder($reminder_id)
    {
        $company_id = (int) get_current_company_id();

        $this->db->select('sr.*, c.name AS customer_name, c.phone AS customer_phone, c.email AS customer_email, v.registration_no AS vehicle_no');
        $this->db->from('service_reminders sr');
        $this->db->join('customers c', 'c.customer_id = sr.customer_id', 'left');
        $this->db->join('vehicles v', 'v.vehicle_id = sr.vehicle_id', 'left');
        $this->db->where('sr.reminder_id', (int) $reminder_id);
        if ($this->reminder_has_company_id()) {
            $this->db->where('sr.company_id', $company_id);
        }
        return $this->db->get()->row();
    }

    public function log_notification($reminder_id, $channel, $sent_to, $status, $note = '')
    {
        return $this->db->insert('service_reminder_logs', [
            'reminder_id' => (int) $reminder_id,
            'channel'     => $channel,
            'sent_to'     => (string) $sent_to,
            'sent_at'     => date('Y-m-d H:i:s'),
            'status'      => $status,
            'note'        => $note,
        ]);
    }

    public function get_notification_logs($reminder_id)
    {
        return $this->db->where('reminder_id', (int) $reminder_id)
            ->order_by('sent_at', 'DESC')->get('service_reminder_logs')->result();
    }

    public function get_reminders_due($days_ahead = 7)
    {
        $days_ahead = max(0, (int) $days_ahead);
        $cutoff     = date('Y-m-d', strtotime('+' . $days_ahead . ' days'));

        return $this->db->where('status', 'Pending')
            ->where('next_service_date <=', $cutoff)
            ->where('next_service_date >=', date('Y-m-d'))
            ->order_by('reminder_date', 'DESC')->get('service_reminders')->result();
    }

    public function close_reminder($reminder_id)
    {
        $company_id = (int) get_current_company_id();

        $this->db->where('reminder_id', $reminder_id);
        if ($this->reminder_has_company_id()) {
            $this->db->where('company_id', $company_id);
        }
        return $this->db->update('service_reminders', [
            'status'    => 'Closed',
            'closed_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function get_pending_count()
    {
        $company_id = (int) get_current_company_id();

        $this->db->where('status', 'Pending');
        if ($this->reminder_has_company_id()) {
            $this->db->where('company_id', $company_id);
        }
        return (int) $this->db->count_all_results('service_reminders');
    }
}
