<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insurance_claim_settlement_model extends CI_Model
{
    protected $table = 'insurance_claim_settlements';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_claims_for_settlement()
    {
        $this->db->select('
            c.claim_id,
            c.claim_number,
            c.claim_date,
            c.claim_amount,
            c.claim_status AS claim_status,

            p.policy_id,
            p.policy_number,

            ic.company_name
        ');

        $this->db->from('insurance_claim_records c');

        $this->db->join(
            'insurance_policies p',
            'p.policy_id = c.policy_id',
            'left'
        );

        $this->db->join(
            'insurance_companies ic',
            'ic.company_id = p.insurance_company_id',
            'left'
        );

        $this->db->where_in(
            'c.claim_status',
            array('Approved', 'Partially Approved')
        );

        $this->db->order_by('c.claim_id', 'DESC');

        return $this->db->get()->result();
    }

    public function get_claim_for_settlement($claim_id)
    {
        $this->db->select('
            c.claim_id,
            c.claim_number,
            c.claim_date,
            c.claim_amount,
            c.approved_amount,
            c.deducted_amount,
            c.claim_status,

            p.policy_id,
            p.policy_number,
            p.customer_id,
            p.vehicle_id,

            ic.company_name AS company_name,

            pt.policy_type_name,

            cu.name AS customer_name,

            v.brand AS vehicle_brand,
            v.registration_no AS vehicle_registration_no
        ');

        $this->db->from('insurance_claim_records c');

        $this->db->join(
            'insurance_policies p',
            'p.policy_id = c.policy_id',
            'left'
        );

        $this->db->join(
            'insurance_companies ic',
            'ic.company_id = p.insurance_company_id',
            'left'
        );

        $this->db->join(
            'insurance_policy_types pt',
            'pt.policy_type_id = p.policy_type_id',
            'left'
        );

        $this->db->join(
            'customers cu',
            'cu.customer_id = p.customer_id',
            'left'
        );

        $this->db->join(
            'vehicles v',
            'v.vehicle_id = p.vehicle_id',
            'left'
        );

        $this->db->where(
            'c.claim_id',
            $claim_id
        );

        return $this->db->get()->row();
    }

    public function insert_settlement($data)
    {
        $this->db->insert(
            $this->table,
            $data
        );

        return $this->db->insert_id();
    }

    public function get_settlements()
    {
        $this->db->select('
            s.settlement_id,
            s.claim_id,
            s.settlement_reference,

            s.claim_amount,
            s.approved_amount,
            s.deducted_amount,
            s.settlement_amount,

            s.settlement_date,
            s.settlement_method,
            s.payment_reference,
            s.settlement_status,

            s.settlement_details,
            s.remarks,

            c.claim_number,
            c.claim_date,

            p.policy_number,

            ic.company_name,

            pt.policy_type_name,

            cu.name
        ');

        $this->db->from(
            'insurance_claim_settlements s'
        );

        $this->db->join(
            'insurance_claim_records c',
            'c.claim_id = s.claim_id',
            'left'
        );

        $this->db->join(
            'insurance_policies p',
            'p.policy_id = c.policy_id',
            'left'
        );

        $this->db->join(
            'insurance_companies ic',
            'ic.company_id = p.insurance_company_id',
            'left'
        );

        $this->db->join(
            'insurance_policy_types pt',
            'pt.policy_type_id = p.policy_type_id',
            'left'
        );

        $this->db->join(
            'customers cu',
            'cu.customer_id = p.customer_id',
            'left'
        );

        $this->db->order_by(
            's.settlement_id',
            'DESC'
        );

        return $this->db->get()->result();
    }

    public function insert_settlement_document($data)
    {
        return $this->db->insert(
            'insurance_claim_settlement_documents',
            $data
        );
    }

    public function get_settlement($settlement_id)
    {
        $this->db->select('
            s.*,

            c.claim_number,
            c.claim_date,
            c.incident_date,
            c.claim_type,
            c.claim_reason,
            c.incident_description,
            c.claim_amount AS original_claim_amount,
            c.claim_status,

            p.policy_number,
            p.start_date,
            p.expiry_date,

            ic.company_name AS company_name,

            pt.policy_type_name,
        ');

        $this->db->from('insurance_claim_settlements s');

        $this->db->join(
            'insurance_claim_records c',
            'c.claim_id = s.claim_id',
            'left'
        );

        $this->db->join(
            'insurance_policies p',
            'p.policy_id = c.policy_id',
            'left'
        );

        $this->db->join(
            'insurance_companies ic',
            'ic.company_id = p.insurance_company_id',
            'left'
        );

        $this->db->join(
            'insurance_policy_types pt',
            'pt.policy_type_id = p.policy_type_id',
            'left'
        );

        $this->db->where(
            's.settlement_id',
            $settlement_id
        );

        $query = $this->db->get();
        return $query->row();
    }

    public function get_settlement_documents($settlement_id)
    {
        $this->db->where(
            'settlement_id',
            $settlement_id
        );

        $this->db->order_by(
            'document_id',
            'ASC'
        );

        $query = $this->db->get(
            'insurance_claim_settlement_documents'
        );

        return $query->result();
    }

    public function update_settlement($settlement_id, $data)
    {
        $this->db->where(
            'settlement_id',
            $settlement_id
        );

        return $this->db->update(
            'insurance_claim_settlements',
            $data
        );
    }

    public function delete_settlement_document($document_id)
    {
        $this->db->where(
            'document_id',
            $document_id
        );

        return $this->db->delete(
            'insurance_claim_settlement_documents'
        );
    }

    public function get_settlement_document_by_id($document_id)
    {
        $this->db->where(
            'document_id',
            $document_id
        );

        return $this->db
            ->get(
                'insurance_claim_settlement_documents'
            )
            ->row();
    }

    public function delete_settlement($settlement_id)
    {
        $this->db->where(
            'settlement_id',
            $settlement_id
        );

        return $this->db->delete(
            'insurance_claim_settlements'
        );
    }

}