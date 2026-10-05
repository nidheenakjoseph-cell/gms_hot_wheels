<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scrap_collection_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all($branch_id = null)
    {
        if (!empty($branch_id)) {
            $this->db->where('sc.branch_id', $branch_id);
        } else {
            apply_branch_filter('sc');
        }

        return $this->db
            ->select('sc.*, c.category_name, c.unit, b.branch_name')
            ->from('scrap_collection sc')
            ->join('scrap_category c', 'c.id = sc.category_id', 'left')
            ->join('branches b', 'b.branch_id = sc.branch_id', 'left')
            ->order_by('sc.collection_date', 'DESC')
            ->get()
            ->result();
    }

    public function get($id)
    {
        return $this->db->where('sc.id', $id)
            ->select('sc.*, c.category_name, c.unit')
            ->from('scrap_collection sc')
            ->join('scrap_category c', 'c.id = sc.category_id', 'left')
            ->get()
            ->row();
    }

    public function insert($data)
    {
        $this->db->insert('scrap_collection', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('scrap_collection', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('scrap_collection');
    }
}
