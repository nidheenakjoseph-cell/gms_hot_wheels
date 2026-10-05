<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountsDashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(
            'Accounts_dashboard_model'
        );

        $this->load->database();

        $this->load->helper(
            array(
                'url',
                'security'
            )
        );
    }

    public function index()
    {

        $branch_id =
            $this->input->get(
                'branch_id',
                TRUE
            );

        $from_date =
            $this->input->get(
                'from_date',
                TRUE
            );

        $to_date =
            $this->input->get(
                'to_date',
                TRUE
            );

        if (
            $branch_id !== NULL &&
            $branch_id !== ''
        ) {

            $branch_id =
                (int)$branch_id;

        } else {

            $branch_id = NULL;

        }

        if (
            empty($from_date) ||
            !strtotime($from_date)
        ) {

            $from_date =
                date('Y-m-01');

        }

        if (
            empty($to_date) ||
            !strtotime($to_date)
        ) {

            $to_date =
                date('Y-m-t');

        }

        if (
            strtotime($from_date) >
            strtotime($to_date)
        ) {

            $temp = $from_date;

            $from_date = $to_date;

            $to_date = $temp;

        }

        $branches = $this->db
            ->select(
                'branch_id, branch_name'
            )
            ->from('branches')
            ->where(
                'is_active',
                1
            )
            ->order_by(
                'branch_name',
                'ASC'
            )
            ->get()
            ->result();

        $accounts_summary =
            $this->Accounts_dashboard_model
                ->get_accounts_summary(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $monthly_cash_flow =
            $this->Accounts_dashboard_model
                ->get_monthly_cash_flow(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $accounts_chart =
            $this->Accounts_dashboard_model
                ->get_accounts_chart(
                    $branch_id,
                    $from_date,
                    $to_date
                );

        $outstanding_receivables =
            $this->Accounts_dashboard_model
                ->get_receivables(
                    $branch_id,
                    $from_date,
                    $to_date,
                    10
                );

        $outstanding_payables =
            $this->Accounts_dashboard_model
                ->get_payables(
                    $branch_id,
                    $from_date,
                    $to_date,
                    10
                );

        $recent_receipts =
            $this->Accounts_dashboard_model
                ->get_recent_receipts(
                    $branch_id,
                    $from_date,
                    $to_date,
                    5
                );

        $recent_payments =
            $this->Accounts_dashboard_model
                ->get_recent_payments(
                    $branch_id,
                    $from_date,
                    $to_date,
                    5
                );

        $recent_expenses =
            $this->Accounts_dashboard_model
                ->get_recent_expenses(
                    $branch_id,
                    $from_date,
                    $to_date,
                    5
                );

        $data = array(

            'branches' =>
                $branches,

            'selected_branch_id' =>
                $branch_id,

            'selected_from_date' =>
                $from_date,

            'selected_to_date' =>
                $to_date,

            'accounts_summary' =>
                $accounts_summary,

            'accounts_chart' =>
                $accounts_chart,

            'outstanding_receivables' =>
                $outstanding_receivables,

            'outstanding_payables' =>
                $outstanding_payables,

            'recent_receipts' => $recent_receipts,

            'recent_payments' => $recent_payments,

            'recent_expenses' => $recent_expenses,

            'monthly_cash_flow' =>
                $monthly_cash_flow,
        );

        $data['main_content'] =
            'accounts/accounts_dashboard';

        $this->load->view(
            'includes/template',
            $data
        );
    }
}