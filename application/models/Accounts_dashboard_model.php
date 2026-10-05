<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_dashboard_model extends CI_Model
{

    protected $income_root_group = 3;

    protected $expense_root_group = 4;
    protected $asset_root_group   = NULL;
    protected $liability_root_group = NULL;

    protected $cash_group_no = 21;

    protected $bank_group_no = 19;

    public function __construct()
    {
        parent::__construct();
    }

    private function get_child_group_ids($parent_group)
    {
        if ($parent_group === NULL) {
            return array();
        }

        $groups = $this->db
            ->select('group_no')
            ->from('account_group')
            ->where('parent_group', $parent_group)
            ->get()
            ->result();

        $ids = array();

        foreach ($groups as $group) {

            $ids[] = $group->group_no;

            $children = $this->get_child_group_ids(
                $group->group_no
            );

            if (!empty($children)) {
                $ids = array_merge($ids, $children);
            }
        }

        return array_unique($ids);
    }

    private function get_group_tree_ids($root_group)
    {
        if ($root_group === NULL) {
            return array();
        }

        $ids = array($root_group);

        $children = $this->get_child_group_ids(
            $root_group
        );

        if (!empty($children)) {
            $ids = array_merge(
                $ids,
                $children
            );
        }

        return array_unique($ids);
    }

    private function apply_date_filter(
        $from_date = NULL,
        $to_date = NULL
    ) {

        if (!empty($from_date)) {

            $this->db->where(
                'vt.voucher_date >=',
                $from_date . ' 00:00:00'
            );

        }

        if (!empty($to_date)) {

            $this->db->where(
                'vt.voucher_date <=',
                $to_date . ' 23:59:59'
            );

        }
    }

    private function apply_branch_filter(
        $branch_id = NULL
    ) {

    }

    public function get_total_income(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $group_ids = $this->get_group_tree_ids(
            $this->income_root_group
        );

        if (empty($group_ids)) {
            return 0;
        }

        $this->db
            ->select("
                COALESCE(
                    SUM(
                        CASE
                            WHEN UPPER(vt.drcr_type) = 'CR'
                                THEN vt.amount
                            WHEN UPPER(vt.drcr_type) = 'DR'
                                THEN -vt.amount
                            ELSE 0
                        END
                    ),
                    0
                ) AS total_income
            ", FALSE)
            ->from('voucher_transaction vt')
            ->join(
                'general_ledger gl',
                'gl.account_id = vt.account_id',
                'inner'
            )
            ->where_in(
                'gl.group_no',
                $group_ids
            )
            ->where('vt.cancel', 0);

        $this->apply_date_filter(
            $from_date,
            $to_date
        );

        $this->apply_branch_filter(
            $branch_id
        );

        $row = $this->db
            ->get()
            ->row();

        return !empty($row)
            ? (float)$row->total_income
            : 0;
    }

    public function get_total_expense(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        if ($this->expense_root_group === NULL) {
            return 0;
        }

        $group_ids = $this->get_group_tree_ids(
            $this->expense_root_group
        );

        if (empty($group_ids)) {
            return 0;
        }

        $this->db
            ->select("
                COALESCE(
                    SUM(
                        CASE
                            WHEN UPPER(vt.drcr_type) = 'DR'
                                THEN vt.amount
                            WHEN UPPER(vt.drcr_type) = 'CR'
                                THEN -vt.amount
                            ELSE 0
                        END
                    ),
                    0
                ) AS total_expense
            ", FALSE)
            ->from('voucher_transaction vt')
            ->join(
                'general_ledger gl',
                'gl.account_id = vt.account_id',
                'inner'
            )
            ->where_in(
                'gl.group_no',
                $group_ids
            )
            ->where('vt.cancel', 0);

        $this->apply_date_filter(
            $from_date,
            $to_date
        );

        $this->apply_branch_filter(
            $branch_id
        );

        $row = $this->db
            ->get()
            ->row();

        return !empty($row)
            ? (float)$row->total_expense
            : 0;
    }

    public function get_income_transaction_count(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $group_ids = $this->get_group_tree_ids(
            $this->income_root_group
        );

        if (empty($group_ids)) {
            return 0;
        }

        $this->db
            ->select('COUNT(DISTINCT vt.trans_id) AS transaction_count')
            ->from('voucher_transaction vt')
            ->join(
                'general_ledger gl',
                'gl.account_id = vt.account_id',
                'inner'
            )
            ->where_in(
                'gl.group_no',
                $group_ids
            )
            ->where('vt.cancel', 0);

        $this->apply_date_filter(
            $from_date,
            $to_date
        );

        $this->apply_branch_filter(
            $branch_id
        );

        $row = $this->db
            ->get()
            ->row();

        return !empty($row)
            ? (int)$row->transaction_count
            : 0;
    }

    public function get_expense_transaction_count(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        if ($this->expense_root_group === NULL) {
            return 0;
        }

        $group_ids = $this->get_group_tree_ids(
            $this->expense_root_group
        );

        if (empty($group_ids)) {
            return 0;
        }

        $this->db
            ->select('COUNT(DISTINCT vt.trans_id) AS transaction_count')
            ->from('voucher_transaction vt')
            ->join(
                'general_ledger gl',
                'gl.account_id = vt.account_id',
                'inner'
            )
            ->where_in(
                'gl.group_no',
                $group_ids
            )
            ->where('vt.cancel', 0);

        $this->apply_date_filter(
            $from_date,
            $to_date
        );

        $this->apply_branch_filter(
            $branch_id
        );

        $row = $this->db
            ->get()
            ->row();

        return !empty($row)
            ? (int)$row->transaction_count
            : 0;
    }

    public function get_income_categories(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $group_ids = $this->get_group_tree_ids(
            $this->income_root_group
        );

        if (empty($group_ids)) {
            return array();
        }

        $this->db
            ->select("
                gl.group_no,
                ag.group_name AS category_name,

                COUNT(DISTINCT vt.trans_id)
                    AS transaction_count,

                COALESCE(
                    SUM(
                        CASE
                            WHEN UPPER(vt.drcr_type) = 'CR'
                                THEN vt.amount
                            WHEN UPPER(vt.drcr_type) = 'DR'
                                THEN -vt.amount
                            ELSE 0
                        END
                    ),
                    0
                ) AS amount
            ", FALSE)
            ->from('voucher_transaction vt')
            ->join(
                'general_ledger gl',
                'gl.account_id = vt.account_id',
                'inner'
            )
            ->join(
                'account_group ag',
                'ag.group_no = gl.group_no',
                'left'
            )
            ->where_in(
                'gl.group_no',
                $group_ids
            )
            ->where('vt.cancel', 0)
            ->group_by('gl.group_no')
            ->order_by('amount', 'DESC');

        $this->apply_date_filter(
            $from_date,
            $to_date
        );

        $this->apply_branch_filter(
            $branch_id
        );

        return $this->db
            ->get()
            ->result();
    }

    public function get_expense_categories(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        if ($this->expense_root_group === NULL) {
            return array();
        }

        $group_ids = $this->get_group_tree_ids(
            $this->expense_root_group
        );

        if (empty($group_ids)) {
            return array();
        }

        $this->db
            ->select("
                gl.group_no,
                ag.group_name AS category_name,

                COUNT(DISTINCT vt.trans_id)
                    AS transaction_count,

                COALESCE(
                    SUM(
                        CASE
                            WHEN UPPER(vt.drcr_type) = 'DR'
                                THEN vt.amount
                            WHEN UPPER(vt.drcr_type) = 'CR'
                                THEN -vt.amount
                            ELSE 0
                        END
                    ),
                    0
                ) AS amount
            ", FALSE)
            ->from('voucher_transaction vt')
            ->join(
                'general_ledger gl',
                'gl.account_id = vt.account_id',
                'inner'
            )
            ->join(
                'account_group ag',
                'ag.group_no = gl.group_no',
                'left'
            )
            ->where_in(
                'gl.group_no',
                $group_ids
            )
            ->where('vt.cancel', 0)
            ->group_by('gl.group_no')
            ->order_by('amount', 'DESC');

        $this->apply_date_filter(
            $from_date,
            $to_date
        );

        $this->apply_branch_filter(
            $branch_id
        );

        return $this->db
            ->get()
            ->result();
    }

    public function get_accounts_chart(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        if (empty($from_date)) {

            $from_date = date(
                'Y-m-01',
                strtotime('-5 months')
            );
        }

        if (empty($to_date)) {

            $to_date = date('Y-m-t');
        }

        $income_groups = $this->get_group_tree_ids(
            $this->income_root_group
        );

        $expense_groups = array();

        if ($this->expense_root_group !== NULL) {

            $expense_groups = $this->get_group_tree_ids(
                $this->expense_root_group
            );
        }

        $chart = array(
            'labels' => array(),
            'income' => array(),
            'expense' => array()
        );

        if (
            empty($income_groups) &&
            empty($expense_groups)
        ) {
            return $chart;
        }

        $income_condition = '0';

        if (!empty($income_groups)) {

            $income_condition =
                'gl.group_no IN (' .
                implode(
                    ',',
                    array_map(
                        'intval',
                        $income_groups
                    )
                ) .
            ')';
        }

        $expense_condition = '0';

        if (!empty($expense_groups)) {

            $expense_condition =
                'gl.group_no IN (' .
                implode(
                    ',',
                    array_map(
                        'intval',
                        $expense_groups
                    )
                ) .
            ')';
        }

        $this->db
            ->select("
                DATE_FORMAT(
                    vt.voucher_date,
                    '%b %Y'
                ) AS month,

                DATE_FORMAT(
                    vt.voucher_date,
                    '%Y-%m'
                ) AS month_sort,

                COALESCE(
                    SUM(
                        CASE

                            WHEN {$income_condition}
                            THEN
                                CASE

                                    WHEN UPPER(vt.drcr_type) = 'CR'
                                    THEN vt.amount

                                    WHEN UPPER(vt.drcr_type) = 'DR'
                                    THEN -vt.amount

                                    ELSE 0

                                END

                            ELSE 0

                        END
                    ),
                    0
                ) AS income,

                COALESCE(
                    SUM(
                        CASE

                            WHEN {$expense_condition}
                            THEN
                                CASE

                                    WHEN UPPER(vt.drcr_type) = 'DR'
                                    THEN vt.amount

                                    WHEN UPPER(vt.drcr_type) = 'CR'
                                    THEN -vt.amount

                                    ELSE 0

                                END

                            ELSE 0

                        END
                    ),
                    0
                ) AS expense

            ", FALSE)

            ->from('voucher_transaction vt')

            ->join(
                'general_ledger gl',
                'gl.account_id = vt.account_id',
                'inner'
            )

            ->where(
                'vt.voucher_date >=',
                $from_date . ' 00:00:00'
            )

            ->where(
                'vt.voucher_date <=',
                $to_date . ' 23:59:59'
            )

            ->where(
                '(vt.cancel IS NULL OR vt.cancel = 0)',
                NULL,
                FALSE
            );

        if (!empty($branch_id)) {

            $this->db->where(
                'vt.branch_id',
                $branch_id
            );
        }

        $this->db
            ->group_by(
                "DATE_FORMAT(vt.voucher_date, '%Y-%m')"
            )
            ->order_by(
                'month_sort',
                'ASC'
            );

        $rows = $this->db
            ->get()
            ->result_array();

        foreach ($rows as $row) {

            $chart['labels'][] =
                $row['month'];

            $chart['income'][] =
                (float)$row['income'];

            $chart['expense'][] =
                (float)$row['expense'];
        }

        return $chart;
    }

    public function get_payment_status_chart(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $this->db
            ->select("
                COUNT(
                    CASE
                        WHEN
                            COALESCE(ip.total_paid, 0)
                            >= i.grand_total
                        THEN 1
                    END
                ) AS paid,

                COUNT(
                    CASE
                        WHEN
                            COALESCE(ip.total_paid, 0) > 0
                            AND
                            COALESCE(ip.total_paid, 0)
                            < i.grand_total
                        THEN 1
                    END
                ) AS partial,

                COUNT(
                    CASE
                        WHEN
                            COALESCE(ip.total_paid, 0) = 0
                        THEN 1
                    END
                ) AS pending
            ", FALSE)
            ->from('invoices i')
            ->join(
                '(SELECT
                    invoice_id,
                    SUM(amount) AS total_paid
                  FROM invoice_payments
                  GROUP BY invoice_id
                ) ip',
                'ip.invoice_id = i.invoice_id',
                'left'
            );

        if (!empty($from_date)) {

            $this->db->where(
                'DATE(i.created_at) >=',
                $from_date
            );

        }

        if (!empty($to_date)) {

            $this->db->where(
                'DATE(i.created_at) <=',
                $to_date
            );

        }

        $row = $this->db
            ->get()
            ->row();

        return array(
            'paid'    => !empty($row->paid)
                ? (int)$row->paid
                : 0,

            'partial' => !empty($row->partial)
                ? (int)$row->partial
                : 0,

            'pending' => !empty($row->pending)
                ? (int)$row->pending
                : 0
        );
    }

    public function get_recent_transactions(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL,
        $limit = 10
    ) {

        $this->db
            ->select("
                vt.trans_id,
                vt.voucher_date AS transaction_date,
                vt.voucher_type,
                vt.drcr_type,
                vt.amount,

                gl.account_id,
                gl.group_no,

                ag.group_name AS category_name
            ", FALSE)
            ->from('voucher_transaction vt')
            ->join(
                'general_ledger gl',
                'gl.account_id = vt.account_id',
                'left'
            )
            ->join(
                'account_group ag',
                'ag.group_no = gl.group_no',
                'left'
            )
            ->where(
                'vt.cancel',
                0
            )
            ->order_by(
                'vt.voucher_date',
                'DESC'
            )
            ->limit($limit);

        $this->apply_date_filter(
            $from_date,
            $to_date
        );

        $this->apply_branch_filter(
            $branch_id
        );

        return $this->db
            ->get()
            ->result();
    }

    public function get_receivables(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL,
        $limit = 10
    ) {

        $this->db
            ->select("
                i.invoice_id,
                i.invoice_no,
                i.invoice_date,
                i.created_at,

                j.customer_id,
                c.name,

                COALESCE(i.grand_total, 0) AS invoice_amount,

                COALESCE(i.paid_amt, 0) AS paid_amount,

                COALESCE(i.adv_paid, 0) AS advance_amount,

                (
                    COALESCE(i.grand_total, 0)
                    - COALESCE(i.paid_amt, 0)
                    - COALESCE(i.adv_paid, 0)
                ) AS outstanding_amount
            ", FALSE)

            ->from('invoices i')

            ->join(
                'job_cards j',
                'j.jobcard_id = i.jobcard_id',
                'left'
            )

            ->join(
                'customers c',
                'c.customer_id = j.customer_id',
                'left'
            )

            ->where("
                (
                    COALESCE(i.grand_total, 0)
                    - COALESCE(i.paid_amt, 0)
                    - COALESCE(i.adv_paid, 0)
                ) > 0
            ", NULL, FALSE);

        if (!empty($branch_id)) {
            $this->db->where(
                'i.branch_id',
                (int)$branch_id
            );
        }

        if (!empty($from_date)) {
            $this->db->where(
                'i.invoice_date >=',
                $from_date
            );
        }

        if (!empty($to_date)) {
            $this->db->where(
                'i.invoice_date <=',
                $to_date
            );
        }

        $this->db
            ->order_by(
                'outstanding_amount',
                'DESC'
            )
            ->limit((int)$limit);

        return $this->db
            ->get()
            ->result();
    }

    public function get_total_receivables(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $this->db
            ->select("
                COALESCE(
                    SUM(
                        COALESCE(i.grand_total, 0)
                        -
                        COALESCE(i.paid_amt, 0)
                        -
                        COALESCE(i.adv_paid, 0)
                    ),
                    0
                ) AS receivables
            ", FALSE)
            ->from('invoices i');

        if (!empty($from_date)) {
            $this->db->where(
                'DATE(i.invoice_date) >=',
                $from_date
            );
        }

        if (!empty($to_date)) {
            $this->db->where(
                'DATE(i.invoice_date) <=',
                $to_date
            );
        }

        if (!empty($branch_id)) {
            $this->db->where(
                'i.branch_id',
                $branch_id
            );
        }

        $row = $this->db
            ->get()
            ->row();

        return !empty($row)
            ? (float)$row->receivables
            : 0;
    }

    public function get_accounts_summary(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $total_income =
            $this->get_total_income(
                $branch_id,
                $from_date,
                $to_date
            );

        $total_expense =
            $this->get_total_expense(
                $branch_id,
                $from_date,
                $to_date
            );

        $receivables =
            $this->get_total_receivables(
                $branch_id,
                $from_date,
                $to_date
            );

        $payables =
            $this->get_total_payables(
                $branch_id,
                $from_date,
                $to_date
            );

        $cash_balance =
            $this->get_cash_balance(
                $branch_id,
                $from_date,
                $to_date
            );

        $bank_balance =
            $this->get_bank_balance(
                $branch_id,
                $from_date,
                $to_date
            );

        return array(

            'total_income' =>
                $total_income,

            'total_expense' =>
                $total_expense,

            'net_profit' =>
                $total_income -
                $total_expense,

            'receivables' =>
                $receivables,

            'payables' =>
                $payables,

            'cash_balance' => $cash_balance,

            'bank_balance' =>
                        $bank_balance
        );
    }

    public function get_total_payables(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $this->db
            ->select('
                COALESCE(
                    SUM(COALESCE(pgm.grand_total, 0)),
                    0
                ) AS total
            ', FALSE)
            ->from('purchase_grn_master pgm')
            ->join(
                'purchase_order_master pom',
                'pom.grn_id = pgm.grn_id',
                'inner'
            )
            ->where('pgm.fully_payment', 0)
            ->where('(pgm.status IS NULL OR pgm.status != 1)', NULL, FALSE);

        if (!empty($branch_id)) {
            $this->db->where(
                'pom.branch_id',
                $branch_id
            );
        }

        if (!empty($from_date)) {
            $this->db->where(
                'pgm.grn_date >=',
                $from_date
            );
        }

        if (!empty($to_date)) {
            $this->db->where(
                'pgm.grn_date <=',
                $to_date
            );
        }

        $query = $this->db
            ->get()
            ->row();

        return isset($query->total)
            ? (float) $query->total
            : 0;
    }

    private function get_group_balance(
        $group_no,
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        $result = $this->db
            ->select("
                COALESCE(
                    SUM(
                        CASE
                            WHEN UPPER(gl.opening_bal_type) = 'DR'
                                THEN COALESCE(gl.opening_balance, 0)

                            WHEN UPPER(gl.opening_bal_type) = 'CR'
                                THEN -COALESCE(gl.opening_balance, 0)

                            ELSE COALESCE(gl.opening_balance, 0)
                        END
                    ),
                    0
                ) AS opening_balance
            ", FALSE)
            ->from('general_ledger gl')
            ->where('gl.group_no', $group_no)
            ->get()
            ->row();

        $opening_balance = !empty($result)
            ? (float)$result->opening_balance
            : 0;

        $this->db
            ->select("
                COALESCE(
                    SUM(
                        CASE
                            WHEN UPPER(vt.drcr_type) = 'DR'
                                THEN vt.amount

                            WHEN UPPER(vt.drcr_type) = 'CR'
                                THEN -vt.amount

                            ELSE 0
                        END
                    ),
                    0
                ) AS transaction_balance
            ", FALSE)
            ->from('voucher_transaction vt')
            ->join(
                'general_ledger gl',
                'gl.account_id = vt.account_id',
                'inner'
            )
            ->where(
                'gl.group_no',
                $group_no
            )
            ->where(
                '(vt.cancel IS NULL OR vt.cancel = 0)',
                NULL,
                FALSE
            );

        if (!empty($branch_id)) {
            $this->db->where(
                'vt.branch_id',
                $branch_id
            );
        }

        if (!empty($from_date)) {
            $this->db->where(
                'vt.voucher_date >=',
                $from_date . ' 00:00:00'
            );
        }

        if (!empty($to_date)) {
            $this->db->where(
                'vt.voucher_date <=',
                $to_date . ' 23:59:59'
            );
        }

        $transactions = $this->db
            ->get()
            ->row();

        $transaction_balance = !empty($transactions)
            ? (float)$transactions->transaction_balance
            : 0;


        return $opening_balance + $transaction_balance;
    }

    public function get_cash_balance(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        if ($this->cash_group_no === NULL) {
            return 0;
        }

        return $this->get_group_balance(
            $this->cash_group_no,
            $branch_id,
            $from_date,
            $to_date
        );
    }

    public function get_bank_balance(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        if ($this->bank_group_no === NULL) {
            return 0;
        }

        return $this->get_group_balance(
            $this->bank_group_no,
            $branch_id,
            $from_date,
            $to_date
        );
    }

    public function get_monthly_cash_flow(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL
    ) {

        if (empty($from_date)) {
            $from_date = date(
                'Y-m-01',
                strtotime('-5 months')
            );
        }

        if (empty($to_date)) {
            $to_date = date('Y-m-t');
        }

        $this->db
            ->select("
                DATE_FORMAT(
                    vt.voucher_date,
                    '%b %Y'
                ) AS month,

                DATE_FORMAT(
                    vt.voucher_date,
                    '%Y-%m'
                ) AS month_sort,

                COALESCE(
                    SUM(
                        CASE
                            WHEN UPPER(vt.drcr_type) = 'DR'
                            THEN vt.amount
                            ELSE 0
                        END
                    ),
                    0
                ) AS cash_in,

                COALESCE(
                    SUM(
                        CASE
                            WHEN UPPER(vt.drcr_type) = 'CR'
                            THEN vt.amount
                            ELSE 0
                        END
                    ),
                    0
                ) AS cash_out
            ", FALSE)

            ->from('voucher_transaction vt')

            ->join(
                'general_ledger gl',
                'gl.account_id = vt.account_id'
            )

            ->where_in(
                'gl.group_no',
                array(
                    19,
                    20,
                    21
                )
            )

            ->where(
                'vt.voucher_date >=',
                $from_date . ' 00:00:00'
            )

            ->where(
                'vt.voucher_date <=',
                $to_date . ' 23:59:59'
            )

            ->where(
                '(vt.cancel IS NULL OR vt.cancel = 0)',
                NULL,
                FALSE
            );

        if (!empty($branch_id)) {

            $this->db->where(
                'vt.branch_id',
                $branch_id
            );

        }

        return $this->db

            ->group_by(
                "DATE_FORMAT(vt.voucher_date, '%Y-%m')"
            )

            ->order_by(
                'month_sort',
                'ASC'
            )

            ->get()

            ->result_array();
    }

    public function get_payables(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL,
        $limit = 10
    ) {

        $this->db
            ->select("
                g.grn_id,
                g.grn_code,
                g.grn_date AS due_date,

                s.supplier_name,

                COALESCE(
                    g.grand_total,
                    0
                ) AS outstanding_amount
            ", FALSE)

            ->from('purchase_grn_master g')

            ->join(
                'purchase_order_master po',
                'po.grn_id = g.grn_id',
                'inner'
            )

            ->join(
                'supplier_master s',
                's.supplier_id = g.supplier_id',
                'left'
            )

            ->where(
                'g.fully_payment',
                0
            )

            ->where(
                '(g.status IS NULL OR g.status != 1)',
                NULL,
                FALSE
            );

        if (!empty($branch_id)) {

            $this->db->where(
                'po.branch_id',
                (int)$branch_id
            );
        }

        if (!empty($from_date)) {

            $this->db->where(
                'g.grn_date >=',
                $from_date
            );
        }

        if (!empty($to_date)) {

            $this->db->where(
                'g.grn_date <=',
                $to_date
            );
        }

        $this->db
            ->order_by(
                'outstanding_amount',
                'DESC'
            )
            ->limit(
                (int)$limit
            );

        return $this->db
            ->get()
            ->result();
    }

    public function get_recent_receipts(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL,
        $limit = 5
    ) {

        $this->db
            ->select("
                v.voucher_date,
                v.voucher_code,
                v.amount,
                v.narration,

                COALESCE(
                    c.name,
                    gl.account_name
                ) AS customer_name
            ", FALSE)

            ->from('voucher_transaction v')

            ->join(
                'customers c',
                'c.customer_id = v.customer_id',
                'left'
            )

            ->join(
                'general_ledger gl',
                'gl.customer_id = v.customer_id',
                'left'
            )

            ->where(
                'v.voucher_type',
                'R'
            )

            ->where(
                '(v.cancel IS NULL OR v.cancel = 0)',
                NULL,
                FALSE
            );

        if (!empty($branch_id)) {

            $this->db->where(
                'v.branch_id',
                (int)$branch_id
            );
        }

        if (!empty($from_date)) {

            $this->db->where(
                'v.voucher_date >=',
                $from_date . ' 00:00:00'
            );
        }

        if (!empty($to_date)) {

            $this->db->where(
                'v.voucher_date <=',
                $to_date . ' 23:59:59'
            );
        }

        $this->db
            ->group_by('v.voucher_code')
            ->order_by(
                'v.voucher_date',
                'DESC'
            )
            ->order_by(
                'v.voucher_code',
                'DESC'
            )
            ->limit((int)$limit);

        return $this->db
            ->get()
            ->result();
    }

    public function get_recent_payments(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL,
        $limit = 5
    ) {

        $this->db
            ->select("
                v.voucher_date,
                v.voucher_code,
                v.narration,
                v.amount
            ", FALSE)
            ->from('voucher_transaction v')
            ->where(
                'v.voucher_type',
                'P'
            )
            ->where(
                '(v.cancel IS NULL OR v.cancel = 0)',
                NULL,
                FALSE
            );

        if (!empty($branch_id)) {
            $this->db->where(
                'v.branch_id',
                (int)$branch_id
            );
        }

        if (!empty($from_date)) {
            $this->db->where(
                'v.voucher_date >=',
                $from_date . ' 00:00:00'
            );
        }

        if (!empty($to_date)) {
            $this->db->where(
                'v.voucher_date <=',
                $to_date . ' 23:59:59'
            );
        }

        $this->db
            ->group_by('v.voucher_code')
            ->order_by('v.voucher_date', 'DESC')
            ->order_by('v.voucher_code', 'DESC')
            ->limit((int)$limit);

        return $this->db
            ->get()
            ->result();
    }

    public function get_recent_expenses(
        $branch_id = NULL,
        $from_date = NULL,
        $to_date = NULL,
        $limit = 5
    ) {

        $this->db
            ->select("
                vt.trans_id,
                vt.voucher_date,
                vt.voucher_code,
                vt.voucher_type,
                vt.narration,

                SUM(
                    CASE
                        WHEN UPPER(vt.drcr_type) = 'DR'
                        AND vt.account_id <> 226
                        THEN vt.amount
                        ELSE 0
                    END
                ) AS amount
            ", FALSE)

            ->from('voucher_transaction vt')

            ->where_in(
                'vt.voucher_type',
                array('E', 'J')
            )

            ->where(
                '(vt.cancel IS NULL OR vt.cancel = 0)',
                NULL,
                FALSE
            );

        if (!empty($branch_id)) {

            $this->db->where(
                'vt.branch_id',
                (int)$branch_id
            );
        }

        if (!empty($from_date)) {

            $this->db->where(
                'vt.voucher_date >=',
                $from_date . ' 00:00:00'
            );
        }

        if (!empty($to_date)) {

            $this->db->where(
                'vt.voucher_date <=',
                $to_date . ' 23:59:59'
            );
        }

        $this->db
            ->group_by(
                array(
                    'vt.trans_id',
                    'vt.voucher_date',
                    'vt.voucher_code',
                    'vt.voucher_type',
                    'vt.narration'
                )
            )

            ->order_by(
                'vt.voucher_date',
                'DESC'
            )

            ->order_by(
                'vt.trans_id',
                'DESC'
            )

            ->limit(
                (int)$limit
            );

        return $this->db
            ->get()
            ->result();
    }

}