<?php
class Reports_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

    private function apply_revenue_branch_filter($table_alias)
    {
        if (empty(get_user_allowed_branches())) {
            $this->db->where('1 = 0', null, false);
            return;
        }

        apply_branch_filter($table_alias);
    }

public function get_daily_job_report($date,$customer_id = null)
{
    $this->db->select('
        jc.jobcard_id,
       
        jc.status,
        jc.jobcard_date,
        c.customer_id,
        c.name AS customer_name,
        c.phone,
        v.registration_no,
        v.brand,
        v.model
    ');
        $this->db->from('job_cards jc');
        apply_branch_filter('jc');
        $this->db->join('customers c', 'c.customer_id = jc.customer_id');
        $this->db->join('vehicles v', 'v.vehicle_id = jc.vehicle_id');
        $this->db->where('DATE(jc.jobcard_date)', $date);
        if($customer_id != null || $customer_id != '')
        {
                  $this->db->where('jc.customer_id', $customer_id);

        }
        $this->db->where('status !=', 'Draft');

        $this->db->order_by('jc.jobcard_date', 'DESC');

        return $this->db->get()->result();
    }


    public function get_over_stay_report()
    {
        $this->db->select('
        jc.jobcard_id,
        jc.status,
        jc.jobcard_date,
        c.customer_id,
        c.name AS customer_name,
        c.phone,
        v.registration_no,
        v.brand,
        v.model
    ');

        $this->db->from('job_cards jc');
        $this->db->join('customers c', 'c.customer_id = jc.customer_id');
        $this->db->join('vehicles v', 'v.vehicle_id = jc.vehicle_id');
        apply_branch_filter('jc');

        // Exclude Draft and Finished
        $this->db->where_not_in('jc.status', ['Draft', 'Finished']);

        // Older than 15 days from today
        $this->db->where('DATE(jc.jobcard_date) <=', date('Y-m-d', strtotime('-15 days')));

        $this->db->order_by('jc.jobcard_date', 'ASC');

        return $this->db->get()->result();
    }


    public function get_over_night_report($date)
    {
       $this->db->select('
        jc.jobcard_id,
        jc.status,
        jc.jobcard_date,
        c.customer_id,
        c.name AS customer_name,
        c.phone,
        v.registration_no,
        v.brand,
        v.model
    ');

        $this->db->from('job_cards jc');
        $this->db->join('customers c', 'c.customer_id = jc.customer_id');
        $this->db->join('vehicles v', 'v.vehicle_id = jc.vehicle_id');
        apply_branch_filter('jc');

        // Exclude Draft and Finished
        $this->db->where_not_in('jc.status', ['Draft', 'Finished']);

        // Older than 15 days from today
        $this->db->where('DATE(jc.jobcard_date) <=', date('Y-m-d', strtotime('-1 days')));

        $this->db->order_by('jc.jobcard_date', 'ASC');

        return $this->db->get()->result();
    }
    // public function get_daily_job_report($from, $to, $customer_id = null)
    // {
    //     $this->db->select('
    //     jc.jobcard_id,

    //     jc.status,
    //     jc.jobcard_date,
    //     c.name AS customer_name,
    //     v.registration_no,
    //     v.brand,
    //     v.model
    // ');
    //     $this->db->from('job_cards jc');
    //     $this->db->join('customers c', 'c.customer_id = jc.customer_id');
    //     $this->db->join('vehicles v', 'v.vehicle_id = jc.vehicle_id');
    //     $this->db->where('DATE(jc.jobcard_date)', $date);
    //     $this->db->order_by('jc.jobcard_id', 'DESC');

    //     return $this->db->get()->result();
    // }
    public function get_revenue_reportold($from_date, $to_date)
    {
        $this->db->select('invoice_id,
        invoice_no,
        invoice_date,
        subtotal,
        tax_amount,
        discount_amount,
        grand_total,
        status
    ');
        $this->db->from('invoices');
        $this->db->where('invoice_date >=', $from_date);
        $this->db->where('invoice_date <=', $to_date);
        $this->db->order_by('invoice_date', 'ASC');

    return $this->db->get()->result();
}
public function get_revenue_report($from_date, $to_date, $report_type = 'job_card')
{
    if ($report_type === 'scrap') {
        $this->db->select(
            "ss.id AS invoice_id,
            ss.invoice_no,
            ss.sale_date AS invoice_date,
            ss.subtotal,
            ss.tax_amount,
            ss.discount_amount,
            ss.grand_total,
            ss.balance,
            ss.advance_used,
            (ss.grand_total - IFNULL(ss.balance, ss.grand_total)) AS paid_amount,
            CASE 
                WHEN IFNULL(ss.balance, ss.grand_total) <= 0 THEN 'Paid'
                WHEN IFNULL(ss.balance, ss.grand_total) < ss.grand_total THEN 'Partially Paid'
                ELSE 'Unpaid'
            END AS payment_status"
        );

        $this->db->from('scrap_sales ss');
        $this->apply_revenue_branch_filter('ss');

        $this->db->where('ss.sale_date >=', $from_date);
        $this->db->where('ss.sale_date <=', $to_date);

        $this->db->order_by('ss.sale_date', 'ASC');

        return $this->db->get()->result();
    }

    $this->db->select("
        i.invoice_id,
        i.invoice_no,
        i.invoice_date,
        i.subtotal,
        i.tax_amount,
        i.discount_amount,
        i.grand_total,

        (
            SELECT IFNULL(SUM(vt.amount),0)
            FROM voucher_transaction vt
            JOIN job_cards jc ON jc.jobcard_id = i.jobcard_id
            JOIN general_ledger gl ON gl.customer_id = jc.customer_id
            WHERE
                (
                    vt.invoice_code = i.invoice_no
                    OR
                    (
                        vt.trans_id = i.quotation_id
                        AND vt.trans_type = 'R'
                    )
                )
                AND vt.account_id = gl.account_id
                AND vt.voucher_type = 'R'
                AND vt.drcr_type = 'Cr'
                AND vt.cancel = 0
        ) AS paid_amount
    ");

    $this->db->from('invoices i');
    $this->apply_revenue_branch_filter('i');

    $this->db->where('i.invoice_date >=', $from_date);
    $this->db->where('i.invoice_date <=', $to_date);

    $this->db->order_by('i.invoice_date', 'ASC');

    $result = $this->db->get()->result();

    foreach ($result as &$row) {
        $row->balance_amount = $row->grand_total - $row->paid_amount;

        if ($row->paid_amount >= $row->grand_total) {
            $row->payment_status = 'Paid';
        } elseif ($row->paid_amount > 0) {
            $row->payment_status = 'Partially Paid';
        } else {
            $row->payment_status = 'Unpaid';
        }
    }

    return $result; 
}
public function get_revenue_report1($from_date, $to_date)
{
    $this->db->select("
        i.invoice_id,
        i.invoice_no,
        i.invoice_date,
        i.subtotal,
        i.tax_amount,
        i.discount_amount,
        i.grand_total,
        i.status,
        IFNULL(SUM(vt.amount),0) AS paid_amount
    ");

        $this->db->from('invoices i');
        apply_branch_filter('i');

        $this->db->join(
            'voucher_transaction vt',
            "vt.invoice_code = i.invoice_no 
        AND vt.drcr_type = 'Cr'
        AND vt.trans_type = 'R'
        AND vt.cancel = 0",
            'left'
        );

        $this->db->where('i.invoice_date >=', $from_date);
        $this->db->where('i.invoice_date <=', $to_date);

        $this->db->group_by('i.invoice_id');

        $this->db->order_by('i.invoice_date', 'ASC');

        return $this->db->get()->result();
    }
    public function get_inventory_usage_report($from, $to)
    {
        $this->db->select('
        jp.part_id ,
        jp.qty,
        jc.jobcard_date,
        sp.part_name,
        sp.part_code,
        jc.jobcard_id,
		jc.jobcard_no,
        c.name AS customer_name,
        v.registration_no
    ');
        $this->db->from('jobcard_parts jp');
        $this->db->join('spare_parts sp', 'sp.part_id = jp.part_id');
        $this->db->join('job_cards jc', 'jc.jobcard_id = jp.jobcard_id');
        $this->db->join('customers c', 'c.customer_id = jc.customer_id');
        $this->db->join('vehicles v', 'v.vehicle_id = jc.vehicle_id');
        apply_branch_filter('jc');
        $this->db->where('DATE(jc.jobcard_date) >=', $from);
        $this->db->where('DATE(jc.jobcard_date) <=', $to);
        $this->db->order_by('jc.jobcard_date', 'DESC');

        return $this->db->get()->result();
    }
    public function get_customer_visit_history($from, $to, $customer_id = null)
    {
        $this->db->select('
        jc.jobcard_id,
        
        jc.status,
        jc.jobcard_date,
        c.customer_id,
        c.name AS customer_name,
        c.phone,
        v.registration_no,
        v.brand,
        v.model
    ');
        $this->db->from('job_cards jc');
        $this->db->join('customers c', 'c.customer_id = jc.customer_id');
        $this->db->join('vehicles v', 'v.vehicle_id = jc.vehicle_id');
        $this->db->where('DATE(jc.jobcard_date) >=', $from);
        $this->db->where('DATE(jc.jobcard_date) <=', $to);
        $this->db->where('status !=', 'Draft');
        apply_branch_filter('jc');
        if (!empty($customer_id)) {
            $this->db->where('c.customer_id', $customer_id);
        }

        $this->db->order_by('jc.jobcard_date', 'DESC');
        
        return $this->db->get()->result();
    }

    /////////////////////////////////////purchase reports////////////////////////////
    public function get_rfq_report_records()
    {
        $from = isset($_REQUEST['from_date']) ? date('Y-m-d', strtotime($_REQUEST['from_date'])) : '';
        $to = isset($_REQUEST['to_date']) ? date('Y-m-d', strtotime($_REQUEST['to_date'])) : '';

        // Fail early if no date filters
        if (empty($from) || empty($to)) {
            return [];
        }

        $created_by = isset($_REQUEST['created_by']) ? $_REQUEST['created_by'] : '';
        $supplier_id = isset($_REQUEST['supplier_id']) ? $_REQUEST['supplier_id'] : '';

        $user_condition = '';
        $supplier_condition = '';

        if ($created_by != '') {
            $user_condition = " AND r.created_by = '$created_by'";
        }

        if ($supplier_id != '') {
            $supplier_condition = " AND r.supplier_id = '$supplier_id'";
        }

        $query = $this->db->query("
            SELECT 
                r.rfq_id,
                r.rfq_code,
                r.rfq_date,
                r.rev_version,
                r.supplier_id,
                CONCAT(em.username) AS rfq_created_by,
                supplier_name 
            FROM 
                purchase_rfq r
            JOIN users em ON r.created_by = em.id
            JOIN supplier_master s ON r.supplier_id = s.supplier_id
            WHERE 
                r.rfq_date BETWEEN '$from' AND '$to'
                $user_condition 
                $supplier_condition 
            ORDER BY 
                r.rfq_date DESC
        ");
        // apply_branch_filter('r');
        return $query->result();
    }
    public function get_po_report($from_date, $to_date, $supplier)
    {
        $this->db->select('po.po_code, po.po_date, po.grand_total, acc.account_name as supplier_name');
        $this->db->from('purchase_order_master po');
        $this->db->join('general_ledger acc', 'acc.supplier_id = po.supplier_id', 'left');
        
        if (!empty($from_date)) {
            $this->db->where('po.po_date >=', $from_date);
        }

        if (!empty($to_date)) {
            $this->db->where('po.po_date <=', $to_date);
        }

        if (!empty($supplier)) {
            $this->db->where('po.supplier_id', $supplier);
        }

        return $this->db->get()->result();
    }

    function get_po_report_records()
    {
        $from = isset($_REQUEST['from_date']) ? date('Y-m-d', strtotime($_REQUEST['from_date'])) : '';
        $to   = isset($_REQUEST['to_date']) ? date('Y-m-d', strtotime($_REQUEST['to_date'])) : '';

        // Fail early if no date filters
        if (empty($from) || empty($to)) {
            return [];
        }

        $created_by  = isset($_REQUEST['created_by'])  ? $_REQUEST['created_by']  : '';
        $supplier_id = isset($_REQUEST['supplier_id']) ? $_REQUEST['supplier_id'] : '';
        // $brand_id    = isset($_REQUEST['brand_id'])    ? $_REQUEST['brand_id']    : ''; // new brand filter

        // Build query safely with bindings
        $this->db->select('
            r.po_id,
            r.po_code,
            r.po_date,
            em.username as rfq_created_by,
            s.supplier_name,
            r.grand_total,
            r.po_status
        ');
        $this->db->from('purchase_order_master r');
        $this->db->join('users em', 'r.created_by = em.id', 'left');
        $this->db->join('supplier_master s', 'r.supplier_id = s.supplier_id', 'left');
        apply_branch_filter('r');
        // If brand filter used, join transaction table
        // if (!empty($brand_id)) {
        // 	$this->db->join('purchase_order_transaction t', 't.po_master_id = r.po_id', 'inner');
        // 	$this->db->where('t.brand', $brand_id);
        // }

        // Apply filters
        $this->db->where('r.po_date >=', $from);
        $this->db->where('r.po_date <=', $to);

        if (!empty($created_by)) {
            $this->db->where('r.created_by', $created_by);
        }

        if (!empty($supplier_id)) {
            $this->db->where('r.supplier_id', $supplier_id);
        }

        $this->db->order_by('r.po_date', 'desc');

        // Avoid duplicate rows if same PO has multiple brands
        if (!empty($brand_id)) {
            $this->db->group_by('r.po_id');
        }

        $query = $this->db->get();
        return $query->result();
    }
    public function get_grn_report_records()
    {
        $from = isset($_REQUEST['from_date'])
            ? date('Y-m-d', strtotime($_REQUEST['from_date']))
            : '';

        $to = isset($_REQUEST['to_date'])
            ? date('Y-m-d', strtotime($_REQUEST['to_date']))
            : '';

        // Fail early if no date filters
        if (empty($from) || empty($to)) {
            return [];
        }

        $created_by = isset($_REQUEST['created_by'])
            ? $_REQUEST['created_by']
            : '';

        $supplier_id = isset($_REQUEST['supplier_id'])
            ? $_REQUEST['supplier_id']
            : '';

        $this->db->select("
            r.grn_id,
            r.grn_code,
            r.grn_date,
            em.username AS grn_created_by,
            s.supplier_name,
            r.grand_total
        ");

        $this->db->from('purchase_grn_master r');

        $this->db->join(
            'users em',
            'r.created_by = em.id',
            'inner'
        );

        $this->db->join(
            'supplier_master s',
            'r.supplier_id = s.supplier_id',
            'inner'
        );

        apply_branch_filter('s');

        $this->db->where('r.grn_date >=', $from);
        $this->db->where('r.grn_date <=', $to);
        if ($created_by != '') {
            $this->db->where('r.created_by', $created_by);
        }

        if ($supplier_id != '') {
            $this->db->where('r.supplier_id', $supplier_id);
        }
        $this->db->order_by('r.grn_date', 'DESC');
        return $this->db->get()->result();
    }
     //fleet service reports


    public function get_fleet_customers()
    {
        $this->db->select('customer_id, name, phone, email, credit_limit, payment_terms');
        $this->db->from('customers');
        $this->db->where('customer_type', 'fleet');
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result();
    }

    public function get_customer_by_id($customer_id)
    {
        $this->db->select('customer_id, name, phone, email, address, trn, credit_limit, payment_terms, company_contact_person');
        $this->db->from('customers');
        $this->db->where('customer_id', $customer_id);
        return $this->db->get()->row();
    }

    public function get_fleet_soa($customer_id, $from = null, $to = null, $vehicle_id = null, $aging_filter = null, $status_filter = null, $payment_filter = null)
    {
        // Get customer's GL account_id + payment_terms
        $gl = $this->db->select('account_id')
            ->from('general_ledger')
            ->where('customer_id', $customer_id)
            ->where('group_no', 30)
            ->get()->row();
        $gl_account_id = $gl ? $gl->account_id : 0;

        $cust = $this->db->select('payment_terms')
            ->from('customers')
            ->where('customer_id', $customer_id)
            ->get()->row();
        $payment_terms = (!empty($cust->payment_terms) && $cust->payment_terms > 0)
            ? (int)$cust->payment_terms
            : 0;

        // GL opening balance (set when customer account was created)
        $gl_row = $this->db->select('opening_balance, opening_bal_type, date')
            ->from('general_ledger')
            ->where('account_id', $gl_account_id)
            ->get()->row();
        $gl_opening = 0;
        $gl_opening_date = null;
        if ($gl_row) {
            $gl_opening = (float)$gl_row->opening_balance;
            if ($gl_row->opening_bal_type === 'Cr') $gl_opening = -$gl_opening;
            $gl_opening_date = $gl_row->date;
        }

        // Opening balance — GL opening + all transactions strictly before $from
        $opening_balance = 0;
        if (!empty($from)) {
            $ob_inv = $this->db->query("
                SELECT IFNULL(SUM(i.grand_total), 0) AS total
                FROM invoices i
                JOIN job_cards jc ON jc.jobcard_id = i.jobcard_id
                WHERE jc.customer_id = {$customer_id}
                  AND i.invoice_date < '{$from}'
            ")->row();

            $ob_pay = $this->db->query("
                SELECT IFNULL(SUM(vt.amount), 0) AS total
                FROM voucher_transaction vt
                WHERE vt.account_id = {$gl_account_id}
                  AND vt.drcr_type  = 'Cr'
                  AND vt.trans_type IN ('J', 'R')
                  AND vt.cancel     = 0
                  AND DATE(vt.voucher_date) < '{$from}'
            ")->row();

            $ob_advance = $this->db->query("
                SELECT IFNULL(SUM(qp.amount), 0) AS total
                FROM quotation_payments qp
                WHERE qp.customer_id = {$customer_id}
                  AND DATE(qp.created_at) < '{$from}'
            ")->row();

            $ob_inv_pay = $this->db->query("
                SELECT IFNULL(SUM(ip.amount), 0) AS total
                FROM invoice_payments ip
                JOIN invoices i ON i.invoice_id = ip.invoice_id
                JOIN job_cards jc ON jc.jobcard_id = i.jobcard_id
                WHERE jc.customer_id = {$customer_id}
                  AND DATE(ip.payment_date) < '{$from}'
            ")->row();

            $ob_inv_adv = $this->db->query("
                SELECT IFNULL(SUM(i.adv_paid), 0) AS total
                FROM invoices i
                JOIN job_cards jc ON jc.jobcard_id = i.jobcard_id
                WHERE jc.customer_id = {$customer_id}
                  AND i.adv_paid > 0
                  AND i.invoice_date < '{$from}'
            ")->row();

            $opening_balance = $gl_opening + (float)$ob_inv->total - ((float)$ob_pay->total + (float)$ob_advance->total + (float)$ob_inv_pay->total + (float)$ob_inv_adv->total);
        } else {
            $opening_balance = $gl_opening;
        }

        // Invoices
        $this->db->select("
            i.invoice_id,
            i.invoice_no,
            i.invoice_date AS txn_date,
            'Invoice' AS txn_type,
            i.grand_total AS debit,
            0 AS credit,
            i.status,
            jc.jobcard_no,
            v.registration_no,
            v.brand,
            v.model,
            v.vehicle_id,
            0 AS invoice_paid_amt
        ");
        $this->db->from('invoices i');
        $this->db->join('job_cards jc', 'jc.jobcard_id = i.jobcard_id', 'left');
        $this->db->join('vehicles v', 'v.vehicle_id = jc.vehicle_id', 'left');
        // Fleet pays cumulatively via journal — no per-invoice paid tracking
        $this->db->where('jc.customer_id', $customer_id);
        if (!empty($from)) $this->db->where('i.invoice_date >=', $from);
        if (!empty($to))   $this->db->where('i.invoice_date <=', $to);
        if (!empty($vehicle_id)) $this->db->where('jc.vehicle_id', $vehicle_id);
        $invoices = $this->db->get()->result();

        // Fleet customers pay cumulatively — payment_status not tracked per invoice

        // Payments via voucher_transaction (Journal or Receipt, Cr side)
        $this->db->select("
            vt.voucher_id AS invoice_id,
            vt.voucher_code AS invoice_no,
            DATE(vt.voucher_date) AS txn_date,
            CASE vt.voucher_type
                WHEN 'J' THEN 'Receipt'
                WHEN 'R' THEN 'Receipt'
                WHEN 'P' THEN 'Payment'
                ELSE IFNULL(vt.voucher_type, 'Payment')
            END AS txn_type,
            0 AS debit,
            vt.amount AS credit,
            '' AS status,
            '' AS jobcard_no,
            '' AS registration_no,
            '' AS brand,
            '' AS model,
            0 AS vehicle_id
        ");
        $this->db->from('voucher_transaction vt');
        $this->db->where('vt.account_id', $gl_account_id);
        $this->db->where('vt.drcr_type', 'Cr');
        $this->db->where_in('vt.trans_type', ['J', 'R']);
        $this->db->where('vt.cancel', 0);
        if (!empty($from)) $this->db->where('DATE(vt.voucher_date) >=', $from);
        if (!empty($to))   $this->db->where('DATE(vt.voucher_date) <=', $to);
        $payments = $this->db->get()->result();

        // Include customer advance receipts that are tracked in quotation_payments.
        // These represent customer advance payments and should appear in the SOA ledger and totals.
        $this->db->select("
            qp.id AS invoice_id,
            qp.receipt_id AS invoice_no,
            DATE(qp.created_at) AS txn_date,
            'Advance Receipt' AS txn_type,
            0 AS debit,
            qp.amount AS credit,
            '' AS status,
            '' AS jobcard_no,
            '' AS registration_no,
            '' AS brand,
            '' AS model,
            0 AS vehicle_id
        ");
        $this->db->from('quotation_payments qp');
        $this->db->where('qp.customer_id', $customer_id);
        if (!empty($from)) $this->db->where('DATE(qp.created_at) >=', $from);
        if (!empty($to))   $this->db->where('DATE(qp.created_at) <=', $to);
        $advance_payments = $this->db->get()->result();

        // Payments recorded directly on invoices via invoice_payments
        $this->db->select("
            ip.payment_id AS invoice_id,
            IF(IFNULL(ip.reference_no, '') != '', ip.reference_no, i.invoice_no) AS invoice_no,
            DATE(ip.payment_date) AS txn_date,
            'Invoice Payment' AS txn_type,
            0 AS debit,
            ip.amount AS credit,
            '' AS status,
            jc.jobcard_no,
            v.registration_no,
            v.brand,
            v.model,
            v.vehicle_id
        ");
        $this->db->from('invoice_payments ip');
        $this->db->join('invoices i', 'i.invoice_id = ip.invoice_id', 'inner');
        $this->db->join('job_cards jc', 'jc.jobcard_id = i.jobcard_id', 'inner');
        $this->db->join('vehicles v', 'v.vehicle_id = jc.vehicle_id', 'left');
        $this->db->where('jc.customer_id', $customer_id);
        if (!empty($from)) $this->db->where('DATE(ip.payment_date) >=', $from);
        if (!empty($to))   $this->db->where('DATE(ip.payment_date) <=', $to);
        if (!empty($vehicle_id)) $this->db->where('jc.vehicle_id', $vehicle_id);
        $direct_invoice_payments = $this->db->get()->result();

        // Advance payments recorded on invoices
        $this->db->select("
            i.invoice_id,
            i.invoice_no,
            i.invoice_date AS txn_date,
            'Invoice Advance' AS txn_type,
            0 AS debit,
            i.adv_paid AS credit,
            '' AS status,
            jc.jobcard_no,
            v.registration_no,
            v.brand,
            v.model,
            v.vehicle_id
        ");
        $this->db->from('invoices i');
        $this->db->join('job_cards jc', 'jc.jobcard_id = i.jobcard_id', 'inner');
        $this->db->join('vehicles v', 'v.vehicle_id = jc.vehicle_id', 'left');
        $this->db->where('jc.customer_id', $customer_id);
        $this->db->where('i.adv_paid >', 0);
        if (!empty($from)) $this->db->where('i.invoice_date >=', $from);
        if (!empty($to))   $this->db->where('i.invoice_date <=', $to);
        if (!empty($vehicle_id)) $this->db->where('jc.vehicle_id', $vehicle_id);
        $invoice_adv_payments = $this->db->get()->result();

        // Merge and sort
        $all = array_merge($invoices, $payments, $advance_payments, $direct_invoice_payments, $invoice_adv_payments);
        usort($all, function($a, $b) {
            return strtotime($a->txn_date) - strtotime($b->txn_date);
        });

        // Build opening balance row
        $ob_row = null;
        $ob_date = !empty($from) ? $from : ($gl_opening_date ? date('Y-m-d', strtotime($gl_opening_date)) : date('Y-m-d'));
        if (!empty($from) || $gl_opening != 0) {
            $ob_row = (object)[
                'invoice_id'      => null,
                'invoice_no'      => '—',
                'txn_date'        => $ob_date,
                'txn_type'        => 'Opening Balance',
                'debit'           => $opening_balance > 0 ? $opening_balance : 0,
                'credit'          => $opening_balance < 0 ? abs($opening_balance) : 0,
                'status'          => '',
                'jobcard_no'      => null,
                'registration_no' => null,
                'brand'           => null,
                'model'           => null,
                'balance'         => $opening_balance,
                'aging_days'      => null,
                'aging_bucket'    => null,
                'gl_opening'      => $gl_opening,
                'gl_opening_date' => $gl_opening_date ? date('Y-m-d', strtotime($gl_opening_date)) : null,
            ];
        }

        // Running balance — start from opening balance, process transaction rows only
        $age_ref = !empty($to) ? strtotime($to) : time();
        $balance = $opening_balance;

        foreach ($all as &$row) {
            $balance       += $row->debit - $row->credit;
            $row->balance   = $balance;

            // Aging only on invoice rows
            if ($row->txn_type === 'Invoice') {
                $aging_days = (int)(($age_ref - strtotime($row->txn_date)) / 86400);
                $due_ts     = strtotime($row->txn_date) + ($payment_terms * 86400);

                $row->aging_days = $aging_days;
                $row->is_overdue = ($age_ref > $due_ts);

                if ($aging_days <= 30)        $row->aging_bucket = '0-30';
                elseif ($aging_days <= 60)    $row->aging_bucket = '31-60';
                elseif ($aging_days <= 90)    $row->aging_bucket = '61-90';
                elseif ($aging_days <= 120)   $row->aging_bucket = '91-120';
                else                          $row->aging_bucket = '120+';
            }
        }
        unset($row);

       // Apply aging filter — keep only invoice rows matching the bucket (plus all payment/OB rows)
        if (!empty($aging_filter)) {
            $all = array_filter($all, function($row) use ($aging_filter) {
                if ($row->txn_type === 'Opening Balance') return true;
                if ($row->txn_type === 'Invoice') {
                    return ($row->aging_bucket === $aging_filter);
                }
                // Keep receipts only if vehicle filter not isolating; always keep for aging view
                return true;
            });
            $all = array_values($all);
        }

        // Apply status filter — 'overdue' keeps only overdue invoices; 'current' keeps only non-overdue invoices
        if (!empty($status_filter)) {
            $all = array_filter($all, function($row) use ($status_filter) {
                if ($row->txn_type === 'Opening Balance') return true;
                if ($row->txn_type === 'Invoice') {
                    if ($status_filter === 'overdue') return !empty($row->is_overdue);
                    if ($status_filter === 'current') return empty($row->is_overdue);
                }
                return true; // always keep receipts
            });
            $all = array_values($all);
        }

        // Payment filter removed — fleet customers pay cumulatively via journal

        // Prepend opening balance row
        if ($ob_row !== null) {
            array_unshift($all, $ob_row);
        }

        return $all;
    }

   public function get_fleet_soa_summary(
    $customer_id,
    $from = null,
    $to = null,
    $vehicle_id = null,
    $aging_filter = null,
    $status_filter = null,
    $payment_filter = null
) {
    /*
     * ============================================================
     * 1. CUSTOMER GL ACCOUNT
     * ============================================================
     */
    $gl = $this->db->select('account_id')
        ->from('general_ledger')
        ->where('customer_id', $customer_id)
        ->where('group_no', 30)
        ->get()
        ->row();

    $gl_account_id = $gl ? (int)$gl->account_id : 0;


    /*
     * ============================================================
     * 2. GL OPENING BALANCE
     * ============================================================
     */
    $gl_ob = $this->db->select('opening_balance, opening_bal_type, date')
        ->from('general_ledger')
        ->where('account_id', $gl_account_id)
        ->get()
        ->row();

    $gl_opening_bal = 0;
    $gl_opening_date = null;

    if ($gl_ob) {
        $gl_opening_bal = (float)$gl_ob->opening_balance;

        if ($gl_ob->opening_bal_type === 'Cr') {
            $gl_opening_bal = -$gl_opening_bal;
        }

        $gl_opening_date = $gl_ob->date;
    }


    /*
     * ============================================================
     * 3. PAYMENT TERMS
     * ============================================================
     */
    $cust_terms = $this->db->select('payment_terms')
        ->from('customers')
        ->where('customer_id', $customer_id)
        ->get()
        ->row();

    $pt = (!empty($cust_terms->payment_terms) && $cust_terms->payment_terms > 0)
        ? (int)$cust_terms->payment_terms
        : 0;


    /*
     * ============================================================
     * 4. OPENING BALANCE BEFORE FROM DATE
     *
     * Same logic as get_fleet_soa()
     *
     * Opening =
     * GL opening
     * + invoices before FROM
     * - payments before FROM
     * ============================================================
     */
    $opening_balance = $gl_opening_bal;

    if (!empty($from)) {

        // Invoices before FROM
        $ob_inv = $this->db->select('IFNULL(SUM(i.grand_total), 0) AS total')
            ->from('invoices i')
            ->join('job_cards jc', 'jc.jobcard_id = i.jobcard_id', 'inner')
            ->where('jc.customer_id', $customer_id)
            ->where('i.invoice_date <', $from);

        if (!empty($vehicle_id)) {
            $this->db->where('jc.vehicle_id', $vehicle_id);
        }

        $ob_inv = $this->db->get()->row();

        // Payments before FROM
        $ob_pay = $this->db->select('IFNULL(SUM(vt.amount), 0) AS total')
            ->from('voucher_transaction vt')
            ->where('vt.account_id', $gl_account_id)
            ->where('vt.drcr_type', 'Cr')
            ->where_in('vt.trans_type', ['J', 'R'])
            ->where('vt.cancel', 0)
            ->where('DATE(vt.voucher_date) <', $from)
            ->get()
            ->row();

        $ob_advance = $this->db->select('IFNULL(SUM(qp.amount), 0) AS total')
            ->from('quotation_payments qp')
            ->where('qp.customer_id', $customer_id)
            ->where('DATE(qp.created_at) <', $from)
            ->get()
            ->row();

        $ob_inv_pay = $this->db->select('IFNULL(SUM(ip.amount), 0) AS total')
            ->from('invoice_payments ip')
            ->join('invoices i', 'i.invoice_id = ip.invoice_id', 'inner')
            ->join('job_cards jc', 'jc.jobcard_id = i.jobcard_id', 'inner')
            ->where('jc.customer_id', $customer_id)
            ->where('DATE(ip.payment_date) <', $from);
        if (!empty($vehicle_id)) $ob_inv_pay->where('jc.vehicle_id', $vehicle_id);
        $ob_inv_pay = $ob_inv_pay->get()->row();

        $ob_inv_adv = $this->db->select('IFNULL(SUM(i.adv_paid), 0) AS total')
            ->from('invoices i')
            ->join('job_cards jc', 'jc.jobcard_id = i.jobcard_id', 'inner')
            ->where('jc.customer_id', $customer_id)
            ->where('i.adv_paid >', 0)
            ->where('i.invoice_date <', $from);
        if (!empty($vehicle_id)) $ob_inv_adv->where('jc.vehicle_id', $vehicle_id);
        $ob_inv_adv = $ob_inv_adv->get()->row();

        $opening_balance =
            $gl_opening_bal
            + (float)$ob_inv->total
            - ((float)$ob_pay->total + (float)$ob_advance->total + (float)$ob_inv_pay->total + (float)$ob_inv_adv->total);
    }


    /*
     * ============================================================
     * 5. INVOICE TOTALS
     *
     * Respect FROM / TO / VEHICLE
     * ============================================================
     */
    $this->db->select("
        IFNULL(SUM(i.grand_total), 0) AS total_invoiced,
        IFNULL(SUM(i.tax_amount), 0) AS total_vat
    ");
    $this->db->from('invoices i');
    $this->db->join('job_cards jc', 'jc.jobcard_id = i.jobcard_id', 'inner');
    $this->db->where('jc.customer_id', $customer_id);

    if (!empty($from)) {
        $this->db->where('i.invoice_date >=', $from);
    }

    if (!empty($to)) {
        $this->db->where('i.invoice_date <=', $to);
    }

    if (!empty($vehicle_id)) {
        $this->db->where('jc.vehicle_id', $vehicle_id);
    }

    $inv = $this->db->get()->row();


    /*
     * ============================================================
     * 6. PAYMENTS WITHIN FROM / TO
     *
     * Fleet payments are account-level.
     * Do NOT apply vehicle filter to payments.
     * ============================================================
     */
    $this->db->select('IFNULL(SUM(vt.amount), 0) AS total_paid');
    $this->db->from('voucher_transaction vt');
    $this->db->where('vt.account_id', $gl_account_id);
    $this->db->where('vt.drcr_type', 'Cr');
    $this->db->where_in('vt.trans_type', ['J', 'R']);
    $this->db->where('vt.cancel', 0);

    if (!empty($from)) {
        $this->db->where('DATE(vt.voucher_date) >=', $from);
    }

    if (!empty($to)) {
        $this->db->where('DATE(vt.voucher_date) <=', $to);
    }

    $pay = $this->db->get()->row();

    $advance_pay = $this->db->select('IFNULL(SUM(qp.amount), 0) AS total_advance_paid')
        ->from('quotation_payments qp')
        ->where('qp.customer_id', $customer_id);

    if (!empty($from)) {
        $advance_pay->where('DATE(qp.created_at) >=', $from);
    }

    if (!empty($to)) {
        $advance_pay->where('DATE(qp.created_at) <=', $to);
    }

    $advance_pay = $advance_pay->get()->row();

    // Payments recorded directly on invoices via invoice_payments
    $inv_pay = $this->db->select('IFNULL(SUM(ip.amount), 0) AS total_inv_paid')
        ->from('invoice_payments ip')
        ->join('invoices i', 'i.invoice_id = ip.invoice_id', 'inner')
        ->join('job_cards jc', 'jc.jobcard_id = i.jobcard_id', 'inner')
        ->where('jc.customer_id', $customer_id);

    if (!empty($from))       $inv_pay->where('DATE(ip.payment_date) >=', $from);
    if (!empty($to))         $inv_pay->where('DATE(ip.payment_date) <=', $to);
    if (!empty($vehicle_id)) $inv_pay->where('jc.vehicle_id', $vehicle_id);
    $inv_pay = $inv_pay->get()->row();

    // Payments recorded as advance on invoices (invoices.adv_paid)
    $adv_paid_inv = $this->db->select('IFNULL(SUM(i.adv_paid), 0) AS total_adv_paid')
        ->from('invoices i')
        ->join('job_cards jc', 'jc.jobcard_id = i.jobcard_id', 'inner')
        ->where('jc.customer_id', $customer_id)
        ->where('i.adv_paid >', 0);

    if (!empty($from))       $adv_paid_inv->where('i.invoice_date >=', $from);
    if (!empty($to))         $adv_paid_inv->where('i.invoice_date <=', $to);
    if (!empty($vehicle_id)) $adv_paid_inv->where('jc.vehicle_id', $vehicle_id);
    $adv_paid_inv = $adv_paid_inv->get()->row();

    $total_paid_float = (float)($pay->total_paid ?? 0)
        + (float)($advance_pay->total_advance_paid ?? 0)
        + (float)($inv_pay->total_inv_paid ?? 0)
        + (float)($adv_paid_inv->total_adv_paid ?? 0);

    /*
     * ============================================================
     * 7. AGING REFERENCE DATE
     *
     * Same principle as get_fleet_soa()
     *
     * If TO is selected:
     *     aging is calculated as of TO
     *
     * Otherwise:
     *     aging is calculated as of today
     * ============================================================
     */
    $age_ref = !empty($to)
        ? strtotime($to)
        : time();

    $age_ref_date = date('Y-m-d', $age_ref);


    /*
     * ============================================================
     * 8. AGING BUCKETS
     *
     * Respect FROM / TO / VEHICLE
     * ============================================================
     */
    $this->db->select("
        IFNULL(SUM(
            CASE
                WHEN DATEDIFF('{$age_ref_date}', i.invoice_date) <= 30
                THEN i.grand_total
                ELSE 0
            END
        ), 0) AS bucket_0_30,

        IFNULL(SUM(
            CASE
                WHEN DATEDIFF('{$age_ref_date}', i.invoice_date) BETWEEN 31 AND 60
                THEN i.grand_total
                ELSE 0
            END
        ), 0) AS bucket_31_60,

        IFNULL(SUM(
            CASE
                WHEN DATEDIFF('{$age_ref_date}', i.invoice_date) BETWEEN 61 AND 90
                THEN i.grand_total
                ELSE 0
            END
        ), 0) AS bucket_61_90,

        IFNULL(SUM(
            CASE
                WHEN DATEDIFF('{$age_ref_date}', i.invoice_date) BETWEEN 91 AND 120
                THEN i.grand_total
                ELSE 0
            END
        ), 0) AS bucket_91_120,

        IFNULL(SUM(
            CASE
                WHEN DATEDIFF('{$age_ref_date}', i.invoice_date) > 120
                THEN i.grand_total
                ELSE 0
            END
        ), 0) AS bucket_120plus
    ");

    $this->db->from('invoices i');
    $this->db->join('job_cards jc', 'jc.jobcard_id = i.jobcard_id', 'inner');
    $this->db->where('jc.customer_id', $customer_id);

    if (!empty($from)) {
        $this->db->where('i.invoice_date >=', $from);
    }

    if (!empty($to)) {
        $this->db->where('i.invoice_date <=', $to);
    }

    if (!empty($vehicle_id)) {
        $this->db->where('jc.vehicle_id', $vehicle_id);
    }

    $aging = $this->db->get()->row();


    /*
     * ============================================================
     * 9. GROSS BUCKETS
     * ============================================================
     */
    $gross_buckets = [
        'bucket_0_30'    => (float)$aging->bucket_0_30,
        'bucket_31_60'   => (float)$aging->bucket_31_60,
        'bucket_61_90'   => (float)$aging->bucket_61_90,
        'bucket_91_120'  => (float)$aging->bucket_91_120,
        'bucket_120plus' => (float)$aging->bucket_120plus,
    ];


    /*
     * ============================================================
     * 10. ALLOCATE PAYMENTS OLDEST FIRST
     *
     * 120+ -> 91-120 -> 61-90 -> 31-60 -> 0-30
     *
     * Payments are account-level.
     * ============================================================
     */
    $remaining_payment = $total_paid_float;

    $buckets_ordered = [
        'bucket_120plus' => $gross_buckets['bucket_120plus'],
        'bucket_91_120'  => $gross_buckets['bucket_91_120'],
        'bucket_61_90'   => $gross_buckets['bucket_61_90'],
        'bucket_31_60'   => $gross_buckets['bucket_31_60'],
        'bucket_0_30'    => $gross_buckets['bucket_0_30'],
    ];

    $net_buckets = [];

    foreach ($buckets_ordered as $key => $gross) {

        if ($remaining_payment <= 0) {

            $net_buckets[$key] = $gross;

        } elseif ($remaining_payment >= $gross) {

            $net_buckets[$key] = 0;

            $remaining_payment -= $gross;

        } else {

            $net_buckets[$key] = $gross - $remaining_payment;

            $remaining_payment = 0;
        }
    }


    /*
     * ============================================================
     * 11. PAID AMOUNT PER AGING BUCKET
     * ============================================================
     */
    $paid_buckets = [];

    foreach ($gross_buckets as $key => $gross) {
        $paid_buckets[$key] =
            max(0, $gross - $net_buckets[$key]);
    }


    /*
     * ============================================================
     * 12. OVERDUE AMOUNT
     *
     * Use TO as aging reference instead of CURDATE().
     * Respect FROM / TO / VEHICLE.
     * ============================================================
     */
    $this->db->select('IFNULL(SUM(i.grand_total), 0) AS overdue_total');
    $this->db->from('invoices i');
    $this->db->join('job_cards jc', 'jc.jobcard_id = i.jobcard_id', 'inner');
    $this->db->where('jc.customer_id', $customer_id);

    if (!empty($from)) {
        $this->db->where('i.invoice_date >=', $from);
    }

    if (!empty($to)) {
        $this->db->where('i.invoice_date <=', $to);
    }

    if (!empty($vehicle_id)) {
        $this->db->where('jc.vehicle_id', $vehicle_id);
    }

    /*
     * Due when:
     * invoice date + payment terms < reference date
     */
    $this->db->where(
        "DATE_ADD(i.invoice_date, INTERVAL {$pt} DAY) <",
        $age_ref_date,
        false
    );

    $due_row = $this->db->get()->row();

    $overdue_invoiced = (float)$due_row->overdue_total;


    /*
     * ============================================================
     * 13. CALCULATE OVERDUE PAID
     *
     * Since fleet payments are cumulative and not invoice-specific,
     * distribute payment proportionally against invoice total.
     * ============================================================
     */
    $total_inv_float = (float)$inv->total_invoiced;

    $overdue_paid = $total_inv_float > 0
        ? (($overdue_invoiced / $total_inv_float) * $total_paid_float)
        : 0;

    $due_amount = max(
        0,
        $overdue_invoiced - $overdue_paid
    );


    /*
     * ============================================================
     * 14. FINAL BALANCE
     *
     * Opening
     * + current-period invoices
     * - current-period payments
     * ============================================================
     */
    $balance_due =
        $opening_balance
        + (float)$inv->total_invoiced
        - $total_paid_float;


    /*
     * ============================================================
     * 15. RETURN
     * ============================================================
     */
    return [
        'total_invoiced'       => (float)$inv->total_invoiced,
        'total_vat'            => (float)$inv->total_vat,
        'total_paid'           => $total_paid_float,

        'balance_due'          => $balance_due,
        'due_amount'           => $due_amount,

        'gl_opening_bal'       => $gl_opening_bal,
        'gl_opening_date'      => $gl_opening_date
            ? date('Y-m-d', strtotime($gl_opening_date))
            : null,

        'opening_balance'      => $opening_balance,

        'bucket_0_30'          => $net_buckets['bucket_0_30'],
        'bucket_31_60'         => $net_buckets['bucket_31_60'],
        'bucket_61_90'         => $net_buckets['bucket_61_90'],
        'bucket_91_120'        => $net_buckets['bucket_91_120'],
        'bucket_120plus'       => $net_buckets['bucket_120plus'],

        'bucket_0_30_gross'    => $gross_buckets['bucket_0_30'],
        'bucket_31_60_gross'   => $gross_buckets['bucket_31_60'],
        'bucket_61_90_gross'   => $gross_buckets['bucket_61_90'],
        'bucket_91_120_gross'  => $gross_buckets['bucket_91_120'],
        'bucket_120plus_gross' => $gross_buckets['bucket_120plus'],

        'bucket_0_30_paid'     => $paid_buckets['bucket_0_30'],
        'bucket_31_60_paid'    => $paid_buckets['bucket_31_60'],
        'bucket_61_90_paid'    => $paid_buckets['bucket_61_90'],
        'bucket_91_120_paid'   => $paid_buckets['bucket_91_120'],
        'bucket_120plus_paid'  => $paid_buckets['bucket_120plus'],

        'aging_reference_date' => $age_ref_date,
    ];
}
    
    public function get_vehicles_by_customer($customer_id)
    {
        $this->db->select('v.vehicle_id, v.registration_no, v.brand, v.model, v.year');
        $this->db->from('vehicles v');
        $this->db->where('v.customer_id', $customer_id);
        $this->db->order_by('v.registration_no', 'ASC');
        return $this->db->get()->result();
    }

   public function get_vehicles_with_invoice_summary($customer_id,$from = null,$to = null,$vehicle_id = null, $aging_filter = null,$status_filter = null, $payment_filter = null) 
   {

    $this->db->select('
        v.vehicle_id,
        v.registration_no,
        v.brand,
        v.model,
        v.year,

        COUNT(DISTINCT i.invoice_id) AS invoice_count,

        IFNULL(SUM(i.grand_total), 0) AS total_billed
    ');

    $this->db->from('vehicles v');

    $this->db->join(
        'job_cards jc',
        'jc.vehicle_id = v.vehicle_id',
        'left'
    );

    $this->db->join(
        'invoices i',
        'i.jobcard_id = jc.jobcard_id',
        'left'
    );

    $this->db->where('v.customer_id', $customer_id);

    if (!empty($vehicle_id)) {
        $this->db->where('v.vehicle_id', $vehicle_id);
    }

    if (!empty($from)) {
        $this->db->where(
            '(i.invoice_date IS NULL OR i.invoice_date >= ' .
            $this->db->escape($from) . ')',
            null,
            false
        );
    }

    if (!empty($to)) {
        $this->db->where(
            '(i.invoice_date IS NULL OR i.invoice_date <= ' .
            $this->db->escape($to) . ')',
            null,
            false
        );
    }

    $this->db->group_by('v.vehicle_id');

    $this->db->order_by(
        'v.registration_no',
        'ASC'
    );

    $rows = $this->db->get()->result();

    $gl = $this->db->select('account_id')
        ->from('general_ledger')
        ->where('customer_id', $customer_id)
        ->where('group_no', 30)
        ->get()
        ->row();

    $gl_account_id = $gl ? (int)$gl->account_id : 0;


    $this->db->select(
        'IFNULL(SUM(amount), 0) AS total_paid'
    );

    $this->db->from('voucher_transaction');

    $this->db->where(
        'account_id',
        $gl_account_id
    );

    $this->db->where(
        'drcr_type',
        'Cr'
    );

    $this->db->where_in(
        'trans_type',
        ['J', 'R']
    );

    $this->db->where(
        'cancel',
        0
    );

    if (!empty($from)) {
        $this->db->where(
            'DATE(voucher_date) >=',
            $from
        );
    }

    if (!empty($to)) {
        $this->db->where(
            'DATE(voucher_date) <=',
            $to
        );
    }

    $pay_row = $this->db->get()->row();

    $inv_pay_row = $this->db->select('IFNULL(SUM(ip.amount), 0) AS total_paid')
        ->from('invoice_payments ip')
        ->join('invoices i', 'i.invoice_id = ip.invoice_id', 'inner')
        ->join('job_cards jc', 'jc.jobcard_id = i.jobcard_id', 'inner')
        ->where('jc.customer_id', $customer_id);
    if (!empty($from)) $inv_pay_row->where('DATE(ip.payment_date) >=', $from);
    if (!empty($to))   $inv_pay_row->where('DATE(ip.payment_date) <=', $to);
    $inv_pay_row = $inv_pay_row->get()->row();

    $adv_pay_row = $this->db->select('IFNULL(SUM(i.adv_paid), 0) AS total_paid')
        ->from('invoices i')
        ->join('job_cards jc', 'jc.jobcard_id = i.jobcard_id', 'inner')
        ->where('jc.customer_id', $customer_id)
        ->where('i.adv_paid >', 0);
    if (!empty($from)) $adv_pay_row->where('i.invoice_date >=', $from);
    if (!empty($to))   $adv_pay_row->where('i.invoice_date <=', $to);
    $adv_pay_row = $adv_pay_row->get()->row();

    $total_paid = ((float)($pay_row ? $pay_row->total_paid : 0))
        + ((float)($inv_pay_row ? $inv_pay_row->total_paid : 0))
        + ((float)($adv_pay_row ? $adv_pay_row->total_paid : 0));


    $total_billed = 0;

    foreach ($rows as $row) {
        $row->total_billed = (float)$row->total_billed;
        $total_billed += $row->total_billed;
    }

    foreach ($rows as &$row) {

        if ($total_billed > 0) {

            $share =
                ($row->total_billed / $total_billed)
                * $total_paid;

        } else {

            $share = 0;
        }

        $row->total_paid_v = min(
            $share,
            $row->total_billed
        );

        $row->outstanding = max(
            0,
            $row->total_billed - $row->total_paid_v
        );
    }

    unset($row);
    return $rows;
}
public function get_total_sales_summary($filters = array())
{
    $this->db->select("
        COUNT(DISTINCT i.invoice_id) AS total_invoices,

        COALESCE(SUM(i.subtotal), 0) AS gross_sales,

        COALESCE(SUM(i.discount_amount), 0) AS discount,

        COALESCE(SUM(i.tax_amount), 0) AS vat,

        COALESCE(SUM(i.grand_total), 0) AS net_sales
    ");

    $this->db->from('invoices i');
    $this->db->join('job_cards j', 'j.jobcard_id = i.jobcard_id', 'left');
    $this->db->where('i.status !=', 'Cancelled');

    if (!empty($filters['from_date'])) {
        $this->db->where('DATE(i.invoice_date) >=', $filters['from_date']);
    }

    if (!empty($filters['to_date'])) {
        $this->db->where('DATE(i.invoice_date) <=', $filters['to_date']);
    }

    if (!empty($filters['branch_id'])) {
        $this->db->where('i.branch_id', $filters['branch_id']);
    }

    if (!empty($filters['customer_id'])) {
        $this->db->where('j.customer_id', $filters['customer_id']);
    }

    if (!empty($filters['invoice_no'])) {
        $this->db->like('i.invoice_no', $filters['invoice_no']);
    }

    $result = $this->db->get()->row_array();

    if (!$result) {
        $result = array(
            'total_invoices' => 0,
            'gross_sales'    => 0,
            'discount'       => 0,
            'vat'            => 0,
            'net_sales'      => 0
        );
    }

    return $result;
}
public function get_total_sales_details($filters = array())
{
    $this->db->select("
        i.invoice_id,
        i.invoice_date,
        i.invoice_no,

        c.name AS customer_name,

        i.subtotal AS sub_total,
        i.discount_amount AS discount,
        i.tax_amount,
        i.grand_total

    ");

    $this->db->from('invoices i');
    $this->db->join(
        'job_cards j',
        'j.jobcard_id = i.jobcard_id',
        'left'
    );

    $this->db->join(
        'customers c',
        'c.customer_id = j.customer_id',
        'left'
    );
    $this->db->where('i.status !=', 'Cancelled');

    if (!empty($filters['from_date'])) {
        $this->db->where(
            'DATE(i.invoice_date) >=',
            $filters['from_date']
        );
    }

    if (!empty($filters['to_date'])) {
        $this->db->where(
            'DATE(i.invoice_date) <=',
            $filters['to_date']
        );
    }

    if (!empty($filters['branch_id'])) {
        $this->db->where(
            'i.branch_id',
            $filters['branch_id']
        );
    }

    if (!empty($filters['customer_id'])) {
        $this->db->where(
            'j.customer_id',
            $filters['customer_id']
        );
    }

    if (!empty($filters['invoice_no'])) {
        $this->db->like(
            'i.invoice_no',
            $filters['invoice_no']
        );
    }

    $this->db->order_by(
        'i.invoice_date',
        'DESC'
    );

    return $this->db->get()->result_array();
}
public function get_daily_sales_summary($filters = array())
{
    $this->db->select("
        DATE(i.invoice_date) AS sale_date,

        COUNT(i.invoice_id) AS invoice_count,

        COALESCE(SUM(i.subtotal), 0) AS gross_sales,

        COALESCE(SUM(i.discount_amount), 0) AS discount,

        COALESCE(SUM(i.tax_amount), 0) AS vat,

        COALESCE(SUM(i.grand_total), 0) AS net_sales
    ");

    $this->db->from('invoices i');
    $this->db->join('job_cards j', 'j.jobcard_id = i.jobcard_id', 'left');
    $this->db->where('i.status !=', 'Cancelled');

    if (!empty($filters['from_date'])) {
        $this->db->where(
            'DATE(i.invoice_date) >=',
            $filters['from_date']
        );
    }

    if (!empty($filters['to_date'])) {
        $this->db->where(
            'DATE(i.invoice_date) <=',
            $filters['to_date']
        );
    }

    if (!empty($filters['branch_id'])) {
        $this->db->where(
            'i.branch_id',
            $filters['branch_id']
        );
    }

    if (!empty($filters['customer_id'])) {
        $this->db->where(
            'j.customer_id',
            $filters['customer_id']
        );
    }

    if (!empty($filters['invoice_no'])) {
        $this->db->like(
            'i.invoice_no',
            $filters['invoice_no']
        );
    }

    $this->db->group_by(
        'DATE(i.invoice_date)'
    );

    $this->db->order_by(
        'sale_date',
        'DESC'
    );

    return $this->db->get()->result_array();
}
}
