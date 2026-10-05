<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insurance_policy_model extends CI_Model
{

    public function get_policy_types()
    {
        return $this->db
            ->order_by('policy_type_id', 'DESC')
            ->get('insurance_policy_types')
            ->result();
    }

    public function get_policy_type($id)
    {
        return $this->db
            ->where('policy_type_id', $id)
            ->get('insurance_policy_types')
            ->row();
    }

    public function insert_policy_type($data)
    {
        return $this->db
            ->insert('insurance_policy_types', $data);
    }

    public function get_policy_type_by_id($policy_type_id)
    {
        return $this->db
        ->where('policy_type_id', $policy_type_id)
        ->get('insurance_policy_types')
        ->row();
    }

    public function update_policy_type($id, $data)
    {
        return $this->db
            ->where('policy_type_id', $id)
            ->update('insurance_policy_types', $data);
    }

    public function delete_policy_type($id)
    {
        return $this->db
            ->where('policy_type_id', $id)
            ->delete('insurance_policy_types');
    }

    public function get_coverage_types()
    {
        return $this->db
            ->order_by('coverage_type_id', 'DESC')
            ->get('insurance_coverage_types')
            ->result();
    }

    public function get_coverage_type($id)
    {
        return $this->db
            ->where('coverage_type_id', $id)
            ->get('insurance_coverage_types')
            ->row();
    }

    public function get_coverage_type_by_id($coverage_type_id)
    {
        return $this->db
            ->where('coverage_type_id', $coverage_type_id)
            ->get('insurance_coverage_types')
            ->row();
    }

    public function insert_coverage_type($data)
    {
        return $this->db
            ->insert('insurance_coverage_types', $data);
    }

    public function update_coverage_type($id, $data)
    {
        return $this->db
            ->where('coverage_type_id', $id)
            ->update('insurance_coverage_types', $data);
    }

    public function delete_coverage_type($id)
    {
        return $this->db
            ->where('coverage_type_id', $id)
            ->delete('insurance_coverage_types');
    }

    public function get_policy_terms()
    {
        return $this->db
            ->order_by('policy_term_id', 'DESC')
            ->get('insurance_policy_terms')
            ->result();
    }

    public function get_policy_term($id)
    {
        return $this->db
            ->where('policy_term_id', $id)
            ->get('insurance_policy_terms')
            ->row();
    }

    public function get_policy_term_by_id($term_id)
    {
        return $this->db
            ->where('policy_term_id', $term_id)
            ->get('insurance_policy_terms')
            ->row();
    }

    public function insert_policy_term($data)
    {
        return $this->db
            ->insert('insurance_policy_terms', $data);
    }

    public function update_policy_term($id, $data)
    {
        return $this->db
            ->where('policy_term_id', $id)
            ->update('insurance_policy_terms', $data);
    }

    public function delete_policy_term($id)
    {
        return $this->db
            ->where('policy_term_id', $id)
            ->delete('insurance_policy_terms');
    }

    public function get_policies()
    {
        return $this->db
            ->select('
                insurance_policies.*,
                vehicles.brand,
                vehicles.registration_no,
                customers.name
            ')
            ->from('insurance_policies')
                ->join(
                'vehicles',
                'vehicles.vehicle_id = insurance_policies.vehicle_id',
                'left'
            )
            ->join(
                'customers',
                'customers.customer_id = insurance_policies.customer_id',
                'left'
            )
            ->order_by('insurance_policies.policy_id', 'DESC')
            ->get()
            ->result();
    }

    public function get_policy($policy_id)
    {
        return $this->db
            ->select('
                insurance_policies.*,

                insurance_companies.company_name,

                insurance_policy_types.policy_type_name,

                insurance_policy_terms.policy_term_name,

                customers.name AS customer_name,

                vehicles.brand AS vehicle_brand,
                vehicles.registration_no,

            ')
            ->from('insurance_policies')

            ->join(
                'insurance_companies',
                'insurance_companies.company_id = insurance_policies.insurance_company_id',
                'left'
            )

            ->join(
                'insurance_policy_types',
                'insurance_policy_types.policy_type_id = insurance_policies.policy_type_id',
                'left'
            )

            ->join(
                'insurance_policy_terms',
                'insurance_policy_terms.policy_term_id = insurance_policies.policy_term_id',
                'left'
            )

            ->join(
                'customers',
                'customers.customer_id = insurance_policies.customer_id',
                'left'
            )

            ->join(
                'vehicles',
                'vehicles.vehicle_id = insurance_policies.vehicle_id',
                'left'
            )

            ->where(
                'insurance_policies.policy_id',
                $policy_id
            )

            ->get()
            ->row();
    }

    public function get_policy_coverages($policy_id)
    {
        return $this->db
            ->select('
                insurance_policy_coverages.*,

                insurance_coverage_types.coverage_type_name
            ')

            ->from('insurance_policy_coverages')

            ->join(
                'insurance_coverage_types',
                'insurance_coverage_types.coverage_type_id =
                insurance_policy_coverages.coverage_type_id',
                'left'
            )

            ->where(
                'insurance_policy_coverages.policy_id',
                $policy_id
            )

            ->get()
            ->result();
    }

    public function insert_policy($data)
    {
        $this->db->insert(
            'insurance_policies',
            $data
        );

        return $this->db->insert_id();
    }

    public function update_policy($id, $data)
    {
        return $this->db
            ->where('policy_id', $id)
            ->update(
                'insurance_policies',
                $data
            );
    }

    public function delete_policy($id)
    {
        $this->db
            ->where('policy_id', $id)
            ->delete('insurance_policy_documents');

        return $this->db
            ->where('policy_id', $id)
            ->delete('insurance_policies');
    }

    public function get_policy_document($policy_id)
    {
        return $this->db
            ->where('policy_id', $policy_id)
            ->order_by('document_id', 'DESC')
            ->get('insurance_policy_documents')
            ->result();
    }

    public function insert_policy_document($data)
    {
        return $this->db
            ->insert(
                'insurance_policy_documents',
                $data
            );
    }

    public function delete_policy_document($id)
    {
        return $this->db
            ->where('document_id', $id)
            ->delete('insurance_policy_documents');
    }

    public function get_customers()
    {
        return $this->db
            ->order_by('customer_id', 'DESC')
            ->get('customers')
            ->result();
    }

    public function get_vehicles_by_customer($customer_id)
	{
		return $this->db
			->where('customer_id', $customer_id)
			->order_by('vehicle_id', 'DESC')
			->get('vehicles')
			->result();
	}

    public function get_all_vehicles()
    {
        $this->db->select('vehicle_id, brand, registration_no');
        $this->db->from('vehicles');
        $this->db->order_by('vehicle_id', 'DESC');

        return $this->db->get()->result();
    }

    public function get_vehicle_with_customer($vehicle_id)
    {
        $this->db->select('
            v.vehicle_id,
            v.customer_id,
            v.brand,
            v.registration_no
        ');

        $this->db->from('vehicles v');
        $this->db->where('v.vehicle_id', $vehicle_id);

        return $this->db->get()->row();
    }

    public function insert_policy_coverage($data)
    {
        $this->db->insert(
            'insurance_policy_coverages',
            $data
        );

        return $this->db->insert_id();
    }

    public function delete_policy_coverages($policy_id)
    {
        return $this->db
            ->where('policy_id', $policy_id)
            ->delete('insurance_policy_coverages');
    }

}