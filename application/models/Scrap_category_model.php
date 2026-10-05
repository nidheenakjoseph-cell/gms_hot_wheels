<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scrap_category_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->order_by('category_name', 'ASC')->get('scrap_category')->result();
    }

    public function get_all_with_stock()
    {
        $categories = $this->get_all();
        foreach ($categories as $category) {
            $category->collected_qty = $this->get_collected_quantity($category->id);
            $category->sold_qty = $this->get_sold_quantity($category->id);
            $category->balance_qty = $category->collected_qty - $category->sold_qty;
        }
        return $categories;
    }

    public function get_active_categories()
    {
        return $this->db->where('is_active', 1)->order_by('category_name', 'ASC')->get('scrap_category')->result();
    }

    public function get($id)
    {
        return $this->db->where('id', $id)->get('scrap_category')->row();
    }

    public function insert($data)
    {
        $this->db->insert('scrap_category', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('scrap_category', $data);
    }

    public function is_used($id)
    {
        $collectionCount = $this->db->from('scrap_collection')->where('category_id', $id)->count_all_results();
        if ($collectionCount > 0) {
            return true;
        }

        $salesCount = $this->db->from('scrap_sales_items')->where('category_id', $id)->count_all_results();
        return $salesCount > 0;
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('scrap_category');
    }

    public function get_active_scrap_units()
    {
        return $this->db->select('unit_id, unit_name, unit_abbr')
            ->where('is_active', 1)
            ->order_by('unit_name', 'ASC')
            ->get('scrap_unit_master')
            ->result();
    }

    public function search_active_scrap_units($term = '')
    {
        $this->db->select('unit_id, unit_name, unit_abbr')
            ->from('scrap_unit_master')
            ->where('is_active', 1);

        if ($term !== '') {
            $this->db->group_start()
                ->like('unit_name', $term)
                ->or_like('unit_abbr', $term)
            ->group_end();
        }

        return $this->db->order_by('unit_name', 'ASC')->get()->result();
    }

    public function get_scrap_unit_by_name_abbr($unit_name, $unit_abbr)
    {
        return $this->db->group_start()
            ->where('unit_name', $unit_name)
            ->or_where('unit_abbr', $unit_abbr)
        ->group_end()
            ->get('scrap_unit_master')
            ->row();
    }

    public function insert_scrap_unit($unit_name, $unit_abbr)
    {
        $data = [
            'unit_name' => $unit_name,
            'unit_abbr' => $unit_abbr,
            'is_active' => 1,
        ];

        $this->db->insert('scrap_unit_master', $data);
        return $this->db->insert_id();
    }

    public function get_collected_quantity($category_id, $branch_id = null)
    {
        $this->db->select('COALESCE(SUM(quantity), 0) AS total')
            ->from('scrap_collection')
            ->where('category_id', $category_id);

        if (!empty($branch_id)) {
            $this->db->where('branch_id', $branch_id);
        }

        $row = $this->db->get()->row();
        return $row ? floatval($row->total) : 0;
    }

    public function get_sold_quantity($category_id, $branch_id = null)
    {
        $this->db->select('COALESCE(SUM(ssi.quantity), 0) AS total')
            ->from('scrap_sales_items ssi')
            ->join('scrap_sales ss', 'ss.id = ssi.sales_id', 'left')
            ->where('ssi.category_id', $category_id);

        if (!empty($branch_id)) {
            $this->db->where('ss.branch_id', $branch_id);
        }

        $row = $this->db->get()->row();
        return $row ? floatval($row->total) : 0;
    }
}
