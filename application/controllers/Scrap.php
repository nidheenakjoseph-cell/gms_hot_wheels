<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scrap extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Scrap_model');
        $this->load->model('Scrap_category_model');
        $this->load->model('Accounts_model');
        $this->load->model('Customer_model');
        $this->load->helper(array('form', 'url', 'myopeningbalance'));
        $this->load->library('form_validation');
    } 

    // AJAX: search customers for Select2
    public function customer_search()
    {
        $term = $this->input->get('q');
        $customers = $this->Customer_model->search_customers($term);
        
        $results = [];
        foreach ($customers as $c) {
            $results[] = [
                'id' => $c->text,
                'text' => $c->text,
                'customer_id' => $c->id,
                'ledger_id' => $c->ledger_id ?? null,
            ];
        }

        echo json_encode(['results' => $results]);
        return;
    }

    // AJAX: create customer and ledger, return created info
    public function create_customer_ajax()
    {
        $name = trim($this->input->post('name'));
        if (empty($name)) {
            echo json_encode(['error' => 'Name required']);
            return;
        }

        $customerData = [
            'name'      => $name,
            'phone'     => trim($this->input->post('phone')),
            'email'     => trim($this->input->post('email')),
            'address'   => trim($this->input->post('address')),
            'emirates'  => trim($this->input->post('emirate')),
            'trn'       => trim($this->input->post('trn')),
        ];

        // Check existing by exact name
        $existing = $this->Customer_model->get_customer_by_name($name);
        if ($existing) {
            $ledger = $this->Customer_model->get_customer_ledger($existing->customer_id);
            echo json_encode(['id' => $existing->customer_id, 'name' => $existing->name, 'ledger' => $ledger]);
            return;
        }

        $customer_id = $this->Customer_model->create_with_ledger($customerData);
        $ledger = $this->Customer_model->get_customer_ledger($customer_id);

        echo json_encode(['id' => $customer_id, 'name' => $name, 'ledger' => $ledger]);
        return;
    }

    // AJAX: return accounts list (for refreshing revenue/cash selects)
    public function accounts_ajax()
    {

        $accounts = $this->Accounts_model->get_all_general_ledger_accounts();
        $out = [];
        foreach ($accounts as $a) {
            $out[] = ['id' => $a->account_id, 'text' => $a->account_name];
        }
        echo json_encode(['results' => $out]);
        return;
    }

    public function get_category_balances_by_branch()
    {
        $branch_id = $this->input->get('branch_id');
        $branch_id = !empty($branch_id) ? intval($branch_id) : get_primary_branch_id();

        $categories = $this->Scrap_category_model->get_active_categories();
        $balances = [];
        foreach ($categories as $category) {
            $collected = $this->Scrap_category_model->get_collected_quantity($category->id, $branch_id);
            $sold = $this->Scrap_category_model->get_sold_quantity($category->id, $branch_id);
            $balances[$category->id] = $collected - $sold;
        }

        header('Content-Type: application/json');
        echo json_encode(['balances' => $balances]);
        return;
    }

    public function index()
    {
        $data['scrap_sales'] = $this->Scrap_model->get_all();

        $account_names = [];
        foreach ($this->Accounts_model->get_all_general_ledger_accounts() as $account) {
            $account_names[$account->account_id] = $account->account_name;
        }
        $data['account_names'] = $account_names;

        $data['title'] = 'Scrap Sales';
        $data['main_content'] = 'scrap/list';
        $this->load->view('includes/template', $data);
    }

    public function list()
    {
        $this->index();
    }

    public function add()
    {
        $data['title'] = 'Add Scrap Sale';
        $data['accounts'] = $this->Accounts_model->get_all_general_ledger_accounts();
        $data['sundry_accounts1'] = $this->Accounts_model->get_gen_ledger_detors_records();
        $data['sundry_accounts2'] = $this->Accounts_model->get_general_ledger_by_group('Sales Accounts');
        $data['sundry_accounts3'] = $this->Accounts_model->get_all_general_ledger_accounts();
        $categories = $this->Scrap_category_model->get_active_categories();

        $branch_id = get_primary_branch_id();
        $category_balances = [];
        foreach ($categories as $category) {
            $collected = $this->Scrap_category_model->get_collected_quantity($category->id, $branch_id);
            $sold = $this->Scrap_category_model->get_sold_quantity($category->id, $branch_id);
            $category_balances[$category->id] = $collected - $sold;
        }
        
        $data['categories'] = $categories;
        $data['category_balances'] = $category_balances;
        $data['scrap'] = null;
        $data['main_content'] = 'scrap/form';
        $this->load->view('includes/template', $data);
    }

    public function edit($scrap_id)
    {
        $data['scrap'] = $this->Scrap_model->get($scrap_id);
        if (!$data['scrap']) {
            $this->session->set_flashdata('error', 'Scrap sale invoice not found.');
            redirect('scrap');
        }

        $data['title'] = 'Edit Scrap Sale';
        $data['accounts'] = $this->Accounts_model->get_all_general_ledger_accounts();
        $data['sundry_accounts1'] = $this->Accounts_model->get_gen_ledger_detors_records();
        $data['sundry_accounts2'] = $this->Accounts_model->get_general_ledger_by_group('Sales Accounts');
        $data['sundry_accounts3'] = $this->Accounts_model->get_all_general_ledger_accounts();

        $branch_id = !empty($data['scrap']->branch_id) ? $data['scrap']->branch_id : get_primary_branch_id();

        $customer = $this->Customer_model->get_customer_by_name($data['scrap']->customer_name);
        $data['customer_ledger_id'] = null;
        if ($customer) {
            $ledger = $this->Customer_model->get_customer_ledger($customer->customer_id);
            $data['customer_ledger_id'] = $ledger->account_id ?? null;
        }

        // Organize ledger entries for form display
        $data['scrap']->inv_debtor = [];
        $data['scrap']->inv_creditor = [];
        $data['scrap']->inv_dr_amount = [];
        $data['scrap']->inv_cr_amount = [];

        if (!empty($data['scrap']->ledger_entries)) {
            $debit_idx = 0;
            $credit_idx = 0;
            foreach ($data['scrap']->ledger_entries as $entry) {
                if ($entry->drcr_type === 'Dr') {
                    $data['scrap']->inv_debtor[$debit_idx] = $entry->account_id;
                    $data['scrap']->inv_dr_amount[$debit_idx] = $entry->amount;
                    $debit_idx++;
                } elseif ($entry->drcr_type === 'Cr') {
                    $data['scrap']->inv_creditor[$credit_idx] = $entry->account_id;
                    $data['scrap']->inv_cr_amount[$credit_idx] = $entry->amount;
                    $credit_idx++;
                }
            }
        }

        $categories = $this->Scrap_category_model->get_active_categories();
        
        $category_balances = [];
        foreach ($categories as $category) {
            $collected = $this->Scrap_category_model->get_collected_quantity($category->id, $branch_id);
            $sold = $this->Scrap_category_model->get_sold_quantity($category->id, $branch_id);
            $category_balances[$category->id] = $collected - $sold;
        }
        
        $data['categories'] = $categories;
        $data['category_balances'] = $category_balances;
        $data['scrap_items'] = $this->Scrap_model->get_items($scrap_id);
        $data['main_content'] = 'scrap/form';
        $this->load->view('includes/template', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('sale_date', 'Sale Date', 'required');
        $this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
        // $this->form_validation->set_rules('payment_status', 'Payment Status', 'required');

        $scrap_id = $this->input->post('scrap_id');
        $existing_invoice_no = null;
        if ($scrap_id) {
            $existing_scrap = $this->Scrap_model->get($scrap_id);
            if ($existing_scrap) {
                $existing_invoice_no = $existing_scrap->invoice_no;
            } else {
                $scrap_id = null;
            }
        }

        $item_categories = $this->input->post('category_id');
        $item_quantities = $this->input->post('quantity');
        $item_rates = $this->input->post('rate');
        $item_amounts = $this->input->post('amount');

        $items = [];
        $balance_errors = [];
        
        $branch_id = $this->input->post('branch_id') ?: get_primary_branch_id();

        if (is_array($item_categories)) {
            foreach ($item_categories as $index => $category_id) {
                $category_id = intval($category_id);
                $quantity = floatval($item_quantities[$index] ?? 0);
                $rate = floatval($item_rates[$index] ?? 0);
                $amount = floatval($item_amounts[$index] ?? 0);

                if ($category_id > 0 && $quantity > 0 && $rate > 0) {
                    $collected = $this->Scrap_category_model->get_collected_quantity($category_id, $branch_id);
                    $sold = $this->Scrap_category_model->get_sold_quantity($category_id, $branch_id);
                    $available_balance = $collected - $sold;
                    
                    if ($quantity > $available_balance) {
                        $category = $this->Scrap_category_model->get($category_id);
                        $balance_errors[] = "Category '{$category->category_name}': You are trying to sell {$quantity}, but only {$available_balance} is available in stock.";
                    }
                    
                    $items[] = [
                        'category_id' => $category_id,
                        'quantity' => $quantity,
                        'rate' => $rate,
                        'amount' => $amount ?: ($quantity * $rate),
                    ];
                }
            }
        }

        if (empty($items)) {
            $this->form_validation->set_rules('category_id[]', 'Scrap Items', 'required', array('required' => 'At least one scrap item is required.'));
        }

        if (!empty($balance_errors)) {
            foreach ($balance_errors as $error) {
                $this->form_validation->set_message('required', $error);
            }
        }

        if ($this->form_validation->run() === false || empty($items) || !empty($balance_errors)) {
            $data['title'] = $scrap_id ? 'Edit Scrap Sale' : 'Add Scrap Sale';
            $data['accounts'] = $this->Accounts_model->get_all_general_ledger_accounts();
            $data['sundry_accounts1'] = $this->Accounts_model->get_gen_ledger_detors_records();
            $data['sundry_accounts2'] = $this->Accounts_model->get_general_ledger_by_group('Sales Accounts');
            $data['sundry_accounts3'] = $this->Accounts_model->get_all_general_ledger_accounts();
            $categories = $this->Scrap_category_model->get_active_categories();
            
            $branch_id = $this->input->post('branch_id') ?: get_primary_branch_id();
            $category_balances = [];
            foreach ($categories as $category) {
                $collected = $this->Scrap_category_model->get_collected_quantity($category->id, $branch_id);
                $sold = $this->Scrap_category_model->get_sold_quantity($category->id, $branch_id);
                $category_balances[$category->id] = $collected - $sold;
            }
            
            $data['categories'] = $categories;
            $data['category_balances'] = $category_balances;
            $data['scrap'] = (object) $this->input->post();
            $data['scrap_items'] = $items;
            
            if (!empty($balance_errors)) {
                $data['balance_errors'] = $balance_errors;
            }
            
            $data['main_content'] = 'scrap/form';
            $this->load->view('includes/template', $data);
            return;
        }

        $total_amount = array_sum(array_column($items, 'amount'));
        $inv_creditors = $this->input->post('inv_creditor') ?: [];
        $inv_cre_amount = $this->input->post('inv_cr_amount') ?: [];
        $customer_ledger_id = $this->input->post('customer_ledger_id') ?: null;

        // Taxes and totals
        $subtotal = $total_amount;
        $discount_amount = 0.00;
        $taxable = max(0, $subtotal - $discount_amount);
        $tax_amount = round($taxable * 0.05, 2);
        $grand_total = round($taxable + $tax_amount, 2);

        $advance_used = floatval($this->input->post('advance_paid') ?: 0);
        if ($advance_used > $grand_total) $advance_used = $grand_total;

        $sale_date = date('Y-m-d', strtotime($this->input->post('sale_date')));

        $record = [
            'invoice_no' => $this->input->post('invoice_no') ?: ($existing_invoice_no ?: $this->Scrap_model->generate_invoice_no()),
            'sale_date' => $sale_date,
            'customer_name' => $this->input->post('customer_name'),
            'branch_id' => $this->input->post('branch_id') ?: get_primary_branch_id(),
            'total_amount' => $grand_total,
            'subtotal' => $subtotal,
            'discount_amount' => $discount_amount,
            'taxable_amount' => $taxable,
            'tax_amount' => $tax_amount,
            'grand_total' => $grand_total,
            'advance_used' => $advance_used,
            'revenue_account_id' => $inv_creditors[0] ?? null,
            'cash_account_id' => $customer_ledger_id,
            'notes' => $this->input->post('notes'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->trans_begin();
        try {
            if ($scrap_id) {
                $existing = $this->Scrap_model->get($scrap_id);
                $later_payments = max(0, floatval($existing->paid_amt ?? 0) - floatval($existing->advance_used ?? 0));
                $record['paid_amt'] = $advance_used + $later_payments;
                $record['balance'] = round($grand_total - $record['paid_amt'], 2);
                $record['payment_status'] = ($record['paid_amt'] >= $grand_total) ? 'Paid'
                    : (($record['paid_amt'] > 0) ? 'Partially Paid' : 'Unpaid');

                $this->Scrap_model->update_sale($scrap_id, $record, $items);
                $this->save_ledger_entries($scrap_id, $record, $customer_ledger_id, $inv_creditors, $inv_cre_amount);
                $this->db->trans_commit();
                $this->apply_customer_advance_to_scrap($record['customer_name'], $scrap_id, $advance_used, $customer_ledger_id, $record['invoice_no']);
                $this->session->set_flashdata('success', 'Scrap sale updated successfully.');
            } else {
                $record['paid_amt'] = $advance_used;
                $record['balance'] = round($grand_total - $advance_used, 2);
                $payment_status = ($advance_used >= $grand_total) ? 'Paid' : (($advance_used > 0) ? 'Partially Paid' : 'Unpaid');
                $record['payment_status'] = $payment_status;
                $record['created_at'] = date('Y-m-d H:i:s');

                $scrap_id = $this->Scrap_model->insert_sale($record, $items);
                $this->save_ledger_entries($scrap_id, $record, $customer_ledger_id, $inv_creditors, $inv_cre_amount);
                $this->db->trans_commit();
                if ($advance_used > 0) {
                    $this->apply_customer_advance_to_scrap($record['customer_name'], $scrap_id, $advance_used, $customer_ledger_id, $record['invoice_no']);
                }
                $this->session->set_flashdata('success', 'Scrap sale created successfully.');
            }
        } catch (RuntimeException $e) {
            $this->db->trans_rollback();
            log_message('error', '[SCRAP] Save failed: ' . $e->getMessage());
            $this->session->set_flashdata('error', $e->getMessage());
        }

        redirect('scrap');
    }

    public function delete($scrap_id)
    {
        $scrap = $this->Scrap_model->get($scrap_id);
        if (!$scrap) {
            $this->session->set_flashdata('error', 'Scrap sale invoice not found.');
            redirect('scrap');
            return;
        }

        // Clean up advance receipts and ADV transactions
        $this->db->like('receipt_no', 'ADV-SCRAP-' . $scrap_id, 'both')->delete('advance_receipts');
        $this->db->where('trans_id', $scrap_id)->where('trans_type', 'ADV')->delete('voucher_transaction');

        $this->db->where('trans_type', 'SCRAP')
            ->where('trans_id', $scrap_id)
            ->delete('voucher_transaction');

        $this->Scrap_model->delete_sale($scrap_id);
        $this->session->set_flashdata('success', 'Scrap sale deleted successfully.');
        redirect('scrap');
    }

    public function view($scrap_id)
    {
        $scrap = $this->Scrap_model->get($scrap_id);
        if (!$scrap) {
            $this->session->set_flashdata('error', 'Scrap sale invoice not found.');
            redirect('scrap');
        }

        $data['title'] = 'Scrap Sale Details';
        $data['scrap'] = $scrap;
        $data['main_content'] = 'scrap/view';
        $this->load->view('includes/template', $data);
    }

    public function print_scrap($scrap_id)
    {
        $scrap = $this->Scrap_model->get($scrap_id);
        if (!$scrap) {
            show_error('Scrap sale invoice not found.');
        }

        $this->load->view('scrap/print', ['scrap' => $scrap]);
    }

    public function download_scrap($scrap_id)
    {
        $scrap = $this->Scrap_model->get($scrap_id);
        if (!$scrap) {
            show_error('Scrap sale invoice not found.');
        }

        $this->load->library('pdf');
        $html = $this->load->view('scrap/print', ['scrap' => $scrap], true);
        $this->pdf->createPDF(
            $html,
            'Scrap_' . $scrap->invoice_no,
            true
        );
    }

    private function save_ledger_entries($scrap_id, $record, $debit_account_id = null, $credit_accounts = [], $credit_amounts = [])
    {
        $this->Scrap_model->save_ledger_entries($scrap_id, $record, $debit_account_id, $credit_accounts, $credit_amounts);
    }

    /**
     * Add Receipt Voucher Form for Scrap Invoice
     */
    public function add_receipt()
    {
        $data['title'] = "Scrap Receipt Voucher";
        
        // Get scrap invoices that haven't been fully paid
        $data['scrap_invoices'] = $this->Scrap_model->get_pending_invoices();
        
        // Get all general ledger accounts for credit side
        $data['sundry_detors_records'] = $this->Accounts_model->get_all_general_ledger_accounts();
        
        // Get customer accounts for debit side
        $data['receipt_Creditors'] = $this->Accounts_model->get_general_ledger_accounts('1', '3');
        
        $data['main_content'] = 'scrap/receipt_add';
        $this->load->view('includes/template', $data);
    }

    /**
     * Save Scrap Receipt Voucher
     */
    public function add_receipt_details()
    {
        $this->load->model('Accounts_model');

        $validation = $this->Scrap_model->validate_receipt_payments(
            $this->input->post('invoiceID'),
            $this->input->post('dr_amount')
        );
        if (!$validation['valid']) {
            $this->session->set_flashdata('error', $validation['message']);
            redirect('Scrap/add_receipt');
        }

        $id = $this->Scrap_model->add_scrap_receipt();

        if ($id != '') {
            $this->session->set_flashdata('success', 'Scrap Receipt Voucher Successfully Saved');
            redirect('Scrap/view_receipt_list');
        } else {
            $this->session->set_flashdata('error', 'Failed to save receipt voucher');
            redirect('Scrap/add_receipt');
        }
    }
 
    /**
     * View Scrap Receipt List
     */
    public function view_receipt_list()
    {
        $data['title'] = "Scrap Receipt Voucher List";
        
        if ($this->input->post('from')) {
            $data['from'] = $this->input->post('from');
            $data['to'] = $this->input->post('to');
        } else {
            $data['from'] = date('Y-m-d');
            $data['to'] = date('Y-m-d');
        }

        $data['receipt_records'] = $this->Scrap_model->get_receipt_list($data['from'], $data['to']);
        $data['main_content'] = 'scrap/receipt_list';
        $this->load->view('includes/template', $data);
    }
 
    /**
     * AJAX: Get pending scrap invoices for customer
     */
    public function get_scrap_invoices()
    {
        $customer_name = $this->input->post('customer_name');
        $voucher_code = $this->input->post('voucher_code');
        $invoices = $this->Scrap_model->get_pending_invoices_for_customer($customer_name, $voucher_code);
        echo json_encode($invoices);
    }

    private function apply_customer_advance_to_scrap($customer_name, $scrap_id, $advance_used, $customer_ledger_id = null, $invoice_no = '')
    {
        // Find customer id by name
        $customer = $this->db->select('customer_id')->from('customers')->where('name', $customer_name)->get()->row();
        $customer_id = $customer->customer_id ?? null;
        if (!$customer_id) {
            // cannot find customer to adjust advances
            return;
        }

        // Clean up any previously created scrap-specific advance receipts and voucher transactions for this scrap sale
        $this->db->like('receipt_no', 'ADV-SCRAP-' . $scrap_id, 'both')->delete('advance_receipts');
        $this->db->where('trans_id', $scrap_id)->where('trans_type', 'ADV')->delete('voucher_transaction');

        if ($advance_used <= 0) return;

        // Calculate total available advance balance for the customer
        $total_available = 0;
        $advances_sum = $this->db->select('SUM(balance_amount) as total')
            ->from('advance_receipts')
            ->where('customer_id', $customer_id)
            ->where('balance_amount >', 0)
            ->get()
            ->row();
        if ($advances_sum && $advances_sum->total) {
            $total_available = floatval($advances_sum->total);
        }

        // If the advance used is greater than available pre-existing advances,
        // we create a new advance receipt for the difference!
        if ($advance_used > $total_available) {
            $new_advance_amt = $advance_used - $total_available;
            
            $adv_data = [
                'receipt_no' => 'ADV-SCRAP-' . $scrap_id . '-' . time(),
                'receipt_date' => date('Y-m-d'),
                'customer_id' => $customer_id,
                'amount' => $new_advance_amt,
                'balance_amount' => $new_advance_amt,
                'used_amount' => 0,
                'status' => 'partial',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('advance_receipts', $adv_data);
        }

        $remaining = (float) $advance_used;

        // Use advance_receipts (customer advances) — FIFO
        $advances = $this->db->select('advance_id, amount, used_amount, balance_amount')
            ->from('advance_receipts')
            ->where('customer_id', $customer_id)
            ->where('balance_amount >', 0)
            ->order_by('created_at', 'ASC')
            ->get()
            ->result();

        foreach ($advances as $adv) {
            $available = floatval($adv->balance_amount);
            if ($available <= 0) continue;

            $consume = min($available, $remaining);
            $new_balance = $available - $consume;
            $status = ($new_balance <= 0) ? 'fully_used' : 'partial';

            // update advance_receipts
            $this->db->set('used_amount', 'used_amount + ' . $consume, false)
                ->set('balance_amount', 'balance_amount - ' . $consume, false)
                ->set('status', $status)
                ->where('advance_id', $adv->advance_id)
                ->update('advance_receipts');

            // Create ADV voucher entries (receipt) for this consumed amount
            $this->load->model('Accounts_model');
            $code_prefix = "ADV/" . date('y') . "/";
            $num = $this->Accounts_model->get_account_code_count_for_advance($code_prefix, 'ADV') + 1;
            $advance_code = $code_prefix . sprintf("%05d", $num);

            $vdate = date('Y-m-d H:i:s');
            $cash_account = 23; // cash/bank ledger

            // Debit cash/bank (Dr)
            $dr = [
                'voucher_code' => $advance_code,
                'voucher_date' => $vdate,
                'voucher_type' => 'R',
                'customer_id' => $customer_id,
                'account_id' => $cash_account,
                'amount' => $consume,
                'drcr_type' => 'Dr',
                'trans_id' => $scrap_id,
                'trans_type' => 'ADV',
                'recordCreatedBy' => $this->session->userdata('user_id'),
                'invoice_code' => $invoice_no,
                'invoice_amount' => $consume,
            ];
            insert_voucher_transaction($dr);

            // Credit customer advance (liability) or customer ledger if provided
            $credit_account = $customer_ledger_id ?: $this->Accounts_model->get_account_id_using_name('Customer Advance');
            $cr = $dr;
            $cr['account_id'] = $credit_account;
            $cr['drcr_type'] = 'Cr';
            insert_voucher_transaction($cr);

            $remaining -= $consume;
            if ($remaining <= 0) break;
        }
    }
    /**
     * Edit Receipt Voucher
     */
    public function edit_receipt($voucher_code = '')
    {
        if (empty($voucher_code)) {
            $voucher_code = $this->input->get('code');
        }
        $voucher_code = trim(urldecode($voucher_code));
        if (empty($voucher_code)) {
            $this->session->set_flashdata('error', 'Invalid receipt voucher code.');
            redirect('Scrap/view_receipt_list');
        }

        // Get receipt header and details
        $receipt_header = $this->Scrap_model->get_receipt_header($voucher_code);
        $receipt_details = $this->Scrap_model->get_receipt_details($voucher_code);
        $receipt_credits = $this->Scrap_model->get_receipt_credit_details($voucher_code);

        if (!$receipt_header) {
            $this->session->set_flashdata('error', 'Receipt voucher not found.');
            redirect('Scrap/view_receipt_list');
        }

        $data['title'] = "Edit Scrap Receipt Voucher";
        $data['voucher_code'] = $voucher_code;
        $data['receipt_header'] = $receipt_header;
        $data['receipt_details'] = $receipt_details;
        $data['receipt_credits'] = $receipt_credits;
        $data['scrap_invoices'] = $this->Scrap_model->get_pending_invoices();
        $data['sundry_detors_records'] = $this->Accounts_model->get_general_ledger_accounts('2', '4');
        $data['receipt_Creditors'] = $this->Accounts_model->get_general_ledger_accounts('1', '3');
        $data['main_content'] = 'scrap/receipt_edit';
        $this->load->view('includes/template', $data);
    }

    /**
     * Update Receipt Voucher
     */
    public function update_receipt_details()
    {
        $voucher_code = $this->input->post('voucher_code');
        
        if (empty($voucher_code)) {
            $this->session->set_flashdata('error', 'Invalid receipt voucher code.');
            redirect('Scrap/view_receipt_list');
        }

        $validation = $this->Scrap_model->validate_receipt_payments(
            $this->input->post('invoiceID'),
            $this->input->post('dr_amount'),
            $voucher_code
        );
        if (!$validation['valid']) {
            $this->session->set_flashdata('error', $validation['message']);
            redirect('Scrap/edit_receipt/' . urlencode($voucher_code));
        }

        // Delete old transaction entries
        $id = $this->Scrap_model->update_scrap_receipt($voucher_code);

        if ($id != '') {
            $this->session->set_flashdata('success', 'Scrap Receipt Voucher Successfully Updated');
            redirect('Scrap/view_receipt_list');
        } else {
            $this->session->set_flashdata('error', 'Failed to update receipt voucher');
            redirect('Scrap/edit_receipt/' . urlencode($voucher_code));
        }
    }

    /**
     * Delete Receipt Voucher
     */
    public function delete_receipt($voucher_code = '')
    {
        if (empty($voucher_code)) {
            $voucher_code = $this->input->get('code');
        }
        $voucher_code = trim(urldecode($voucher_code));
        if (empty($voucher_code)) {
            $this->session->set_flashdata('error', 'Invalid receipt voucher code.');
            redirect('Scrap/view_receipt_list');
        }

        // Verify receipt exists
        $receipt_header = $this->Scrap_model->get_receipt_header($voucher_code);
        if (!$receipt_header) {
            $this->session->set_flashdata('error', 'Receipt voucher not found.');
            redirect('Scrap/view_receipt_list');
        }

        // Delete the receipt
        if ($this->Scrap_model->delete_receipt($voucher_code)) {
            $this->session->set_flashdata('success', 'Scrap Receipt Voucher Successfully Deleted');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete receipt voucher');
        }

        redirect('Scrap/view_receipt_list');
    }

    /**
     * Cancel Receipt Voucher
     */
    public function cancel_receipt($voucher_code = '')
    {
        if (empty($voucher_code)) {
            $voucher_code = $this->input->get('code');
        }
        $voucher_code = trim(urldecode($voucher_code));
        if (empty($voucher_code)) {
            $this->session->set_flashdata('error', 'Invalid receipt voucher code.');
            redirect('Scrap/view_receipt_list');
        }

        // Verify receipt exists
        $receipt_header = $this->Scrap_model->get_receipt_header($voucher_code);
        if (!$receipt_header) {
            $this->session->set_flashdata('error', 'Receipt voucher not found.');
            redirect('Scrap/view_receipt_list');
        }

        // Cancel the receipt
        if ($this->Scrap_model->cancel_receipt($voucher_code)) {
            $this->session->set_flashdata('success', 'Scrap Receipt Voucher Successfully Cancelled');
        } else {
            $this->session->set_flashdata('error', 'Failed to cancel receipt voucher');
        }

        redirect('Scrap/view_receipt_list');
    }

    function print_receipt()
    {
        // Prefer code via query parameter to avoid issues with encoded slashes in URI segments
        $voucher_code = $this->input->get('code');
        if (!empty($voucher_code)) {
            $voucher_code = trim(urldecode($voucher_code));
        }

        if (empty($voucher_code)) {
            // Fallback: assemble remaining URI segments (supports legacy links)
            $segments = array_slice($this->uri->segment_array(), 2);
            $voucher_code = implode('/', $segments);
            $voucher_code = trim(urldecode($voucher_code));
        }

        if (empty($voucher_code)) {
            show_error('Receipt code not provided.');
        }

        $data['header'] = $this->Scrap_model->get_receipt_header($voucher_code);
        $data['details'] = $this->Scrap_model->get_receipt_details($voucher_code);

        if (!$data['header']) {
            show_error('Receipt not found!');
        }

        $this->load->view('scrap/print_receipt', $data);
    }
}
