<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InventoryDashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Inventory_dashboard_model');
    }

    public function inventory_dashboard()
    {
        $data['title'] = 'Inventory Dashboard';

        $branch_id = $this->input->get('branch_id');

        if ($branch_id === null || $branch_id === '') {
            $branch_id = $this->session->userdata('branch_id');
        }

        $data['selected_branch_id'] = $branch_id;

        $from_date = $this->input->get('from_date');
        $to_date   = $this->input->get('to_date');

        if (empty($from_date)) {
            $from_date = date('Y-m-01');
        }

        if (empty($to_date)) {
            $to_date = date('Y-m-d');
        }

        if ($from_date > $to_date) {
            $from_date = date('Y-m-01');
            $to_date   = date('Y-m-d');
        }

        $data['selected_from_date'] = $from_date;
        $data['selected_to_date']   = $to_date;

        $data['branches'] = $this->db
            ->select('branch_id, branch_name')
            ->from('branches')
            ->where('is_active', 1)
            ->order_by('branch_name', 'ASC')
            ->get()
            ->result();


        $data['selected_branch_name'] =
            $this->get_branch_name($branch_id);

        $data['inventory_summary'] =
            $this->Inventory_dashboard_model
                ->get_inventory_summary(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $data['stock_summary'] =
            $this->Inventory_dashboard_model
                ->get_stock_summary(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $data['low_stock_summary'] =
            $this->Inventory_dashboard_model
                ->get_low_stock_summary(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $data['out_of_stock_summary'] =
            $this->Inventory_dashboard_model
                ->get_out_of_stock_summary(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $data['part_type_summary'] =
            $this->Inventory_dashboard_model
                ->get_part_type_summary(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $data['brand_summary'] =
            $this->Inventory_dashboard_model
                ->get_brand_summary(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $data['inventory_chart'] =
            $this->Inventory_dashboard_model
                ->get_inventory_chart(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $data['stock_status_chart'] =
            $this->Inventory_dashboard_model
                ->get_stock_status_chart(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $data['low_stock_parts'] =
            $this->Inventory_dashboard_model
                ->get_low_stock_parts(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $data['recent_stock_in'] =
            $this->Inventory_dashboard_model
                ->get_recent_stock_in(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $data['top_inventory_items'] =
            $this->Inventory_dashboard_model
                ->get_top_inventory_items(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $data['main_content'] =
            'inventory/inventory_dashboard';

        $this->load->view(
            'includes/template',
            $data
        );
    }

    private function get_branch_name($branch_id)
    {
        if (empty($branch_id)) {
            return 'All Branches';
        }

        $branch = $this->db
            ->select('branch_name')
            ->from('branches')
            ->where('branch_id', $branch_id)
            ->get()
            ->row();

        return $branch
            ? $branch->branch_name
            : 'All Branches';
    }
}