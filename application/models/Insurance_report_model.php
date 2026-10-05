<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insurance_report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_policy_report()
    {
        $this->db->select('
            p.*,
            ic.company_name,
            pt.policy_type_name,
            pterm.policy_term_name,
            ct.coverage_type_name,
            c.name,
            v.brand,
            v.registration_no
        ');

        $this->db->from('insurance_policies p');

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

        $this->db->join( 'insurance_policy_terms pterm', 'pterm.policy_term_id = p.policy_term_id', 'left' );

        $this->db->join( 'insurance_policy_coverages pc', 'pc.policy_id = p.policy_id', 'left' );

        $this->db->join( 'insurance_coverage_types ct', 'ct.coverage_type_id = pc.coverage_type_id', 'left' );

        $this->db->join(
            'customers c',
            'c.customer_id = p.customer_id',
            'left'
        );

        $this->db->join(
            'vehicles v',
            'v.vehicle_id = p.vehicle_id',
            'left'
        );

        $this->db->order_by('p.expiry_date', 'DESC');

        return $this->db->get()->result();
    }

    public function get_upcoming_renewals($days = 30)
    {
        $today = date('Y-m-d');
        $future_date = date(
            'Y-m-d',
            strtotime("+{$days} days")
        );

        $this->db->select('
            p.*,
            ic.company_name,
            pt.policy_type_name,
            c.name,
            v.brand,
            v.registration_no
        ');

        $this->db->from('insurance_policies p');

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
            'customers c',
            'c.customer_id = p.customer_id',
            'left'
        );

        $this->db->join(
            'vehicles v',
            'v.vehicle_id = p.vehicle_id',
            'left'
        );

        $this->db->where('p.expiry_date >=', $today);
        $this->db->where('p.expiry_date <=', $future_date);

        $this->db->order_by('p.expiry_date', 'ASC');

        return $this->db->get()->result();
    }

    public function get_claims_report()
    {

        $this->db->select('
            cr.*,
            p.policy_number,
            ic.company_name,
            pt.policy_type_name,
            cu.name,
            v.brand,
            v.registration_no
        ');

        $this->db->from('insurance_claim_records cr');

        $this->db->join(
            'insurance_policies p',
            'p.policy_id = cr.policy_id',
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

        $this->db->order_by(
            'cr.claim_date',
            'DESC'
        );

        return $this->db->get()->result();

    }

    public function get_payment_report()
    {
        $this->db->select('
            ip.*,
            p.policy_number,
            p.total_premium,
            ic.company_name,
            ipterm.policy_term_name,
            cu.name,
            v.brand,
            v.registration_no
        ');

        $this->db->from('insurance_payment_records ip');

        $this->db->join(
            'insurance_policies p',
            'p.policy_id = ip.policy_id',
            'left'
        );

        $this->db->join(
            'insurance_companies ic',
            'ic.company_id = p.insurance_company_id',
            'left'
        );

        $this->db->join(
            'insurance_policy_terms ipterm',
            'ipterm.policy_term_id = p.policy_term_id',
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

        $this->db->order_by(
            'ip.payment_date',
            'DESC'
        );

        return $this->db->get()->result();
    }

}