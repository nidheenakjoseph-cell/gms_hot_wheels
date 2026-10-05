<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Branch_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db
            ->select('branches.*, cm.company_name, cm.company_code')
            ->join('company_master cm', 'cm.company_id = branches.company_id', 'left')
            ->order_by('branches.is_main_branch DESC, branches.is_active DESC, branches.branch_name ASC')
            ->get('branches')
            ->result();
    }

    public function get_active($company_id = null)
    {
        if ($company_id) {
            $this->db->where('branches.company_id', (int) $company_id);
        }
        return $this->db
            ->where('is_active', 1)
            ->order_by('is_main_branch DESC, branch_name ASC')
            ->get('branches')
            ->result();
    }

    public function get_by_company($company_id, $active_only = true)
    {
        $this->db->where('company_id', (int) $company_id);
        if ($active_only) {
            $this->db->where('is_active', 1);
        }
        return $this->db
            ->order_by('is_main_branch DESC, branch_name ASC')
            ->get('branches')
            ->result();
    }

    public function get($branch_id)
    {
        return $this->db
            ->where('branch_id', $branch_id)
            ->get('branches')
            ->row();
    }

    public function get_by_code($code)
    {
        return $this->db
            ->where('branch_code', $code)
            ->get('branches')
            ->row();
    }

    public function insert($data)
    {
        $this->db->insert('branches', $data);
        return $this->db->insert_id();
    }

    public function update($branch_id, $data)
    {
        $this->db->where('branch_id', $branch_id);
        return $this->db->update('branches', $data);
    }

    public function delete($branch_id)
    {
        // Don't delete main branch
        $branch = $this->get($branch_id);
        if ($branch && $branch->is_main_branch) {
            return false;
        }

        $this->db->where('branch_id', $branch_id);
        return $this->db->delete('branches');
    }

    public function generate_branch_code()
    {
        $last = $this->db
            ->select('branch_code')
            ->order_by('branch_id', 'DESC')
            ->limit(1)
            ->get('branches')
            ->row();

        if (!$last || empty($last->branch_code)) {
            return 'BR001';
        }

        $num = intval(preg_replace('/[^0-9]/', '', $last->branch_code)) + 1;
        return 'BR' . str_pad($num, 3, '0', STR_PAD_LEFT);
    }
}
