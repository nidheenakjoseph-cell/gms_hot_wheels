<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseDashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Purchase_Model');
        $this->load->model('Dashboard_model');
    }


    /**
     * =========================================================
     * PURCHASE DASHBOARD
     * =========================================================
     */
    public function index()
    {
        $data['title'] = 'Purchase Dashboard';

        // -----------------------------------------------------
        // USER
        // -----------------------------------------------------
        $data['username'] =
            $this->session->userdata('username');

        $data['userid'] =
            $this->session->userdata('user_id');


        // -----------------------------------------------------
        // COMPANY
        // -----------------------------------------------------
        $data['company_name'] =
            $this->session->userdata('company_name');

        if (empty($data['company_name'])) {
            $data['company_name'] =
                'Garage Management System';
        }


        // -----------------------------------------------------
        // BRANCH
        // -----------------------------------------------------
        $data['selected_branch_name'] =
            'All Branches';

        $selected_branch_ids =
            get_selected_branch_ids();

        if (
            $selected_branch_ids !== 'all' &&
            !empty($selected_branch_ids)
        ) {

            $selected_branch_ids =
                array_map(
                    'intval',
                    $selected_branch_ids
                );

            if (count($selected_branch_ids) === 1) {

                $branch_id =
                    $selected_branch_ids[0];

                /*
                 * Get branch name directly.
                 *
                 * Change table/column only if your actual
                 * branch table uses a different name.
                 */
                $branch = $this->db
                    ->where('branch_id', $branch_id)
                    ->get('branches')
                    ->row();

                if (!empty($branch)) {

                    if (
                        isset($branch->branch_name) &&
                        !empty($branch->branch_name)
                    ) {
                        $data['selected_branch_name'] =
                            $branch->branch_name;
                    }
                    elseif (
                        isset($branch->name) &&
                        !empty($branch->name)
                    ) {
                        $data['selected_branch_name'] =
                            $branch->name;
                    }
                }

            } else {

                $data['selected_branch_name'] =
                    count($selected_branch_ids) .
                    ' Branches';
            }
        }


        // -----------------------------------------------------
        // DATE FILTER
        // -----------------------------------------------------
        $filter =
            $this->input->get('purchase_filter');

        $allowed_filters = [
            'today',
            'this_week',
            'this_month',
            '6_months',
            '12_months',
            'full_purchase'
        ];

        if (
            empty($filter) ||
            !in_array(
                $filter,
                $allowed_filters,
                true
            )
        ) {

            $filter = '12_months';
        }

        $data['purchase_filter'] =
            $filter;


        // -----------------------------------------------------
        // DATE RANGE
        // -----------------------------------------------------
        switch ($filter) {

            case 'today':

                $from_date = date('Y-m-d');
                $to_date   = date('Y-m-d');

                break;


            case 'this_week':

                $from_date =
                    date(
                        'Y-m-d',
                        strtotime('monday this week')
                    );

                $to_date =
                    date('Y-m-d');

                break;


            case 'this_month':

                $from_date =
                    date('Y-m-01');

                $to_date =
                    date('Y-m-d');

                break;


            case '6_months':

                $from_date =
                    date(
                        'Y-m-01',
                        strtotime('-5 months')
                    );

                $to_date =
                    date('Y-m-d');

                break;


            case 'full_purchase':

                $from_date = null;
                $to_date   = date('Y-m-d');

                break;


            case '12_months':
            default:

                $from_date =
                    date(
                        'Y-m-01',
                        strtotime('-11 months')
                    );

                $to_date =
                    date('Y-m-d');

                break;
        }


        $data['from_date'] = $from_date;
        $data['to_date']   = $to_date;


        // -----------------------------------------------------
        // PURCHASE SUMMARY
        // -----------------------------------------------------
        $data['purchase_summary'] =
            $this->Purchase_Model
                ->get_dashboard_purchase_summary(
                    $from_date,
                    $to_date
                );


        // -----------------------------------------------------
        // PURCHASE ORDER SUMMARY
        // -----------------------------------------------------
        $data['po_summary'] =
            $this->Purchase_Model
                ->get_dashboard_po_summary(
                    $from_date,
                    $to_date
                );


        // -----------------------------------------------------
        // PURCHASE TYPE SUMMARY
        // PARTS / SERVICE
        // -----------------------------------------------------
        $data['purchase_type_summary'] =
            $this->Purchase_Model
                ->get_dashboard_purchase_type_summary(
                    $from_date,
                    $to_date
                );


        // -----------------------------------------------------
        // SUPPLIER SUMMARY
        // -----------------------------------------------------
        $data['supplier_summary'] =
            $this->Purchase_Model
                ->get_dashboard_supplier_summary(
                    $from_date,
                    $to_date
                );


        // -----------------------------------------------------
        // PURCHASE RETURN
        // -----------------------------------------------------
        $data['purchase_return_summary'] =
            $this->Purchase_Model
                ->get_dashboard_purchase_return_summary(
                    $from_date,
                    $to_date
                );


        // -----------------------------------------------------
        // GRN SUMMARY
        // -----------------------------------------------------
        $data['grn_summary'] =
            $this->Purchase_Model
                ->get_dashboard_grn_summary(
                    $from_date,
                    $to_date
                );


        // -----------------------------------------------------
        // PAYMENT SUMMARY
        // -----------------------------------------------------
        $data['payment_summary'] =
            $this->Purchase_Model
                ->get_dashboard_purchase_payment_summary(
                    $from_date,
                    $to_date
                );


        // -----------------------------------------------------
        // MONTHLY PURCHASE CHART
        // -----------------------------------------------------
        $data['purchase_chart'] =
            $this->Purchase_Model
                ->get_dashboard_purchase_chart(
                    $filter,
                    $from_date,
                    $to_date
                );


        // -----------------------------------------------------
        // PO STATUS CHART
        // -----------------------------------------------------
        $data['po_status_chart'] =
            $this->Purchase_Model
                ->get_dashboard_po_status_chart(
                    $from_date,
                    $to_date
                );


        // -----------------------------------------------------
        // TOP SUPPLIERS
        // -----------------------------------------------------
        $data['top_suppliers'] =
            $this->Purchase_Model
                ->get_dashboard_top_suppliers(
                    $from_date,
                    $to_date
                );


        // -----------------------------------------------------
        // RECENT PURCHASE ORDERS
        // -----------------------------------------------------
        $data['recent_purchase_orders'] =
            $this->Purchase_Model
                ->get_dashboard_recent_purchase_orders(
                    10,
                    $from_date,
                    $to_date
                );


        // -----------------------------------------------------
        // RECENT GRNs
        // -----------------------------------------------------
        $data['recent_grns'] =
            $this->Purchase_Model
                ->get_dashboard_recent_grns(
                    10,
                    $from_date,
                    $to_date
                );


        // -----------------------------------------------------
        // RECENT PURCHASE RETURNS
        // -----------------------------------------------------
        $data['recent_purchase_returns'] =
            $this->Purchase_Model
                ->get_dashboard_recent_purchase_returns(
                    10,
                    $from_date,
                    $to_date
                );


        // -----------------------------------------------------
        // LOAD VIEW
        // -----------------------------------------------------
        $data['main_content'] =
            'purchase/purchase_dashboard.php';

        $this->load->view(
            'includes/template.php',
            $data
        );
    }
}

