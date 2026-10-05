<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Invoice extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Invoice_model');
		$this->load->model('Jobcard_model');
		$this->load->model('Accounts_model');
		$this->load->model('Advance_model');
		$this->load->helper('amount');
	} 
	public function generate()
	{
		$data['title'] = 'Invoice List';

		// Get all invoices with customer & vehicle details
		$data['invoices'] = $this->Invoice_model->get_all_invoices();
		$data['jobcards'] = $this->Jobcard_model->get_all_jobcards_completed();


		$data['sundry_accounts1'] = $this->Accounts_model->get_gen_ledger_detors_records();
		$data['sundry_accounts2'] = $this->Accounts_model->get_general_ledger_by_group('Sales Accounts');
		$data['sundry_accounts3'] = $this->Accounts_model->get_all_general_ledger_accounts();

		// log_message('error', 'Sundry Accounts 1 (Debtors): ' . print_r($data['sundry_accounts1'], true));
		// log_message('error', 'Sundry Accounts 2 (Sales Accounts): ' . print_r($data['sundry_accounts2'], true));
		// log_message('error', 'Sundry Accounts 3 (All GL Accounts): ' . print_r($data['sundry_accounts3'], true));




		$data['main_content'] = 'invoice/generate';
		$this->load->view('includes/template', $data);
	}

	public function index()
	{
		$data['title'] = 'Invoice List';
		$data['username'] = $this->session->userdata('username');
		$data['userid'] = $this->session->userdata('user_id');

		$data['invoices'] = $this->Invoice_model->get_all_invoices_with_payment();
		$company_id = get_current_company_id();
		$wa_settings = $this->db->get_where('whatsapp_settings', ['company_id' => $company_id])->row();
		$data['whatsapp_enabled'] = !empty($wa_settings->whatsapp_enabled);
		log_message('error', 'Invoice List: ' . print_r($data['invoices'], true));
		$data['main_content'] = 'invoice/index';
		$this->load->view('includes/template', $data);
	}
 

	public function save()
	{
		$jobcard_id = $this->input->post('jobcard_id');

		$jobcard = $this->db
			->select('quotation_id, branch_id')
			->from('job_cards')
			->where('jobcard_id', $jobcard_id)
			->get()
			->row();

		if (!$jobcard || !$jobcard->quotation_id) {
			show_error('Quotation not linked with Jobcard');
		}

		$quotation_id = $jobcard->quotation_id;
		$branch_id    = $jobcard->branch_id;
		$invoice_type = $this->input->post('invoice_type');
		$invoice_date = $this->input->post('invoice_date_hidden');
		$invoice_no   = $this->generate_invoice_no($invoice_type, $jobcard_id);

		notify_event(
			'invoice_created',
			$invoice_id,
			'Invoice ' . $invoice_no . ' created',
			'invoice/view/' . $invoice_id,
			'Invoice',
			['details' => 'Invoice total: ' . number_format($grand_total, 2)]
		);

		$service_prices    = $this->input->post('service_price')    ?: [];
		$service_discounts = $this->input->post('service_discount') ?: [];
		$part_totals       = $this->input->post('part_total')       ?: [];
		$part_discounts    = $this->input->post('part_discount')    ?: [];
		$desc_amounts      = $this->input->post('desc_amount')      ?: [];
		$sublet_discounts  = $this->input->post('sublet_discount')  ?: [];

		$subtotal_amount = 0.0;
		foreach ($service_prices as $price) {
			$subtotal_amount += (float) $price;
		}
		foreach ($part_totals as $price) {
			$subtotal_amount += (float) $price;
		}
		foreach ($desc_amounts as $amount) {
			$subtotal_amount += (float) $amount;
		}

		$discount_amount = 0.0;
		foreach ($service_discounts as $discount) {
			$discount_amount += (float) $discount;
		}
		foreach ($part_discounts as $discount) {
			$discount_amount += (float) $discount;
		}
		foreach ($sublet_discounts as $discount) {
			$discount_amount += (float) $discount;
		}

		$discount_amount = round($discount_amount, 2);
		$taxable_amount  = max(0, round($subtotal_amount - $discount_amount, 2));
		$tax_amount      = round($taxable_amount * 5 / 100, 2);
		$grand_total     = round($taxable_amount + $tax_amount, 2);
		$status          = ($this->input->post('adv_paid') > 0) ? 'Advance Paid' : 'Unpaid';

		$this->db->trans_begin();
		try {
			$invoice_id = $this->Invoice_model->create_invoice([
				'branch_id'             => $branch_id,
				'jobcard_id'            => $this->input->post('jobcard_id'),
				'quotation_id'          => $quotation_id,
				'invoice_type'          => $invoice_type,
				'invoice_date'          => $invoice_date,
				'subtotal'              => $this->input->post('subtotal')         !== null ? (float)$this->input->post('subtotal')         : $subtotal_amount,
				'tax_amount'            => $this->input->post('tax_amount')       !== null ? (float)$this->input->post('tax_amount')       : $tax_amount,
				'discount_amount'       => $this->input->post('discount_amount')  !== null ? (float)$this->input->post('discount_amount')  : $discount_amount,
				'grand_total'           => $this->input->post('grand_total')      !== null ? (float)$this->input->post('grand_total')      : $grand_total,
				'status'                => $status,
				'remarks'               => $this->input->post('remarks'),
				'invoice_no'            => $invoice_no,
				'customer_id'           => $this->input->post('customer_id'),
				'adv_paid'              => $this->input->post('adv_paid'),
				'balance_after_invoice' => $this->input->post('balance_total'),
			]);

			$this->Invoice_model->insert_invoice_items_from_post($invoice_id);

			$this->db->trans_commit();

		} catch (RuntimeException $e) {
			$this->db->trans_rollback();
			log_message('error', '[INVOICE] Save failed: ' . $e->getMessage());
			$this->session->set_flashdata('invoice_error_message', $e->getMessage());
			redirect('invoice/generate');
			return;
		}

		// ADVANCE ADJUSTMENT (outside transaction â€” non-accounting table)
		$advance_used = (float)$this->input->post('adv_paid');
		if ($advance_used > 0) {
			$result = $this->Invoice_model->auto_adjust_advance($quotation_id, $advance_used);
			if (!$result['status']) {
				$this->session->set_flashdata('invoice_error_message', $result['msg']);
				$this->session->set_flashdata('invoice_error_remaining', $result['remaining']);
				// redirect('invoice/generate');
				// return;
				redirect('invoice/view/' . $invoice_id);
			}
		}

		redirect('invoice/view/' . $invoice_id);
	}


	public function download($invoice_id)
	{
		$this->load->library('pdf');
		$data['invoice'] = $this->Invoice_model->get_full_invoice($invoice_id);

		$html = $this->load->view('invoice/pdf', $data, true);

		$this->pdf->createPDF($html, 'invoice_' . $invoice_id, false);
	}

	public function send_email($invoice_id)
	{
		$data = $this->Invoice_model->get_invoice_full($invoice_id);
		if (empty($data['invoice'])) return $this->email_response(false, 'Invoice not found.');
		$invoice = $data['invoice'];
		$customer_email = $invoice->customer_email ?? '';
		$recipient = trim($this->input->post('email')) ?: $customer_email;
		if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) return $this->email_response(false, 'Please enter a valid email address.');

		$options = new Options(); $options->set('isRemoteEnabled', true); $dompdf = new Dompdf($options);
		$dompdf->loadHtml($this->load->view('invoice/print_pdf', $data, true)); $dompdf->setPaper('A4', 'portrait'); $dompdf->render();
		$cache_dir = FCPATH . 'application/cache/';
		if (!is_dir($cache_dir)) { mkdir($cache_dir, 0755, true); }
		$pdf_path = $cache_dir . 'invoice_' . $invoice_id . '_' . uniqid() . '.pdf'; file_put_contents($pdf_path, $dompdf->output());
		$this->load->library('gms_mailer');
		$company_id   = get_current_company_id();
		$company_name = $this->gms_mailer->get_company_name($company_id);
		$result = $this->gms_mailer->send_notification($recipient, 'invoice_sent', [
			'{customer_name}' => $invoice->customer_name ?? '', '{vehicle_no}' => $invoice->registration_no ?? '',
			'{invoice_no}' => $invoice->invoice_no,
			'{amount}' => number_format((float) $invoice->grand_total, 2),
			'{invoice_amount}' => number_format((float) $invoice->grand_total, 2),
			'{date}' => date('d/m/Y', strtotime($invoice->invoice_date)), '{company_name}' => $company_name,
		], $pdf_path, $company_id);
		@unlink($pdf_path);
		return $this->email_response($result['status'], $result['message']);
	}

	private function email_response($status, $message)
	{
		$this->output->set_content_type('application/json')->set_output(json_encode(['status' => (bool) $status, 'message' => $message]));
	}

	public function get_jobcard_details($jobcard_id)
	{
		// $jobcard = $this->Jobcard_model->get_jobcard_with_details($jobcard_id);
		$jobcard = $this->Jobcard_model->get_jobcard_full_details_quotation($jobcard_id);
		log_message('error', 'Jobcard Data: ' . print_r($jobcard, true));
		echo json_encode($jobcard);
	}


	public function save_payment()
	{
		$invoice_id = $this->input->post('invoice_id');
		$amount     = (float) $this->input->post('amount');

		// Basic validation
		if (!$invoice_id || $amount <= 0) {
			show_error('Invalid payment data');
		}

		// 1. Save payment
		$paymentData = [
			'invoice_id'   => $invoice_id,
			'payment_date' => date('Y-m-d'),
			'payment_mode' => $this->input->post('payment_mode'),
			'amount'       => $amount,
			'reference_no' => $this->input->post('reference_no'),
			'notes'        => $this->input->post('notes')
		];

		$this->Invoice_model->insert_payment($paymentData);

		// 2. Update invoice status
		$this->Invoice_model->update_invoice_payment_status($invoice_id);
		$invoice = $this->Invoice_model->get_invoice($invoice_id);
		$paid_amount = 0;
		foreach ($this->Invoice_model->get_invoice_payments($invoice_id) as $payment) {
			$paid_amount += (float) $payment->amount;
		}
		$paid_amount += (float) ($invoice->adv_paid ?? 0);
		$event_key = $paid_amount >= (float) $invoice->grand_total ? 'payment_received' : 'invoice_partially_paid';
		notify_event(
			$event_key,
			$invoice_id,
			'Payment received for invoice ' . ($invoice->invoice_no ?? $invoice_id),
			'invoice/view/' . $invoice_id,
			'Invoice',
			['details' => 'Received: ' . number_format($amount, 2) . '; total paid: ' . number_format($paid_amount, 2)]
		);

		// 3. Redirect back to invoice list
		redirect('invoice');
	}

	public function view($invoice_id)
	{
		$data['title'] = 'Invoice View';

		$data['invoice']  = $this->Invoice_model->get_invoice($invoice_id);
		$data['items']    = $this->Invoice_model->get_invoice_items($invoice_id);
		$data['payments'] = $this->Invoice_model->get_invoice_payments($invoice_id);

		// Calculate paid & balance
		// Receipt voucher payments (already excludes advance/QT vouchers via get_invoice_payments)
		$paid = 0;
		foreach ($data['payments'] as $p) {
			$paid += floatval($p->amount);
		}

		// Add the advance paid recorded on the invoice itself
		$paid += floatval($data['invoice']->adv_paid ?? 0);

		$data['paid_amount']    = $paid;
		$data['balance_amount'] = max(0, $data['invoice']->grand_total - $paid);

		$data['invstatus'] = 'Unpaid';

		if ($data['balance_amount'] >= $data['invoice']->grand_total) {
			$data['invstatus'] = 'Unpaid';
			
		} elseif ($data['balance_amount'] > 0) {
			$data['invstatus']  = 'Partially Paid';
			
		} else {
			$data['invstatus']  = 'Paid';
			
		}


		$data['main_content'] = 'invoice/view';
		$this->load->view('includes/template', $data);
	}
	public function print_invoice($invoice_id)
	{
		// $data['title'] = 'Invoice View';
		$data = $this->Invoice_model->get_invoice_full($invoice_id);
		// echo "<pre>";
		// print_r($data);
		// exit;
		// $data['main_content'] = 'invoice/print';
		$this->load->view('invoice/print', $data);
	}


	public function download_invoice($invoice_id)
	{
		$this->load->library('pdf');

		$data = $this->Invoice_model->get_invoice_full($invoice_id);
		log_message('error', 'Invoice Data: ' . print_r($data, true));
		$html = $this->load->view('invoice/print_pdf', $data, true);

		$this->pdf->createPDF(
			$html,
			'Invoice_' . $data['invoice']->invoice_no,
			true
		);
	}


	// use PhpOffice\PhpSpreadsheet\Spreadsheet;
	// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	// use PhpOffice\PhpSpreadsheet\Style\Alignment;
	// use PhpOffice\PhpSpreadsheet\Style\Border;

	public function export_excel($invoice_id)
	{
		$this->load->model('Invoice_model');

		$data = $this->Invoice_model->get_invoice_full($invoice_id);

		$invoice  = $data['invoice'];
		$items    = $data['items'];
		$payments = $data['payments'];

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setTitle('Invoice');

		/* ------------------------------
			GLOBAL STYLES
					------------------------------ */
		foreach (range('A', 'F') as $col) {
			$sheet->getColumnDimension($col)->setAutoSize(true);
		}

		$bold = ['font' => ['bold' => true]];
		$center = ['alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]];
		$border = [
			'borders' => [
				'allBorders' => ['borderStyle' => Border::BORDER_THIN]
			]
		];

		/* ------------------------------
			TITLE
				------------------------------ */
		$sheet->mergeCells('A1:F1');
		$sheet->setCellValue('A1', 'TAX INVOICE');
		$sheet->getStyle('A1')->applyFromArray([
			'font' => ['bold' => true, 'size' => 16],
			'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
		]);

		/* ------------------------------
			INVOICE INFO
			------------------------------ */
		$sheet->setCellValue('A3', 'Invoice No');
		$sheet->setCellValue('B3', $invoice->invoice_no);
		$sheet->setCellValue('D3', 'Invoice Date');
		$sheet->setCellValue('E3', $invoice->invoice_date);

		$sheet->setCellValue('A4', 'Status');
		$sheet->setCellValue('B4', $invoice->status);

		$sheet->getStyle('A3:A4')->applyFromArray($bold);
		$sheet->getStyle('D3')->applyFromArray($bold);

		/* ------------------------------
			CUSTOMER & VEHICLE
			------------------------------ */
		$sheet->setCellValue('A6', 'Customer Name');
		$sheet->setCellValue('B6', $invoice->customer_name);
		$sheet->setCellValue('A7', 'Phone');
		$sheet->setCellValueExplicit('B7', $invoice->phone, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

		$sheet->setCellValue('D6', 'Vehicle No');
		$sheet->setCellValue('E6', $invoice->registration_no);
		$sheet->setCellValue('D7', 'Vehicle');
		$sheet->setCellValue('E7', $invoice->brand . ' ' . $invoice->model);

		$sheet->getStyle('A6:A7')->applyFromArray($bold);
		$sheet->getStyle('D6:D7')->applyFromArray($bold);

		/* ------------------------------
				ITEMS HEADER
				------------------------------ */
		$row = 9;
		$sheet->setCellValue("A{$row}", 'Item Type');
		$sheet->setCellValue("B{$row}", 'Description');
		$sheet->setCellValue("C{$row}", 'Qty');
		$sheet->setCellValue("D{$row}", 'Unit Price');
		$sheet->setCellValue("E{$row}", 'Total');

		$sheet->getStyle("A{$row}:E{$row}")->applyFromArray($bold);
		$sheet->getStyle("A{$row}:E{$row}")->applyFromArray($border);
		$sheet->getStyle("C{$row}:E{$row}")->applyFromArray($center);

		/* ------------------------------
			ITEMS DATA
			------------------------------ */
		$row++;
		foreach ($items as $it) {
			$sheet->setCellValue("A{$row}", $it->item_type);
			$sheet->setCellValue("B{$row}", $it->item_name);
			$sheet->setCellValue("C{$row}", $it->quantity);
			$sheet->setCellValue("D{$row}", $it->unit_price);
			$sheet->setCellValue("E{$row}", $it->total_price);

			$sheet->getStyle("A{$row}:E{$row}")->applyFromArray($border);
			$sheet->getStyle("C{$row}:E{$row}")->applyFromArray($center);
			$row++;
		}

		/* ------------------------------
			SUMMARY
			------------------------------ */
		$row += 1;

		$summary = [
			'Subtotal'       => $invoice->subtotal,
			'VAT (5%)'       => $invoice->tax_amount,
			'Discount'       => $invoice->discount_amount,
			'Grand Total'    => $invoice->grand_total,
			'Paid Amount'    => $data['paid'],
			'Balance Amount' => $data['balance']
		];

		foreach ($summary as $label => $value) {
			$sheet->setCellValue("D{$row}", $label);
			$sheet->setCellValue("E{$row}", $value);
			$sheet->getStyle("D{$row}:E{$row}")->applyFromArray($border);
			$sheet->getStyle("D{$row}")->applyFromArray($bold);
			$row++;
		}

		/* ------------------------------
			DOWNLOAD
			------------------------------ */
		$filename = 'Invoice_' . $invoice->invoice_no . '.xlsx';

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit;
	}


	public function generate_invoice_no9_4($invoice_type)
	{
		$year = date('Y');
		// log_message('error', $invoice_type);
		// Prefix based on invoice type
		$prefix = ($invoice_type === 'PI') ? 'PI' : 'TI';

		$last = $this->db
			->like('invoice_no', "$prefix-$year-", 'after')
			->order_by('invoice_id', 'DESC')
			->limit(1)
			->get('invoices')
			->row();

		if ($last) {
			$last_no = intval(substr($last->invoice_no, -4));
			$new_no  = str_pad($last_no + 1, 4, '0', STR_PAD_LEFT);
		} else {
			$new_no = '0001';
		}

		return "$prefix-$year-$new_no";
	}

	public function generate_invoice_no($invoice_type, $jobcard_id)
	{
		// ðŸ” Step 1: Check existing invoice for SAME jobcard + type
		$existing = $this->db
			->where('jobcard_id', $jobcard_id)
			->where('invoice_type', $invoice_type)
			->get('invoices')
			->row();

		if ($existing) {
			return $existing->invoice_no; // âœ… already exists â†’ reuse
		}

		// ðŸ”¢ Step 2: Generate new invoice number
		$year = date('Y');

		// Prefix
		$prefix = ($invoice_type === 'PI') ? 'PI' : 'TI';

		// Get last invoice of same type
		$last = $this->db
			->like('invoice_no', "$prefix-$year-", 'after')
			->order_by('invoice_id', 'DESC')
			->limit(1)
			->get('invoices')
			->row();

		if ($last) {
			$parts = explode('-', $last->invoice_no);
			$last_no = intval(end($parts));
			$new_no  = str_pad($last_no + 1, 4, '0', STR_PAD_LEFT);
		} else {
			$new_no = '0001';
		}

		return "$prefix-$year-$new_no";
	}


	public function delete($invoice_id)
	{
		// 1. Get invoice number (for voucher delete)
		$invoice = $this->db
			->where('invoice_id', $invoice_id)
			->get('invoices')
			->row();

		if (!$invoice) {
			show_error('Invoice not found');
		}

		$invoice_no = $invoice->invoice_no;

		$this->db->trans_start();
		try {

		// 2. Delete invoice items
		$this->db->where('invoice_id', $invoice_id);
		$this->db->delete('invoice_items');


		// 3. Delete voucher transaction entry
		$this->db->where('invoice_code', $invoice_no);
		$this->db->delete('voucher_transaction');


		// 4. Delete invoice header
		$this->db->where('invoice_id', $invoice_id);
		$this->db->delete('invoices');

			$this->db->trans_commit();
			$this->session->set_flashdata('success', 'Invoice deleted successfully');

		} catch (RuntimeException $e) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', $e->getMessage());
		}

		redirect('Invoice');
	}

	// ======================= edit invoicev================

	public function edit($invoice_id)
	{
		$data['invoice'] = $this->Invoice_model->get_invoice_fullnew($invoice_id);
		$data['items']   = $this->Invoice_model->get_invoice_items($invoice_id);

		$data['payments'] = $this->Invoice_model->get_invoice_payments($invoice_id);

		// other_paid = invoice-mode receipt vouchers (excludes QT advance receipts which are
		// already captured in $invoice->adv_paid and shown in the Advance Payment field).
		$other_paid = 0;
		foreach ($data['payments'] as $p) {
			$other_paid += floatval($p->amount);
		}
		$data['other_paid'] = $other_paid;

		$data['sundry_accounts1'] = $this->Accounts_model->get_gen_ledger_detors_records();
		$data['sundry_accounts2'] = $this->Accounts_model->get_general_ledger_by_group('Sales Accounts');
		$data['sundry_accounts3'] = $this->Accounts_model->get_all_general_ledger_accounts();
 
		$data['title'] = 'Invoice Edit';
		$data['main_content'] = 'invoice/edit_invoice';
		$this->load->view('includes/template', $data);
	}

	public function get_invoice_details($invoice_id)
	{
		$header = $this->Invoice_model->get_invoice_header($invoice_id);
		$items  = $this->Invoice_model->get_invoice_items($invoice_id);

		echo json_encode([
			'header' => $header,
			'items'  => $items
		]);
	}

	public function get_invoice_full_data($invoice_id)
	{
		$header = $this->Invoice_model->get_invoice_header($invoice_id);
		$services = $this->Invoice_model->get_invoice_services($invoice_id);
		$parts = $this->Invoice_model->get_invoice_parts($invoice_id);
		$descs = $this->Invoice_model->get_invoice_desc($invoice_id);

		echo json_encode([
			'header' => $header,
			'services' => $services,
			'parts' => $parts,
			'descs' => $descs
		]);
	}
	public function update()
	{
		$invoice_id = $this->input->post('invoice_id');

		// Fetch existing invoice header to determine advance delta and quotation
		$existing = $this->Invoice_model->get_invoice_header($invoice_id);
		$existing_adv = 0.0;
		$quotation_id = null;
		if ($existing) {
			$existing_adv = floatval($existing->adv_paid ?? 0);
			$quotation_id = $existing->quotation_id ?? null;
		}

		$posted_adv = $this->input->post('adv_paid');
		if ($posted_adv === null || $posted_adv === '') {
			$posted_adv = $this->input->post('advance_paid');
		}

		$discount_amount = $this->input->post('discount_amount');
		if ($discount_amount === null || $discount_amount === '') {
			$discount_amount = $this->input->post('discount_input');
		}

		$header = [
			'remarks'         => $this->input->post('remarks'),
			'subtotal'        => $this->input->post('subtotal'),
			'tax_amount'      => $this->input->post('tax_amount'),
			'discount_amount' => (float) $discount_amount,
			'grand_total'     => $this->input->post('grand_total'),
			'invoice_date'    => $this->input->post('invoice_date'),
			'adv_paid'         => floatval($posted_adv ?? 0),
			'balance_after_invoice'     => $this->input->post('balance_total'),
			// 'add_dis_percentage'     => $this->input->post('adddiscount_amount_per'),
			// 'add_dis_amount'     => $this->input->post('adddiscount_amount'),
			
		];


		// Determine advance difference and adjust quotation_payments accordingly.
		$new_adv = floatval($posted_adv ?? 0);
		$delta = $new_adv - $existing_adv;
		if ($quotation_id && abs($delta) > 0.0001) {
			if ($delta > 0) {
				// consume additional advance
				$result = $this->Invoice_model->auto_adjust_advance($quotation_id, $delta);
				if (!$result['status']) {
					$this->session->set_flashdata('invoice_adjustment_error', $result['msg']);
					$this->session->set_flashdata('invoice_id', $invoice_id);
					// redirect('invoice/edit/' . $invoice_id);
					// return;
				}
			} else {
				// release previously adjusted amount
				$this->Invoice_model->auto_unadjust_advance($quotation_id, abs($delta));
			}
		}

		$this->db->trans_begin();

		try {

		$this->Invoice_model->update_invoice($invoice_id, $header);

		// delete old items
		$this->Invoice_model->delete_invoice_items($invoice_id);

		/*
		====================================
		SAVE SERVICES
		====================================
		*/
		$srv_names = $this->input->post('srv_name');
		$srv_costs = $this->input->post('srv_cost');
		$srv_check_open = $this->input->post('srv_check_open');

		if ($srv_names) {
			foreach ($srv_names as $k => $name) {
				// âŒ Skip if unchecked
				if (!isset($srv_check_open[$k])) {
					continue;
				}

				$data = [
					'invoice_id' => $invoice_id,
					'item_type'  => 'Service',
					'item_name'  => $name,
					'quantity'   => 1,
					'unit_price' => $srv_costs[$k],
					'total_price' => $srv_costs[$k],
				];

				$this->db->insert('invoice_items', $data);
			}
		}

		/*
		====================================
		SAVE PARTS
		====================================
		*/

		$part_names  = $this->input->post('part_name');
		$part_qty    = $this->input->post('part_qty');
		$part_price  = $this->input->post('part_price');
		$part_dis    = $this->input->post('part_dis');
		$part_total  = $this->input->post('part_total');
		$part_id  = $this->input->post('part_id');
		$part_check_open = $this->input->post('part_check_open');
		if ($part_names) {
			foreach ($part_names as $k => $name) {

				// âŒ Skip if unchecked
				if (!isset($part_check_open[$k])) {
					continue;
				}

				$data = [
					'invoice_id' => $invoice_id,
					'item_type'  => 'Part',
					'item_name'  => $name,
					'source_jobcard_item_id'  => $part_id[$k],
					'quantity'   => $part_qty[$k],
					'unit_price' => $part_price[$k],
					'disamount'  => $part_dis[$k],
					'total_price' => $part_total[$k],
				];

				$this->db->insert('invoice_items', $data);
			}
		}

		/*
		====================================
		SAVE SUBLET
		====================================
		*/

		$sub_names = $this->input->post('sub_name');
		$sub_costs = $this->input->post('sub_cost');
		$sub_check_open = $this->input->post('sub_check_open');

		if ($sub_names) {
			foreach ($sub_names as $k => $name) {
				// âŒ Skip if unchecked
				if (!isset($sub_check_open[$k])) {
					continue;
				}

				$data = [
					'invoice_id' => $invoice_id,
					'item_type'  => 'Sublet',
					'item_name'  => $name,
					'quantity'   => 1,
					'unit_price' => $sub_costs[$k],
					'total_price' => $sub_costs[$k],
				];

				$this->db->insert('invoice_items', $data);
			}
		}

		$this->db->trans_commit();

		$this->Invoice_model->update_invoice_payment_status($invoice_id);

		redirect('Invoice');

		} catch (RuntimeException $e) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error', $e->getMessage());
			redirect('invoice/edit/' . $invoice_id);
		}
	}
	// ==============================function for updating part, service id on source_jobcard_item_id field ====================some are missing======
	public function fix_missing_part_links()
	{
		// 1ï¸âƒ£ Get invoice items where part_id is missing
		$items = $this->db
			->select('item_id, item_name')
			->from('invoice_items')
			->where('item_type', 'Part')
			->where('source_jobcard_item_id IS NULL', null, false)
			->get()
			->result();

		foreach ($items as $item) {

			// 2ï¸âƒ£ Try to find matching part
			$part = $this->db
				->select('part_id')
				->from('spare_parts')
				->where('LOWER(part_name)', strtolower(trim($item->item_name)))
				->get()
				->row();

			if ($part) {
				// 3ï¸âƒ£ Update invoice_items with correct part_id
				$this->db->where('item_id', $item->item_id);
				$this->db->update('invoice_items', [
					'source_jobcard_item_id' => $part->part_id
				]);

				echo "Updated Item ID: {$item->item_id} â†’ Part ID: {$part->part_id}<br>";
			} else {
				echo "No match for Item ID: {$item->item_id} ({$item->item_name})<br>";
			}
		}

		echo "DONE";
	}


	// ==================== function for updating quptation items table id ========================
	public function update_invoice_items_quotation_id()
	{
		$this->db->trans_start();

		/* ==============================
	   1. SERVICES
	============================== */
		$sql1 = "
		UPDATE invoice_items ii
		JOIN invoices inv ON inv.invoice_id = ii.invoice_id
		JOIN job_cards jc ON jc.jobcard_id = inv.jobcard_id
		JOIN quotations q ON q.quotation_id = jc.quotation_id
		JOIN quotation_services qs 
			ON qs.quotation_id = q.quotation_id
			AND qs.service_id = ii.source_jobcard_item_id
		SET ii.quotation_item_id = qs.id
		WHERE ii.item_type = 'Service'
		AND ii.quotation_item_id IS NULL
	";
		$this->db->query($sql1);
		$services_updated = $this->db->affected_rows();


		/* ==============================
	   2. PARTS
	============================== */
		$sql2 = "
		UPDATE invoice_items ii
		JOIN invoices inv ON inv.invoice_id = ii.invoice_id
		JOIN job_cards jc ON jc.jobcard_id = inv.jobcard_id
		JOIN quotations q ON q.quotation_id = jc.quotation_id
		JOIN quotation_parts qp 
			ON qp.quotation_id = q.quotation_id
			AND qp.part_id = ii.source_jobcard_item_id
		SET ii.quotation_item_id = qp.id
		WHERE ii.item_type = 'Part'
		AND ii.quotation_item_id IS NULL
	";
		$this->db->query($sql2);
		$parts_updated = $this->db->affected_rows();


		/* ==============================
	   3. SUBLET (optional attempt)
	============================== */
		// Only if you have item_name stored in invoice_items
		$sql3 = "
		UPDATE invoice_items ii
		JOIN invoices inv ON inv.invoice_id = ii.invoice_id
		JOIN job_cards jc ON jc.jobcard_id = inv.jobcard_id
		JOIN quotations q ON q.quotation_id = jc.quotation_id
		JOIN quotation_job_descriptions qjd 
			ON qjd.quotation_id = q.quotation_id
			AND qjd.description = ii.item_name
		SET ii.quotation_item_id = qjd.id
		WHERE ii.item_type = 'Sublet'
		AND ii.quotation_item_id IS NULL
	";
		$this->db->query($sql3);
		$sublet_updated = $this->db->affected_rows();


		$this->db->trans_complete();

		/* ==============================
	   4. RESULT OUTPUT
	============================== */

		if ($this->db->trans_status() === FALSE) {
			echo "âŒ Update Failed";
			return;
		}

		echo "<pre>";
		echo "âœ… Invoice Items Updated Successfully\n\n";
		echo "Services Updated: " . $services_updated . "\n";
		echo "Parts Updated: " . $parts_updated . "\n";
		echo "Sublet Updated: " . $sublet_updated . "\n";

		// Remaining unmatched
		$remaining = $this->db
			->where('quotation_item_id IS NULL', null, false)
			->count_all_results('invoice_items');

		echo "Remaining Unmatched: " . $remaining . "\n";
		echo "</pre>";
	}
}

