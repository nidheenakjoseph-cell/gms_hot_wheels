<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insurance_claim_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_policy_for_claim()
    {
        $policy_id = $this->input->post('policy_id');

        if (empty($policy_id)) {
            echo json_encode([]);
            return;
        }

        $policy = $this->db
            ->select('
                p.policy_id,
                p.customer_id,
                ic.company_name,
                pt.policy_type_name,
                v.brand,
                v.registration_no
            ')
            ->from('insurance_policies p')
            ->join(
                'insurance_companies ic',
                'ic.insurance_company_id = p.insurance_company_id',
                'left'
            )
            ->join(
                'insurance_policy_types pt',
                'pt.policy_type_id = p.policy_type_id',
                'left'
            )
            ->join(
                'vehicles v',
                'v.vehicle_id = p.vehicle_id',
                'left'
            )
            ->where('p.policy_id', $policy_id)
            ->get()
            ->row();

        if ($policy) {

            echo json_encode([

                'company_name'     => $policy->company_name,
                'policy_type_name' => $policy->policy_type_name,
                'customer_id'      => $policy->customer_id,
                'vehicle_id'       => $policy->vehicle_id,
                'brand'            => $policy->brand,
                'registration_no'  => $policy->registration_no
            ]);

        } else {

            echo json_encode([]);

        }
    }

    public function generate_claim_number()
    {
        $prefix = 'CLM-' . date('Ym') . '-';

        $this->db
            ->select('claim_number')
            ->from('insurance_claim_records')
            ->like(
                'claim_number',
                $prefix,
                'after'
            )
            ->order_by(
                'claim_id',
                'DESC'
            )
            ->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 0) {

            return $prefix . '0001';
        }

        $last_claim =
            $query->row()->claim_number;


        $last_number =
            intval(
                substr(
                    $last_claim,
                    -4
                )
            );


        return $prefix .
            str_pad(
                $last_number + 1,
                4,
                '0',
                STR_PAD_LEFT
            );
    }

    public function insert_claim($data)
    {
        $this->db->insert(
            'insurance_claim_records',
            $data
        );

        return $this->db->insert_id();
    }

    public function insert_claim_document($data)
    {
        $this->db->insert('insurance_claim_documents', $data);
        return $this->db->insert_id();
    }

    public function get_all_claims()
    {
        return $this->db
            ->select('
                c.*,
                p.policy_number,
                cu.name AS customer_name,
                v.brand AS vehicle_brand,
                v.registration_no AS vehicle_registration_no
            ')
            ->from('insurance_claim_records c')

            ->join(
                'insurance_policies p',
                'p.policy_id = c.policy_id',
                'left'
            )

            ->join(
                'customers cu',
                'cu.customer_id = p.customer_id',
                'left'
            )

            ->join(
                'vehicles v',
                'v.vehicle_id = p.vehicle_id',
                'left'
            )

            ->order_by(
                'c.claim_id',
                'DESC'
            )

            ->get()
            ->result();
    }

    public function get_claim_documents($claim_id)
    {
        $this->db->where('claim_id', $claim_id);
        $this->db->order_by('doc_id', 'ASC');

        return $this->db
            ->get('insurance_claim_documents')
            ->result();
    }

    public function get_claim_document($doc_id)
    {
        return $this->db
            ->where('doc_id', $doc_id)
            ->get('insurance_claim_documents')
            ->row();
    }

    public function get_claim_by_id($claim_id)
    {
        $this->db->select('
            ic.*,

            ip.policy_number,
            ip.start_date,
            ip.expiry_date,

            icomp.company_name,

            ipt.policy_type_name,
            ipterm.policy_term_name,

            c.name AS customer_name,
            c.email AS customer_email,

            v.brand,
            v.registration_no,

        ');

        $this->db->from('insurance_claim_records ic');

        $this->db->join(
            'insurance_policies ip',
            'ip.policy_id = ic.policy_id',
            'left'
        );

        $this->db->join(
            'insurance_companies icomp',
            'icomp.company_id = ip.insurance_company_id',
            'left'
        );

        $this->db->join(
            'insurance_policy_types ipt',
            'ipt.policy_type_id = ip.policy_type_id',
            'left'
        );

        $this->db->join(
            'insurance_policy_terms ipterm',
            'ipterm.policy_term_id = ip.policy_term_id',
            'left'
        );

        $this->db->join(
            'customers c',
            'c.customer_id = ip.customer_id',
            'left'
        );

        $this->db->join(
            'vehicles v',
            'v.vehicle_id = ip.vehicle_id',
            'left'
        );

        $this->db->where('ic.claim_id', $claim_id);

        return $this->db->get()->row();
    }

    public function update_claim($claim_id, $data)
    {
        return $this->db
            ->where('claim_id', $claim_id)
            ->update('insurance_claim_records', $data);
    }

    public function delete_claim_document($doc_id)
    {
        return $this->db
            ->where('doc_id', $doc_id)
            ->delete('insurance_claim_documents');
    }

    public function delete_claim($claim_id)
    {
        return $this->db
            ->where('claim_id', $claim_id)
            ->delete('insurance_claim_records');
    }
}
