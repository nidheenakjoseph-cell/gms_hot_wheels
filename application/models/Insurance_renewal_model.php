<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insurance_renewal_model extends CI_Model
{

    public function get_policy_renewals()
    {
        return $this->db
            ->select('
                r.*,

                COALESCE(
                    newp.policy_number,
                    prev.policy_number
                ) AS policy_number,

                c.name AS customer_name,

                v.brand AS vehicle_brand,
                v.registration_no AS vehicle_registration_no
            ')

            ->from('insurance_policy_renewals r')

            ->join(
                'insurance_policies prev',
                'prev.policy_id = r.previous_policy_id',
                'left'
            )

            ->join(
                'insurance_policies newp',
                'newp.policy_id = r.new_policy_id',
                'left'
            )

            ->join(
                'customers c',
                'c.customer_id = prev.customer_id',
                'left'
            )

            ->join(
                'vehicles v',
                'v.vehicle_id = prev.vehicle_id',
                'left'
            )

            ->order_by(
                'r.renewal_id',
                'DESC'
            )

            ->get()
            ->result();
    }

    public function get_policies_for_renewal()
    {
        return $this->db
            ->select('
                p.policy_id,
                p.policy_number
            ')
            ->from('insurance_policies p')
            ->where_in(
                'p.policy_status',
                array('Active', 'Expired')
            )
            ->order_by(
                'p.policy_number',
                'ASC'
            )
            ->get()
            ->result();
    }

    public function get_policy_for_renewal($policy_id)
    {
        return $this->db
            ->select('
                p.policy_id,
                p.policy_number,
                p.insurance_company_id,
                p.expiry_date,
                p.premium_amount,
                p.sum_insured,
                p.total_premium,
                p.discount_amount,
                p.vat_treatment,
                p.vat_rate,
                p.vat_amount,
                
                p.policy_type_id,
                p.policy_term_id,
                p.customer_id,
                p.vehicle_id,

                ic.company_name,

                pt.policy_type_name,
                ptr.policy_term_name,

                c.name AS customer_name,

                v.brand AS vehicle_brand,
                v.registration_no AS vehicle_registration_no
            ')
            ->from('insurance_policies p')

            ->join(
                'insurance_companies ic',
                'ic.company_id = p.insurance_company_id',
                'left'
            )

            ->join(
                'insurance_policy_types pt',
                'pt.policy_type_id = p.policy_type_id',
                'left'
            )

            ->join(
                'insurance_policy_terms ptr',
                'ptr.policy_term_id = p.policy_term_id',
                'left'
            )

            ->join(
                'customers c',
                'c.customer_id = p.customer_id',
                'left'
            )

            ->join(
                'vehicles v',
                'v.vehicle_id = p.vehicle_id',
                'left'
            )

            ->where(
                'p.policy_id',
                $policy_id
            )

            ->get()
            ->row();
    }

    public function insert_policy_document($data)
    {
        return $this->db
            ->insert(
                'insurance_policy_documents',
                $data
            );
    }

    public function get_policy_coverages_for_renewal($policy_id)
    {
        return $this->db
            ->select('
                ipc.policy_coverage_id,
                ipc.policy_id,
                ipc.coverage_type_id,
                ipc.coverage_amount,
                ipc.coverage_limit_type,
                ipc.deductible_amount,
                ipc.deductible_type,
                ipc.coverage_status,
                ipc.created_at,
                ipc.updated_at,
                ct.coverage_type_name
            ')
            ->from('insurance_policy_coverages ipc')
            ->join(
                'insurance_coverage_types ct',
                'ct.coverage_type_id = ipc.coverage_type_id',
                'left'
            )
            ->where('ipc.policy_id', $policy_id)
            ->get()
            ->result();
    }

    public function delete_policy_coverage($policy_coverage_id)
    {
        return $this->db
            ->where('policy_coverage_id', $policy_coverage_id)
            ->delete('insurance_policy_coverages');
    }

    public function insert_policy_renewal($data)
    {
        $this->db->insert(
            'insurance_policy_renewals',
            $data
        );

        return $this->db->insert_id();
    }

    public function get_coverage_types()
    {
        return $this->db
            ->order_by('coverage_type_id', 'DESC')
            ->get('insurance_coverage_types')
            ->result();
    }

    public function insert_new_policy($data)
    {
        $this->db->insert('insurance_policies', $data);

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }

        return false;
    }

    public function insert_policy_coverage($data)
    {
        $this->db->insert('insurance_policy_coverages', $data);

        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }

        return false;
    }

    public function get_renewal_by_id($renewal_id)
    {
        return $this->db
            ->select('
                r.*,

                p.policy_number,
                p.start_date,
                p.expiry_date,

                p.sum_insured,
                p.premium_amount,
                p.discount_amount,
                p.vat_treatment,
                p.vat_rate,
                p.vat_amount,
                p.total_premium,

                ic.company_name,
                pt.policy_type_name,
                ptr.policy_term_name,

                c.name AS customer_name,

                v.brand AS vehicle_brand,
                v.registration_no AS vehicle_registration_no
            ')
            ->from('insurance_policy_renewals r')

            ->join(
                'insurance_policies p',
                'p.policy_id = r.new_policy_id',
                'left'
            )

            ->join(
                'insurance_companies ic',
                'ic.company_id = p.insurance_company_id',
                'left'
            )

            ->join(
                'insurance_policy_types pt',
                'pt.policy_type_id = p.policy_type_id',
                'left'
            )

            ->join(
                'insurance_policy_terms ptr',
                'ptr.policy_term_id = p.policy_term_id',
                'left'
            )

            ->join(
                'customers c',
                'c.customer_id = p.customer_id',
                'left'
            )

            ->join(
                'vehicles v',
                'v.vehicle_id = p.vehicle_id',
                'left'
            )

            ->where(
                'r.renewal_id',
                $renewal_id
            )

            ->get()
            ->row();
    }

    public function get_renewal_documents($renewal_id)
    {

        $renewal = $this->db
            ->select('new_policy_id')
            ->where('renewal_id', $renewal_id)
            ->get('insurance_policy_renewals')
            ->row();

        if (!$renewal) {
            return [];
        }

        return $this->db
            ->select('
                document_id,
                policy_id,
                document_name,
                document_type,
                file_name,
                file_path,
                uploaded_at
            ')
            ->where('policy_id', $renewal->new_policy_id)
            ->order_by('document_id', 'ASC')
            ->get('insurance_policy_documents')
            ->result();
    }

    public function get_document_by_id($document_id)
    {
        return $this->db
            ->where('document_id', $document_id)
            ->get('insurance_policy_documents')
            ->row();
    }

    public function update_renewal($renewal_id, $data)
    {
        return $this->db
            ->where('renewal_id', $renewal_id)
            ->update('insurance_policy_renewals', $data);
    }

    public function update_policy($policy_id, $data)
    {
        return $this->db
            ->where('policy_id', $policy_id)
            ->update(
                'insurance_policies',
                $data
            );
    }

    public function update_policy_renewal($renewal_id, $data)
    {
        return $this->db
            ->where('renewal_id', $renewal_id)
            ->update(
                'insurance_policy_renewals',
                $data
            );
    }

    public function get_insurance_companies()
    {
        return $this->db
            ->select('company_id, company_name')
            ->from('insurance_companies')
            ->where('status', 1)
            ->order_by('company_name', 'ASC')
            ->get()
            ->result();
    }

    public function get_policy_coverage_by_type(
        $policy_id,
        $coverage_type_id
    ) {
        return $this->db
            ->where('policy_id', $policy_id)
            ->where('coverage_type_id', $coverage_type_id)
            ->get('insurance_policy_coverages')
            ->row();
    }

    public function update_policy_coverage($coverage_id, $data)
    {
        return $this->db
            ->where(
                'policy_coverage_id',
                $coverage_id
            )
            ->update(
                'insurance_policy_coverages',
                $data
            );
    }

    public function get_policy_types()
    {
        return $this->db
            ->select('policy_type_id, policy_type_name')
            ->from('insurance_policy_types')
            ->where('status', 1)
            ->order_by('policy_type_name', 'ASC')
            ->get()
            ->result();
    }

    public function get_policy_terms()
    {
        return $this->db
            ->select('
                policy_term_id,
                policy_term_name,
            ')
            ->from('insurance_policy_terms')
            ->where('status', 1)
            ->order_by('policy_term_name', 'ASC')
            ->get()
            ->result();
    }

    public function get_renewal_coverages($renewal_id)
    {
        return $this->db
            ->select('
                pc.policy_coverage_id,
                pc.policy_id,
                pc.coverage_type_id,
                pc.coverage_amount,
                pc.coverage_limit_type,
                pc.deductible_amount,
                pc.deductible_type,
                pc.coverage_status,
                ct.coverage_type_name
            ')
            ->from('insurance_policy_coverages pc')
            ->join(
                'insurance_policy_renewals r',
                'r.new_policy_id = pc.policy_id',
                'inner'
            )
            ->join(
                'insurance_coverage_types ct',
                'ct.coverage_type_id = pc.coverage_type_id',
                'left'
            )
            ->where('r.renewal_id', $renewal_id)
            ->order_by('pc.policy_coverage_id', 'ASC')
            ->get()
            ->result();
    }

    public function delete_renewal($renewal_id)
    {

        $renewal = $this->db
            ->where('renewal_id', $renewal_id)
            ->get('insurance_policy_renewals')
            ->row();

        if (!$renewal) {
            return false;
        }

        $new_policy_id = $renewal->new_policy_id;

        if (!empty($new_policy_id)) {

            $this->db
                ->where('policy_id', $new_policy_id)
                ->delete('insurance_policy_coverages');
        }

        if (!empty($new_policy_id)) {

            $this->db
                ->where('policy_id', $new_policy_id)
                ->delete('insurance_policy_documents');
        }

        if (!empty($new_policy_id)) {

            $this->db
                ->where('policy_id', $new_policy_id)
                ->delete('insurance_policies');
        }

        return $this->db
            ->where('renewal_id', $renewal_id)
            ->delete('insurance_policy_renewals');
    }

    public function delete_renewal_documents($renewal_id)
    {
        $renewal = $this->db
            ->select('new_policy_id')
            ->from('insurance_policy_renewals')
            ->where('renewal_id', $renewal_id)
            ->get()
            ->row();

        if (!$renewal) {
            return false;
        }

        return $this->db
            ->where('policy_id', $renewal->new_policy_id)
            ->delete('insurance_policy_documents');
    }

    public function delete_document($document_id)
    {
        return $this->db
            ->where('document_id', $document_id)
            ->delete('insurance_policy_documents');
    }

    public function get_policy_by_id($policy_id)
    {
        return $this->db
            ->select('
                p.*,
                v.brand AS vehicle_brand,
                v.registration_no AS vehicle_registration_no
            ')
            ->from('insurance_policies p')
            ->join(
                'vehicles v',
                'v.vehicle_id = p.vehicle_id',
                'left'
            )
            ->where('p.policy_id', $policy_id)
            ->get()
            ->row();
    }

}