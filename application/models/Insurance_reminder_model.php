<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insurance_reminder_model extends CI_Model
{
    protected $table = 'insurance_reminders';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_reminders()
    {
        $this->db->select('
            r.*,
            p.policy_number,
            ic.company_name,
            c.name
        ');

        $this->db->from($this->table . ' r');

        $this->db->join(
            'insurance_policies p',
            'p.policy_id = r.policy_id',
            'left'
        );

        $this->db->join(
            'insurance_companies ic',
            'ic.company_id = p.insurance_company_id',
            'left'
        );

        $this->db->join(
            'customers c',
            'c.customer_id = p.customer_id',
            'left'
        );

        $this->db->order_by('r.reminder_date', 'ASC');

        return $this->db->get()->result();
    }

    public function get_reminder($reminder_id) 
    { 
        $this->db->select(' ir.*, ip.policy_number '); 

        $this->db->from('insurance_reminders ir'); 
        
        $this->db->join( 'insurance_policies ip', 'ip.policy_id = ir.policy_id', 'left' ); 
        
        $this->db->where( 'ir.reminder_id', $reminder_id ); 
        
        return $this->db->get()->row(); 
    }

    public function get_reminders_by_policy($policy_id)
    {
        return $this->db
            ->where('policy_id', $policy_id)
            ->order_by('reminder_date', 'ASC')
            ->get($this->table)
            ->result();
    }

    public function insert_reminder($data)
    {
        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function update_reminder($reminder_id, $data)
    {
        $this->db->where(
            'reminder_id',
            $reminder_id
        );

        return $this->db->update(
            'insurance_reminders',
            $data
        );
    }

    public function delete_reminder($reminder_id)
    {
        return $this->db
            ->where('reminder_id', $reminder_id)
            ->delete($this->table);
    }

    public function mark_as_completed($reminder_id)
    {
        return $this->update_reminder($reminder_id, [
            'status'       => 'Completed',
            'completed_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function get_policies()
    {
        $this->db->select('
            policy_id,
            policy_number
        ');

        $this->db->from('insurance_policies');

        $this->db->order_by('policy_number', 'ASC');

        return $this->db->get()->result();
    }

}