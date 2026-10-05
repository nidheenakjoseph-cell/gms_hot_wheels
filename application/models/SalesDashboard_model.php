<?php defined('BASEPATH') or exit('No direct script access allowed');

class SalesDashboard_model extends CI_Model
{
    /**
     * Apply common invoice filters
     */
    private function apply_invoice_filters($filters, $alias = 'i')
    {
        // $company_id = isset($filters['company_id'])
        //     ? (int) $filters['company_id']
        //     : (int) get_current_company_id();

        /*
        |--------------------------------------------------------------------------
        | Company
        |--------------------------------------------------------------------------
        */
        // $this->db->where(
        //     $alias . '.company_id',
        //     $company_id
        // );

        /*
        |--------------------------------------------------------------------------
        | Date
        |--------------------------------------------------------------------------
        */
        if (!empty($filters['start_date'])) {
            $this->db->where(
                $alias . '.created_at >=',
                $filters['start_date']
            );
        }

        if (!empty($filters['end_date'])) {
            $this->db->where(
                $alias . '.created_at <=',
                $filters['end_date']
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Branch
        |--------------------------------------------------------------------------
        */
        if (
            isset($filters['branch_id']) &&
            $filters['branch_id'] !== '' &&
            $filters['branch_id'] !== 'all'
        ) {
            $this->db->where(
                $alias . '.branch_id',
                (int) $filters['branch_id']
            );
        } else {
            apply_branch_filter($alias);
        }
    }


    /**
     * Apply customer filter.
     *
     * IMPORTANT:
     * This method assumes job_cards is already joined.
     */
    private function apply_customer_filter($filters, $jobcard_alias = 'jc')
    {
        if (
            isset($filters['customer_id']) &&
            $filters['customer_id'] !== '' &&
            $filters['customer_id'] !== 'all'
        ) {
            $this->db->where(
                $jobcard_alias . '.customer_id',
                (int) $filters['customer_id']
            );
        }
    }


    /**
     * Calculate invoice paid amount.
     *
     * Payment + advance payment.
     */
    private function paid_amount_sql($invoice_alias = 'i')
    {
        return "
            (
                COALESCE(
                    (
                        SELECT SUM(ip.amount)
                        FROM invoice_payments ip
                        WHERE ip.invoice_id = {$invoice_alias}.invoice_id
                    ),
                    0
                )
                +
                COALESCE(
                    (
                        SELECT SUM(vt.amount)
                        FROM voucher_transaction vt
                        WHERE vt.trans_id = {$invoice_alias}.invoice_id
                          AND vt.voucher_type = 'R'
                          AND vt.drcr_type = 'Cr'
                          AND vt.cancel = 0
                    ),
                    0
                )
                +
                COALESCE({$invoice_alias}.adv_paid, 0)
            )
        ";
    }


    /**
     * Invoice balance SQL
     */
    private function balance_sql($invoice_alias = 'i')
    {
        return "
            (
                COALESCE({$invoice_alias}.grand_total, 0)
                -
                {$this->paid_amount_sql($invoice_alias)}
            )
        ";
    }


    /**
     * Apply invoice payment status filter.
     */
    private function apply_status_filter($filters, $alias = 'i')
    {
        if (
            empty($filters['status']) ||
            $filters['status'] === 'all'
        ) {
            return;
        }

        $paid_sql = $this->paid_amount_sql($alias);

        $balance_sql = "
            (
                COALESCE({$alias}.grand_total, 0)
                - {$paid_sql}
            )
        ";

        if ($filters['status'] === 'paid') {

            $this->db->where(
                "{$balance_sql} <=",
                0,
                false
            );

        } elseif ($filters['status'] === 'unpaid') {

            $this->db->where(
                "{$paid_sql} =",
                0,
                false
            );

        } elseif ($filters['status'] === 'partial') {

            $this->db->where(
                "{$paid_sql} >",
                0,
                false
            );

            $this->db->where(
                "{$balance_sql} >",
                0,
                false
            );
        }
    }


    /**
     * KPI
     */
    public function get_kpis($filters)
    {
        /*
        |--------------------------------------------------------------------------
        | Invoice KPI
        |--------------------------------------------------------------------------
        */
        $this->db->select("
            COUNT(DISTINCT i.invoice_id) AS total_invoices,
            COALESCE(SUM(i.grand_total), 0) AS total_sales,
            COALESCE(SUM(i.discount_amount), 0) AS total_discounts
        ", false);

        $this->db->from('invoices i');

        /*
        |--------------------------------------------------------------------------
        | Customer Join
        |--------------------------------------------------------------------------
        */
        $this->db->join(
            'job_cards jc',
            'jc.jobcard_id = i.jobcard_id',
            'left'
        );

        $this->apply_invoice_filters($filters, 'i');
        $this->apply_customer_filter($filters, 'jc');
        $this->apply_status_filter($filters, 'i');

        $invoice_data = $this->db
            ->get()
            ->row();

        $total_sales = (float) (
            $invoice_data->total_sales ?? 0
        );

        $total_discounts = (float) (
            $invoice_data->total_discounts ?? 0
        );

        $total_invoices = (int) (
            $invoice_data->total_invoices ?? 0
        );


        /*
        |--------------------------------------------------------------------------
        | Today's Sales
        |--------------------------------------------------------------------------
        |
        | Uses current day, but still respects company/branch/customer/status.
        |
        */
        $this->db->select("
            COALESCE(SUM(i.grand_total), 0) AS today_sales
        ", false);

        $this->db->from('invoices i');

        $this->db->join(
            'job_cards jc',
            'jc.jobcard_id = i.jobcard_id',
            'left'
        );

        // $this->db->where(
        //     'i.company_id',
        //     (int) $filters['company_id']
        // );

        $this->db->where(
            'i.created_at >=',
            date('Y-m-d') . ' 00:00:00'
        );

        $this->db->where(
            'i.created_at <=',
            date('Y-m-d') . ' 23:59:59'
        );

        if (
            !empty($filters['branch_id']) &&
            $filters['branch_id'] !== 'all'
        ) {
            $this->db->where(
                'i.branch_id',
                (int) $filters['branch_id']
            );
        } else {
            apply_branch_filter('i');
        }

        $this->apply_customer_filter($filters, 'jc');
        $this->apply_status_filter($filters, 'i');

        $today_row = $this->db
            ->get()
            ->row();

        $today_sales = (float) (
            $today_row->today_sales ?? 0
        );


        /*
        |--------------------------------------------------------------------------
        | Total Collection
        |--------------------------------------------------------------------------
        |
        | Payments against invoices in selected period.
        |
        */
        $this->db->select("
            COALESCE(
                SUM(
                    COALESCE(
                        (
                            SELECT SUM(ip2.amount)
                            FROM invoice_payments ip2
                            WHERE ip2.invoice_id = i.invoice_id
                        ),
                        0
                    )
                    +
                    COALESCE(
                        (
                            SELECT SUM(vt2.amount)
                            FROM voucher_transaction vt2
                            WHERE vt2.trans_id = i.invoice_id
                              AND vt2.voucher_type = 'R'
                              AND vt2.drcr_type = 'Cr'
                              AND vt2.cancel = 0
                        ),
                        0
                    )
                ),
                0
            ) AS payment_collection
        ", false);

        $this->db->from('invoices i');

        $this->db->join(
            'job_cards jc',
            'jc.jobcard_id = i.jobcard_id',
            'left'
        );

        $this->apply_invoice_filters($filters, 'i');
        $this->apply_customer_filter($filters, 'jc');

        /*
        |--------------------------------------------------------------------------
        | Don't apply invoice status here.
        |--------------------------------------------------------------------------
        | If status = paid/partial, collection itself should not disappear.
        */
        $payment_row = $this->db
            ->get()
            ->row();

        $payment_collection = (float) (
            $payment_row->payment_collection ?? 0
        );


        /*
        |--------------------------------------------------------------------------
        | Advance Collection
        |--------------------------------------------------------------------------
        */
        $this->db->select("
            COALESCE(SUM(i.adv_paid), 0) AS advance_collection
        ", false);

        $this->db->from('invoices i');

        $this->db->join(
            'job_cards jc',
            'jc.jobcard_id = i.jobcard_id',
            'left'
        );

        $this->apply_invoice_filters($filters, 'i');
        $this->apply_customer_filter($filters, 'jc');

        $advance_row = $this->db
            ->get()
            ->row();

        $advance_collection = (float) (
            $advance_row->advance_collection ?? 0
        );

        $total_collection =
            $payment_collection +
            $advance_collection;


        /*
        |--------------------------------------------------------------------------
        | Pending Quotations
        |--------------------------------------------------------------------------
        */
        $this->db->select("
            COUNT(q.quotation_id) AS pending_quotes
        ", false);

        $this->db->from('quotations q');

        $this->db->join(
            'customers c',
            'c.customer_id = q.customer_id',
            'left'
        );

        if (
            isset($filters['customer_id']) &&
            $filters['customer_id'] !== '' &&
            $filters['customer_id'] !== 'all'
        ) {
            $this->db->where(
                'q.customer_id',
                (int) $filters['customer_id']
            );
        }

        if (!empty($filters['start_date'])) {
            $this->db->where(
                'q.created_at >=',
                $filters['start_date']
            );
        }

        if (!empty($filters['end_date'])) {
            $this->db->where(
                'q.created_at <=',
                $filters['end_date']
            );
        }

        if (
            !empty($filters['branch_id']) &&
            $filters['branch_id'] !== 'all'
        ) {
            $this->db->where(
                'q.branch_id',
                (int) $filters['branch_id']
            );
        } else {
            apply_branch_filter('q');
        }

        $this->db->where(
            'q.status !=',
            'Converted'
        );

        $this->db->where(
            'q.status !=',
            'Rejected'
        );

        $pending_row = $this->db
            ->get()
            ->row();

        $pending_quotes = (int) (
            $pending_row->pending_quotes ?? 0
        );


        /*
        |--------------------------------------------------------------------------
        | Quotation Conversion
        |--------------------------------------------------------------------------
        */
        $this->db->select("
            COUNT(q.quotation_id) AS total_quotes,
            SUM(
                CASE
                    WHEN q.status = 'Converted'
                    THEN 1
                    ELSE 0
                END
            ) AS invoiced_quotes
        ", false);

        $this->db->from('quotations q');

        $this->db->join(
            'customers c',
            'c.customer_id = q.customer_id',
            'left'
        );

        if (
            isset($filters['customer_id']) &&
            $filters['customer_id'] !== '' &&
            $filters['customer_id'] !== 'all'
        ) {
            $this->db->where(
                'q.customer_id',
                (int) $filters['customer_id']
            );
        }

        if (!empty($filters['start_date'])) {
            $this->db->where(
                'q.created_at >=',
                $filters['start_date']
            );
        }

        if (!empty($filters['end_date'])) {
            $this->db->where(
                'q.created_at <=',
                $filters['end_date']
            );
        }

        if (
            !empty($filters['branch_id']) &&
            $filters['branch_id'] !== 'all'
        ) {
            $this->db->where(
                'q.branch_id',
                (int) $filters['branch_id']
            );
        } else {
            apply_branch_filter('q');
        }

        $quote_row = $this->db
            ->get()
            ->row();

        $total_quotes = (int) (
            $quote_row->total_quotes ?? 0
        );

        $invoiced_quotes = (int) (
            $quote_row->invoiced_quotes ?? 0
        );

        $conversion_rate = $total_quotes > 0
            ? ($invoiced_quotes / $total_quotes) * 100
            : 0;


        /*
        |--------------------------------------------------------------------------
        | Outstanding
        |--------------------------------------------------------------------------
        */
        $outstanding = $total_sales - $total_collection;

        if ($outstanding < 0 && abs($outstanding) < 0.01) {
            $outstanding = 0;
        }

        $profit_margin = $total_sales > 0
            ? (($total_sales - $total_collection) / $total_sales) * 100
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Average Ticket
        |--------------------------------------------------------------------------
        */
        $average_ticket = $total_invoices > 0
            ? $total_sales / $total_invoices
            : 0;


        return [
            'today_sales'       => round($today_sales, 2),
            'total_sales'       => round($total_sales, 2),
            'total_invoices'    => $total_invoices,
            'total_discounts'   => round($total_discounts, 2),
            'pending_quotes'    => $pending_quotes,
            'total_quotes'      => $total_quotes,
            'invoiced_quotes'   => $invoiced_quotes,
            'conversion_rate'   => round($conversion_rate, 2),
            'total_collection'  => round($total_collection, 2),
            'outstanding'       => round($outstanding, 2),
            'profit_percent'    => round($profit_margin, 2),
            'average_ticket'    => round($average_ticket, 2)
        ];
    }


    /**
     * Sales Trend
     */
    public function get_sales_trend_chart($filters)
    {
        $this->db->select("
            DATE(i.created_at) AS sale_date,
            COALESCE(SUM(i.grand_total), 0) AS total_sales
        ", false);

        $this->db->from('invoices i');

        $this->db->join(
            'job_cards jc',
            'jc.jobcard_id = i.jobcard_id',
            'left'
        );

        $this->apply_invoice_filters($filters, 'i');
        $this->apply_customer_filter($filters, 'jc');
        $this->apply_status_filter($filters, 'i');

        $this->db->group_by(
            'DATE(i.created_at)'
        );

        $this->db->order_by(
            'DATE(i.created_at)',
            'ASC'
        );

        $results = $this->db
            ->get()
            ->result();

        $labels = [];
        $data = [];

        foreach ($results as $row) {

            $labels[] = date(
                'd M',
                strtotime($row->sale_date)
            );

            $data[] = round(
                (float) $row->total_sales,
                2
            );
        }

        return [
            'labels' => $labels,
            'data'   => $data
        ];
    }


    /**
     * Collection Trend
     *
     * Includes both invoice_payments (cash/card/etc) AND adv_paid on each
     * invoice so the chart matches the KPI "Total Collection" figure.
     */
    public function get_collection_trend_chart($filters)
    {
        /*
        |------------------------------------------------------------------
        | Build branch / customer conditions as plain SQL fragments
        |------------------------------------------------------------------
        */
        $branch_sql  = '';
        $customer_sql = '';

        if (
            !empty($filters['branch_id']) &&
            $filters['branch_id'] !== 'all'
        ) {
            $branch_id  = (int) $filters['branch_id'];
            $branch_sql = "AND i.branch_id = {$branch_id}";
        } else {
            // Respect multi-branch session: use get_selected_branch_ids() from branch_helper
            $selected_ids = get_selected_branch_ids(); // returns array of int IDs or 'all'
            if (is_array($selected_ids) && !empty($selected_ids)) {
                if (count($selected_ids) === 1) {
                    $branch_sql = "AND i.branch_id = " . (int) $selected_ids[0];
                } else {
                    $ids        = implode(',', array_map('intval', $selected_ids));
                    $branch_sql = "AND i.branch_id IN ({$ids})";
                }
            }
            // if 'all' → no branch filter needed ($branch_sql stays '')
        }

        if (
            isset($filters['customer_id']) &&
            $filters['customer_id'] !== '' &&
            $filters['customer_id'] !== 'all'
        ) {
            $cid          = (int) $filters['customer_id'];
            $customer_sql = "AND jc.customer_id = {$cid}";
        }

        $date_from_pay = '';
        $date_to_pay   = '';
        $date_from_receipt = '';
        $date_to_receipt   = '';
        $date_from_adv = '';
        $date_to_adv   = '';

        if (!empty($filters['start_date'])) {
            $sd            = $this->db->escape($filters['start_date']);
            $date_from_pay = "AND ip.payment_date >= {$sd}";
            $date_from_receipt = "AND vt.voucher_date >= {$sd}";
            $date_from_adv = "AND i.created_at    >= {$sd}";
        }

        if (!empty($filters['end_date'])) {
            $ed          = $this->db->escape($filters['end_date']);
            $date_to_pay = "AND ip.payment_date <= {$ed}";
            $date_to_receipt = "AND vt.voucher_date <= {$ed}";
            $date_to_adv = "AND i.created_at    <= {$ed}";
        }

        /*
        |------------------------------------------------------------------
        | UNION:
        |  Part 1 – invoice_payments rows  (payment_date)
        |  Part 2 – adv_paid on invoices   (invoice created_at date)
        |------------------------------------------------------------------
        */
        $sql = "
            SELECT coll_date, SUM(amount) AS collection
            FROM (

                /* --- regular payments --- */
                SELECT
                    DATE(ip.payment_date) AS coll_date,
                    ip.amount             AS amount
                FROM invoice_payments ip
                INNER JOIN invoices   i  ON i.invoice_id  = ip.invoice_id
                LEFT  JOIN job_cards  jc ON jc.jobcard_id = i.jobcard_id
                WHERE 1=1
                  {$date_from_pay}
                  {$date_to_pay}
                  {$branch_sql}
                  {$customer_sql}


                  UNION ALL

                /* --- receipt vouchers entered through Accounts/add_receipt --- */
                SELECT
                    DATE(vt.voucher_date) AS coll_date,
                    vt.amount             AS amount
                FROM voucher_transaction vt
                INNER JOIN invoices i ON i.invoice_id = vt.trans_id
                LEFT JOIN job_cards jc ON jc.jobcard_id = i.jobcard_id
                WHERE vt.voucher_type = 'R'
                  AND vt.drcr_type = 'Cr'
                  AND vt.cancel = 0
                  {$date_from_receipt}
                  {$date_to_receipt}
                  {$branch_sql}
                  {$customer_sql}

                UNION ALL

                /* --- advance paid on invoice --- */
                SELECT
                    DATE(i.created_at) AS coll_date,
                    i.adv_paid         AS amount
                FROM invoices  i
                LEFT JOIN job_cards jc ON jc.jobcard_id = i.jobcard_id
                WHERE COALESCE(i.adv_paid, 0) > 0
                  {$date_from_adv}
                  {$date_to_adv}
                  {$branch_sql}
                  {$customer_sql}

            ) AS combined
            GROUP BY coll_date
            ORDER BY coll_date ASC
        ";

        $results = $this->db->query($sql)->result();

        $labels = [];
        $data   = [];

        foreach ($results as $row) {

            $labels[] = date(
                'd M',
                strtotime($row->coll_date)
            );

            $data[] = round(
                (float) $row->collection,
                2
            );
        }

        return [
            'labels' => $labels,
            'data'   => $data
        ];
    }


    /**
     * Top Services
     */
    public function get_top_services($filters)
    {
        $this->db->select("
            ii.item_name,
            COALESCE(SUM(ii.total_price), 0) AS revenue
        ", false);

        $this->db->from('invoice_items ii');

        $this->db->join(
            'invoices i',
            'i.invoice_id = ii.invoice_id',
            'inner'
        );

        $this->db->join(
            'job_cards jc',
            'jc.jobcard_id = i.jobcard_id',
            'left'
        );

        $this->db->where(
            'ii.item_type',
            'Service'
        );

        $this->apply_invoice_filters($filters, 'i');
        $this->apply_customer_filter($filters, 'jc');
        $this->apply_status_filter($filters, 'i');

        $this->db->group_by(
            'ii.item_name'
        );

        $this->db->order_by(
            'revenue',
            'DESC'
        );

        $this->db->limit(10);

        $results = $this->db
            ->get()
            ->result();

        $labels = [];
        $data = [];

        foreach ($results as $row) {

            $labels[] = $row->item_name;

            $data[] = round(
                (float) $row->revenue,
                2
            );
        }

        return [
            'labels' => $labels,
            'data'   => $data
        ];
    }


    /**
     * Top Parts
     */
    public function get_top_parts($filters)
    {
        $this->db->select("
            ii.item_name,
            COALESCE(SUM(ii.quantity), 0) AS qty_sold,
            COALESCE(SUM(ii.total_price), 0) AS revenue
        ", false);

        $this->db->from('invoice_items ii');

        $this->db->join(
            'invoices i',
            'i.invoice_id = ii.invoice_id',
            'inner'
        );

        $this->db->join(
            'job_cards jc',
            'jc.jobcard_id = i.jobcard_id',
            'left'
        );

        $this->db->where(
            'ii.item_type',
            'Part'
        );

        $this->apply_invoice_filters($filters, 'i');
        $this->apply_customer_filter($filters, 'jc');
        $this->apply_status_filter($filters, 'i');

        $this->db->group_by(
            'ii.item_name'
        );

        $this->db->order_by(
            'qty_sold',
            'DESC'
        );

        $this->db->limit(10);

        $results = $this->db
            ->get()
            ->result();

        $labels = [];
        $data = [];

        foreach ($results as $row) {

            $labels[] = $row->item_name;

            $data[] = (float) $row->qty_sold;
        }

        return [
            'labels' => $labels,
            'data'   => $data
        ];
    }


    /**
     * Payment Status Chart
     */
    public function get_payment_status_chart($filters)
    {
        $this->db->select('
            i.invoice_id,
            i.grand_total,
            i.adv_paid
        ');

        $this->db->from('invoices i');

        $this->db->join(
            'job_cards jc',
            'jc.jobcard_id = i.jobcard_id',
            'left'
        );

        $this->apply_invoice_filters($filters, 'i');
        $this->apply_customer_filter($filters, 'jc');

        $results = $this->db
            ->get()
            ->result();

        $paid = 0;
        $partial = 0;
        $unpaid = 0;

        foreach ($results as $row) {

            $payment_query = $this->db
                ->select('COALESCE(SUM(amount),0) AS paid')
                ->where(
                    'invoice_id',
                    (int) $row->invoice_id
                )
                ->get('invoice_payments')
                ->row();

            $receipt_query = $this->db
                ->select('COALESCE(SUM(amount),0) AS paid')
                ->where(
                    'trans_id',
                    (int) $row->invoice_id
                )
                ->where('voucher_type', 'R')
                ->where('drcr_type', 'Cr')
                ->where('cancel', 0)
                ->get('voucher_transaction')
                ->row();

            $total_paid =
                (float) ($payment_query->paid ?? 0)
                +
                (float) ($receipt_query->paid ?? 0)
                +
                (float) ($row->adv_paid ?? 0);

            $grand_total =
                (float) ($row->grand_total ?? 0);

            if ($total_paid >= $grand_total) {

                $paid++;

            } elseif ($total_paid > 0) {

                $partial++;

            } else {

                $unpaid++;
            }
        }

        return [
            'labels' => [
                'Paid',
                'Partial',
                'Unpaid'
            ],
            'data' => [
                $paid,
                $partial,
                $unpaid
            ]
        ];
    }


    /**
     * Recent Sales
     */
    public function get_recent_sales($filters)
    {
        $paid_sql = $this->paid_amount_sql('i');

        $this->db->select("
            i.invoice_id,
            i.invoice_no,
            i.created_at,
            i.grand_total,
            i.adv_paid,

            c.name AS customer_name,

            v.registration_no,

            b.branch_name,

            COALESCE(
                (
                    SELECT SUM(ip.amount)
                    FROM invoice_payments ip
                    WHERE ip.invoice_id = i.invoice_id
                ),
                0
            )
            +
            COALESCE(
                (
                    SELECT SUM(vt.amount)
                    FROM voucher_transaction vt
                    WHERE vt.trans_id = i.invoice_id
                      AND vt.voucher_type = 'R'
                      AND vt.drcr_type = 'Cr'
                      AND vt.cancel = 0
                ),
                0
            ) AS paid_amount,

            {$paid_sql} AS total_paid,

            (
                COALESCE(i.grand_total, 0)
                - {$paid_sql}
            ) AS balance
        ", false);

        $this->db->from('invoices i');

        $this->db->join(
            'job_cards jc',
            'jc.jobcard_id = i.jobcard_id',
            'left'
        );

        $this->db->join(
            'customers c',
            'c.customer_id = jc.customer_id',
            'left'
        );

        $this->db->join(
            'vehicles v',
            'v.vehicle_id = jc.vehicle_id',
            'left'
        );

        $this->db->join(
            'branches b',
            'b.branch_id = i.branch_id',
            'left'
        );

        $this->apply_invoice_filters($filters, 'i');
        $this->apply_customer_filter($filters, 'jc');
        $this->apply_status_filter($filters, 'i');

        $this->db->order_by(
            'i.created_at',
            'DESC'
        );

        $this->db->limit(10);

        $results = $this->db
            ->get()
            ->result();

        foreach ($results as &$row) {

            $balance = (float) $row->balance;
            $total_paid = (float) $row->total_paid;

            if ($balance <= 0.01) {

                $row->status = 'Paid';

            } elseif ($total_paid > 0) {

                $row->status = 'Partial';

            } else {

                $row->status = 'Unpaid';
            }

            $row->balance = round(
                max(0, $balance),
                2
            );

            $row->total_paid = round(
                $total_paid,
                2
            );
        }

        return $results;
    }


    /**
     * Customer Sales Summary
     */
    public function get_customer_sales_summary($filters)
    {
        $paid_sql = $this->paid_amount_sql('i');

        $this->db->select("
            c.customer_id,
            COALESCE(c.name, 'N/A') AS customer_name,

            COUNT(DISTINCT i.invoice_id) AS num_invoices,

            COALESCE(
                SUM(i.grand_total),
                0
            ) AS total_sales,

            COALESCE(
                SUM(
                    {$paid_sql}
                ),
                0
            ) AS paid_amount
        ", false);

        $this->db->from('invoices i');

        $this->db->join(
            'job_cards jc',
            'jc.jobcard_id = i.jobcard_id',
            'left'
        );

        $this->db->join(
            'customers c',
            'c.customer_id = jc.customer_id',
            'left'
        );

        $this->apply_invoice_filters($filters, 'i');
        $this->apply_customer_filter($filters, 'jc');
        $this->apply_status_filter($filters, 'i');

        $this->db->group_by(
            'c.customer_id'
        );

        $this->db->order_by(
            'total_sales',
            'DESC'
        );

        $this->db->limit(10);

        $results = $this->db
            ->get()
            ->result();

        foreach ($results as &$row) {

            $row->total_sales = round(
                (float) $row->total_sales,
                2
            );

            $row->paid_amount = round(
                (float) $row->paid_amount,
                2
            );

            $row->outstanding = round(
                max(
                    0,
                    $row->total_sales -
                    $row->paid_amount
                ),
                2
            );
        }

        return $results;
    }


    /**
     * Payment Collection Summary
     */
    public function get_payment_collection_summary($filters)
    {
        $kpis = $this->get_kpis($filters);

        /*
        |--------------------------------------------------------------------------
        | Today Collection
        |--------------------------------------------------------------------------
        */
        $this->db->select("
            COALESCE(
                SUM(
                    COALESCE(
                        (
                            SELECT SUM(ip2.amount)
                            FROM invoice_payments ip2
                            WHERE ip2.invoice_id = i.invoice_id
                              AND ip2.payment_date >= " . $this->db->escape(date('Y-m-d') . ' 00:00:00') . "
                              AND ip2.payment_date <= " . $this->db->escape(date('Y-m-d') . ' 23:59:59') . "
                        ),
                        0
                    )
                    +
                    COALESCE(
                        (
                            SELECT SUM(vt2.amount)
                            FROM voucher_transaction vt2
                            WHERE vt2.trans_id = i.invoice_id
                              AND vt2.voucher_type = 'R'
                              AND vt2.drcr_type = 'Cr'
                              AND vt2.cancel = 0
                              AND vt2.voucher_date >= " . $this->db->escape(date('Y-m-d') . ' 00:00:00') . "
                              AND vt2.voucher_date <= " . $this->db->escape(date('Y-m-d') . ' 23:59:59') . "
                        ),
                        0
                    )
                ),
                0
            ) AS today_collection
        ", false);

        $this->db->from('invoices i');

        $this->db->join(
            'job_cards jc',
            'jc.jobcard_id = i.jobcard_id',
            'left'
        );

        if (
            !empty($filters['branch_id']) &&
            $filters['branch_id'] !== 'all'
        ) {
            $this->db->where(
                'i.branch_id',
                (int) $filters['branch_id']
            );
        } else {
            apply_branch_filter('i');
        }

        $this->apply_customer_filter($filters, 'jc');

        $today_row = $this->db
            ->get()
            ->row();

        $today_collection = (float) (
            $today_row->today_collection ?? 0
        );


        /*
        |--------------------------------------------------------------------------
        | Selected Period Collection
        |--------------------------------------------------------------------------
        |
        | Filters directly on payment_date / voucher_date so that receipts
        | entered via Accounts/add_receipt are captured even when the linked
        | invoice was created before the selected period.
        |
        */
        $period_collection = 0;

        // Build branch SQL fragment (mirrors get_collection_trend_chart pattern)
        $p_branch_sql = '';
        if (
            !empty($filters['branch_id']) &&
            $filters['branch_id'] !== 'all'
        ) {
            $bid          = (int) $filters['branch_id'];
            $p_branch_sql = "AND i.branch_id = {$bid}";
        } else {
            $selected_ids = get_selected_branch_ids();
            if (is_array($selected_ids) && !empty($selected_ids)) {
                if (count($selected_ids) === 1) {
                    $p_branch_sql = "AND i.branch_id = " . (int) $selected_ids[0];
                } else {
                    $ids          = implode(',', array_map('intval', $selected_ids));
                    $p_branch_sql = "AND i.branch_id IN ({$ids})";
                }
            }
        }

        // Build customer SQL fragment
        $p_customer_sql = '';
        if (
            isset($filters['customer_id']) &&
            $filters['customer_id'] !== '' &&
            $filters['customer_id'] !== 'all'
        ) {
            $cid            = (int) $filters['customer_id'];
            $p_customer_sql = "AND jc.customer_id = {$cid}";
        }

        $p_sd = $this->db->escape($filters['start_date'] ?? '');
        $p_ed = $this->db->escape($filters['end_date'] ?? '');

        $period_sql = "
            SELECT COALESCE(SUM(amount), 0) AS period_collection
            FROM (

                /* --- invoice_payments within the period --- */
                SELECT ip.amount
                FROM invoice_payments ip
                INNER JOIN invoices  i  ON i.invoice_id  = ip.invoice_id
                LEFT  JOIN job_cards jc ON jc.jobcard_id = i.jobcard_id
                WHERE ip.payment_date >= {$p_sd}
                  AND ip.payment_date <= {$p_ed}
                  {$p_branch_sql}
                  {$p_customer_sql}

                UNION ALL

                /* --- receipt vouchers (Accounts/add_receipt) within the period --- */
                SELECT vt.amount
                FROM voucher_transaction vt
                INNER JOIN invoices  i  ON i.invoice_id  = vt.trans_id
                LEFT  JOIN job_cards jc ON jc.jobcard_id = i.jobcard_id
                WHERE vt.voucher_type = 'R'
                  AND vt.drcr_type   = 'Cr'
                  AND vt.cancel      = 0
                  AND vt.voucher_date >= {$p_sd}
                  AND vt.voucher_date <= {$p_ed}
                  {$p_branch_sql}
                  {$p_customer_sql}

            ) AS period_payments
        ";

        $period_row = $this->db->query($period_sql)->row();

        $period_collection = (float) (
            $period_row->period_collection ?? 0
        );


        return [
            'total_invoice_amount' =>
                round((float) $kpis['total_sales'], 2),

            'total_collected' =>
                round((float) $kpis['total_collection'], 2),

            'outstanding' =>
                round((float) $kpis['outstanding'], 2),

            'today_collection' =>
                round($today_collection, 2),

            'monthly_collection' =>
                round($period_collection, 2)
        ];
    }
}