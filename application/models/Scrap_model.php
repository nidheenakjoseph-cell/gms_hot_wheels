<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scrap_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // public function get_all()
    // {
    //     $sales = $this->db->order_by('sale_date', 'DESC')->get('scrap_sales')->result();

    //     foreach ($sales as $sale) {
    //         $items = $this->get_items($sale->id);
    //         $sale->item_count = count($items);
    //         $categories = array_unique(array_column($items, 'category_name'));
    //         $sale->categories = implode(', ', $categories);
    //     }

    //     return $sales;
    // }
    public function get_all()
    {
        apply_branch_filter('ss');
        $sales = $this->db
            ->select("
                ss.*,
                COUNT(ssi.id) AS item_count,
                GROUP_CONCAT(DISTINCT c.category_name SEPARATOR ', ') AS categories
            ")
            ->from('scrap_sales ss')
            ->join('scrap_sales_items ssi', 'ssi.sales_id = ss.id', 'left')
            ->join('scrap_category c', 'c.id = ssi.category_id', 'left')
            ->group_by('ss.id')
            ->order_by('ss.sale_date', 'DESC')
            ->order_by('ss.invoice_no', 'DESC')
            ->get()
            ->result();
// print_r($this->db->last_query());exit;
        foreach ($sales as $sale) {
            $this->normalize_scrap_sale_payment($sale);
        }

        return $sales;
    }

    public function get($sale_id)
    {
        $sale = $this->db->where('id', $sale_id)->get('scrap_sales')->row();
        if ($sale) {
            $this->normalize_scrap_sale_payment($sale);
            $sale->items = $this->get_items($sale_id);
            $sale->ledger_entries = $this->get_ledger_entries($sale_id);
            $sale->customer_ledger_id = $sale->cash_account_id;
        }
        return $sale;
    }

    public function get_ledger_entries($sale_id)
    {
        return $this->db
            ->where('trans_type', 'SCRAP')
            ->where('trans_id', $sale_id)
            ->order_by('drcr_type DESC, voucher_id  ASC')
            ->get('voucher_transaction')
            ->result();
    }

    public function get_receipt_paid_amount($sale_id)
    {
        $row = $this->db
            ->select('COALESCE(SUM(amount), 0) as receipt_paid')
            ->from('voucher_transaction')
            ->where('trans_type', 'SCRAP')
            ->where('trans_id', $sale_id)
            ->where('voucher_type', 'R')
            ->where('drcr_type', 'Cr')
            ->where('cancel', 0)
            ->get()
            ->row();

        return floatval($row->receipt_paid ?? 0);
    }

    public function normalize_scrap_sale_payment($sale)
    {
        if (!$sale) {
            return $sale;
        }

        $receipt_paid = $this->get_receipt_paid_amount($sale->id);
        $advance_used = floatval($sale->advance_used ?? 0);
        $actual_paid = $receipt_paid + $advance_used;

        $sale->receipt_paid_amount = $receipt_paid;
        $sale->paid_amt = round($actual_paid, 2);
        $sale->balance = max(0, round(floatval($sale->grand_total) - $sale->paid_amt, 2));

        if ($sale->balance <= 0) {
            $sale->payment_status = 'Paid';
        } elseif ($sale->paid_amt > 0) {
            $sale->payment_status = 'Partially Paid';
        } else {
            $sale->payment_status = 'Unpaid';
        }

        return $sale;
    }

    public function get_items($sale_id)
    {
        return $this->db
            ->select('ssi.*, c.category_name, c.unit')
            ->from('scrap_sales_items ssi')
            ->join('scrap_category c', 'c.id = ssi.category_id', 'left')
            ->where('ssi.sales_id', $sale_id)
            ->get()
            ->result();
    }

    // public function generate_invoice_no()
    // {
    //     $prefix = 'SCRAP' . date('Ym');
    //     $row = $this->db
    //         ->select('invoice_no')
    //         ->like('invoice_no', $prefix, 'after')
    //         ->order_by('id', 'DESC')
    //         ->limit(1)
    //         ->get('scrap_sales')
    //         ->row();

    //     if (!$row) {
    //         return $prefix . '0001';
    //     }

    //     $last_number = intval(substr($row->invoice_no, strlen($prefix)));
    //     return $prefix . str_pad($last_number + 1, 4, '0', STR_PAD_LEFT);
    // }

    public function generate_invoice_no()
    {
        $date_part = date('Ym');

        // Get last invoice generated
        $row = $this->db
            ->select('invoice_no')
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get('scrap_sales')
            ->row();

        if (!$row) {
            $next_number = 1;
        } else {
            // Extract last 4 digits (sequence part)
            $next_number = (int)substr($row->invoice_no, -4) + 1;
        }

        return 'SCRAP' . $date_part . str_pad($next_number, 4, '0', STR_PAD_LEFT);
    }

    public function insert_sale($sale_data, $items)
    {
        $this->db->trans_start();

        if (!isset($sale_data['branch_id'])) {
            $sale_data['branch_id'] = get_primary_branch_id();
        }

        $this->db->insert('scrap_sales', $sale_data);
        $sales_id = $this->db->insert_id();

        foreach ($items as $item) {
            $item['sales_id'] = $sales_id;
            $this->db->insert('scrap_sales_items', $item);
        }

        $this->db->trans_complete();

        return $sales_id;
    }

    public function update_sale($sale_id, $sale_data, $items)
    {
        $this->db->trans_start();

        $this->db->where('id', $sale_id)->update('scrap_sales', $sale_data);
        //   print_r($this->db->last_query());exit;
        $this->db->where('sales_id', $sale_id)->delete('scrap_sales_items');

        foreach ($items as $item) {
            $item['sales_id'] = $sale_id;
            $this->db->insert('scrap_sales_items', $item);
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function delete_sale($sale_id)
    {
        $this->db->trans_start();
        $this->db->where('sales_id', $sale_id)->delete('scrap_sales_items');
        $this->db->where('id', $sale_id)->delete('scrap_sales');
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function delete_ledger_entries($scrap_id)
    {
        $this->db->where('trans_type', 'SCRAP')
            ->where('trans_id', $scrap_id)
            ->delete('voucher_transaction');
        return $this->db->affected_rows();
    }

    public function save_ledger_entries($scrap_id, $record, $debit_account_id = null, $credit_accounts = [], $credit_amounts = [])
    {
        $this->delete_ledger_entries($scrap_id);

        if (empty($credit_accounts) || !is_array($credit_accounts)) {
            return true;
        }

        $customer_id = null;
        if (empty($debit_account_id)) {
            $customer = $this->db->select('customer_id')
                ->from('customers')
                ->where('name', $record['customer_name'])
                ->get()
                ->row();

            if ($customer) {
                $customer_id = $customer->customer_id;
                $ledger = $this->db->where('customer_id', $customer->customer_id)
                    ->get('general_ledger')
                    ->row();
                $debit_account_id = $ledger->account_id ?? null;
            }
        }

        if (empty($debit_account_id)) {
            return true;
        }

        $voucher_code = 'SCRAP/' . date('Ymd') . '/' . sprintf('%04d', $scrap_id);
        $voucher_date = date('Y-m-d H:i:s', strtotime($record['sale_date']));
        $user_id = $this->session->userdata('user_id') ?: null;

        $common_data = [
            'voucher_code' => $voucher_code,
            'voucher_date' => $voucher_date,
            'voucher_type' => 'S',
            'customer_id' => $customer_id,
            'trans_id' => $scrap_id,
            'trans_type' => 'SCRAP',
            'branch_id' => $record['branch_id'] ?? get_primary_branch_id(),
            'recordCreatedBy' => $user_id,
            'invoice_code' => $voucher_code,
            'narration' => 'Scrap sale invoice ' . $record['invoice_no'],
        ];

        $debit_entry = $common_data;
        $debit_entry['account_id'] = $debit_account_id;
        $debit_entry['amount'] = $record['total_amount'];
        $debit_entry['drcr_type'] = 'Dr';
        $debit_entry['invoice_amount'] = $record['total_amount'];
        insert_voucher_transaction($debit_entry);

        foreach ($credit_accounts as $index => $credit_id) {
            $amount = floatval($credit_amounts[$index] ?? 0);
            if (empty($credit_id) || $amount <= 0) {
                continue;
            }

            $credit_entry = $common_data;
            $credit_entry['account_id'] = $credit_id;
            $credit_entry['amount'] = $amount;
            $credit_entry['drcr_type'] = 'Cr';
            $credit_entry['invoice_amount'] = $amount;
            insert_voucher_transaction($credit_entry);
        }

        return true;
    }

    /**
     * Get pending scrap invoices (not fully paid)
     */
    public function get_pending_invoices()
    {
        $receipt_subquery = "(
            SELECT trans_id, SUM(amount) AS receipt_paid
            FROM voucher_transaction
            WHERE trans_type = 'SCRAP'
                AND voucher_type = 'R'
                AND drcr_type = 'Cr'
                AND cancel = 0
            GROUP BY trans_id
        ) receipt";
// print_r("Nnnnnn".$receipt_subquery);
        apply_branch_filter('ss');
       $invoices = $this->db
    ->select('
        ss.id,
        ss.invoice_no,
        ss.customer_name,
        ss.sale_date,
        ss.grand_total AS total_amount,
        COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0) AS paid_amount,
        ss.grand_total - (COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0)) AS pending_amount,
        ss.cash_account_id AS customer_ledger_id
    ', false)
    ->from('scrap_sales ss')
    ->join($receipt_subquery, 'receipt.trans_id = ss.id', 'left')
    ->where('(COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0)) < ss.grand_total', null, false)
    ->order_by('ss.sale_date', 'DESC')
    ->get()
    ->result();

        foreach ($invoices as $invoice) {
            if ($invoice->paid_amount >= $invoice->total_amount) {
                $invoice->payment_status = 'Paid';
            } elseif ($invoice->paid_amount > 0) {
                $invoice->payment_status = 'Partially Paid';
            } else {
                $invoice->payment_status = 'Pending';
            }
        }

        return $invoices;
    }

    /**
     * Get pending invoices for specific customer
     */
    public function get_pending_invoices_for_customer($customer_name, $voucher_code = null)
    {
        $voucher_invoice_ids = [];
        if (!empty($voucher_code)) {
            $voucher_invoice_ids = $this->db
                ->select('trans_id')
                ->from('voucher_transaction')
                ->where('voucher_code', $voucher_code)
                ->where('trans_type', 'SCRAP')
                ->where('drcr_type', 'Cr')
                ->where('cancel', 0)
                ->get()
                ->result();

            $voucher_invoice_ids = array_map(function ($row) {
                return $row->trans_id;
            }, $voucher_invoice_ids);
        }

        $receipt_subquery = "(
            SELECT trans_id, SUM(amount) AS receipt_paid
            FROM voucher_transaction
            WHERE trans_type = 'SCRAP'
                AND voucher_type = 'R'
                AND drcr_type = 'Cr'
                AND cancel = 0
            GROUP BY trans_id
        ) receipt";
$this->db->select("
    ss.id,
    ss.invoice_no,
    ss.sale_date,
    ss.grand_total AS total_amount,
    (COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0)) AS paid_amount,
    (ss.grand_total - (COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0))) AS pending_amount,
    ss.cash_account_id AS customer_ledger_id
", false);

$this->db->from('scrap_sales ss');
$this->db->join($receipt_subquery, 'receipt.trans_id = ss.id', 'left');
$this->db->where('ss.customer_name', $customer_name);
apply_branch_filter('ss');

$pending_condition = '(COALESCE(ss.advance_used, 0) + COALESCE(receipt.receipt_paid, 0)) < ss.grand_total';

if (!empty($voucher_invoice_ids)) {
    $this->db->group_start();
        $this->db->where($pending_condition, null, false);
        $this->db->or_where_in('ss.id', $voucher_invoice_ids);
    $this->db->group_end();
} else {
    $this->db->where($pending_condition, null, false);
}

$this->db->order_by('ss.sale_date', 'DESC');

$results = $this->db->get()->result();

        foreach ($results as $invoice) {
            if ($invoice->paid_amount >= $invoice->total_amount) {
                $invoice->payment_status = 'Paid';
            } elseif ($invoice->paid_amount > 0) {
                $invoice->payment_status = 'Partially Paid';
            } else {
                $invoice->payment_status = 'Pending';
            }

            $invoice->max_payable = $this->get_invoice_payable_amount(
                $invoice->id,
                !empty($voucher_code) ? $voucher_code : null
            );
        }

        return $results;
    }

    /**
     * Maximum amount that can be paid on a scrap invoice (after advance and other receipts).
     */
    public function get_invoice_payable_amount($invoice_id, $exclude_voucher_code = null)
    {
        $scrap = $this->db
            ->select('grand_total, advance_used, invoice_no')
            ->where('id', $invoice_id)
            ->get('scrap_sales')
            ->row();

        if (!$scrap) {
            return 0;
        }

        $advance_used = floatval($scrap->advance_used ?? 0);
        $grand_total = floatval($scrap->grand_total);

        $this->db->select('COALESCE(SUM(amount), 0) AS receipt_paid', false);
        $this->db->from('voucher_transaction');
        $this->db->where('trans_id', $invoice_id);
        $this->db->where('trans_type', 'SCRAP');
        $this->db->where('voucher_type', 'R');
        $this->db->where('drcr_type', 'Cr');
        $this->db->where('cancel', 0);
        if (!empty($exclude_voucher_code)) {
            $this->db->where('voucher_code !=', $exclude_voucher_code);
        }

        $receipt_paid = floatval($this->db->get()->row()->receipt_paid ?? 0);
        $payable = $grand_total - $advance_used - $receipt_paid;

        return max(0, round($payable, 2));
    }

    /**
     * Validate receipt payment amounts against invoice payable limits.
     */
    public function validate_receipt_payments($invoice_ids, $dr_amounts, $exclude_voucher_code = null)
    {
        if (empty($invoice_ids) || !is_array($invoice_ids)) {
            return [
                'valid' => false,
                'message' => 'Please select at least one scrap invoice to pay.',
            ];
        }

        $total_positive_payment = 0;
        foreach ($invoice_ids as $inv_id) {
            $amount = isset($dr_amounts[$inv_id]) ? (float) $dr_amounts[$inv_id] : 0;
            if ($amount <= 0) {
                continue;
            }
            $total_positive_payment += $amount;

            $max_payable = $this->get_invoice_payable_amount($inv_id, $exclude_voucher_code);
            if ($amount > $max_payable + 0.009) {
                $scrap = $this->db->select('invoice_no')->where('id', $inv_id)->get('scrap_sales')->row();
                $invoice_no = $scrap ? $scrap->invoice_no : $inv_id;

                return [
                    'valid' => false,
                    'message' => 'Payment for invoice ' . $invoice_no . ' exceeds payable amount of ' . number_format($max_payable, 2) . '.',
                ];
            }
        }

        if ($total_positive_payment <= 0) {
            return [
                'valid' => false,
                'message' => 'Please enter a valid payment amount for at least one selected invoice.',
            ];
        }

        return ['valid' => true, 'message' => ''];
    }

    /**
     * Cap a payment amount to the invoice payable limit.
     */
    private function cap_receipt_payment_amount($amount, $invoice_id, $exclude_voucher_code = null)
    {
        $amount = (float) $amount;
        if ($amount <= 0) {
            return 0;
        }

        $max_payable = $this->get_invoice_payable_amount($invoice_id, $exclude_voucher_code);
        return min($amount, $max_payable);
    }

    /**
     * Add Scrap Receipt Voucher (similar to add_new_receipt in Accounts_model)
     */
    public function add_scrap_receipt()
    {
        // Generate voucher code
        $code_prefix = "SRV/" . date('y') . "/";
        $this->load->model('Accounts_model');
        $num = $this->Accounts_model->get_account_code_count($code_prefix, 'R') + 1;
        $voucher_code = $code_prefix . sprintf("%05d", $num);

        // Get POST data
        $vdate = $this->input->post('v_date');
        $vtime = $this->input->post('vtime');
        $customer_name = $this->input->post('customer_name');
        $debtor_account_id = $this->input->post('debtor');
        $narration = $this->input->post('narration');
        $transaction_type = $this->input->post('transaction_type');
        $transaction_no = $this->input->post('transaction_no');
        $user_id = $this->session->userdata('user_id');

        // Invoice data from scrap sales
        $invoiceIDs = $this->input->post('invoiceID');
        $dr_amounts = $this->input->post('dr_amount');
        $invoice_codes = $this->input->post('invoice_no');

        // Credit data
        $creditors = $this->input->post('creditor');
        $cr_amounts = $this->input->post('cr_amount');

        $voucher_datetime = date('Y-m-d H:i:s', strtotime("$vdate $vtime"));

        // Get customer ledger ID
        $cust_id = null;
        if (!empty($invoiceIDs) && is_array($invoiceIDs)) {
            $first_invoice = $this->db->where('id', $invoiceIDs[0])->get('scrap_sales')->row();
            if ($first_invoice) {
                $cust_id = $first_invoice->cash_account_id;
            }
        }

        try {
            // Insert debit entries (from scrap invoices)
            if (!empty($invoiceIDs) && is_array($invoiceIDs)) {
                foreach ($invoiceIDs as $inv_id) {
                    $dr_amount = isset($dr_amounts[$inv_id]) ? (float)$dr_amounts[$inv_id] : 0;
                    $dr_amount = $this->cap_receipt_payment_amount($dr_amount, $inv_id);
                    $invoice_no = isset($invoice_codes[$inv_id]) ? $invoice_codes[$inv_id] : '';

                    if ($dr_amount > 0) {
                        // Get scrap sale details
                        $scrap = $this->db->where('id', $inv_id)->get('scrap_sales')->row();

                        $data_dr = array(
                            'voucher_code'     => $voucher_code,
                            'voucher_date'     => $voucher_datetime,
                            'voucher_type'     => 'R',
                            'customer_id'      => $cust_id,
                            'account_id'       => $debtor_account_id,
                            'amount'           => $dr_amount,
                            'drcr_type'        => 'Cr',
                            'narration'        => $narration,
                            'trans_id'         => $inv_id,
                            'trans_type'       => 'SCRAP',
                            'branch_id'        => get_primary_branch_id(),
                            'invoice_code'     => $invoice_no,
                            'invoice_amount'   => $dr_amount,
                            'transaction_type' => $transaction_type,
                            'transaction_no'   => $transaction_no,
                            'recordCreatedBy'  => $user_id
                        );

                        insert_voucher_transaction($data_dr);

                        // Update scrap sale payment status
                        $this->db->set('paid_amt', 'paid_amt + ' . $dr_amount, false);
                        $this->db->where('id', $inv_id);
                        $result = $this->db->update('scrap_sales');

                        // ✅ Check and update status (Pending/Paid/Partially Paid)
                        $scrap = $this->db->where('id', $inv_id)->get('scrap_sales')->row();
                        if ($scrap) {
                            if ($scrap->paid_amt >= $scrap->grand_total) {
                                $this->db->where('id', $inv_id)->update('scrap_sales', ['payment_status' => 'Paid']);
                            } elseif ($scrap->paid_amt > 0) {
                                $this->db->where('id', $inv_id)->update('scrap_sales', ['payment_status' => 'Partially Paid']);
                            } else {
                                $this->db->where('id', $inv_id)->update('scrap_sales', ['payment_status' => 'Pending']);
                            }
                        }
                    }
                }
            }

            // Insert credit entries (cash/bank accounts)
            if (!empty($creditors) && is_array($creditors)) {
                foreach ($creditors as $index => $creditor_id) {
                    $cr_amount = isset($cr_amounts[$index]) ? (float)$cr_amounts[$index] : 0;

                    if ($cr_amount > 0 && !empty($creditor_id)) {
                        $data_cr = array(
                            'voucher_code'     => $voucher_code,
                            'voucher_date'     => $voucher_datetime,
                            'voucher_type'     => 'R',
                            'customer_id'      => $cust_id,
                            'account_id'       => $creditor_id,
                            'amount'           => $cr_amount,
                            'drcr_type'        => 'Dr',
                            'narration'        => $narration,
                            'trans_type'       => 'SCRAP',
                            'branch_id'        => get_primary_branch_id(),
                            'transaction_type' => $transaction_type,
                            'transaction_no'   => $transaction_no,
                            'recordCreatedBy'  => $user_id
                        );

                        insert_voucher_transaction($data_cr);
                    }
                }
            }

            return $voucher_code;
        } catch (Exception $e) {
            log_message('error', 'Scrap Receipt Error: ' . $e->getMessage());
            return '';
        }
    }

    /**
     * Get scrap receipt list
     */
    public function get_receipt_list($from_date, $to_date)
    {
        apply_branch_filter('vt');
        return $this->db
            ->select("
                vt.voucher_code,
                MAX(vt.voucher_date) AS voucher_date,
                SUM(CASE WHEN vt.drcr_type = 'Dr' THEN vt.amount ELSE 0 END) AS amount,
                MAX(vt.cancel) AS cancel,
                GROUP_CONCAT(
                    DISTINCT CASE
                        WHEN vt.drcr_type = 'Cr' AND NULLIF(vt.invoice_code, '') IS NOT NULL
                            THEN vt.invoice_code
                        WHEN vt.drcr_type = 'Cr' THEN ss.invoice_no
                    END
                    ORDER BY vt.invoice_code SEPARATOR ', '
                ) AS invoice_no,
                GROUP_CONCAT(DISTINCT ss.customer_name ORDER BY ss.customer_name SEPARATOR ', ') AS customer_name,
                COUNT(DISTINCT vt.voucher_id) AS transaction_count
            ", false)
            ->from('voucher_transaction vt')
            ->join('scrap_sales ss', 'ss.id = vt.trans_id', 'left')
            ->where('vt.trans_type', 'SCRAP')
            ->where('vt.voucher_type', 'R')
            ->where('vt.voucher_date >=', $from_date . ' 00:00:00')
            ->where('vt.voucher_date <=', $to_date . ' 23:59:59')
            ->group_by('vt.voucher_code')
            ->order_by('vt.voucher_date', 'DESC')
            ->get()
            ->result();
    }
public function get_receipt_header($voucher_code)
{
    // Reset previous query
    $this->db->reset_query();

    log_message('error', 'Voucher Code: ' . $voucher_code);

    $this->db->select('
        vt.voucher_code,
        vt.voucher_id,
        vt.voucher_date,
        vt.voucher_type,
        SUM(CASE WHEN vt.drcr_type = "Dr" THEN vt.amount ELSE 0 END) as amount,
        vt.customer_id,
        COALESCE(MAX(ss.customer_name), MAX(cm.name)) as customer_name,
        vt.transaction_type,
        vt.transaction_no,
        vt.narration,
        dr.invoice_codes,
        dr.invoice_amounts,
        cr.credit_account_name
    ');

    $this->db->from('voucher_transaction vt');

    $this->db->join(
        'scrap_sales ss',
        'ss.id = vt.trans_id',
        'left'
    );

    $this->db->join(
        'customers cm',
        'cm.customer_id = vt.customer_id',
        'left'
    );

    $drSubquery = "
        (
            SELECT
                voucher_code,
                GROUP_CONCAT(invoice_code SEPARATOR ', ') AS invoice_codes,
                GROUP_CONCAT(amount SEPARATOR ', ') AS invoice_amounts
            FROM voucher_transaction
            WHERE trans_type = 'SCRAP'
                AND voucher_type = 'R'
                AND drcr_type = 'Cr'
                AND cancel = 0
            GROUP BY voucher_code
        ) dr
    ";

    $this->db->join(
        $drSubquery,
        'dr.voucher_code = vt.voucher_code',
        'left'
    );

    $crSubquery = "
        (
            SELECT
                vt2.voucher_code,
                GROUP_CONCAT(gl.account_name SEPARATOR ', ') AS credit_account_name
            FROM voucher_transaction vt2
            JOIN general_ledger gl ON gl.account_id = vt2.account_id
            WHERE vt2.trans_type = 'SCRAP'
                AND vt2.voucher_type = 'R'
                AND vt2.drcr_type = 'Dr'
                AND vt2.cancel = 0
            GROUP BY vt2.voucher_code
        ) cr
    ";

    $this->db->join(
        $crSubquery,
        'cr.voucher_code = vt.voucher_code',
        'left'
    );

    $this->db->where('vt.voucher_code', $voucher_code);
    $this->db->where('vt.voucher_type', 'R');
    $this->db->where('vt.trans_type', 'SCRAP');
    $this->db->where('vt.drcr_type', 'Dr');
    $this->db->where('vt.cancel', 0);

    $this->db->group_by([
        'vt.voucher_code',
        'vt.voucher_id',
        'vt.voucher_date',
        'vt.voucher_type',
        'vt.customer_id',
        'cm.name',
        'vt.transaction_type',
        'vt.transaction_no',
        'vt.narration',
        'dr.invoice_codes',
        'dr.invoice_amounts',
        'cr.credit_account_name'
    ]);

    return $this->db->get()->row();
}


public function get_receipt_details($voucher_code)
{
    // Reset previous query
    $this->db->reset_query();

    $this->db->select('
        vt.voucher_code,
        vt.trans_id as invoice_id,
        vt.amount as receipt_amount,
        COALESCE(im.customer_name, cm.name) as customer_name,
        im.invoice_no,
        ssi.id as item_id,
        COALESCE(c.category_name, "N/A") as category_name,
        COALESCE(c.unit, "") as unit_name,
        ssi.quantity,
        ssi.rate,
        ssi.amount as item_amount
    ');

    $this->db->from('voucher_transaction vt');

    $this->db->join(
        'scrap_sales im',
        'im.id = vt.trans_id',
        'left'
    );

    $this->db->join(
        'customers cm',
        'cm.customer_id = vt.customer_id',
        'left'
    );

    $this->db->join(
        'scrap_sales_items ssi',
        'ssi.sales_id = vt.trans_id',
        'left'
    );

    $this->db->join(
        'scrap_category c',
        'c.id = ssi.category_id',
        'left'
    );

    $this->db->where('vt.voucher_code', $voucher_code);
    $this->db->where('vt.voucher_type', 'R');
    $this->db->where('vt.trans_type', 'SCRAP');
    $this->db->where('vt.drcr_type', 'Cr');
    $this->db->where('vt.cancel', 0);

    $this->db->order_by('im.invoice_no', 'ASC');
    $this->db->order_by('ssi.id', 'ASC');

    return $this->db->get()->result();
    }

    public function get_receipt_credit_details($voucher_code)
    {
        $this->db->reset_query();

        $this->db->select('vt.account_id, vt.amount');
        $this->db->from('voucher_transaction vt');
        $this->db->where('vt.voucher_code', $voucher_code);
        $this->db->where('vt.voucher_type', 'R');
        $this->db->where('vt.trans_type', 'SCRAP');
        $this->db->where('vt.drcr_type', 'Dr');
        $this->db->where('vt.cancel', 0);

        return $this->db->get()->result();
    }

/**
 * Update Scrap Receipt Voucher (delete old and create new)
 */
public function update_scrap_receipt()
{
    // Get voucher code from POST
    $voucher_code = $this->input->post('voucher_code');
    
    try {
        // Step 1: Reverse old transactions - Get all invoices that were paid by this receipt
        $old_transactions = $this->db
            ->where('voucher_code', $voucher_code)
            ->where('trans_type', 'SCRAP')
            ->where('voucher_type', 'R')
            ->where('drcr_type', 'Cr')
            ->get('voucher_transaction')
            ->result();

        // Reverse paid amounts from scrap sales
        foreach ($old_transactions as $trans) {
            if ($trans->trans_id) {
                $this->db->set('paid_amt', 'paid_amt - ' . $trans->amount, false);
                $this->db->where('id', $trans->trans_id);
                $this->db->update('scrap_sales');

                // Reset payment status
                $scrap = $this->db->where('id', $trans->trans_id)->get('scrap_sales')->row();
                if ($scrap) {
                    if ($scrap->paid_amt <= 0) {
                        $this->db->where('id', $trans->trans_id)->update('scrap_sales', ['payment_status' => 'Pending']);
                    } elseif ($scrap->paid_amt < $scrap->grand_total) {
                        $this->db->where('id', $trans->trans_id)->update('scrap_sales', ['payment_status' => 'Partially Paid']);
                    }
                }
            }
        }

        // Step 2: Delete old voucher transactions
        $this->db->where('voucher_code', $voucher_code)->delete('voucher_transaction');

        // Step 3: Create new transactions (same as add_scrap_receipt)
        $vdate = $this->input->post('v_date');
        $vtime = $this->input->post('vtime');
        $customer_name = $this->input->post('customer_name');
        $debtor_account_id = $this->input->post('debtor');
        $narration = $this->input->post('narration');
        $transaction_type = $this->input->post('transaction_type');
        $transaction_no = $this->input->post('transaction_no');
        $user_id = $this->session->userdata('user_id');

        // Invoice data from scrap sales
        $invoiceIDs = $this->input->post('invoiceID');
        $dr_amounts = $this->input->post('dr_amount');
        $invoice_codes = $this->input->post('invoice_no');

        // Credit data
        $creditors = $this->input->post('creditor');
        $cr_amounts = $this->input->post('cr_amount');

        $voucher_datetime = date('Y-m-d H:i:s', strtotime("$vdate $vtime"));

        // Get customer ledger ID
        $cust_id = null;
        if (!empty($invoiceIDs) && is_array($invoiceIDs)) {
            $first_invoice = $this->db->where('id', $invoiceIDs[0])->get('scrap_sales')->row();
            if ($first_invoice) {
                $cust_id = $first_invoice->cash_account_id;
            }
        }

        // Insert debit entries (from scrap invoices)
        if (!empty($invoiceIDs) && is_array($invoiceIDs)) {
            foreach ($invoiceIDs as $inv_id) {
                $dr_amount = isset($dr_amounts[$inv_id]) ? (float)$dr_amounts[$inv_id] : 0;
                $dr_amount = $this->cap_receipt_payment_amount($dr_amount, $inv_id);
                $invoice_no = isset($invoice_codes[$inv_id]) ? $invoice_codes[$inv_id] : '';

                if ($dr_amount > 0) {
                    $scrap = $this->db->where('id', $inv_id)->get('scrap_sales')->row();

                    $data_dr = array(
                        'voucher_code'     => $voucher_code,
                        'voucher_date'     => $voucher_datetime,
                        'voucher_type'     => 'R',
                        'customer_id'      => $cust_id,
                        'account_id'       => $debtor_account_id,
                        'amount'           => $dr_amount,
                        'drcr_type'        => 'Cr',
                        'narration'        => $narration,
                        'trans_id'         => $inv_id,
                        'trans_type'       => 'SCRAP',
                        'invoice_code'     => $invoice_no,
                        'invoice_amount'   => $dr_amount,
                        'transaction_type' => $transaction_type,
                        'transaction_no'   => $transaction_no,
                        'recordCreatedBy'  => $user_id
                    );

                    insert_voucher_transaction($data_dr);

                    // Update scrap sale payment status
                    $this->db->set('paid_amt', 'paid_amt + ' . $dr_amount, false);
                    $this->db->where('id', $inv_id);
                    $this->db->update('scrap_sales');

                    // ✅ Check and update status (Pending/Paid/Partially Paid)
                    $scrap = $this->db->where('id', $inv_id)->get('scrap_sales')->row();
                    if ($scrap) {
                        if ($scrap->paid_amt >= $scrap->grand_total) {
                            $this->db->where('id', $inv_id)->update('scrap_sales', ['payment_status' => 'Paid']);
                        } elseif ($scrap->paid_amt > 0) {
                            $this->db->where('id', $inv_id)->update('scrap_sales', ['payment_status' => 'Partially Paid']);
                        } else {
                            $this->db->where('id', $inv_id)->update('scrap_sales', ['payment_status' => 'Pending']);
                        }
                    }
                }
            }
        }

            // Insert credit entries (cash/bank accounts)
        if (!empty($creditors) && is_array($creditors)) {
            foreach ($creditors as $index => $creditor_id) {
                $cr_amount = isset($cr_amounts[$index]) ? (float)$cr_amounts[$index] : 0;

                if ($cr_amount > 0 && !empty($creditor_id)) {
                    $data_cr = array(
                        'voucher_code'     => $voucher_code,
                        'voucher_date'     => $voucher_datetime,
                        'voucher_type'     => 'R',
                        'customer_id'      => $cust_id,
                        'account_id'       => $creditor_id,
                        'amount'           => $cr_amount,
                        'drcr_type'        => 'Dr',
                        'narration'        => $narration,
                        'trans_type'       => 'SCRAP',
                        'transaction_type' => $transaction_type,
                        'transaction_no'   => $transaction_no,
                        'recordCreatedBy'  => $user_id
                    );

                    insert_voucher_transaction($data_cr);
                }
            }
        }

        return $voucher_code;
    } catch (Exception $e) {
        log_message('error', 'Scrap Receipt Update Error: ' . $e->getMessage());
        return '';
    }
}

/**
 * Cancel Scrap Receipt Voucher (Mark as cancelled without deleting)
 */
public function cancel_receipt($voucher_code)
{
    try {
        // Get all transactions for this voucher
        $old_transactions = $this->db
            ->where('voucher_code', $voucher_code)
            ->where('trans_type', 'SCRAP')
            ->where('voucher_type', 'R')
            ->where('drcr_type', 'Dr')
            ->get('voucher_transaction')
            ->result();

        // Reverse paid amounts from scrap sales
        foreach ($old_transactions as $trans) {
            if ($trans->trans_id) {
                $this->db->set('paid_amt', 'paid_amt - ' . $trans->amount, false);
                $this->db->where('id', $trans->trans_id);
                $this->db->update('scrap_sales');

                // Reset payment status
                $scrap = $this->db->where('id', $trans->trans_id)->get('scrap_sales')->row();
                if ($scrap) {
                    if ($scrap->paid_amt <= 0) {
                        $this->db->where('id', $trans->trans_id)->update('scrap_sales', ['payment_status' => 'Pending']);
                    } elseif ($scrap->paid_amt < $scrap->grand_total) {
                        $this->db->where('id', $trans->trans_id)->update('scrap_sales', ['payment_status' => 'Partially Paid']);
                    }
                }
            }
        }
 
        // Mark all voucher transactions as cancelled
        $this->db->where('voucher_code', $voucher_code);
        $this->db->where('trans_type', 'SCRAP');
        $this->db->where('voucher_type', 'R');
        $upd = ['cancel' => 1];
        ensure_branch_in_data($upd);
        $this->db->update('voucher_transaction', $upd);

        return true;
    } catch (Exception $e) {
        log_message('error', 'Scrap Receipt Cancel Error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Delete Scrap Receipt Voucher (Permanently delete)
 */
public function delete_receipt($voucher_code)
{
    try {
        // Get all transactions for this voucher
        $old_transactions = $this->db
            ->where('voucher_code', $voucher_code)
            ->where('trans_type', 'SCRAP')
            ->where('voucher_type', 'R')
            ->where('drcr_type', 'Dr')
            ->get('voucher_transaction')
            ->result();

        // Reverse paid amounts from scrap sales
        foreach ($old_transactions as $trans) {
            if ($trans->trans_id) {
                $this->db->set('paid_amt', 'paid_amt - ' . $trans->amount, false);
                $this->db->where('id', $trans->trans_id);
                $this->db->update('scrap_sales');

                // Reset payment status
                $scrap = $this->db->where('id', $trans->trans_id)->get('scrap_sales')->row();
                if ($scrap) {
                    if ($scrap->paid_amt <= 0) {
                        $this->db->where('id', $trans->trans_id)->update('scrap_sales', ['payment_status' => 'Pending']);
                    } elseif ($scrap->paid_amt < $scrap->grand_total) {
                        $this->db->where('id', $trans->trans_id)->update('scrap_sales', ['payment_status' => 'Partially Paid']);
                    }
                }
            }
        }

        // Delete all voucher transactions
        $this->db->where('voucher_code', $voucher_code);
        $this->db->where('trans_type', 'SCRAP');
        $this->db->where('voucher_type', 'R');
        $this->db->delete('voucher_transaction');

        return true;
    } catch (Exception $e) {
        log_message('error', 'Scrap Receipt Delete Error: ' . $e->getMessage());
        return false;
    }
}
}
