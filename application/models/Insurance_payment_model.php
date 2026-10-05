<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insurance_payment_model extends CI_Model
{
    protected $table = 'insurance_payment_records';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_payments()
    {
        $this->db->select('
            ipr.*,
            ip.policy_number,
            ip.total_premium,
            ic.company_name,
            ipterm.policy_term_name,
        ');

        $this->db->from($this->table . ' ipr');

        $this->db->join(
            'insurance_policies ip',
            'ip.policy_id = ipr.policy_id',
            'left'
        );

        $this->db->join(
            'insurance_companies ic',
            'ic.company_id = ip.insurance_company_id',
            'left'
        );

        $this->db->join( 'insurance_policy_terms ipterm', 'ipterm.policy_term_id = ip.policy_term_id', 'left' );
        
        $this->db->order_by('ipr.payment_id', 'DESC');

        return $this->db->get()->result();
    }

    public function get_policies()
    {
        $this->db->select('
            policy_id,
            policy_number
        ');

        $this->db->from('insurance_policies');

        $this->db->order_by('policy_id', 'DESC');

        return $this->db->get()->result();
    }

    public function get_payment($id)
    {
        $this->db->select('
            ipr.*,
            ip.policy_number,
            ic.company_name,
            ipterm.policy_term_name
        ');

        $this->db->from($this->table . ' ipr');

        $this->db->join(
            'insurance_policies ip',
            'ip.policy_id = ipr.policy_id',
            'left'
        );

        $this->db->join(
            'insurance_companies ic',
            'ic.company_id = ip.insurance_company_id',
            'left'
        );

        $this->db->join(
            'insurance_policy_terms ipterm',
            'ipterm.policy_term_id = ip.policy_term_id',
            'left'
        );

        $this->db->where(
            'ipr.payment_id',
            $id
        );

        return $this->db->get()->row();
    }

    public function insert_payment($data)
    {
        return $this->db->insert(
            $this->table,
            $data
        );
    }

    public function update_payment($id, $data)
    {
        $this->db->where(
            'payment_id',
            $id
        );

        return $this->db->update(
            'insurance_payment_records',
            $data
        );
    }

    public function get_policy_details($policy_id)
    {
        $this->db->select('
            ip.policy_id,
            ip.policy_number,

            ic.company_name,

            pt.policy_type_name,

            c.name AS customer_name
        ');

        $this->db->from('insurance_policies ip');

        $this->db->join(
            'insurance_companies ic',
            'ic.company_id = ip.insurance_company_id',
            'left'
        );

        $this->db->join(
            'insurance_policy_types pt',
            'pt.policy_type_id = ip.policy_type_id',
            'left'
        );

        $this->db->join(
            'customers c',
            'c.customer_id = ip.customer_id',
            'left'
        );

        $this->db->where(
            'ip.policy_id',
            $policy_id
        );

        return $this->db->get()->row();
    }

    public function delete_payment($id)
    {
        $this->db->where('payment_id', $id);

        return $this->db->delete(
            $this->table
        );
    }
    
}