<?php

// date_default_timezone_set('Asia/Kolkata');

class Accounts extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$removed_financial_actions = [
			'financial_years', 'add_financial_year', 'close_financial_year',
			'request_financial_year_extension', 'decide_financial_year_extension',
			'reopen_financial_year', 'corporate_tax', 'corporate_tax_add_adjustment',
			'corporate_tax_calculate', 'corporate_tax_delete_adjustment',
			'corporate_tax_update_adjustment', 'corporate_tax_report', 'corporate_tax_finalize'
		];
		if (in_array(strtolower($this->router->fetch_method()), $removed_financial_actions, true)) {
			show_404();
		}
		$this->load->model('Admin_model');
		$this->require_login();
	}

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('logged_in') === TRUE || $this->session->userdata('is_logged_in') === TRUE;
		if (!$is_logged_in) {
			$this->session->set_flashdata('error', 'Please login to continue.');
			redirect('login');
			exit;
		}
	}

	function get_account_balance()
	{
		$account_id = $this->input->post('account_id');
		$vdate = date('Y-m-d', strtotime($this->input->post('today')));
		$this->load->model('Accounts_model');
		$res = $this->Accounts_model->get_account_balance($account_id, $vdate);
		echo $res;
	}


	//////////////////////////////// Account group starts ////////////////////////////////

	function view_account_group_form()
	{
		$data['title'] = 'Account Group';
		$this->load->model('Accounts_model');
		$data['parent_records'] = $this->Accounts_model->get_account_group_parent();
		$data['section_records'] = $this->Accounts_model->get_account_section();
		$data['main_content'] = 'accounts/account_group_addition.php';
		$this->load->view('includes/template', $data);
	}

	function account_group_list()
	{
		$data['title'] = 'Account Group';
		$this->load->model('Accounts_model');
		$data['account_records'] = $this->Accounts_model->get_account_group_list();
		$data['main_content'] = 'accounts/list_account_group_addition.php';
		$this->load->view('includes/template', $data);
	}

	function add_account_group_records()
	{
		$data['title'] = 'Account Group';
		$this->load->model('Accounts_model');
		$flag = $this->Accounts_model->add_account_group_addition();
		if ($flag == 0) {
			$this->session->set_flashdata('success', 'Record Successfully Saved');
			redirect('accounts/account_group_list');
		} else {
			$this->session->set_flashdata('error', 'Account Name Already Exist');
			redirect('accounts/account_group_list');
		}
	}

	function edit_account_group_form()
	{
		$data['title'] = 'Account Group';
		$this->load->model('Accounts_model');
		$data['parent_records'] = $this->Accounts_model->get_account_group_parent();
		$data['section_records'] = $this->Accounts_model->get_account_section();
		$data['acc_grp_records'] = $this->Accounts_model->get_account_group_list_by_id();
		$data['main_content'] = 'accounts/edit_account_group_addition.php';
		$this->load->view('includes/template', $data);
	}

	function update_account_grp_records()
	{
		$data['title'] = 'Account Group';
		$this->load->model('Accounts_model');
		$insert_id = $this->Accounts_model->update_account_group();
		if ($insert_id) {
			$this->session->set_flashdata('success', 'Data Updated successfully');
			redirect('accounts/account_group_list');
		} else {
			$this->session->set_flashdata('error', 'Record Not Updated !! Duplicate Entry ');
			redirect('accounts/account_group_list');
		}
	}

	function delete_group()
	{
		$data['title'] = 'Account Group';
		$id = $this->input->post('post_id');
		$this->load->model('Accounts_model');
		$res = $this->Accounts_model->delete_group_record($id);
		echo $res;
	}

	//////////////////////////////// Account group end ////////////////////////////////

	///////////////////////////// General Ledger Account starts ////////////////////////////

	function view_general_ledger_account_form()
	{
		$data['title'] = 'General Ledger Account';
		$this->load->model('Accounts_model');
		$data['account_records'] = $this->Accounts_model->get_account_group();
		$data['customer_records'] = $this->Accounts_model->get_customer_record();
		$data['supplier_records'] = $this->Accounts_model->get_supplier_record();
		$data['main_content'] = 'accounts/general_ledger_account.php';
		$this->load->view('includes/template', $data);
	}

	function edit_general_ledger_account_form()
	{
		$data['title'] = 'General Ledger Account';
		$this->load->model('Accounts_model');
		$data['account_records'] = $this->Accounts_model->get_account_group();
		$data['gen_ledger_records'] = $this->Accounts_model->get_general_ledger_list_by_id();
		//	$data['opening_balance'] = $this->Accounts_model->get_opening_balance_by_id();
		$data['main_content'] = 'accounts/general_ledger_account_edit.php';
		$this->load->view('includes/template', $data);
	}

	function list_general_ledger_account_form()
	{
		$data['title'] = 'General Ledger Account';
		$this->load->model('Accounts_model');
		$data['ledger_records'] = $this->Accounts_model->get_general_ledger_list();
		$data['main_content'] = 'accounts/general_ledger_account_list.php';
		$this->load->view('includes/template', $data);
	}

	function add_general_ledger_records()
	{
		$data['title'] = 'General Ledger Account';
		$user_id = $this->input->post('ac_name');
		$acc_type = $this->input->post('account_type');
		if ($acc_type == 'OTHER') {
			$account_name = $this->input->post('ac_name');
			$user_id = '';
		} else if ($acc_type == 'CUS') {
			$user_id = $this->input->post('acc_type');
			//	$this->load->helper('finance_helper.php');
			//	$account_name = get_name_record($acc_type,$user_id);
			$account_name = $this->input->post('CUS');
			$customer_id = $this->input->post('CUS');
		} else if ($acc_type == 'SUPP') {
			$user_id = $this->input->post('acc_type');
			$account_name = $this->input->post('SUPP');
		}
		$this->load->model('Accounts_model');
		$insert_id = $this->Accounts_model->add_general_leadger();

		if ($flag == 0) {
			$this->session->set_flashdata('success', 'Record Successfully Saved');
			redirect('accounts/list_general_ledger_account_form');
		} else {
			$this->session->set_flashdata('error', 'Ward No/Name Already Exist');
			redirect('accounts/list_general_ledger_account_form');
		}
	}

	function update_general_ledger_records()
	{
		$data['title'] = 'General Ledger Account';
		$this->load->model('Accounts_model');
		$insert_id = $this->Accounts_model->update_general_ledger();
		if ($insert_id) {
			$this->session->set_flashdata('success', 'Data Updated successfully');
			redirect('accounts/list_general_ledger_account_form');
		} else {
			$this->session->set_flashdata('error', 'Record Not Updated !! Duplicate Entry ');
			redirect('accounts/list_general_ledger_account_form');
		}
	}

	function delete_ledger_record()
	{
		$data['title'] = 'General Ledger Account';
		$id = $this->input->post('account_id');
		$this->load->model('Accounts_model');
		$res = $this->Accounts_model->delete_ledger($id);
		echo $res;
	}

	function ajax_get_ledger_group()
	{
		$account_id = $this->input->post('account_id');
		$data['type'] = $this->input->post('type');
		$this->load->model('Accounts_model');
		$data['ledger_records'] = $this->Accounts_model->get_general_ledger_by_group_id($account_id);
		$this->load->view('ajax/select_account_ledger', $data);
	}
	/////////////////////// contra_entry_add start  //////////////////////
	function add_contra_entry()
	{ //in use
		$data['title'] = "Add Contra Entry";
		$this->load->model('Accounts_model');
		$data['sundry_detors_records'] = $this->Accounts_model->get_all_general_ledger_accounts();
		$data['credit_records'] = $this->Accounts_model->get_all_general_ledger_accounts();
		$data['main_content'] = 'accounts/contra_entry_add.php';
		$this->load->view('includes/template', $data);
	}

	function add_contra_entry_details()
	{ //in use
		$data['title'] = "Add Contra Entry";
		$this->load->model('Accounts_model');
		$id = $this->Accounts_model->add_contra_entry();
		if ($id != '')
			$this->session->set_flashdata('success', 'Record Successfully Saved');
		redirect('accounts/list_contra_entry');
	}

	function list_contra_entry()
	{ //in use
		$data['title'] = "Contra Entry List";
		if ($this->input->post('from')) {
			$data['from'] = $this->input->post('from');
			$data['to'] = $this->input->post('to');
		} else {
			$data['from'] = date('Y-m-d');
			$data['to'] = date('Y-m-d');
		}
		$this->load->model('Accounts_model');
		$data['records'] = $this->Accounts_model->get_contra_entry_records($data['from'], $data['to']);
		$data['main_content'] = 'accounts/contra_entry_list.php';
		$this->load->view('includes/template', $data);
	}
	/////////////////////////////////////////////////////////

	/////////////////////// journal start  //////////////////////
	function journal()
	{ //in use
		$data['title'] = "Add Journal Entry";
		$this->load->model('Accounts_model');
		$data['sundry_detors_records'] = $this->Accounts_model->get_general_ledger_accounts('Expense', '');
		$data['credit_records'] = $this->Accounts_model->get_general_ledger_accounts('Liabilities', '');
		$data['main_content'] = 'accounts/journal_add.php';
		$this->load->view('includes/template', $data);
	}

	function add_journal_details()
	{ //in use
		$data['title'] = "Journal";
		$this->load->model('Accounts_model');
		$id = $this->Accounts_model->add_journal();
		if ($id != '')
			$this->session->set_flashdata('success', 'Record Successfully Saved');
		redirect('accounts/view_journal_list');
	}

	function view_journal_list()
	{ //in use
		$data['title'] = "Journal List";
		if ($this->input->post('from')) {
			$data['from'] = $this->input->post('from');
			$data['to'] = $this->input->post('to');
		} else {
			$data['from'] = date('Y-m-d');
			$data['to'] = date('Y-m-d');
		}
		$this->load->model('Accounts_model');
		$data['records'] = $this->Accounts_model->get_journal_records_new($data['from'], $data['to']);
		// log_message('error', 'Journal Records: ' . print_r($data['records'], true));
		$data['main_content'] = 'accounts/journal_list.php';
		$this->load->view('includes/template', $data);
	}
	/////////////////////////////////////////////////////////


	/////////////////////////////////// Debit Note Start////////////////////////////////////////
	function add_debit_note()
	{ //in use
		$data['title'] = "Debit Note";
		$this->load->model('Accounts_model');
		$data['sundry_detors_records'] = $this->Accounts_model->get_general_ledger_accounts('Expense', '');
		$data['credit_records'] = $this->Accounts_model->get_general_ledger_accounts('Liabilities', '');
		$data['main_content'] = 'accounts/debit_note';
		$this->load->view('includes/template', $data);
	}

	function add_debit_note_details()
	{ //in use
		$data['title'] = "Debit Note";
		$this->load->model('Accounts_model');
		$id = $this->Accounts_model->add_debit_note();
		if ($id != '')
			$this->session->set_flashdata('success', 'Record Successfully Saved');
		redirect('accounts/view_debit_note_list');
	}

	function view_debit_note_list()
	{ //in use
		$data['title'] = "Debit Note";
		if ($this->input->post('from')) {
			$data['from'] = $this->input->post('from');
			$data['to'] = $this->input->post('to');
		} else {
			$data['from'] = date('Y-m-d');
			$data['to'] = date('Y-m-d');
		}
		$this->load->model('Accounts_model');
		$data['debit_note'] = $this->Accounts_model->get_debit_note_records($data['from'], $data['to']);
		$data['main_content'] = 'accounts/debit_note_list';
		$this->load->view('includes/template', $data);
	}

	function edit_debit_note() //in use
	{
		$data['title'] = "Edit Debit Note";
		$this->load->model('Accounts_model');
		$data['debit_note_edit'] = $this->Accounts_model->get_debit_note_records_by_id();
		$data['main_content'] = 'accounts/edit_debit_note';
		$this->load->view('includes/template', $data);
	}
	function update_debit_note() //in use
	{
		$this->load->model('Accounts_model');
		$id = $this->Accounts_model->update_debit_note();
		if ($id) {
			$this->session->set_flashdata('success', 'Data Updated successfully');
			redirect('accounts/view_debit_note_list');
		} else {
			$this->session->set_flashdata('error', 'Record Not Updated !! Duplicate Entry ');
			redirect('accounts/get_edit_debit_note');
		}
	}
	/////////////////////////////////// Debit Note End////////////////////////////////////////

	/////////////////////////////////// Credit Note Start////////////////////////////////////////

	function credit_note()
	{ //in use
		$data['title'] = "Credit Note";
		$this->load->model('Accounts_model');
		$data['sundry_detors_records'] = $this->Accounts_model->get_general_ledger_accounts('', 'Income');
		$data['credit_records'] = $this->Accounts_model->get_general_ledger_accounts('Assets', '');

		$data['main_content'] = 'accounts/credit_note';
		$this->load->view('includes/template', $data);
	}
	// =======================================================

	function supplier_advance()
	{ //in use
		$data['title'] = "Supplier Advance";
		$this->load->model('Accounts_model');
		// $data['sundry_detors_records'] = $this->Accounts_model->get_general_ledger_accounts('', 'Income');
		$data['credit_records'] = $this->Accounts_model->get_general_ledger_accounts('Assets', '');
		$data['sundry_detors_records'] = $this->Accounts_model->get_supplier_account_all();


		$data['main_content'] = 'accounts/supplier_advance';
		$this->load->view('includes/template', $data);
	}

	function add_supplier_advance()
	{ //in use
		$data['title'] = "Supplier Advance";
		$this->load->model('Accounts_model');
		$id = $this->Accounts_model->add_supplier_advance();
		if ($id != '')
			$this->session->set_flashdata('success', 'Record Successfully Saved');
		redirect('accounts/view_supplier_advance_list');
	}

	function view_supplier_advance_list()
	{ //in use
		$data['title'] = "Supplier Advance";
		if ($this->input->post('from')) {
			$data['from'] = $this->input->post('from');
			$data['to'] = $this->input->post('to');
		} else {
			$data['from'] = date('Y-m-d');
			$data['to'] = date('Y-m-d');
		}
		$this->load->model('Accounts_model');
		$data['credit_note'] = $this->Accounts_model->get_supplier_advance_records($data['from'], $data['to']);
		$data['main_content'] = 'accounts/supplier_advance_list';
		$this->load->view('includes/template', $data);
	}

	// ===========================================================

	function add_credit_note()
	{ //in use
		$data['title'] = "Credit Note";
		$this->load->model('Accounts_model');
		$id = $this->Accounts_model->add_credit_note();
		if ($id != '')
			$this->session->set_flashdata('success', 'Record Successfully Saved');
		redirect('accounts/view_credit_note_list');
	}

	function view_credit_note_list()
	{ //in use
		$data['title'] = "Credit Note";
		if ($this->input->post('from')) {
			$data['from'] = $this->input->post('from');
			$data['to'] = $this->input->post('to');
		} else {
			$data['from'] = date('Y-m-d');
			$data['to'] = date('Y-m-d');
		}
		$this->load->model('Accounts_model');
		$data['credit_note'] = $this->Accounts_model->get_credit_note_records($data['from'], $data['to']);
		$data['main_content'] = 'accounts/credit_note_list';
		$this->load->view('includes/template', $data);
	}

	function edit_credit_note() //in use
	{
		$data['title'] = "Credit Note";
		$this->load->model('Accounts_model');
		$data['credit_note_edit'] = $this->Accounts_model->get_credit_note_records_by_id();
		$data['main_content'] = 'accounts/edit_credit_note';
		$this->load->view('includes/template', $data);
	}
	function update_credit_note() //in use
	{
		$this->load->model('Accounts_model');
		$id = $this->Accounts_model->update_credit_note();
		if ($id) {
			$this->session->set_flashdata('success', 'Data Updated successfully');
			redirect('accounts/view_credit_note_list');
		} else {
			$this->session->set_flashdata('error', 'Record Not Updated !! Duplicate Entry ');
			redirect('accounts/get_edit_credit_note');
		}
	}

	public function print_credit_note()
	{
		$segments = array_slice($this->uri->segment_array(), 2);
		$voucher_code = implode('/', $segments);

		$data['title'] = "Credit Note Print";

		$this->load->model('Admin_model');
		$data['logo_details'] = $this->Admin_model->get_company_master_list(get_current_company_id());

		// Customer Details (Credit Account)
		$customer = $this->db->query("
		SELECT
			vt.voucher_code,
			vt.voucher_date,
			vt.narration,
			vt.amount,
			gl.account_name,
			cu.customer_id AS cust_code,
			cu.name AS customer_name,
			cu.address,
			cu.emirates,
			cu.trn
		FROM voucher_transaction vt
		INNER JOIN general_ledger gl
			ON gl.account_id = vt.account_id
		LEFT JOIN customers cu
			ON cu.customer_id = gl.customer_id
		WHERE vt.voucher_code = ?
		AND vt.voucher_type = 'C'
		AND vt.drcr_type = 'Cr'
		LIMIT 1
	", array($voucher_code));

		if ($customer->num_rows() == 0) {
			show_error("Credit Note not found!");
		}

		$data['customer'] = $customer->row();



		// All Voucher Entries (DR & CR)
		$data['receipt'] = $this->db->query("
			SELECT
				vt.*,
				gl.account_name
			FROM voucher_transaction vt
			INNER JOIN general_ledger gl
				ON gl.account_id = vt.account_id
			WHERE vt.voucher_code = ?
			AND vt.voucher_type='C'
			ORDER BY FIELD(vt.drcr_type,'Dr','Cr'), vt.voucher_id
		", array($voucher_code))->result();

		$this->load->view('accounts/print/print_credit_note', $data);
	}

	// function print_credit_note() //in use
	// {
	// 	$segments = array_slice($this->uri->segment_array(), 2);
	// 	$voucher_code = implode('/', $segments);

	// 	$data['title'] = "Credit Note Print";
	// 	$this->load->model('Admin_model');
	// 	$data['logo_details'] = $this->Admin_model->get_company_master_list(get_current_company_id());

	// 	$this->load->model('Accounts_model');

	// 	// Get credit note details by voucher code
	// 	$query = $this->db->query("
	// 		SELECT vt.*,
	// 			cu.customer_id AS cust_code,
	// 			cu.trn,
	// 			cu.name AS customer_name,
	// 			cu.address,
	// 			cu.emirates,
	// 			gl.account_name
	// 		FROM voucher_transaction vt
	// 		LEFT JOIN general_ledger gl ON vt.account_id = gl.account_id
	// 		LEFT JOIN customers cu ON gl.customer_id = cu.customer_id

	// 		WHERE vt.voucher_code = ?
	// 		AND vt.voucher_type = 'C'
	// 		LIMIT 1
	// 	", array($voucher_code));

	// 	if ($query->num_rows() > 0) {
	// 		$data['receipt'] = $query->result();
	// 		$this->load->view('Accounts/print/print_credit_note', $data);
	// 	} else {
	// 		show_error("Credit Note not found!");
	// 	}
	// }

	/////////////////////////////////// Credit Note End////////////////////////////////////////

	///////////////////////////////Receipt Start////////////////////////////////////
	// function add_receipt()
	// {
	//   // in use
	//   $data['title'] = "Receipt Entry";

	//   $data['ledger_id'] = $this->input->post('occupier_id');
	//   $d1 = date('Y-m-d');
	//   $data['opening_bal'] = '';

	//   $this->load->model('Sales_model');
	//   $data['records'] = $this->Sales_model->get_tax_invoice_list();

	//   $this->load->model('Accounts_model');
	//   $data['sundry_detors_records'] = $this->Accounts_model->get_general_ledger_accounts('2', '4');
	//   $data['sundry_detors_records'] = $this->Accounts_model->get_all_general_ledger_accounts();
	//   $data['receipt_Creditors'] = $this->Accounts_model->get_general_ledger_accounts('1', '3'); //customer

	//   $data['main_content'] = 'Accounts/receipt_add.php';
	//   $this->load->view('includes/template', $data);
	// }
	function add_receipt()
	{
		// in use
		$data['title'] = "Receipt Entry";

		$data['ledger_id'] = $this->input->post('occupier_id');
		$d1 = date('Y-m-d');
		$data['opening_bal'] = '';

		// $this->load->model('Sales_model');
		// $data['records'] = $this->Sales_model->get_tax_invoice_list();

		$this->load->model('Accounts_model');
		// $data['sundry_detors_records'] = $this->Accounts_model->get_general_ledger_accounts('2', '4');
		$data['sundry_detors_records'] = $this->Accounts_model->get_all_general_ledger_accounts();
		$data['receipt_Creditors'] = $this->Accounts_model->get_general_ledger_accounts('1', '3'); //customer
		//$data['customer_records'] = $this->Accounts_model->get_customer_record();
		//echo '<pre>';print_r($data);exit;
		$data['main_content'] = 'accounts/receipt_add.php';
		$this->load->view('includes/template', $data);
	}
	// function add_receipt_details()
	// { // in use
	//   $data['title'] = "Receipt ";
	//   $this->load->model('Accounts_model');
	//   $id = $this->Accounts_model->add_new_receipt();
	//   if ($id != '') {
	//     $this->session->set_flashdata('success', 'Record Successfully Saved');
	//     redirect('accounts/view_receipt_list');
	//   }
	// }


	function add_receipt_details()
	{
		$receipt_mode = $this->input->post('receipt_mode');
		$customer_id  = $this->input->post('customer_org_id');
		$quotation_id = $this->input->post('quotation_id');

		// Customer mandatory
		if (empty($customer_id)) {
			$this->session->set_flashdata('error', 'Please select a customer.');
			redirect('accounts/add_receipt');
		}

		// Quotation validation
		if ($receipt_mode == 'quotation' && empty($quotation_id)) {
			$this->session->set_flashdata('error', 'Please select a quotation.');
			redirect('accounts/add_receipt');
		}

		$receipt_mode = $this->input->post('receipt_mode');

		if (empty($this->input->post('customer_org_id'))) {
			$this->session->set_flashdata('error', 'Please select a customer.');
			redirect('accounts/add_receipt');
		}

		if ($receipt_mode == 'quotation' && empty($this->input->post('quotation_id'))) {
			$this->session->set_flashdata('error', 'Please select a quotation.');
			redirect('accounts/add_receipt');
		}

		$creditors = $this->input->post('creditor');
		$cr_amounts = $this->input->post('cr_amount');

		if (empty($creditors) || !is_array($creditors)) {
			$this->session->set_flashdata('error', 'Please select a Credit Account.');
			redirect('accounts/add_receipt');
		}

		$validCredit = false;

		foreach ($creditors as $key => $account) {

			$amount = isset($cr_amounts[$key]) ? (float)$cr_amounts[$key] : 0;

			// Ignore completely empty rows
			if (empty($account) && $amount == 0) {
				continue;
			}

			$validCredit = true;

			if (empty($account)) {
				$this->session->set_flashdata('error', 'Please select a Credit Account.');
				redirect('accounts/add_receipt');
			}

			if ($amount <= 0) {
				$this->session->set_flashdata('error', 'Please enter a valid Credit Amount.');
				redirect('accounts/add_receipt');
			}
		}

		if (!$validCredit) {
			$this->session->set_flashdata('error', 'Please add at least one Credit Account.');
			redirect('accounts/add_receipt');
		}


		$this->load->model('Accounts_model');
		$id = $this->Accounts_model->add_new_receipt(); // this function uses $_POST data internally

		if ($id != '') {
			$this->session->set_flashdata('success', 'Record Successfully Saved');
			redirect('accounts/view_receipt_list');
		} else {
			$this->session->set_flashdata('error', 'Failed to save receipt');
			redirect('accounts/add_receipt');
		}
	}



	function view_receipt_list() // in use
	{
		$data['title'] = "Receipt List";
		$data['header'] = $this->input->post('header');

		if ($this->uri->segment(3)) {
			$data['division_id'] = $this->uri->segment(3);
			$data['from'] = $this->uri->segment(4);
			$data['to'] = $this->uri->segment(5);
		} else if ($this->input->post('from')) {
			$data['from'] = $this->input->post('from');
			$data['to'] = $this->input->post('to');
		} else {
			$data['from'] = date('Y-m-d');
			$data['to'] = date('Y-m-d');
		}

		$this->load->model('Accounts_model');
		$data['receipt'] = $this->Accounts_model->get_receipt_list($data['from'], $data['to']);

		$data['main_content'] = 'accounts/receipt_list.php';
		$this->load->view('includes/template', $data);
	}
	function edit_receipt() // in use
	{
		$data['title'] = "Receipt Edit";
		$this->load->model('accounts/debit_note');
		$data['receipt_records'] = $this->debit_note->receipt_records_pmc();

		$this->load->model('vehicle/vehicle_model');
		$data['driver_records'] = $this->vehicle_model->get_driver_records();
		$this->load->model('bags/Bags_master_model');
		$data['user_records'] = $this->Bags_master_model->get_user_details();

		$data['main_content'] = 'accounts/edit_receipt';
		$this->load->view('includes/template', $data);
	}

	function get_edit_pmc_receipt_data() // in use
	{
		$data['title'] = "Receipt Edit";
		$data['voucher_id'] = $this->input->post('voucher_id');
		$data['occupier'] = $this->input->post('occupier');
		$data['division_id'] = $this->uri->segment(4);
		$data['from'] = $this->uri->segment(5);
		$data['to'] = $this->uri->segment(6);
		$this->load->model('accounts/debit_note');
		$data['receipt_records'] = $this->debit_note->receipt_records_pmc();

		$this->load->model('vehicle/vehicle_model');
		$data['driver_records'] = $this->vehicle_model->get_driver_records();
		$this->load->model('bags/Bags_master_model');
		$data['user_records'] = $this->Bags_master_model->get_user_details();

		$data['main_content'] = 'accounts/edit_receipt';
		$this->load->view('includes/template', $data);
	}

	function update_pmc_receipt_data()
	{ // in use
		$data['title'] = "Receipt";
		$division_id = trim($this->input->post('division_id'));
		$from = trim($this->input->post('from'));
		$to = trim($this->input->post('to'));

		$this->load->model('accounts/debit_note');
		$id = $this->debit_note->update_receipt();
		if ($id) {
			$this->session->set_flashdata('success', 'Data Updated successfully');
		} else {
			$this->session->set_flashdata('error', 'Record Not Updated !! Duplicate Entry ');
		}
		redirect("accounts/view_receipt_list/" . $division_id . '/' . $from . '/' . $to);
	}



	function print_receipt()
	{
		// $voucher_code = $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6);
		$segments = array_slice($this->uri->segment_array(), 2);
		$voucher_code = implode('/', $segments);

		// $this->load->model('Setup_model');
		$data['logo_details'] = $this->Admin_model->get_company_master_list(get_current_company_id());

		$this->load->model('Accounts_model');
		$data['header'] = $this->Accounts_model->get_receipt_header($voucher_code);
		//  print_r($data['header']); exit;
		$data['details'] = $this->Accounts_model->get_receipt_details($voucher_code);
		if (!$data['header']) {
			show_error("Receipt not found!");
		}

		$this->load->view('accounts/print/print_receipt', $data);
	}



	///////////////////////////////Payment Start////////////////////////////////////
	// function add_payment()
	// {
	//   // in use
	//   $data['title'] = "Payment Entry";

	//   $data['ledger_id'] = $this->input->post('occupier_id');
	//   $d1 = date('Y-m-d');
	//   $data['opening_bal'] = '';

	//   $this->load->model('Accounts_model');
	//   $data['records'] = $this->Accounts_model->get_Purchase_invoice_list();
	//   $data['account_records'] = $this->Accounts_model->get_account_group_list();

	//   $this->load->model('Accounts_model');
	//   $data['sundry_detors_records'] = $this->Accounts_model->get_all_general_ledger_accounts(); //all ledgers
	//   $data['receipt_Creditors'] = $this->Accounts_model->get_all_general_ledger_accounts(); //bank

	//   $data['main_content'] = 'Accounts/payment_add.php';
	//   $this->load->view('includes/template', $data);
	// }
	function add_payment()
	{
		// in use
		$data['title'] = "Payment Entry";

		$data['ledger_id'] = $this->input->post('occupier_id');
		$d1 = date('Y-m-d');
		$data['opening_bal'] = '';

		$this->load->model('Supplier_model');
		$data['suppliers'] = $this->Supplier_model->get_active_supplier_list(); //customer

		$this->load->model('Accounts_model');
		$data['sundry_detors_records'] = $this->Accounts_model->get_general_ledger_accounts('2', '4');
		$data['sundry_detors_records'] = $this->Accounts_model->get_all_general_ledger_accounts();
		// $data['receipt_Creditors'] = $this->Accounts_model->get_general_ledger_accounts('1', '3'); //customer
		$data['receipt_Creditors'] = $this->Accounts_model->get_all_general_ledger_accounts();
		$data['main_content'] = 'accounts/payment_add.php';
		$this->load->view('includes/template', $data);
	}
	function add_payment_details()
	{ // in use
		$data['title'] = "Payment Entry";
		$this->load->model('Accounts_model');
		$id = $this->Accounts_model->add_new_payment_data();
		if ($id != '') {
			$this->session->set_flashdata('success', 'Record Successfully Saved');
			redirect('accounts/view_payment_list');
		}
	}

	function view_payment_list() // in use
	{
		$data['title'] = "Payment List";
		$data['header'] = $this->input->post('header');

		if ($this->uri->segment(3)) {
			$data['division_id'] = $this->uri->segment(3);
			$data['from'] = $this->uri->segment(4);
			$data['to'] = $this->uri->segment(5);
		} else if ($this->input->post('from')) {
			$data['from'] = $this->input->post('from');
			$data['to'] = $this->input->post('to');
		} else {
			$data['from'] = date('Y-m-d');
			$data['to'] = date('Y-m-d');
		}

		$this->load->model('Accounts_model');
		$data['receipt'] = $this->Accounts_model->get_payment_list($data['from'], $data['to']);

		$data['main_content'] = 'accounts/payment_list.php';
		$this->load->view('includes/template', $data);
	}

	function edit_payment() // in use
	{
		$data['title'] = "Payment Edit";
		$this->load->model('accounts/debit_note');
		$data['receipt_records'] = $this->debit_note->receipt_records_pmc();

		$this->load->model('vehicle/vehicle_model');
		$data['driver_records'] = $this->vehicle_model->get_driver_records();
		$this->load->model('bags/Bags_master_model');
		$data['user_records'] = $this->Bags_master_model->get_user_details();

		$data['main_content'] = 'accounts/edit_receipt';
		$this->load->view('includes/template', $data);
	}

	function get_edit_payment_data() // in use
	{
		$data['title'] = "Payment edit";
		$data['voucher_id'] = $this->input->post('voucher_id');
		$data['occupier'] = $this->input->post('occupier');
		$data['division_id'] = $this->uri->segment(4);
		$data['from'] = $this->uri->segment(5);
		$data['to'] = $this->uri->segment(6);
		$this->load->model('accounts/debit_note');
		$data['receipt_records'] = $this->debit_note->receipt_records_pmc();

		$this->load->model('vehicle/vehicle_model');
		$data['driver_records'] = $this->vehicle_model->get_driver_records();
		$this->load->model('bags/Bags_master_model');
		$data['user_records'] = $this->Bags_master_model->get_user_details();

		$data['main_content'] = 'accounts/edit_receipt';
		$this->load->view('includes/template', $data);
	}

	function update_payment_data()
	{ // in use
		$data['title'] = "Payment ";
		$division_id = trim($this->input->post('division_id'));
		$from = trim($this->input->post('from'));
		$to = trim($this->input->post('to'));

		$this->load->model('accounts/debit_note');
		$id = $this->debit_note->update_receipt();
		if ($id) {
			$this->session->set_flashdata('success', 'Data Updated successfully');
		} else {
			$this->session->set_flashdata('error', 'Record Not Updated !! Duplicate Entry ');
		}
		redirect("accounts/view_receipt_list/" . $division_id . '/' . $from . '/' . $to);
	}

	function print_payment() // in use
	{
		$data['title'] = "Payment Print";
		$data['header'] = $this->input->post('header');
		$this->load->model('Admin_model');
		$data['logo_details'] = $this->Admin_model->get_company_master_list(get_current_company_id());

		$this->load->model('Accounts_model');
		$data['receipt'] = $this->Accounts_model->transport_receipt_records();
		$this->load->view('accounts/print/print_receipt', $data);
	}
	function delete_trans_entry()
	{
		$voucher_code = $this->input->post('voucher_code');
		$this->load->model('Accounts_model');
		$res = $this->Accounts_model->delete_trans_entry($voucher_code);
		echo $res;
	}
	function view_account_transaction_details()
	{
		$data['title'] = "Transactions Details";
		$voucher_id = $this->uri->segment(3);

		$this->load->model('Accounts_model');
		$data['res'] = $this->Accounts_model->view_account_transaction_details($voucher_id);

		$data['main_content'] = 'accounts/account_transaction_details.php';
		$this->load->view('includes/template', $data);
	}
	function ajax_get_invoice_list()
	{
		$data['account_id'] = $this->input->post('account_id');

		$this->load->model('Accounts_model');
		$data['res'] = $this->Accounts_model->ajax_get_invoice_list($data['account_id']);
		log_message('error', 'Invoice List: ' . print_r($data['res'], true));
		if (empty($data['res']))
			echo 0;
		else
			$this->load->view('ajax/account_invoice_list.php', $data);
	}
	//////////////////////////////////////////////////////////
	function get_outstanding_balance()
	{
		$account_id = $this->input->post('account_id');
		$from_date1 = date('Y-m-d', strtotime($this->input->post('from_date')));
		$this->load->helper('myopeningbalance');
		$balance = calculate_todays_opening_bal($from_date1, $account_id);
		echo $balance;
	}


	///////////////// Individual ledger /////////////////
	function view_individual_ledger()
	{
		$data['title'] = "Report-Individual Ledger Details";
		$data['company_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());
        $data['lname'] ="";
		// $data['from_date'] = date('01-01-Y');
		// $data['to_date'] = date('31-12-Y');
		$data['from_date'] = date("d-m-Y", strtotime(date("Y-m-01")));

		// $data['from_date'] = date('d-m-Y', strtotime('01-01-' . date('Y')));
		$data['to_date'] = date("d-m-Y", strtotime(date("Y-m-d")));
		//    
		// log_message('error', $data['from_date'] . "," . $data['to_date']);
		$data['account_id'] = "";

		$this->load->model('Accounts_model');
		$data['account_ledgers'] = $this->Accounts_model->get_all_general_ledger_accounts();

		$data['ledger_transaction_records'] = "";
		// echo "<pre>"; print_r( $data); exit;
		$data['main_content'] = 'reports/account/view_individual_ledger_details';
		$this->load->view('includes/template', $data);
	}
	public function search_individual_ledger_details()
	{
		$data['title'] = "Report - Individual Ledger Details";
		$data['company_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());

		// Account ID from POST or URL segment
		$account_id = $this->input->post('account_id') ?? $this->uri->segment(3);


		$from_date = empty($this->uri->segment(4))
			? $this->input->post('from_date')
			: $this->uri->segment(4);

		$to_date = empty($this->uri->segment(5))
			? $this->input->post('to_date')
			: $this->uri->segment(5);

		// Assign to data array
		$data['account_id'] = $account_id;
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;

		// Load models
		$this->load->model('Accounts_model');
		$data['account_ledgers'] = $this->Accounts_model->get_all_general_ledger_accounts();
		$data['lname'] = $this->Accounts_model->get_account_name_by_id($account_id);
		$data['ledger_transaction_records'] = $this->Accounts_model->get_ledger_report($account_id, $from_date, $to_date);

		// Load view
		$data['main_content'] = 'reports/account/view_individual_ledger_details';
		$this->load->view('includes/template', $data);
	}

	function print_individual_ledger_account_details()
	{
		$data['title'] = "Report-Individual Ledger Details";

		$data['from_date'] = date('d-m-Y', strtotime($this->input->post('from_date')));;
		$data['to_date'] = date('d-m-Y', strtotime($this->input->post('to_date')));
		$data['account_id'] = $this->input->post('account_id');


		$this->load->model('Accounts_model');
		$data['account_ledgers'] = $this->Accounts_model->get_all_general_ledger_accounts();

		$data['ledger_transaction_records'] = $this->Accounts_model->get_ledger_report($data['account_id'], $data['from_date'], $data['to_date']);

		$this->load->view('Print/print_individual_ledger_account_details', $data);
	}


	function export_individual_ledger_account_details()
	{
		$data['title'] = "Report-Individual Ledger Details";

		$data['from_date'] = date('d-m-Y', strtotime($this->input->post('from_date')));;
		$data['to_date'] = date('d-m-Y', strtotime($this->input->post('to_date')));
		$data['account_id'] = $this->input->post('account_id');

		$this->load->model('Admin_model');
		$data['comapny_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());

		$this->load->model('Accounts_model');
		$data['account_ledgers'] = $this->Accounts_model->get_all_general_ledger_accounts();

		$data['ledger_transaction_records'] = $this->Accounts_model->get_ledger_report($data['account_id'], $data['from_date'], $data['to_date']);

		$this->load->view('excel_reports/export_individual_ledger_account_details', $data);
	}
	function get_acc_details()
	{
		$this->load->model('Accounts_model');
		$data['acc_records'] = $this->Accounts_model->get_acc_details();
		$this->load->view('Ajax/get_acc_details', $data);
	}

	function update_transaction_details() // in use
	{
		$data['title'] = "Transactions Details";
		$voucher_id = $this->input->post('voucherid');
		$this->load->model('Accounts_model');
		$data['receipt_records'] = $this->Accounts_model->update_transaction_details();
		//$data['res']=$this->Accounts_model->view_account_transaction_details($voucher_id);

		$data['main_content'] = 'accounts/edit_receipt';
		redirect("accounts/view_account_transaction_details/$voucher_id");
	}
	function view_balance_sheet11()
	{
		$data['title'] = "Report-Balance Sheet";
		$data['from'] = date('01-01-Y');
		$data['to'] = date('d-m-Y');

		$data['main_content'] = 'reports/account/balance_sheet_list';
		$this->load->view('includes/template', $data);
	}
	// function view_balance_sheet()
	// {
	// 	$data['title'] = "Balance Sheet";
	// 	$data['company_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());


	// 	$from = $this->input->post('from') ?: date('Y-01-01');
	// 	$to   = $this->input->post('to') ?: date('Y-m-d');

	// 	$data['from'] = date('Y-m-d', strtotime($from));
	// 	$data['to']   = date('Y-m-d', strtotime($to));

	// 	$this->load->model('Accounts_model');

	// 	$tree = $this->Accounts_model->prepare_balance_sheet($to);

	// 	$assets = [];
	// 	$liabilities = [];

	// 	foreach ($tree as $group) {

	// 		if (strtolower(trim($group->group_name)) == 'assets') {
	// 			$assets[] = $group; // ✅ FIX
	// 		}

	// 		if (strtolower(trim($group->group_name)) == 'liabilities') {
	// 			$liabilities[] = $group; // ✅ FIX
	// 		}
	// 	}

	// 	$profit = $this->Accounts_model->get_profit_loss($from, $to);
	// 	$this->Accounts_model->add_profit_to_capital($tree, $profit);
	// 	$this->Accounts_model->calculate_totals($tree);
	// 	foreach ($liabilities as &$group) {
	// 		if (strtolower(trim($group->group_name)) == 'capital account') {
	// 			$group->balance += $profit;
	// 		}
	// 	}

	// 	$data['assets'] = $assets;
	// 	$data['liabilities'] = $liabilities;

	// 	$data['main_content'] = 'Reports/account/balance_sheet_list';
	// 	$this->load->view('includes/template', $data);
	// }

	function view_balance_sheet()
	{
		$data['title'] = "Balance Sheet";
		$data['company_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());

		// Only Till Date is required from the user
		$to = $this->input->post('to') ?: date('Y-m-d');

		$data['to'] = date('Y-m-d', strtotime($to));

		$from = date('Y-01-01', strtotime($data['to']));

		$data['from'] = $from;

		$this->load->model('Accounts_model');

		/*
     * Balance Sheet is calculated as of Till Date.
     */
		$tree = $this->Accounts_model->prepare_balance_sheet($to);

		/*
	 * Calculate Profit/Loss from calendar-year start
     * up to the selected Till Date.
     */
		$profit = $this->Accounts_model->get_profit_loss($from, $to);

		/*
     * Add current year profit/loss to Capital Account.
     */
		$this->Accounts_model->add_profit_to_capital($tree, -$profit);

		/*
     * Recalculate all totals.
     */
		$this->Accounts_model->calculate_totals($tree);

		$assets = [];
		$liabilities = [];

		foreach ($tree as $group) {

			$group_name = strtolower(trim($group->group_name));

			if ($group_name == 'assets') {
				$assets[] = $group;
			}

			if ($group_name == 'liabilities') {
				$liabilities[] = $group;
			}
		}

		$data['assets'] = $assets;
		$data['liabilities'] = $liabilities;

		$data['main_content'] = 'reports/account/balance_sheet_list';

		$this->load->view('includes/template', $data);
	}
	public function balance_sheet_full_export()
	{
		$this->load->model('Accounts_model');
		$to   = $this->input->post('to') ?: date('Y-m-d');
		$from = date('Y-01-01', strtotime($to));

		$from_date = date('Y-m-d', strtotime($from));
		$to_date   = date('Y-m-d', strtotime($to));

		$tree = $this->Accounts_model->prepare_balance_sheet($to_date);

		/*
 * Calculate Profit/Loss for selected period
 */
		$profit = $this->Accounts_model->get_profit_loss($from_date, $to_date);

		/*
 * Add current period profit/loss to Capital Account
 */
		$this->Accounts_model->add_profit_to_capital($tree, -$profit);

		/*
 * Recalculate totals
 */
		$this->Accounts_model->calculate_totals($tree);

		/*
 * Separate Assets and Liabilities
 */
		$assets = [];
		$liabilities = [];

		foreach ($tree as $group) {

			$group_name = strtolower(trim($group->group_name));

			if ($group_name === 'assets') {
				$assets[] = $group;
			}

			if ($group_name === 'liabilities') {
				$liabilities[] = $group;
			}
		}

		// foreach ($liabilities as &$group) {

		//     if (strtolower(trim($group->group_name)) === 'capital account') {
		//         $group->balance += $profit;
		//     }
		// }

		// unset($group);

		/*
    |--------------------------------------------------------------------------
    | Company
    |--------------------------------------------------------------------------
    */

		$company_records = $this->Admin_model->get_company_master_list(get_current_company_id());

		$filename = 'Balance_Sheet_' . date('Ymd') . '.xls';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header('Pragma: no-cache');
		header('Expires: 0');


		/*
    |--------------------------------------------------------------------------
    | Function to calculate total
    |--------------------------------------------------------------------------
    */

		$calculate_total = function ($groups) {

			$total = 0;

			foreach ($groups as $group) {
				$total += (float) $group->balance;
			}

			return $total;
		};


		/*
    |--------------------------------------------------------------------------
    | Function to generate rows
    |--------------------------------------------------------------------------
    */

		$write_rows = function ($groups, $level = 0) use (&$write_rows) {

			$html = '';

			foreach ($groups as $group) {

				if (round((float) $group->balance, 2) == 0) {
					continue;
				}

				$indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);

				$html .= '<tr>';

				$html .= '<td style="padding-left:' . ($level * 20) . 'px;">'
					. htmlspecialchars($group->group_name)
					. '</td>';

				$html .= '<td style="text-align:right">'
					. number_format(abs((float) $group->balance), 2)
					. '</td>';

				$html .= '</tr>';


				/*
            |--------------------------------------------------------------------------
            | Ledgers
            |--------------------------------------------------------------------------
            */

				if (!empty($group->ledgers)) {

					foreach ($group->ledgers as $ledger) {

						if (round((float) $ledger->balance, 2) == 0) {
							continue;
						}

						$html .= '<tr>';

						$html .= '<td style="padding-left:' . (($level + 1) * 20) . 'px;">'
							. htmlspecialchars($ledger->name)
							. '</td>';

						$html .= '<td style="text-align:right">'
							. number_format(abs((float) $ledger->balance), 2)
							. '</td>';

						$html .= '</tr>';
					}
				}


				/*
            |--------------------------------------------------------------------------
            | Child Groups
            |--------------------------------------------------------------------------
            */

				if (!empty($group->children)) {
					$html .= $write_rows($group->children, $level + 1);
				}
			}

			return $html;
		};


		/*
    |--------------------------------------------------------------------------
    | Generate both sides
    |--------------------------------------------------------------------------
    */

		$liability_rows = $write_rows($liabilities);
		$asset_rows      = $write_rows($assets);

		$total_liabilities = $calculate_total($liabilities);
		$total_assets      = $calculate_total($assets);


		/*
    |--------------------------------------------------------------------------
    | Excel Output
    |--------------------------------------------------------------------------
    */

		echo '<table border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;">';


		/*
    |--------------------------------------------------------------------------
    | Company Name
    |--------------------------------------------------------------------------
    */

		echo '<tr>';

		echo '<th colspan="4" style="font-size:16px;">'
			. htmlspecialchars($company_records[0]->company_name)
			. '</th>';

		echo '</tr>';


		/*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    */

		echo '<tr>';

		echo '<th colspan="4" style="font-size:15px;">Balance Sheet</th>';

		echo '</tr>';


		/*
    |--------------------------------------------------------------------------
    | Period
    |--------------------------------------------------------------------------
    */

		echo '<tr>';

		echo '<th colspan="4">'
			. 'Period: '
			. date('j-M-y', strtotime($from_date))
			. ' to '
			. date('j-M-y', strtotime($to_date))
			. '</th>';

		echo '</tr>';


		/*
    |--------------------------------------------------------------------------
    | Main Header
    |--------------------------------------------------------------------------
    */

		echo '<tr>';

		echo '<th colspan="2" style="text-align:center;">Liabilities</th>';

		echo '<th colspan="2" style="text-align:center;">Assets</th>';

		echo '</tr>';


		/*
    |--------------------------------------------------------------------------
    | Column Headers
    |--------------------------------------------------------------------------
    */

		echo '<tr>';

		echo '<th>Particulars</th>';
		echo '<th>Amount</th>';

		echo '<th>Particulars</th>';
		echo '<th>Amount</th>';

		echo '</tr>';


		/*
    |--------------------------------------------------------------------------
    | Convert rows into arrays
    |--------------------------------------------------------------------------
    */

		$get_rows = function ($groups, $level = 0) use (&$get_rows) {

			$rows = [];

			foreach ($groups as $group) {

				if (round((float) $group->balance, 2) == 0) {
					continue;
				}

				$rows[] = [
					'name' => str_repeat('    ', $level) . $group->group_name,
					'amount' => number_format(abs((float) $group->balance), 2)
				];


				/*
            |--------------------------------------------------------------------------
            | Ledgers
            |--------------------------------------------------------------------------
            */

				if (!empty($group->ledgers)) {

					foreach ($group->ledgers as $ledger) {

						if (round((float) $ledger->balance, 2) == 0) {
							continue;
						}

						$rows[] = [
							'name' => str_repeat('    ', $level + 1) . $ledger->name,
							'amount' => number_format(
								abs((float) $ledger->balance),
								2
							)
						];
					}
				}


				/*
            |--------------------------------------------------------------------------
            | Children
            |--------------------------------------------------------------------------
            */

				if (!empty($group->children)) {

					$child_rows = $get_rows(
						$group->children,
						$level + 1
					);

					$rows = array_merge($rows, $child_rows);
				}
			}

			return $rows;
		};


		$liability_data = $get_rows($liabilities);
		$asset_data      = $get_rows($assets);


		/*
    |--------------------------------------------------------------------------
    | Find maximum rows
    |--------------------------------------------------------------------------
    */

		$max_rows = max(
			count($liability_data),
			count($asset_data)
		);


		/*
    |--------------------------------------------------------------------------
    | Print both sides
    |--------------------------------------------------------------------------
    */

		for ($i = 0; $i < $max_rows; $i++) {

			echo '<tr>';


			// LIABILITY
			if (isset($liability_data[$i])) {

				echo '<td>'
					. htmlspecialchars($liability_data[$i]['name'])
					. '</td>';

				echo '<td style="text-align:right;">'
					. $liability_data[$i]['amount']
					. '</td>';
			} else {

				echo '<td></td>';
				echo '<td></td>';
			}


			// ASSET
			if (isset($asset_data[$i])) {

				echo '<td>'
					. htmlspecialchars($asset_data[$i]['name'])
					. '</td>';

				echo '<td style="text-align:right;">'
					. $asset_data[$i]['amount']
					. '</td>';
			} else {

				echo '<td></td>';
				echo '<td></td>';
			}


			echo '</tr>';
		}


		/*
    |--------------------------------------------------------------------------
    | Total Row
    |--------------------------------------------------------------------------
    */

		echo '<tr style="font-weight:bold;">';

		echo '<td>Total Liabilities</td>';

		echo '<td style="text-align:right;">'
			. number_format($total_liabilities, 2)
			. '</td>';

		echo '<td>Total Assets</td>';

		echo '<td style="text-align:right;">'
			. number_format($total_assets, 2)
			. '</td>';

		echo '</tr>';


		echo '</table>';

		exit;
	}
	function get_balance_sheet()
	{
		$data['title'] = "Report-Balance Sheet";

		$data['from'] = date('d-m-Y', strtotime($this->input->post('from') ?? ''));;
		$data['to'] = date('d-m-Y', strtotime($this->input->post('to') ?? ''));;

		$data['main_content'] = 'reports/account/balance_sheet_list';
		$this->load->view('includes/template', $data);
	}
	function view_profit_and_loss_old()
	{
		$data['title'] = "Report-Profit and Loss";

		$data['from'] = date('01-01-Y');
		$data['to'] = date('d-m-Y');
		$data['main_content'] = 'reports/account/view_profit_loss.php';
		$this->load->view('includes/template', $data);
	}
	function get_profit_and_loss()
	{
		$data['title'] = "Report-Profit and Loss";

		$data['from'] = $this->input->post('from') ?? date('Y-m-01');
		$data['to'] = $this->input->post('to') ?? date('Y-m-d');
		//$data['to']   = $this->input->post('to')   ?? date("Y-m-d");

		$data['main_content'] = 'reports/account/view_profit_loss.php';
		$this->load->view('includes/template', $data);
	}
	///////////////////////////////////////////////////////////////////////////////

	// function outstanding_report()
	// {
	//   $data['title'] = "Outstanding report";
	//   $data['from_date'] = date('01-01-Y');
	//   $data['to_date'] = date('31-12-Y');
	//   $data['account_id'] = "";
	//   $data['request_type'] = "";

	//   $this->load->model('Accounts_model');
	//   $data['account_ledgers'] = $this->Accounts_model->get_all_general_ledger_accounts();

	//   $data['records'] = "";

	//   $data['main_content'] = 'reports/account/outstanding_report';
	//   $this->load->view('includes/template', $data);
	// }

	// function search_outstanding_report()
	// {
	//   $data['title'] = "Outstanding report";
	//   $data['from_date'] = date('d-m-Y', strtotime($this->input->post('from_date')));   
	//   $data['to_date'] = date('d-m-Y', strtotime($this->input->post('to_date')));
	//   $data['account_id'] = $this->input->post('account_id');
	//   $data['request_type'] = $this->input->post('request_type');


	//   $this->load->model('Accounts_model');
	//   $data['account_ledgers'] = $this->Accounts_model->get_all_general_ledger_accounts();

	//   $data['records'] = $this->Accounts_model->get_outstanding_report($data['account_id'], $data['from_date'], $data['to_date']);

	//   $data['main_content'] = 'reports/account/outstanding_report';
	//   $this->load->view('includes/template', $data);
	// }

	// function printpayment() 
	// {
	//   $data['title'] = "Payment Print";
	//   $data['header'] = $this->input->post('header');


	// 	$data['voucher_code'] = $this->uri->segment(3) . '/' .$this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) ;
	//   $this->load->model('Setup_model');
	//   $data['logo_details'] = $this->Setup_model->get_company_master_list();

	//   $this->load->model('Accounts_model');
	//   $data['payment'] = $this->Accounts_model->get_payment_records($data['voucher_code']);
	//   //  echo '<pre>';print_r($data);exit;
	//   $this->load->view('Accounts/print/print_payment', $data);
	// }

	public function printpayment()
	{
		$data['title'] = "Payment Print";

		$data['account_id'] = $this->uri->segment(7);
		// $data['voucher_code'] = $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6);
		$data['voucher_code'] = implode('/', array_filter([
			$this->uri->segment(3),
			$this->uri->segment(4),
			$this->uri->segment(5)
		])) . '/';

		$data['voucher_code'] = rtrim($data['voucher_code'], '/');
		log_message("error", $data['voucher_code']);
		$this->load->model('Setup_model');
		$this->load->model('Accounts_model');

		$data['logo_details'] = $this->Admin_model->get_company_master_list(get_current_company_id());
		$data['logo_details'] = "";
		// Fetch all voucher_transaction rows for this voucher_code
		$all_voucher_rows = $this->Accounts_model->get_payment_record($data['voucher_code']);
		log_message('error', 'Voucher Rows: ' . print_r($all_voucher_rows, true));
		// Separate header (credit) and details (debits)
		$header = null;
		$payment_details = [];

		foreach ($all_voucher_rows as $row) {
			if ($row->drcr_type === 'Cr') {
				$header = $row; // credit entry as header
			} else if ($row->drcr_type === 'Dr') {
				$payment_details[] = $row; // debit entries as invoice list
			}
		}

		$data['header'] = $header;
		$data['payment_details'] = $payment_details;
		$data['receipt_Creditors'] = $this->Accounts_model->get_account_name_by_id($data['account_id']);

		$this->load->view('accounts/print/print_payment', $data);
	}
	///////////////////////////////////////////////////////////////////////////////////


	function outstanding_report()
	{

		$data['title'] = "Outstanding report";
		$data['company_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());

		$data['from'] = $this->input->post('from') ?? date("d-m-Y", strtotime(date("Y-m-01")));
		$data['to'] = $this->input->post('to') ?? date("d-m-Y", strtotime(date("Y-m-d")));

		$data['request_type'] = "";
		$data['records'] = "";



		$data['main_content'] = 'reports/account/outstanding_report';
		$this->load->view('includes/template', $data);
	}

	public function total_customer_due_report()
	{
		$data['title'] = 'Total Customer Due Report';
		$data['to'] = date('Y-m-d');
		$data['records'] = [];
		$data['main_content'] = 'reports/account/total_customer_due_report';
		$this->load->view('includes/template', $data);
	}

	public function search_total_customer_due_report()
	{
		$to_input = $this->input->post('to') ?: date('Y-m-d');
		$to_ts = strtotime(str_replace(['/', '.'], '-', $to_input));
		$to_date = $to_ts ? date('Y-m-d', $to_ts) : date('Y-m-d');

		$this->load->model('Accounts_model');
		$data['title'] = 'Total Customer Due Report';
		$data['to'] = $to_date;
		$data['records'] = $this->Accounts_model->get_total_customer_due_report($to_date);
		$data['main_content'] = 'reports/account/total_customer_due_report';
		$this->load->view('includes/template', $data);
	}

	public function total_customer_due_export()
	{
		$this->load->model('Accounts_model');
		$to_input = $this->input->post('to') ?: date('Y-m-d');
		$to_ts = strtotime(str_replace(['/', '.'], '-', $to_input));
		$to_date = $to_ts ? date('Y-m-d', $to_ts) : date('Y-m-d');
		$records = $this->Accounts_model->get_total_customer_due_report($to_date);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="Total_Customer_Due_' . $to_date . '.xls"');
		header('Pragma: no-cache');
		header('Expires: 0');

		echo '<table border="1">';
		echo '<tr><th colspan="7">Total Customer Due Report</th></tr>';
		echo '<tr><th colspan="7">As of: ' . htmlspecialchars($to_date, ENT_QUOTES, 'UTF-8') . '</th></tr>';
		echo '<tr><th>S.No</th><th>Customer</th><th>Ledger</th><th>Opening Balance</th><th>Debit</th><th>Credit</th><th>Customer Due</th></tr>';

		$total_due = 0;
		foreach ($records as $index => $row) {
			$due_amount = (float) $row->due_amount;
			$total_due += $due_amount;
			echo '<tr>';
			echo '<td>' . ($index + 1) . '</td>';
			echo '<td>' . htmlspecialchars($row->customer_name, ENT_QUOTES, 'UTF-8') . '</td>';
			echo '<td>' . htmlspecialchars($row->account_name, ENT_QUOTES, 'UTF-8') . '</td>';
			echo '<td align="right">' . number_format((float) $row->opening_balance, 2) . '</td>';
			echo '<td align="right">' . number_format((float) $row->debit, 2) . '</td>';
			echo '<td align="right">' . number_format((float) $row->credit, 2) . '</td>';
			echo '<td align="right">' . number_format($due_amount, 2) . '</td>';
			echo '</tr>';
		}

		echo '<tr><th colspan="6" align="right">Total Customer Due</th><th align="right">' . number_format($total_due, 2) . '</th></tr>';
		echo '</table>';
		exit;
	}

	public function total_customer_due_print()
	{
		$this->load->model('Admin_model');
		$this->load->model('Accounts_model');
		$to_input = $this->input->post('to') ?: date('Y-m-d');
		$to_ts = strtotime(str_replace(['/', '.'], '-', $to_input));
		$to_date = $to_ts ? date('Y-m-d', $to_ts) : date('Y-m-d');

		$data['company_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());
		$data['to'] = $to_date;
		$data['records'] = $this->Accounts_model->get_total_customer_due_report($to_date);
		$this->load->view('Print/total_customer_due_report', $data);
	}

	public function get_ledgers_by_type()
	{
		$request_type = trim((string) $this->input->post('request_type'));
		$group_no = null;

		if ($request_type === 'Sundry Debtors') {
			$group_no = 30;
		} elseif ($request_type === 'Sundry Creditors') {
			$group_no = 29;
		}

		$this->load->model('Accounts_model');
		$ledgers = $group_no === null
			? []
			: $this->Accounts_model->get_ledgers_by_group($group_no);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($ledgers));
	}

	public function search_outstanding_report()
	{
		$from_input = $this->input->post('from') ?: date("d-m-Y");
		$to_input   = $this->input->post('to')   ?: date("d-m-Y");

		$from_ts = strtotime(str_replace('/', '-', $from_input));
		$to_ts   = strtotime(str_replace('/', '-', $to_input));

		$from_date = $from_ts ? date("Y-m-d", $from_ts) : date("Y-m-d");
		$to_date   = $to_ts ? date("Y-m-d", $to_ts) : date("Y-m-d");

		$this->load->model('Accounts_model');

		$request_type = $this->input->post('request_type') ?? '';
		$ledger_id = $this->input->post('ledger_id') ?? '';
		log_message('debug', 'Selected Ledger ID: ' . $ledger_id);

		if ($request_type && $ledger_id) {
			if ($request_type == 'Sundry Debtors') {
				// $data['records'] = $this->Accounts_model->get_outstanding_report($from_date, $to_date, $ledger_id);

				$data['records'] = $this->Accounts_model->get_outstanding_report($from_date, $to_date, $ledger_id);

				$data['group_no'] = 30;
			} elseif ($request_type == 'Sundry Creditors') {
				$data['records'] = $this->Accounts_model->get_sundry_creditors_outstanding($from_date, $to_date, $ledger_id);
				$data['group_no'] = 29;
			} else {
				$data['records'] = [];
			}
		} elseif ($request_type) {
			if ($request_type == 'Sundry Debtors') {
				// $data['records'] = $this->Accounts_model->get_outstanding_report($from_date, $to_date);

				$data['records'] = $this->Accounts_model->get_outstanding_report($from_date, $to_date, null);

				$data['group_no'] = 30;
			} elseif ($request_type == 'Sundry Creditors') {
				$data['records'] = $this->Accounts_model->get_sundry_creditors_outstanding($from_date, $to_date);
				$data['group_no'] = 29;
			} else {
				$data['records'] = [];
			}
		} else {
			$data['records'] = [];
		}
		$data['company_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());
		$data['title'] = "Outstanding Report";
		$data['from'] = $from_input;
		$data['to'] = $to_input;
		$data['request_type'] = $request_type;
		$data['ledger_id'] = $ledger_id; // Optional: pass to view to retain selection
		if ($request_type == 'Sundry Debtors') {
			$data['ledgers'] = $this->Accounts_model->get_ledgers_by_group(30);
		} elseif ($request_type == 'Sundry Creditors') {
			$data['ledgers'] = $this->Accounts_model->get_ledgers_by_group(29);
		}
		$data['main_content'] = 'reports/account/outstanding_report';
		$this->load->view('includes/template', $data);
	}


	public function search_outstanding_reportsssss()
	{
		$data['title'] = "Outstanding Report";

		// Get voucher date and format
		$voucher_date_raw = $this->input->post('voucher_date');
		$voucher_date = date('Y-m-d', strtotime($voucher_date_raw));
		$data['voucher_date'] = $voucher_date_raw;

		// Get request type (Debtors / Creditors)
		$request_type = $this->input->post('request_type');
		$data['request_type'] = $request_type;

		// Load model
		$this->load->model('Accounts_model');

		// Get report data
		$data['records'] = $this->Accounts_model->get_outstanding_report($voucher_date, $request_type);

		// Load view
		$data['main_content'] = 'reports/account/outstanding_report';
		$this->load->view('includes/template', $data);
	}

	public function search_outstanding_report111()
	{
		$data['title'] = "Outstanding Report";

		// Get and format voucher date
		$voucher_date_raw = $this->input->post('voucher_date');
		$voucher_date = date('Y-m-d', strtotime($voucher_date_raw));
		$data['voucher_date'] = date('d-m-Y', strtotime($voucher_date));  // For display

		// Get request type (Sundry Debtors / Sundry Creditors)
		$request_type = $this->input->post('request_type');
		$data['request_type'] = $request_type;

		// Load models
		$this->load->model('Accounts_model');

		// Get report data
		$data['records'] = $this->Accounts_model->get_outstanding_report($voucher_date, $request_type);

		// You don't need party records unless you're using them in your view
		$data['party_records'] = [];

		// Load view
		$data['main_content'] = 'reports/account/outstanding_report';
		$this->load->view('includes/template', $data);
	}


	function print_outstanding_report()
	{
		$data['title'] = "Outstanding reports";
		$from_date = ($ts = strtotime(str_replace(['/', '.'], '-', $this->input->post('from') ?: $this->input->get('from') ?: date('d-m-Y')))) ? date('Y-m-d', $ts) : date('Y-m-d');
		$to_date   = ($ts = strtotime(str_replace(['/', '.'], '-', $this->input->post('to')   ?: $this->input->get('to')   ?: date('d-m-Y')))) ? date('Y-m-d', $ts) : date('Y-m-d');
		$data['request_type']  = $this->input->post('request_type');



		$this->load->model('Admin_model');
		$data['comapny_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());

		$this->load->model('Accounts_model');


		$request_type = $this->input->post('request_type') ?? '';
		$ledger_id = $this->input->post('ledger_id') ?? '';
		log_message('debug', 'Selected Ledger ID: ' . $ledger_id);

		if ($request_type && $ledger_id) {
			if ($request_type == 'Sundry Debtors') {
				$data['records'] = $this->Accounts_model->get_outstanding_report($from_date, $to_date, $ledger_id);
				$data['group_no'] = 30;
			} elseif ($request_type == 'Sundry Creditors') {
				$data['records'] = $this->Accounts_model->get_sundry_creditors_outstanding($from_date, $to_date, $ledger_id);
				$data['group_no'] = 29;
			} else {
				$data['records'] = [];
			}
		} elseif ($request_type) {
			if ($request_type == 'Sundry Debtors') {
				$data['records'] = $this->Accounts_model->get_outstanding_report($from_date, $to_date);
				$data['group_no'] = 30;
			} elseif ($request_type == 'Sundry Creditors') {
				$data['records'] = $this->Accounts_model->get_sundry_creditors_outstanding($from_date, $to_date);
				$data['group_no'] = 29;
			} else {
				$data['records'] = [];
			}
		} else {
			$data['records'] = [];
		}
		$data['user_name'] = $this->session->userdata('username');
		$this->load->view('Print/print_outstanding_report.php', $data);
	}



	function print_outstanding_reportssssss()
	{

		$data['title'] = "Outstanding report";
		$data['voucher_date'] = date('d-m-Y', strtotime($this->input->post('voucher_date')));


		$this->load->model('Admin_model');
		$data['comapny_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());

		$this->load->model('Accounts_model');
		$data['records'] = $this->Accounts_model->get_outstanding_report($data['voucher_date']);

		// print_r($data['records']);

		$this->load->view('Print/print_outstanding_report.php', $data);
	}

	function export_outstanding_report_details()
	{
		$data['title'] = "Outstanding report";
		$from_date = ($ts = strtotime(str_replace(['/', '.'], '-', $this->input->post('from') ?: $this->input->get('from') ?: date('d-m-Y')))) ? date('Y-m-d', $ts) : date('Y-m-d');
		$to_date   = ($ts = strtotime(str_replace(['/', '.'], '-', $this->input->post('to')   ?: $this->input->get('to')   ?: date('d-m-Y')))) ? date('Y-m-d', $ts) : date('Y-m-d');
		$data['request_type']  = $this->input->post('request_type');



		$this->load->model('Admin_model');
		$data['comapny_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());

		$this->load->model('Accounts_model');


		$request_type = $this->input->post('request_type') ?? '';
		$ledger_id = $this->input->post('ledger_id') ?? '';
		log_message('debug', 'Selected Ledger ID: ' . $ledger_id);

		if ($request_type && $ledger_id) {
			if ($request_type == 'Sundry Debtors') {
				$data['records'] = $this->Accounts_model->get_outstanding_report($from_date, $to_date, $ledger_id);
				$data['group_no'] = 30;
			} elseif ($request_type == 'Sundry Creditors') {
				$data['records'] = $this->Accounts_model->get_sundry_creditors_outstanding($from_date, $to_date, $ledger_id);
				$data['group_no'] = 29;
			} else {
				$data['records'] = [];
			}
		} elseif ($request_type) {
			if ($request_type == 'Sundry Debtors') {
				$data['records'] = $this->Accounts_model->get_outstanding_report($from_date, $to_date);
				$data['group_no'] = 30;
			} elseif ($request_type == 'Sundry Creditors') {
				$data['records'] = $this->Accounts_model->get_sundry_creditors_outstanding($from_date, $to_date);
				$data['group_no'] = 29;
			} else {
				$data['records'] = [];
			}
		} else {
			$data['records'] = [];
		}
		$this->load->view('excel_reports/export_outstanding_report_details', $data);
	}



	function outstanding_report_by_individual_ledger()
	{

		$id = $this->uri->segment('3');
		$data['title'] = "Outstanding Report By Individual Ledger";

		$from_raw = $this->uri->segment(4);
		$to_raw   = $this->uri->segment(5);

		$from_obj = DateTime::createFromFormat('d-m-Y', $from_raw);
		$to_obj   = DateTime::createFromFormat('d-m-Y', $to_raw);

		$from_date = $from_obj ? $from_obj->format('Y-m-d') : date('Y-m-d');
		$to_date   = $to_obj ? $to_obj->format('Y-m-d') : date('Y-m-d');

		$this->load->model('Accounts_model');
		$data['records'] = $this->Accounts_model->get_outstanding_individual_ledger($id, $from_date, $to_date);
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;
		$data['main_content'] = 'reports/account/outstanding_report_individual_ledger';
		$this->load->view('includes/template', $data);
	}




	/////////////////////// add_bank_reconciliation start  //////////////////////


	function add_bank_reconciliation()
	{
		$data['title'] = 'Bank Reconciliation';
		$data['account_id'] = $this->input->post('account_id');

		$this->load->model('Accounts_model');
		$data['account_ledgers'] = $this->Accounts_model->get_all_general_ledger_accounts();

		$data['main_content'] = 'accounts/bank_reconciliation_add.php';
		$this->load->view('includes/template.php', $data);
	}


	function view_bank_reconciliation()
	{
		$data['title'] = 'Bank Reconciliation';
		$this->load->model('Accounts_model');
		$flag = $this->Accounts_model->add_bank_reconciliation_details();
		if ($flag) {
			$this->session->set_flashdata('success', 'Record Successfully Saved');
			redirect('accounts/add_bank_reconciliation');
		}
	}


	function list_bank_reconciliation()
	{
		$data['title'] = 'Bank Reconciliation List';

		$this->load->model('Accounts_model');
		$data['records'] = $this->Accounts_model->get_bank_reconciliation_list();
		$data['account_ledgers'] = $this->Accounts_model->get_all_general_ledger_accounts();
		// log_message('error', 'Account Ledgers: ' . print_r($data['records'], true));

		$data['main_content'] = 'accounts/bank_reconciliation_list.php';
		$this->load->view('includes/template.php', $data);
	}

	function edit_bank_reconciliation()
	{
		$data['title'] = "Bank Reconciliation Edit";
		$id = $this->uri->segment('3');

		$this->load->model('Accounts_model');
		$data['records'] = $this->Accounts_model->get_bank_reconciliation_by_id($id);

		// print_r($data['records']);
		$data['main_content'] = 'accounts/bank_reconciliation_edit.php';
		$this->load->view('includes/template', $data);
	}

	function update_bank_reconciliation()
	{
		$data['title'] = "Bank Reconciliation Edit";
		$id = $this->input->post('reconciliation_id');
		$this->load->model('Accounts_model');
		$res = $this->Accounts_model->update_bank_reconciliation_data($id);
		if ($res) {
			$this->session->set_flashdata('success', 'Record Successfully Updated');
			redirect('accounts/list_bank_reconciliation');
		}
	}
	/////////////////////////////////////////////////////////////////////////////////


	public function group_ledger($group_no, $from, $to)
	{
		$this->load->model('Accounts_model');

		$data['group_name'] = $this->Accounts_model->get_group_name($group_no);
		$data['entries'] = $this->Accounts_model->get_group_ledger_entries($group_no, $from, $to);
		$data['from'] = $from;
		$data['to'] = $to;

		$this->load->view('accounts/group_ledger_view', $data);
	}
	////////////////

	public function drill_balance_sheetw()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Accounts_model');

		// Default date values
		$from_date = $this->input->post('from_date')
			? date('Y-m-d', strtotime($this->input->post('from_date')))
			: ($this->uri->segment(4) ? date('Y-m-d', strtotime($this->uri->segment(4))) : date('Y-m-01'));

		$to_date = $this->input->post('to_date')
			? date('Y-m-d', strtotime($this->input->post('to_date')))
			: ($this->uri->segment(5) ? date('Y-m-d', strtotime($this->uri->segment(5))) : date('Y-m-d'));

		$group_no = $this->input->post('group_no')
			? $this->input->post('group_no')
			: ($this->uri->segment(3) ? $this->uri->segment(3) : '');

		// Always load group list
		$data['groups'] = $this->db->select('group_no, group_name')
			->from('account_group')
			->order_by('group_name', 'ASC')
			->get()
			->result();


		$group_no = $this->input->post('group_no')
			? $this->input->post('group_no')
			: $group_no;

		// Set form inputs for repopulating view
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;
		$data['group_no'] = $group_no;
		$action = $this->input->post('action');

		// If group selected and form submitted, fetch data
		$data['balances'] = [];
		if (!empty($group_no)) {
			$data['balances'] = $this->Accounts_model->get_balance_sheet_data($from_date, $to_date, $group_no);
		}

		$data['title'] = 'Report - Balance Sheet';
		$data['main_content'] = 'reports/account/balance_sheet_drill_view';


		$this->load->view('includes/template', $data);
	}
	// Separate print function
	public function balance_sheet_print()
	{
		$this->load->model('Admin_model');
		$this->load->model('Accounts_model');

		// Dates and group from POST (sent by print form)
		$from_date = date('Y-m-d', strtotime($this->input->post('from_date')));
		$to_date = date('Y-m-d', strtotime($this->input->post('to_date')));
		$group_no = $this->input->post('group_no');

		// Company info for header in print
		$data['company_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());

		// Pass parameters to model
		$data['balances'] = $this->Accounts_model->get_balance_sheet_data($from_date, $to_date, $group_no);

		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;
		$data['group_no'] = $group_no;

		$data['title'] = "Print - Balance Sheet";
		$this->load->view('Print/print_balance_sheet_print', $data);  // Your print view file

		//  $this->load->view('Print/print_balance_sheet_print.php', $data);

	}
	public function balance_sheet_export()
	{
		$this->load->model('Accounts_model');
		$to_date = $this->input->post('to') ?: date('Y-m-d');

		$from_date = date('Y-01-01', strtotime($to_date));
		$group_no = $this->input->post('group_no') ?? $this->input->get('group_no');

		//($from_date); exit;

		$balances = [];
		if (!empty($group_no)) {
			$balances = $this->Accounts_model->get_balance_sheet_data($from_date, $to_date, $group_no);
			//  print_r($balances);
		}

		// Export CSV (or you can do Excel with PhpSpreadsheet)
		$filename = "balance_sheet_{$group_no}_" . date('Ymd') . ".csv";

		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header('Pragma: no-cache');
		header('Expires: 0');

		$output = fopen('php://output', 'w');

		fputcsv($output, ['Group', 'Ledger', 'Opening Balance', 'Debit', 'Credit', 'Closing Balance']);

		$prev_group = '';
		foreach ($balances as $row) {
			if ($prev_group !== $row->group_name) {
				// Optional: write group name as a separate row or leave blank
				// fputcsv($output, [strtoupper($row->group_name)]);
				$prev_group = $row->group_name;
			}
			fputcsv($output, [
				'',
				$row->account_name,
				number_format($row->opening_balance, 2),
				number_format($row->debit, 2),
				number_format($row->credit, 2),
				number_format($row->closing_balance, 2)
			]);
		}
		fclose($output);
		exit;
	}

	public function balance_sheet_bsg()
	{
		$this->load->helper('form');
		$this->load->model('Accounts_model');

		// Get POST or default dates
		$from_date = $this->input->post('from_date') ? date('Y-m-d', strtotime($this->input->post('from_date'))) : date('Y-m-01');
		$to_date = $this->input->post('to_date') ? date('Y-m-d', strtotime($this->input->post('to_date'))) : date('Y-m-d');
		$group_no = $this->input->post('group_no');

		// Fetch groups for dropdown
		$data['groups'] = $this->db->select('group_no, group_name')
			->from('account_group')
			->order_by('group_name', 'ASC')
			->get()
			->result();

		// Pass form data back to view
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;
		$data['group_no'] = $group_no;

		// Get balance sheet data only if group selected
		$data['balances'] = [];
		if ($this->input->method() === 'post' && !empty($group_no)) {
			$data['balances'] = $this->Accounts_model->get_balance_sheet_data($from_date, $to_date, $group_no);
		}
		log_message('error', 'Balance Sheet Data: ' . print_r($data['balances'], true));
		$data['title'] = "Report - Balance Sheet";
		$data['main_content'] = 'reports/account/balance_sheet_drill_view';  // Your view file
		$this->load->view('includes/template', $data);
	}

	private function validate_date($date)
	{
		return preg_match('/^\d{4}-\d{2}-\d{2}$/', $date);
	}
	public function trial_balance($from_date = null, $to_date = null)
	{
		$this->load->model('Accounts_model');
		$data['company_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());


		// Accept via POST or URL
		$from_date = $this->input->post('from_date') ?? $this->uri->segment(3);
		$to_date   = $this->input->post('to_date') ?? $this->uri->segment(4);

		if (empty($from_date)) $from_date = date('d-m-Y');
		if (empty($to_date))   $to_date = date('d-m-Y');

		// Accept both browser date input (Y-m-d) and legacy URLs (d-m-Y).
		$from = DateTime::createFromFormat('Y-m-d', $from_date) ?: DateTime::createFromFormat('d-m-Y', $from_date);
		$to   = DateTime::createFromFormat('Y-m-d', $to_date) ?: DateTime::createFromFormat('d-m-Y', $to_date);

		if (!$from || !$to) {
			show_error("Invalid date format.");
		}

		$from_sql = $from->format('Y-m-d');
		$to_sql = $to->format('Y-m-d');

		// Fetch data
		$data['accounts'] = $this->Accounts_model->get_account_trial_balance($from_sql, $to_sql);
		$data['group_totals'] = $this->Accounts_model->get_group_totals($from_sql, $to_sql);

		// For view
		$data['from_date'] = $from->format('d-m-Y');
		$data['to_date'] = $to->format('d-m-Y');
		$data['title'] = 'Trial Balance';
		$data['main_content'] = 'accounts/trial_balance_view';

		$this->load->view('includes/template', $data);
	}



	public function trial_balance_export()
	{

		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$this->load->model('Setup_model');
		$this->load->model('Accounts_model');
		$comapny_records = $this->Admin_model->get_company_master_list(get_current_company_id());

		$from = DateTime::createFromFormat('d-m-Y', $from_date) ?: DateTime::createFromFormat('Y-m-d', $from_date);
		$to = DateTime::createFromFormat('d-m-Y', $to_date) ?: DateTime::createFromFormat('Y-m-d', $to_date);
		if (!$from || !$to) {
			show_error('Invalid date format.');
		}
		$from_sql = $from->format('Y-m-d');
		$to_sql = $to->format('Y-m-d');
		$trial_balance_data = $this->Accounts_model->get_account_trial_balance($from_sql, $to_sql);

		// Prepare the output headers for Excel
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=Trial_Balance_" . date('Ymd') . ".xls");
		header("Pragma: no-cache");
		header("Expires: 0");

		// Use the same HTML table output but stripped down to basic styles for Excel
		echo "<table border='1'>";
		echo "<tr><th colspan='4' style=\"font-size:16px\">" . htmlspecialchars($comapny_records[0]->company_name) . "</th></tr>";
		echo "<tr><th colspan='4'>Trial Balance</th></tr>";
		echo "<tr><th colspan='4'>Period: " . $from->format('j-M-y') . " to " . $to->format('j-M-y') . "</th></tr>";
		echo "<tr>";
		echo "<th>Particulars</th><th></th><th>Debit</th><th>Credit</th>";
		echo "</tr>";

		$current_group = null;
		$group_debit = 0;
		$group_credit = 0;
		$grand_debit = 0;
		$grand_credit = 0;

		foreach ($trial_balance_data as $row) {
			if ($current_group !== null && $current_group !== $row['group_name']) {
				// group total row
				echo "<tr style='font-weight:bold; background:#ccc;'>";
				echo "<td>" . htmlspecialchars($current_group) . " Total</td><td></td>";
				echo "<td align='right'>" . number_format($group_debit, 2) . "</td>";
				echo "<td align='right'>" . number_format($group_credit, 2) . "</td>";
				echo "</tr>";
				$group_debit = 0;
				$group_credit = 0;
			}
			if ($current_group !== $row['group_name']) {
				// new group header
				echo "<tr style='background:#eee; font-weight:bold;'><td colspan='4'>" . htmlspecialchars($row['group_name']) . "</td></tr>";
				$current_group = $row['group_name'];
			}

			$debit = round((float) $row['debit'], 2);
			$credit = round((float) $row['credit'], 2);
			$group_debit += $debit;
			$group_credit += $credit;
			$grand_debit += $debit;
			$grand_credit += $credit;

			echo "<tr>";
			echo "<td>" . htmlspecialchars($row['account_name']) . "</td><td></td>";
			echo "<td align='right'>" . ($debit != 0 ? number_format($debit, 2) : '') . "</td>";
			echo "<td align='right'>" . ($credit != 0 ? number_format($credit, 2) : '') . "</td>";
			echo "</tr>";
		}
		// last group total
		if ($current_group !== null) {
			echo "<tr style='font-weight:bold; background:#ccc;'>";
			echo "<td>" . htmlspecialchars($current_group) . " Total</td><td></td>";
			echo "<td align='right'>" . number_format($group_debit, 2) . "</td>";
			echo "<td align='right'>" . number_format($group_credit, 2) . "</td>";
			echo "</tr>";
		}
		// grand total
		echo "<tr style='font-weight:bold; border-top:2px solid black;'>";
		echo "<td>Grand Total</td><td></td>";
		$grand_debit = round($grand_debit, 2);
		$grand_credit = round($grand_credit, 2);
		echo "<td align='right'>" . number_format($grand_debit, 2) . "</td>";
		echo "<td align='right'>" . number_format($grand_credit, 2) . "</td>";
		echo "</tr>";

		if ($grand_debit !== $grand_credit) {
			$difference = round(abs($grand_debit - $grand_credit), 2);
			echo "<tr style='color:red; font-weight:bold;'>";
			echo "<td colspan='4'>Warning: Debit and Credit mismatch by " . number_format($difference, 2) . "</td>";
			echo "</tr>";
		}

		echo "</table>";
		exit;
	}


	public function trial_balance_print()
	{
		$this->load->model('Accounts_model');
		$this->load->model('Setup_model');

		// Get from GET or POST
		$from_date = $this->input->get('from_date') ?? $this->input->post('from_date');
		$to_date   = $this->input->get('to_date')   ?? $this->input->post('to_date');

		// Fallback to today if empty
		if (empty($from_date)) {
			$from_date = date('d-m-Y');
		}
		if (empty($to_date)) {
			$to_date = date('d-m-Y');
		}

		// Accept both browser date input (Y-m-d) and legacy URLs (d-m-Y).
		$from = DateTime::createFromFormat('Y-m-d', $from_date) ?: DateTime::createFromFormat('d-m-Y', $from_date);
		$to   = DateTime::createFromFormat('Y-m-d', $to_date) ?: DateTime::createFromFormat('d-m-Y', $to_date);

		if (!$from) $from = new DateTime();
		if (!$to)   $to = new DateTime();

		// Format for DB queries
		$from_for_db = $from->format('Y-m-d');
		$to_for_db   = $to->format('Y-m-d');

		// Fetch data using correctly formatted dates
		$data['accounts'] = $this->Accounts_model->get_account_trial_balance($from_for_db, $to_for_db);
		$data['group_totals'] = $this->Accounts_model->get_group_totals($from_for_db, $to_for_db);

		// Pass original input dates for display
		$data['from_date'] = $from->format('d-m-Y');
		$data['to_date'] = $to->format('d-m-Y');

		$data['comapny_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());

		$this->load->view('Print/trial_balance_print_view', $data);
	}

	// public function trial_balance($from_date = null, $to_date = null)
	// {
	// 	$this->load->model('Accounts_model');

	// 	// Accept via POST or URL
	// 	$from_date = $this->input->post('from_date') ?? $this->uri->segment(3);
	// 	$to_date   = $this->input->post('to_date') ?? $this->uri->segment(4);

	// 	if (empty($from_date)) $from_date = date('d-m-Y');
	// 	if (empty($to_date))   $to_date = date('d-m-Y');

	// 	// Convert to Y-m-d format for DB queries
	// 	$from = DateTime::createFromFormat('d-m-Y', $from_date);
	// 	$to   = DateTime::createFromFormat('d-m-Y', $to_date);

	// 	if (!$from || !$to) {
	// 		show_error("333Invalid date format.");
	// 	}

	// 	$from_sql = $from->format('Y-m-d');
	// 	$to_sql = $to->format('Y-m-d');

	// 	// Fetch data
	// 	$data['accounts'] = $this->Accounts_model->get_account_trial_balance($from_sql, $to_sql);
	// 	$data['group_totals'] = $this->Accounts_model->get_group_totals($from_sql, $to_sql);

	// 	// For view
	// 	$data['from_date'] = $from_date;
	// 	$data['to_date'] = $to_date;
	// 	$data['title'] = 'Trial Balance';
	// 	$data['main_content'] = 'Accounts/trial_balance_view';

	// 	$this->load->view('includes/template', $data);
	// }



	// public function trial_balance_export()
	// {

	// 	$from_date = $this->input->post('from_date');
	// 	$to_date = $this->input->post('to_date');
	// 	// $this->load->model('Setup_model');
	// 	$this->load->model('Accounts_model');

	// 	$comapny_records = $this->Admin_model->get_company_master_list(get_current_company_id());
	// 	$from = DateTime::createFromFormat('d-m-Y', $from_date)
	// 		?: DateTime::createFromFormat('Y-m-d', $from_date);

	// 	$to = DateTime::createFromFormat('d-m-Y', $to_date)
	// 		?: DateTime::createFromFormat('Y-m-d', $to_date);

	// 	if (!$from || !$to) {
	// 		show_error("Invalid date format in export");
	// 	}

	// 	$from_sql = $from->format('Y-m-d');
	// 	$to_sql   = $to->format('Y-m-d');

	// 	// ✅ pass converted values
	// 	$trial_balance_data = $this->Accounts_model->get_account_trial_balance($from_sql, $to_sql);

	// 	// log_message('error', 'Trial Balance Data: ' . print_r($trial_balance_data, true));
	// 	// Prepare the output headers for Excel
	// 	header("Content-Type: application/vnd.ms-excel");
	// 	header("Content-Disposition: attachment; filename=Trial_Balance_" . date('Ymd') . ".xls");
	// 	header("Pragma: no-cache");
	// 	header("Expires: 0");

	// 	// Use the same HTML table output but stripped down to basic styles for Excel
	// 	echo "<table border='1'>";
	// 	echo "<tr><th colspan='4' style='font-size:16px'>Demo Garage Solutions LLC</th></tr>";
	// 	echo "<tr><th colspan='4'>Trial Balance</th></tr>";
	// 	echo "<tr><th colspan='4'>Period: " . date('j-M-y', strtotime($from_date)) . " to " . date('j-M-y', strtotime($to_date)) . "</th></tr>";
	// 	echo "<tr>";
	// 	echo "<th>Particulars</th><th></th><th>Debit</th><th>Credit</th>";
	// 	echo "</tr>";

	// 	$current_group = null;
	// 	$group_debit = 0;
	// 	$group_credit = 0;
	// 	$grand_debit = 0;
	// 	$grand_credit = 0;

	// 	foreach ($trial_balance_data as $row) {
	// 		if ($current_group !== null && $current_group !== $row['group_name']) {
	// 			// group total row
	// 			echo "<tr style='font-weight:bold; background:#ccc;'>";
	// 			echo "<td>{$current_group} Total</td><td></td>";
	// 			echo "<td align='right'>" . number_format($group_debit, 2) . "</td>";
	// 			echo "<td align='right'>" . number_format($group_credit, 2) . "</td>";
	// 			echo "</tr>";
	// 			$group_debit = 0;
	// 			$group_credit = 0;
	// 		}
	// 		if ($current_group !== $row['group_name']) {
	// 			// new group header
	// 			echo "<tr style='background:#eee; font-weight:bold;'><td colspan='4'>{$row['group_name']}</td></tr>";
	// 			$current_group = $row['group_name'];
	// 		}

	// 		$group_debit += floatval($row['debit']);
	// 		$group_credit += floatval($row['credit']);
	// 		$grand_debit += floatval($row['debit']);
	// 		$grand_credit += floatval($row['credit']);

	// 		echo "<tr>";
	// 		echo "<td>{$row['account_name']}</td><td></td>";
	// 		echo "<td align='right'>" . (($row['debit'] != 0) ? number_format($row['debit'], 2) : '') . "</td>";
	// 		echo "<td align='right'>" . (($row['credit'] != 0) ? number_format($row['credit'], 2) : '') . "</td>";
	// 		echo "</tr>";
	// 	}
	// 	// last group total
	// 	if ($current_group !== null) {
	// 		echo "<tr style='font-weight:bold; background:#ccc;'>";
	// 		echo "<td>{$current_group} Total</td><td></td>";
	// 		echo "<td align='right'>" . number_format($group_debit, 2) . "</td>";
	// 		echo "<td align='right'>" . number_format($group_credit, 2) . "</td>";
	// 		echo "</tr>";
	// 	}
	// 	// grand total
	// 	echo "<tr style='font-weight:bold; border-top:2px solid black;'>";
	// 	echo "<td>Grand Total</td><td></td>";
	// 	echo "<td align='right'>" . number_format($grand_debit, 2) . "</td>";
	// 	echo "<td align='right'>" . number_format($grand_credit, 2) . "</td>";
	// 	echo "</tr>";

	// 	echo "</table>";
	// 	exit;
	// }


	// public function trial_balance_print()
	// {
	// 	$this->load->model('Accounts_model');
	// 	$this->load->model('Setup_model');

	// 	// Get from GET or POST
	// 	$from_date = $this->input->get('from_date') ?? $this->input->post('from_date');
	// 	$to_date   = $this->input->get('to_date')   ?? $this->input->post('to_date');

	// 	// Fallback to today if empty
	// 	if (empty($from_date)) {
	// 		$from_date = date('d-m-Y');
	// 	}
	// 	if (empty($to_date)) {
	// 		$to_date = date('d-m-Y');
	// 	}

	// 	// Convert to DateTime objects from dd-mm-yyyy format
	// 	$from = DateTime::createFromFormat('d-m-Y', $from_date);
	// 	$to   = DateTime::createFromFormat('d-m-Y', $to_date);

	// 	if (!$from) $from = new DateTime();
	// 	if (!$to)   $to = new DateTime();

	// 	// Format for DB queries
	// 	$from_for_db = $from->format('Y-m-d');
	// 	$to_for_db   = $to->format('Y-m-d');

	// 	// Fetch data using correctly formatted dates
	// 	$data['accounts'] = $this->Accounts_model->get_account_trial_balance($from_for_db, $to_for_db);
	// 	$data['group_totals'] = $this->Accounts_model->get_group_totals($from_for_db, $to_for_db);

	// 	// Pass original input dates for display
	// 	$data['from_date'] = $from->format('d-m-Y');
	// 	$data['to_date'] = $to->format('d-m-Y');

	// 	$data['comapny_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());

	// 	$this->load->view('Print/trial_balance_print_view', $data);
	// }

	function add_expense()
	{
		// in use
		$data['title'] = "Expense/payment Entry";

		$data['ledger_id'] = $this->input->post('occupier_id');
		$d1 = date('Y-m-d');
		$data['opening_bal'] = '';

		$this->load->model('Accounts_model');
		$data['account_records'] = $this->Accounts_model->get_account_group_list();

		$this->load->model('Accounts_model');
		$data['sundry_detors_records'] = $this->Accounts_model->get_all_general_ledger_accounts(); //all ledgers
		$data['receipt_Creditors'] = $this->Accounts_model->get_all_general_ledger_accounts(); //bank

		$data['main_content'] = 'accounts/expense_add.php';
		$this->load->view('includes/template', $data);
	}

	function add_expense_details()
	{ // in use
		$data['title'] = "Payment Entry";
		$this->load->model('Accounts_model');
		$id = $this->Accounts_model->add_new_payment_data();
		if ($id != '') {
			$this->session->set_flashdata('success', 'Record Successfully Saved');
			redirect('accounts/view_payment_list');
		}
	}
	/***********************************    End CI Controller*************************************/
	function vat_report()
	{
		$this->load->model('Accounts_model');
		$data['title'] = "VAT report";

		// Set default date range: first day of current month to today
		$data['from_date'] = date('Y-m-01'); // First day of current month
		$data['to_date']   = date('Y-m-d');  // Today's date

		$data['main_content'] = 'reports/account/tax_report';
		$this->load->view('includes/template', $data);
	}

	public function financial_years()
	{
		$this->load->model('Financial_year_model');
		$this->load->model('Corporate_tax_model');
		$this->load->model('Accounts_model');
		$data['title'] = 'Financial Years';
		$data['financial_years'] = $this->Financial_year_model->get_years();
		$data['extension_requests'] = $this->Financial_year_model->get_extension_requests();

		// Build a set of year IDs whose corporate tax has been finalized so the
		// view can permanently hide the Reopen button for those years.
		$finalized_ids = [];
		foreach ($data['financial_years'] as $yr) {
			if ($this->Financial_year_model->is_tax_finalized($yr->id)) {
				$finalized_ids[] = (int) $yr->id;
			}
		}
		$data['tax_finalized_year_ids'] = $finalized_ids;

		// Closing audit log per year (keyed by financial_year_id)
		$data['closing_logs'] = [];
		foreach ($data['financial_years'] as $yr) {
			$data['closing_logs'][$yr->id] = $this->Financial_year_model->get_closing_log($yr->id);
		}

		// Capital / Equity ledger accounts for the Retained Earnings dropdown.
		// We pull accounts whose group is under parent_group = 0 with pandl = 0
		// and group_name contains 'capital' or 'equity' or 'retained'.
		$data['equity_accounts'] = $this->db
			->query("
				SELECT gl.account_id, gl.account_name, ag.group_name
				FROM general_ledger gl
				JOIN account_group ag ON ag.group_no = gl.group_no
				WHERE ag.pandl = 0
				  AND (
						LOWER(ag.group_name) LIKE '%capital%'
					 OR LOWER(ag.group_name) LIKE '%equity%'
					 OR LOWER(ag.group_name) LIKE '%retained%'
					 OR LOWER(ag.group_name) LIKE '%reserve%'
					 OR LOWER(gl.account_name) LIKE '%retained%'
					 OR LOWER(gl.account_name) LIKE '%accumulated%'
				  )
				ORDER BY ag.group_name, gl.account_name
			")->result();

		// Fallback: if no equity accounts found via name matching,
		// load all non-P&L accounts so the user can at least pick something.
		if (empty($data['equity_accounts'])) {
			$data['equity_accounts'] = $this->db
				->query("
					SELECT gl.account_id, gl.account_name, ag.group_name
					FROM general_ledger gl
					JOIN account_group ag ON ag.group_no = gl.group_no
					WHERE ag.pandl = 0
					ORDER BY ag.group_name, gl.account_name
				")->result();
		}

		$data['main_content'] = 'accounts/financial_years';
		$this->load->view('includes/template', $data);
	}

	public function add_financial_year()
	{
		if (!$this->input->post()) {
			redirect('accounts/financial_years');
		}

		$this->load->model('Financial_year_model');

		$year_name  = trim($this->input->post('year_name', true));
		$start_date = trim($this->input->post('start_date', true));
		$end_date   = trim($this->input->post('end_date', true));

		// Required validation
		if ($year_name === '' || $start_date === '' || $end_date === '') {

			$this->session->set_flashdata(
				'error',
				'Financial Year, Start Date and End Date are required.'
			);

			redirect('accounts/financial_years');
		}

		// Validate date format
		$start = DateTime::createFromFormat('Y-m-d', $start_date);
		$end   = DateTime::createFromFormat('Y-m-d', $end_date);

		if (
			!$start ||
			!$end ||
			$start->format('Y-m-d') !== $start_date ||
			$end->format('Y-m-d') !== $end_date
		) {

			$this->session->set_flashdata(
				'error',
				'Invalid Financial Year dates.'
			);

			redirect('accounts/financial_years');
		}

		// Get current company from existing Financial Year model
		$company_id = $this->Financial_year_model->get_company_id();

		$result = $this->Financial_year_model->add_financial_year([
			'company_id' => $company_id,
			'year_name'  => $year_name,
			'start_date' => $start_date,
			'end_date'   => $end_date
		]);

		if ($result['success']) {

			// Existing audit log
			$this->load->helper('log');

			$user_id = (int) $this->session->userdata('user_id');

			add_log_entry(
				$user_id,
				1,
				'Accounts/add_financial_year',
				'financial_years',
				'id',
				$result['id']
			);

			$this->session->set_flashdata(
				'success',
				$result['message']
			);
		} else {

			$this->session->set_flashdata(
				'error',
				$result['message']
			);
		}

		redirect('accounts/financial_years');
	}

	public function close_financial_year()
	{
		if (strtolower((string) $this->session->userdata('role')) !== 'admin') {
			show_error('You do not have permission to close a Financial Year.', 403);
		}

		$this->load->model('Financial_year_model');

		$year_id    = (int) $this->input->post('financial_year_id');
		$re_account = (int) $this->input->post('retained_earnings_account_id');
		$reason     = trim($this->input->post('close_reason', true));
		$user_id    = (int) $this->session->userdata('user_id');

		if (!$year_id) {
			$this->session->set_flashdata('error', 'Invalid Financial Year.');
			redirect('accounts/financial_years');
		}

		$result = $this->Financial_year_model->close_year_with_jv(
			$year_id,
			$re_account ?: null,
			$reason,
			$user_id
		);

		$this->session->set_flashdata($result['success'] ? 'success' : 'error', $result['message']);
		redirect('accounts/financial_years');
	}

	public function request_financial_year_extension()
	{
		$this->load->model('Financial_year_model');
		$result = $this->Financial_year_model->request_extension(
			(int) $this->input->post('financial_year_id'),
			$this->input->post('extended_to', true),
			$this->input->post('reason', true),
			(int) $this->session->userdata('user_id')
		);
		$this->session->set_flashdata($result['success'] ? 'success' : 'error', $result['message']);
		redirect('accounts/financial_years');
	}

	public function decide_financial_year_extension()
	{
		if (strtolower((string) $this->session->userdata('role')) !== 'admin') {
			show_error('You do not have permission to decide a Financial Year extension.', 403);
		}

		$this->load->model('Financial_year_model');
		$result = $this->Financial_year_model->decide_extension(
			(int) $this->input->post('extension_id'),
			$this->input->post('status', true),
			(int) $this->session->userdata('user_id')
		);
		$this->session->set_flashdata($result['success'] ? 'success' : 'error', $result['message']);
		redirect('accounts/financial_years');
	}

	public function reopen_financial_year()
	{
		if (strtolower((string) $this->session->userdata('role')) !== 'admin') {
			show_error('You do not have permission to reopen a Financial Year.', 403);
		}

		$this->load->model('Financial_year_model');
		$year_id = (int) $this->input->post('financial_year_id');
		$result = $this->Financial_year_model->reopen_year(
			$year_id,
			(int) $this->session->userdata('user_id')
		);
		$this->session->set_flashdata($result['success'] ? 'success' : 'error', $result['message']);
		redirect('accounts/financial_years');
	}


	public function corporate_tax($financial_year_id = null)
	{
		$this->load->model('Financial_year_model');
		$this->load->model('Corporate_tax_model');
		$data['title'] = 'Corporate Tax';
		$data['financial_years'] = $this->Financial_year_model->get_years();
		$data['financial_year_id'] = (int) ($financial_year_id ?: $this->input->post('financial_year_id'));
		$data['calculation'] = $data['financial_year_id'] ? $this->Corporate_tax_model->get_calculation($data['financial_year_id']) : null;
		$data['adjustments'] = $data['financial_year_id'] ? $this->Corporate_tax_model->get_adjustments($data['financial_year_id']) : [];
		$this->load->model('Accounts_model');
		$data['ledger_accounts'] = $this->Accounts_model->get_all_general_ledger_accounts();
		$data['main_content'] = 'accounts/corporate_tax';
		$this->load->view('includes/template', $data);
	}

	public function corporate_tax_add_adjustment()
	{
		$this->load->model('Corporate_tax_model');
		$result = $this->Corporate_tax_model->add_adjustment([
			'financial_year_id' => (int) $this->input->post('financial_year_id'),
			'corporate_tax_calculation_id' => (int) $this->input->post('corporate_tax_calculation_id'),
			'adjustment_type' => $this->input->post('adjustment_type', true),
			'description' => $this->input->post('description', true),
			'accounting_amount' => (float) $this->input->post('accounting_amount'),
			'tax_adjustment' => (float) $this->input->post('tax_adjustment'),
			'adjustment_direction' => $this->input->post('adjustment_direction', true),
			'source_account_id' => $this->input->post('source_account_id') ?: null
		]);
		$this->session->set_flashdata($result['success'] ? 'success' : 'error', $result['message']);
		redirect('accounts/corporate_tax/' . (int) $this->input->post('financial_year_id'));
	}

	public function corporate_tax_calculate()
	{
		$this->load->model('Corporate_tax_model');
		try {
			$this->Corporate_tax_model->calculate(
				(int) $this->input->post('financial_year_id'),
				(float) $this->input->post('tax_loss_brought_forward')
			);
			$this->session->set_flashdata('success', 'Corporate Tax calculated successfully.');
		} catch (RuntimeException $e) {
			$this->session->set_flashdata('error', $e->getMessage());
		}
		redirect('accounts/corporate_tax/' . (int) $this->input->post('financial_year_id'));
	}

	public function corporate_tax_delete_adjustment($adjustment_id)
	{
		$this->load->model('Corporate_tax_model');
		$result = $this->Corporate_tax_model->delete_adjustment((int) $adjustment_id);
		$this->session->set_flashdata($result['success'] ? 'success' : 'error', $result['message']);
		redirect('accounts/corporate_tax/' . (int) $this->input->post('financial_year_id'));
	}

	public function corporate_tax_update_adjustment($adjustment_id)
	{
		$this->load->model('Corporate_tax_model');
		$result = $this->Corporate_tax_model->update_adjustment((int) $adjustment_id, [
			'adjustment_type'      => $this->input->post('adjustment_type', true),
			'description'          => $this->input->post('description', true),
			'accounting_amount'    => (float) $this->input->post('accounting_amount'),
			'tax_adjustment'       => (float) $this->input->post('tax_adjustment'),
			'adjustment_direction' => $this->input->post('adjustment_direction', true),
			'source_account_id'    => $this->input->post('source_account_id') ?: null
		]);
		$this->session->set_flashdata($result['success'] ? 'success' : 'error', $result['message']);
		redirect('accounts/corporate_tax/' . (int) $this->input->post('financial_year_id'));
	}

	public function corporate_tax_report($financial_year_id)
	{
		$this->load->model('Corporate_tax_model');
		$calculation = $this->Corporate_tax_model->get_calculation((int) $financial_year_id);
		if (!$calculation) show_error('Corporate Tax calculation not found.', 404);

		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="corporate_tax_' . (int) $financial_year_id . '.csv"');
		$output = fopen('php://output', 'w');
		fputcsv($output, ['Corporate Tax Field', 'Amount', 'Status']);
		foreach ([
			'Accounting Profit/Loss' => $calculation->accounting_profit,
			'Total Additions' => $calculation->total_additions,
			'Total Deductions' => $calculation->total_deductions,
			'Taxable Income Before Losses' => $calculation->taxable_income_before_losses,
			'Tax Loss Utilised' => $calculation->tax_loss_utilised,
			'Final Taxable Income' => $calculation->final_taxable_income,
			'Corporate Tax Payable' => $calculation->corporate_tax_payable
		] as $label => $amount) {
			fputcsv($output, [$label, number_format((float) $amount, 2, '.', ''), $calculation->status]);
		}
		fclose($output);
		exit;
	}

	public function corporate_tax_finalize()
	{
		if (strtolower((string) $this->session->userdata('role')) !== 'admin') {
			show_error('You do not have permission to finalize Corporate Tax.', 403);
		}
		$this->load->model('Corporate_tax_model');
		$result = $this->Corporate_tax_model->finalize((int) $this->input->post('financial_year_id'));
		$this->session->set_flashdata($result['success'] ? 'success' : 'error', $result['message']);
		redirect('accounts/corporate_tax/' . (int) $this->input->post('financial_year_id'));
	}
	public function tax_report_details()
	{
		$this->load->model('Accounts_model');
		$this->load->model('Invoice_model');
		$this->load->model('Purchase_Model');

		$from_date   = $this->input->post('from_date');
		$to_date     = $this->input->post('to_date');
		$report_type = $this->input->post('report_type');
		$from_date_db = date('Y-m-d', strtotime($from_date));
		$to_date_db   = date('Y-m-d', strtotime($to_date));

		if ($report_type == 'summary') {
			// $data['sales_records']    = $this->Invoice_model->get_tax_summary($from_date_db, $to_date_db);
			$data['sales_records']    = $this->Invoice_model->get_tax_summary_emirate($from_date_db, $to_date_db);
			$data['purchase_summary'] = $this->Purchase_Model->get_purchase_vat_summary($from_date_db, $to_date_db);
			$data['srn_summary']      = $this->Purchase_Model->get_purchase_srn_vat_summary($from_date_db, $to_date_db);
			$data['voucher_summary']  = $this->Accounts_model->get_voucher_vat_summary($from_date_db, $to_date_db);
			$view_file = 'reports/account/tax_report_summary';
		} else {
			$data['sales_records']    = $this->Invoice_model->get_tax_detailed($from_date_db, $to_date_db);
			$data['purchase_records'] = $this->Purchase_Model->get_purchase_vat_details($from_date_db, $to_date_db);
			$data['voucher_records']  = $this->Accounts_model->get_voucher_vat_details($from_date_db, $to_date_db);
			$data['srn_records']      = $this->Purchase_Model->get_purchase_srn_vat_details($from_date_db, $to_date_db);
			$view_file = 'reports/account/tax_report_detailed';
		}

		$data['from_date']   = $from_date;
		$data['to_date']     = $to_date;
		$data['report_type'] = $report_type;

		if ($this->input->is_ajax_request()) {
			// **Only return the report HTML for AJAX**
			$this->load->view($view_file, $data);
		} else {
			// Normal page load
			$data['title']        = "Tax Report";
			$data['main_content'] = 'reports/account/tax_report';
			$this->load->view('includes/template', $data);
		}
	}

	public function save_expense()
	{
		$this->load->model('Accounts_model');

		$expense_id = $this->Accounts_model->save_expense_master();

		if ($expense_id) {
			$this->Accounts_model->post_expense_voucher($expense_id);
			notify_event('expense_created', $expense_id, 'Expense entry created', 'Accounts/expense_list', 'Accounts');

			$this->session->set_flashdata('success', 'Expense Saved Successfully');
		} else {
			$this->session->set_flashdata('error', 'Expense Save Failed');
		}

		redirect('accounts/expense_list');
	}

	public function expense_entry12()
	{
		// ⭐ Load Expense Ledgers (Direct Expense Group)
		$data['expense_ledgers'] = $this->db
			->select('account_id as ledger_id, account_name as ledger_name')
			->from('general_ledger')
			->where('group_no', 4)   // ⭐ change this ID
			->order_by('account_name', 'asc')
			->get()
			->result();

		// ⭐ Load Suppliers
		$data['suppliers'] = $this->db
			->select('supplier_id, supplier_name')
			->from('supplier_master')
			->order_by('supplier_name', 'asc')
			->get()
			->result();

		// ⭐ Load View
		$data['title']        = "Expense Details";
		$data['main_content'] = 'purchase/expense_entry';
		$this->load->view('includes/template', $data);
		// $this->load->view('purchase/expense_entry', $data);
	}
	public function expense_entry()
	{
		// ⭐ Load Expense Ledgers (Direct + Indirect Expense Groups)
		$this->db->select('account_id as ledger_id, account_name as ledger_name');
		$this->db->from('general_ledger');
		$this->db->where_not_in('group_no', [29, 30]);   // Exclude group_no 29 and 30
		$this->db->order_by('account_name', 'asc');
		$data['expense_ledgers'] = $this->db->get()->result();

		// ⭐ Load Bank Ledgers (Bank Accounts Group)
		// $this->db->select('account_id as ledger_id, account_name as ledger_name');
		// $this->db->from('general_ledger');
		// $this->db->where('group_no', 2);   // ⭐ Example: 2 = Bank Accounts
		// $this->db->order_by('account_name', 'asc');
		// $data['bank_ledgers'] = $this->db->get()->result();


		// ⭐ Load Cash Ledger (Single Row)
		$this->db->select('account_id as ledger_id, account_name as ledger_name');
		$this->db->from('general_ledger');
		$this->db->where('group_no', 21);   // ⭐ Example: 1 = Cash-in-hand
		$data['cash_ledger'] = $this->db->get()->row();


		// ⭐ Load Suppliers (For Credit Expense Future)
		$this->db->select('supplier_id, supplier_name');
		$this->db->from('supplier_master');
		$this->db->order_by('supplier_name', 'asc');
		$data['suppliers'] = $this->db->get()->result();


		// ⭐ Page Load
		$data['title']        = "Expense Entry";
		$data['main_content'] = 'purchase/expense_entry';

		$this->load->view('includes/template', $data);
	}


	public function expense_list()
	{
		$data['expenses'] = $this->db
			->select('e.*, g.account_name as ledger_name, s.supplier_name')
			->from('expense_master e')
			->join('general_ledger g', 'g.account_id = e.ledger_id', 'left')
			->join('supplier_master s', 's.supplier_id = e.supplier_id', 'left')
			->order_by('e.expense_id', 'desc')
			->get()
			->result();
		$data['title']        = "Expense List";
		$data['main_content'] = 'purchase/expense_list';
		$this->load->view('includes/template', $data);
	}
	public function delete_expense($expense_id)
	{
		$this->load->model('Accounts_model');

		try {
			$status = $this->Accounts_model->delete_expense_full($expense_id);
		} catch (RuntimeException $e) {
			$this->session->set_flashdata('error', $e->getMessage());
			redirect('accounts/expense_list');
		}

		if ($status)
			$this->session->set_flashdata('success', 'Expense Deleted Successfully');
		else
			$this->session->set_flashdata('error', 'Expense Delete Failed');

		redirect('accounts/expense_list');
	}

	public function edit_expense($expense_id)
	{
		$data['expense'] = $this->db
			->where('expense_id', $expense_id)
			->get('expense_master')
			->row();


		$data['document'] = $this->db
			->where('expense_id', $expense_id)
			->get('expense_documents')
			->row();

		$this->db->select('account_id as ledger_id, account_name as ledger_name');
		$this->db->from('general_ledger');
		$this->db->where_not_in('group_no', [29, 30]);   // Exclude group_no 29 and 30
		$this->db->order_by('account_name', 'asc');
		$data['expense_ledgers'] = $this->db->get()->result();

		$this->db->select('account_id as ledger_id, account_name as ledger_name');
		$this->db->from('general_ledger');
		$this->db->where('group_no', 19);   // ⭐ Example: 2 = Bank Accounts
		$this->db->order_by('account_name', 'asc');
		$data['bank_ledgers'] = $this->db->get()->result();

		if (!$data['expense'])
			redirect('purchase/expense_list');

		$data['title']        = "Expense Edit";
		$data['main_content'] = 'purchase/expense_edit';
		$this->load->view('includes/template', $data);
	}

	public function update_expense($expense_id)
	{
		$this->load->model('Accounts_model');


		$status = $this->Accounts_model->update_expense_full($expense_id);

		if ($status)
			$this->session->set_flashdata('success', 'Expense Updated');
		else
			$this->session->set_flashdata('error', 'Update Failed');

		redirect('accounts/expense_list');
	}

	public function print_expense($expense_id)
	{
		$data['header'] = $this->db->query("
		SELECT e.*,
		l.account_name,
		b.account_name  as bank_ledger_name,
		s.supplier_name
		FROM expense_master e
		LEFT JOIN general_ledger l ON l.account_id  = e.ledger_id
		LEFT JOIN general_ledger b ON b.account_id  = e.bank_ledger_id
		LEFT JOIN supplier_master s ON s.supplier_id = e.supplier_id
		WHERE e.expense_id = $expense_id
	")->row();

		$data['documents'] = $this->db
			->where('expense_id', $expense_id)
			->get('expense_documents')
			->result();

		$this->load->view('accounts/print/print_expense', $data);
	}

	public function get_bank_ledgers()
	{
		$this->load->model('Accounts_model');

		$data = $this->Accounts_model->get_bank_ledgers();

		echo json_encode($data);
	}

	// ========================================

	public function test_pnl()
	{
		$this->load->helper('account_helper');

		$from = $this->input->get('from') ?? '2025-04-01';
		$to   = $this->input->get('to') ?? date('Y-m-d');

		$result = get_net_profit_loss($from, $to);

		// 🔹 Log result
		log_message('error', 'P&L Result: ' . print_r($result, true));

		// 🔹 Also show on screen (optional)
		echo "<pre>";
		print_r($result);
		echo "</pre>";
	}
	// ==============================================================
	public function update_customer_ledger_name($customer_id = null)
	{
		if (empty($customer_id)) {
			echo "Customer ID is required";
			return;
		}

		$this->load->model('Accounts_model');

		$new_name = 'Rajvi Parmar';

		$updated = $this->Accounts_model->update_customer_ledger_name($customer_id, $new_name);

		if ($updated) {
			echo "Ledger name updated successfully";
		} else {
			echo "Failed to update ledger name";
		}
	}

	public function repair_customer_ledgers()
	{
		$this->load->model('Accounts_model');

		$this->Accounts_model->repair_customer_ledgers();

		echo "All customer ledger issues fixed successfully.";
	}

	public function fix_supplier_opening_type()
	{
		$this->load->model('Accounts_model');

		$updated = $this->Accounts_model->fix_supplier_opening_type();

		echo $updated . " supplier ledger records updated to CR.";
	}

	// =========================== new payment entry 

	function add_payment_new()
	{
		// in use
		$data['title'] = "Payment Entry";

		$data['ledger_id'] = $this->input->post('occupier_id');
		$d1 = date('Y-m-d');
		$data['opening_bal'] = '';

		$this->load->model('Accounts_model');
		$data['account_records'] = $this->Accounts_model->get_account_group_list();

		$this->load->model('Accounts_model');
		$data['sundry_detors_records'] = $this->Accounts_model->get_all_general_ledger_accounts(); //all ledgers
		$data['receipt_Creditors'] = $this->Accounts_model->get_all_general_ledger_accounts(); //bank

		$data['main_content'] = 'accounts/payment_add_new.php';
		$this->load->view('includes/template', $data);
	}

	function add_payment_details_new()
	{ // in use
		$data['title'] = "Payment Entry";
		$this->load->model('Accounts_model');
		$id = $this->Accounts_model->add_new_payment();
		if ($id != '') {
			$this->session->set_flashdata('success', 'Record Successfully Saved');
			redirect('accounts/view_payment_list_new');
		}
	}

	function view_payment_list_new() // in use
	{
		$data['title'] = "Payment List";
		$data['header'] = $this->input->post('header');

		if ($this->uri->segment(3)) {
			$data['division_id'] = $this->uri->segment(3);
			$data['from'] = $this->uri->segment(4);
			$data['to'] = $this->uri->segment(5);
		} else if ($this->input->post('from')) {
			$data['from'] = $this->input->post('from');
			$data['to'] = $this->input->post('to');
		} else {
			$data['from'] = date('Y-m-d');
			$data['to'] = date('Y-m-d');
		}

		$this->load->model('Accounts_model');
		$data['receipt'] = $this->Accounts_model->get_payment_list($data['from'], $data['to']);

		$data['main_content'] = 'accounts/payment_list_new.php';
		$this->load->view('includes/template', $data);
	}

	function edit_payment_new() // in use
	{
		$data['title'] = "Payment Edit";
		$this->load->model('accounts/debit_note');
		$data['receipt_records'] = $this->debit_note->receipt_records_pmc();

		$this->load->model('vehicle/vehicle_model');
		$data['driver_records'] = $this->vehicle_model->get_driver_records();
		$this->load->model('bags/Bags_master_model');
		$data['user_records'] = $this->Bags_master_model->get_user_details();

		$data['main_content'] = 'accounts/edit_receipt';
		$this->load->view('includes/template', $data);
	}

	function get_edit_payment_data_new() // in use
	{
		$data['title'] = "Payment edit";
		$data['voucher_id'] = $this->input->post('voucher_id');
		$data['occupier'] = $this->input->post('occupier');
		$data['division_id'] = $this->uri->segment(4);
		$data['from'] = $this->uri->segment(5);
		$data['to'] = $this->uri->segment(6);
		$this->load->model('accounts/debit_note');
		$data['receipt_records'] = $this->debit_note->receipt_records_pmc();

		$this->load->model('vehicle/vehicle_model');
		$data['driver_records'] = $this->vehicle_model->get_driver_records();
		$this->load->model('bags/Bags_master_model');
		$data['user_records'] = $this->Bags_master_model->get_user_details();

		$data['main_content'] = 'accounts/edit_receipt';
		$this->load->view('includes/template', $data);
	}

	function update_payment_data_new()
	{ // in use
		$data['title'] = "Payment ";
		$division_id = trim($this->input->post('division_id'));
		$from = trim($this->input->post('from'));
		$to = trim($this->input->post('to'));

		$this->load->model('accounts/debit_note');
		$id = $this->debit_note->update_receipt();
		if ($id) {
			$this->session->set_flashdata('success', 'Data Updated successfully');
		} else {
			$this->session->set_flashdata('error', 'Record Not Updated !! Duplicate Entry ');
		}
		redirect("accounts/view_receipt_list/" . $division_id . '/' . $from . '/' . $to);
	}

	function print_payment_new() // in use
	{
		$data['title'] = "Payment Print";
		$data['header'] = $this->input->post('header');
		$this->load->model('Admin_model');
		$data['logo_details'] = $this->Admin_model->get_company_master_list(get_current_company_id());

		$this->load->model('Accounts_model');
		$data['receipt'] = $this->Accounts_model->transport_receipt_records();
		$this->load->view('accounts/print/print_receipt', $data);
	}

	//   ======================voucher code changing function ==========

	public function fix_voucher_code_format()
	{
		$data = $this->db
			->where('voucher_code IS NOT NULL', null, false)
			->get('voucher_transaction')
			->result();

		foreach ($data as $row) {

			$old = $row->voucher_code;
			$parts = explode('/', $old);

			// Default values
			$prefix = '';
			$year   = '';
			$number = '';

			// Detect format and map
			if (strpos($old, 'R/') === 0) {
				// R/26/00008
				$prefix = 'RV';
				$year   = $parts[1] ?? '';
				$number = $parts[2] ?? '';
			} elseif (strpos($old, 'COOL/P/') === 0) {
				// COOL/P/26/00016
				$prefix = 'PV';
				$year   = $parts[2] ?? '';
				$number = $parts[3] ?? '';
			} elseif (strpos($old, 'PVF/C/') === 0) {
				$prefix = 'CN';
				$year   = $parts[2] ?? '';
				$number = $parts[3] ?? '';
			} elseif (strpos($old, 'PVF/D/') === 0) {
				$prefix = 'DN';
				$year   = $parts[2] ?? '';
				$number = $parts[3] ?? '';
			} elseif (strpos($old, 'PVF/J/') === 0) {
				$prefix = 'JV';
				$year   = $parts[2] ?? '';
				$number = $parts[3] ?? '';
			} elseif (strpos($old, 'PVF/N/') === 0) {
				$prefix = 'CE';
				$year   = $parts[2] ?? '';
				$number = $parts[3] ?? '';
			}

			// Skip if not matched properly
			if ($prefix == '' || $year == '' || $number == '') {
				continue;
			}

			// Final format
			$new_code = $prefix . '/' . $year . '/' . str_pad($number, 5, '0', STR_PAD_LEFT);

			// Update DB
			$this->db->where('voucher_id', $row->voucher_id);
			$upd = [
				'voucher_code' => $new_code
			];
			ensure_branch_in_data($upd);
			$this->db->update('voucher_transaction', $upd);
		}

		echo "Voucher codes updated successfully";
	}

	public function fix_all_codes11()
	{
		// Tables + column names
		$tables = [
			['table' => 'voucher_transaction', 'column' => 'voucher_code'],

			['table' => 'purchase_order_master', 'column' => 'po_code'],
			['table' => 'purchase_grn_master', 'column' => 'grn_code'],
		];

		foreach ($tables as $t) {

			$data = $this->db
				->where($t['column'] . ' IS NOT NULL', null, false)
				->get($t['table'])
				->result();

			foreach ($data as $row) {

				$old = $row->{$t['column']};
				$parts = explode('/', $old);

				$prefix = '';
				$year   = '';
				$number = '';

				// ✅ PURCHASE ORDER (COOL/POD)
				if (strpos($old, 'COOL/POD/') === 0) {
					$prefix = 'POD';   // your requirement
					$year   = $parts[2] ?? '';
					$number = $parts[3] ?? '';
				}

				// ✅ GRN (COOL/GRN)
				elseif (strpos($old, 'COOL/GRN/') === 0) {
					$prefix = 'GRN';  // keep GRN or change if needed
					$year   = $parts[2] ?? '';
					$number = $parts[3] ?? '';
				}

				// Skip if not matched
				if ($prefix == '' || $year == '' || $number == '') {
					continue;
				}

				// New code
				$new_code = $prefix . '/' . $year . '/' . str_pad($number, 4, '0', STR_PAD_LEFT);

				// Update
				$this->db->where(
					$t['column'] == 'voucher_code' ? 'voucher_id' : ($t['column'] == 'po_code' ? 'po_id' : 'grn_id'),
					$row->{$t['column'] == 'voucher_code' ? 'voucher_id' : ($t['column'] == 'po_code' ? 'po_id' : 'grn_id')}
				);

				$this->db->update($t['table'], [
					$t['column'] => $new_code
				]);
			}
		}

		echo "All codes updated successfully";
	}

	public function fix_grn_codes()
	{
		$rows = $this->db
			->where("grn_code LIKE 'GRN/GRN/%'")
			->get('purchase_grn_master')
			->result();

		foreach ($rows as $row) {

			$old = $row->grn_code;

			// Example: GRN/GRN/0001
			$parts = explode('/', $old);

			if (count($parts) != 3) {
				continue; // skip invalid format
			}

			$number = $parts[2];

			// ✅ Get year from GRN date
			$year = date('y', strtotime($row->grn_date));

			$new_code = 'GRN/' . $year . '/' . $number;

			// ✅ Check duplicate before update
			$exists = $this->db
				->where('grn_code', $new_code)
				->where('grn_id !=', $row->grn_id)
				->get('purchase_grn_master')
				->row();

			if ($exists) {
				// Skip to avoid duplicate crash
				continue;
			}

			// ✅ Update
			$this->db->where('grn_id', $row->grn_id);
			$this->db->update('purchase_grn_master', [
				'grn_code' => $new_code
			]);
		}

		echo "GRN codes updated safely";
	}

	public function fix_po_codes()
	{
		$rows = $this->db
			->where("po_code LIKE 'POD/POD/%'")
			->get('purchase_order_master')
			->result();

		foreach ($rows as $row) {

			$old = $row->po_code;

			// Example: POD/POD/0083
			$parts = explode('/', $old);

			if (count($parts) != 3) {
				continue; // skip invalid format
			}

			$number = $parts[2];

			// ✅ Get year from PO date
			$year = date('y', strtotime($row->po_date));

			$new_code = 'POD/' . $year . '/' . $number;

			// ✅ Prevent duplicate error
			$exists = $this->db
				->where('po_code', $new_code)
				->where('po_id !=', $row->po_id)
				->get('purchase_order_master')
				->row();

			if ($exists) {
				continue; // skip duplicates
			}

			// ✅ Update
			$this->db->where('po_id', $row->po_id);
			$this->db->update('purchase_order_master', [
				'po_code' => $new_code
			]);
		}

		echo "PO codes updated safely";
	}

	public function fix_voucher_codes_safe()
	{
		$rows = $this->db
			->get('voucher_transaction')
			->result();

		foreach ($rows as $row) {

			$update = [];

			/* =========================
           1. FIX VOUCHER CODE
        ========================= */

			if (!empty($row->voucher_code)) {

				// Example: V/26/0274
				if (strpos($row->voucher_code, 'V/') === 0) {

					$parts = explode('/', $row->voucher_code);

					if (count($parts) == 3) {

						$year   = $parts[1];
						$number = $parts[2];

						// Map voucher_type → prefix
						$prefix = '';

						if ($row->voucher_type == 'P') {
							$prefix = 'PV'; // Payment Voucher
						} elseif ($row->voucher_type == 'R') {
							$prefix = 'RV'; // Receipt
						} elseif ($row->voucher_type == 'J') {
							$prefix = 'JV'; // Journal
						} elseif ($row->voucher_type == 'C') {
							$prefix = 'CE'; // Contra
						}

						if ($prefix != '') {
							$new_voucher_code = $prefix . '/' . $year . '/' . $number;

							// Avoid duplicate error
							$exists = $this->db
								->where('voucher_code', $new_voucher_code)
								->where('voucher_id !=', $row->voucher_id)
								->get('voucher_transaction')
								->row();

							if (!$exists) {
								$update['voucher_code'] = $new_voucher_code;
							}
						}
					}
				}
			}

			/* =========================
           2. FIX INVOICE CODE
        ========================= */

			if (!empty($row->invoice_code)) {

				// Example: INV/GRN/0004
				if (strpos($row->invoice_code, 'INV/GRN/') === 0) {

					$parts = explode('/', $row->invoice_code);

					if (count($parts) == 3) {

						$number = $parts[2];

						// Use voucher date year
						$year = date('y', strtotime($row->voucher_date));

						$new_invoice_code = 'GRN/' . $year . '/' . $number;

						// Optional duplicate check
						$exists = $this->db
							->where('invoice_code', $new_invoice_code)
							->where('voucher_id !=', $row->voucher_id)
							->get('voucher_transaction')
							->row();

						if (!$exists) {
							$update['invoice_code'] = $new_invoice_code;
						}
					}
				}
			}

			/* =========================
           UPDATE ONLY IF NEEDED
        ========================= */

			if (!empty($update)) {
				$this->db->where('voucher_id', $row->voucher_id);
				ensure_branch_in_data($update);
				$this->db->update('voucher_transaction', $update);
			}
		}

		echo "Voucher codes fixed safely";
	}

	// ===================== receipt voucher new function =====================


	public function ajax_get_quotation_list()
	{
		$customer_id = $this->input->post('customer_id');

		if (empty($customer_id)) {
			echo '<option value="">No Customer Selected12</option>';
			return;
		}

		$this->load->model('Accounts_model');
		$data['res'] = $this->Accounts_model->ajax_get_quotation_list($customer_id);

		if (empty($data['res'])) {
			echo '<option value="">No Quotations Found</option>';
		} else {
			$this->load->view('ajax/quotation_list', $data);
		}
	}
	// ========================================

	public function create_all_supplier_gl()
	{
		$suppliers = $this->db->get('supplier_master')->result();

		foreach ($suppliers as $sup) {

			$code = !empty($sup->supplier_code)
				? $sup->supplier_code
				: 'SUP' . str_pad($sup->supplier_id, 4, '0', STR_PAD_LEFT);

			$account_name = $sup->supplier_name . ' - Supplier Advance (' . $code . ')';

			$data = [
				'account_name'     => $account_name,
				'group_no'         => 24,
				'supplier_id'      => $sup->supplier_id,
				'opening_balance'  => 0.00,
				'opening_bal_type' => 'Dr',
				'isdeleteable'     => 'N',
				'date'             => date('Y-m-d H:i:s')
			];

			// ✅ smarter check
			$existing = $this->db
				->where('supplier_id', $sup->supplier_id)
				->like('account_name', 'Supplier Advance')
				->get('general_ledger')
				->row();

			if ($existing) {

				// don't overwrite balances if already used
				unset($data['opening_balance']);
				unset($data['opening_bal_type']);

				$this->db->where('account_id', $existing->account_id)
					->update('general_ledger', $data);
			} else {

				// 🔥 extra safety: avoid duplicate by name
				$nameExists = $this->db
					->where('account_name', $account_name)
					->get('general_ledger')
					->row();

				if (!$nameExists) {
					$this->db->insert('general_ledger', $data);
				}
			}
		}

		return true;
	}

	public function view_profit_and_loss()
	{
		$data['title'] = "Report-Profit and Loss";
		$data['company_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());

		$this->load->model('Accounts_model');

		if (!$this->input->post()) {

			// Database format
			$from = date('Y-m-01');
			$to   = date('Y-m-d');
		} else {

			// Convert datepicker format (dd-mm-yyyy) to database format (yyyy-mm-dd)
			$from = date('Y-m-d', strtotime($this->input->post('from')));
			$to   = date('Y-m-d', strtotime($this->input->post('to')));
		}

		// Safety check
		if (empty($from)) {
			$from = date('Y-m-01');
		}

		if (empty($to)) {
			$to = date('Y-m-d');
		}

		// Fetch data using database format
		$data['income']  = $this->Accounts_model->get_income($from, $to);
		$data['expense'] = $this->Accounts_model->get_expense($from, $to);

		// Totals
		$data['total_income'] = array_sum(array_column($data['income'], 'total'));

		$data['total_expense'] = array_sum(array_map(function ($row) {
			return abs($row->total);
		}, $data['expense']));

		// Net Profit / Loss
		$net = $data['total_income'] - $data['total_expense'];

		$data['net_profit'] = $net;
		$data['net_label']  = ($net >= 0) ? 'Net Profit' : 'Net Loss';

		// Display format
		$data['from_display'] = date('d-m-Y', strtotime($from));
		$data['to_display']   = date('d-m-Y', strtotime($to));

		// Keep original values for drilldown
		$data['from'] = $from;
		$data['to']   = $to;

		$data['main_content'] = 'reports/account/view_profit_loss.php';
		$this->load->view('includes/template', $data);
	}

	public function expense_income_report()
	{
		$this->load->model('Accounts_model');

		$from = $this->input->get_post('from', TRUE);
		$selected_date = DateTime::createFromFormat('!Y-m-d', (string) $from);
		if (!$selected_date || $selected_date->format('Y-m-d') !== $from) {
			$from = date('Y-m-d');
		}

		$data['title'] = 'Daily Income and Expense Report';
		$data['from'] = $from;
		$data['to'] = $from;
		$data['income'] = $this->Accounts_model->get_income_daily($from);
		$data['expense'] = $this->Accounts_model->get_expense_daily($from);
		$data['total_income'] = array_sum(array_column($data['income'], 'total'));
		$data['total_expense'] = array_sum(array_map(function ($row) {
			return abs($row->total);
		}, $data['expense']));
		$data['net_profit'] = $data['total_income'] - $data['total_expense'];

		$data['main_content'] = 'reports/account/expense_income_report';
		$this->load->view('includes/template', $data);
	}

	public function expense_income_export()
	{
		$this->load->model('Accounts_model');
		$from = $this->input->get_post('from', TRUE);
		$selected_date = DateTime::createFromFormat('!Y-m-d', (string) $from);
		if (!$selected_date || $selected_date->format('Y-m-d') !== $from) {
			$from = date('Y-m-d');
		}

		$income = $this->Accounts_model->get_income_daily($from);
		$expense = $this->Accounts_model->get_expense_daily($from);
		$total_income = array_sum(array_column($income, 'total'));
		$total_expense = array_sum(array_map(function ($row) {
			return abs($row->total);
		}, $expense));

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="Daily_Income_Expense_' . $from . '.xls"');
		header('Pragma: no-cache');
		header('Expires: 0');

		echo '<table border="1">';
		echo '<tr><th colspan="2">Daily Income &amp; Expense</th></tr>';
		echo '<tr><th colspan="2">Date: ' . htmlspecialchars($from, ENT_QUOTES, 'UTF-8') . '</th></tr>';
		echo '<tr><th>Income</th><th>Amount</th></tr>';
		foreach ($income as $row) {
			echo '<tr><td>' . htmlspecialchars($row->account_name, ENT_QUOTES, 'UTF-8') . '</td><td align="right">' . number_format((float) $row->total, 2) . '</td></tr>';
		}
		echo '<tr><th>Total Income</th><th align="right">' . number_format($total_income, 2) . '</th></tr>';
		echo '<tr><th>Expenses</th><th>Amount</th></tr>';
		foreach ($expense as $row) {
			echo '<tr><td>' . htmlspecialchars($row->account_name, ENT_QUOTES, 'UTF-8') . '</td><td align="right">' . number_format(abs((float) $row->total), 2) . '</td></tr>';
		}
		echo '<tr><th>Total Expense</th><th align="right">' . number_format($total_expense, 2) . '</th></tr>';
		echo '<tr><th>Net ' . ($total_income >= $total_expense ? 'Profit' : 'Loss') . '</th><th align="right">' . number_format(abs($total_income - $total_expense), 2) . '</th></tr>';
		echo '</table>';
		exit;
	}

	public function expense_income_print()
	{
		$this->load->model('Admin_model');
		$this->load->model('Accounts_model');
		$from = $this->input->get_post('from', TRUE);
		$selected_date = DateTime::createFromFormat('!Y-m-d', (string) $from);
		if (!$selected_date || $selected_date->format('Y-m-d') !== $from) {
			$from = date('Y-m-d');
		}

		$data['company_records'] = $this->Admin_model->get_company_master_list(get_current_company_id());
		$data['from'] = $from;
		$data['income'] = $this->Accounts_model->get_income_daily($from);
		$data['expense'] = $this->Accounts_model->get_expense_daily($from);
		$data['total_income'] = array_sum(array_column($data['income'], 'total'));
		$data['total_expense'] = array_sum(array_map(function ($row) {
			return abs($row->total);
		}, $data['expense']));
		$data['net_profit'] = $data['total_income'] - $data['total_expense'];
		$this->load->view('Print/expense_income_report', $data);
	}


	public function drilldown()
	{
		$data['title'] = "";
		$this->load->model('Accounts_model');
		$account_id = $this->input->get('account_id');
		$from       = $this->input->get('from');
		$to         = $this->input->get('to');

		// Safety defaults
		if (empty($from)) $from = date('Y-m-01');
		if (empty($to))   $to   = date('Y-m-d');

		$data['from'] = $from;
		$data['to']   = $to;

		$data['ledgers'] = $this->Accounts_model->get_ledger_transactions($account_id, $from, $to);

		$data['main_content'] = 'reports/account/drilldown';
		$this->load->view('includes/template', $data);
	}

	function view_balance_sheet_new()
	{
		$data['title'] = "Balance Sheet";

		$from = $this->input->post('from') ?: date('Y-01-01');
		$to   = $this->input->post('to') ?: date('Y-m-d');

		$data['from'] = date('Y-m-d', strtotime($from));
		$data['to']   = date('Y-m-d', strtotime($to));

		$this->load->model('Accounts_model');

		$tree = $this->Accounts_model->prepare_balance_sheet($to);

		$assets = [];
		$liabilities = [];

		foreach ($tree as $group) {

			if (strtolower(trim($group->group_name)) == 'assets') {
				$assets[] = $group; // ✅ FIX
			}

			if (strtolower(trim($group->group_name)) == 'liabilities') {
				$liabilities[] = $group; // ✅ FIX
			}
		}

		$profit = $this->Accounts_model->get_profit_loss($from, $to);

		// foreach ($liabilities as &$group) {
		// 	if (strtolower(trim($group->group_name)) == 'capital account') {
		// 		$group->balance += $profit;
		// 	}
		// }

		$data['assets'] = $assets;
		$data['liabilities'] = $liabilities;

		$data['main_content'] = 'Reports/account/balance_sheet_list_new';
		$this->load->view('includes/template', $data);
	}

	public function drilldown_balance_sheet()
	{
		$data['title'] = "";

		$account_id = $this->input->get('account_id');
		$from       = $this->input->get('from');
		$to         = $this->input->get('to');

		// Safety defaults
		if (empty($from)) $from = date('Y-01-01');
		if (empty($to))   $to   = date('Y-m-d');

		$data['account_id'] = $account_id;
		$data['from']       = $from;
		$data['to']         = $to;

		$this->load->model('Accounts_model');

		$details = $this->Accounts_model->get_balance_sheet_ledger_drilldown($account_id, $from, $to);

		if ($details) {
			$data['account_name'] = $details['account_name'];
			$data['group_name']   = $details['group_name'];
			$data['root_type']    = $details['root_type'];
			$data['opening_raw']  = $details['opening_raw'];
			$data['transactions'] = $details['transactions'];
		} else {
			$data['account_name'] = '';
			$data['group_name']   = '';
			$data['root_type']    = '';
			$data['opening_raw']  = 0;
			$data['transactions'] = [];
		}

		$this->load->view('reports/account/drilldown_table', $data);
		// $this->load->model('Hr_model');
		// $data['records'] = $this->Hr_model->get_emp_monthly_salary_list($data['from']);
		// // 	echo "<pre>";
		// // print_r($data['records']);
		// // echo "</pre>";
		// // exit;
		// $data['salary_month'] = !empty($this->input->post('from'))
		// 	? date('Y-m', strtotime($this->input->post('from') . '-01'))
		// 	: date('Y-m');  // default to current month

		// $this->load->model('Accounts_model');
		// $data['sundry_detors_records'] = $this->Accounts_model->get_all_general_ledger_accounts();
		// $gno = "19,21";
		// $data['credit_records'] = $this->Accounts_model->get_bank_cash_ledgers($gno);

		// $data['main_content'] = 'Accounts/emp_monthly_salary_list.php';
		// $this->load->view('includes/template', $data);
	}

	function add_employee_payment_details()
	{
		$data['title'] = "Monthly Salary List";
		$this->load->model('Accounts_model');
		$id = $this->Accounts_model->add_employee_payment_details();
		if ($id != '') {
			$this->session->set_flashdata('success', 'Record Successfully Saved');
			redirect('accounts/emp_monthly_salary_list');
		}
	}
	public function ajax_drilldown()
	{
		$account_id = $this->input->post('account_id');
		$from_raw   = $this->input->post('from');
		$to_raw     = $this->input->post('to');

		$from = date('Y-m-d', strtotime($from_raw));
		$to   = date('Y-m-d', strtotime($to_raw));

		if (empty($from) || $from === '1970-01-01') {
			$from = date('Y-m-01');
		}
		if (empty($to) || $to === '1970-01-01') {
			$to = date('Y-m-d');
		}

		$this->load->model('Accounts_model');

		$data['account_id'] = $account_id;
		$data['from']       = $from;
		$data['to']         = $to;
		$data['account_name'] = '';
		$data['group_name']   = '';
		$data['is_income']    = false;
		$data['is_expense']   = false;

		$ledger = $this->db->query("
      SELECT gl.account_name, ag.group_name, ag.parent_group
      FROM general_ledger gl
      JOIN account_group ag ON ag.group_no = gl.group_no
      WHERE gl.account_id = ?
    ", [$account_id])->row();

		if ($ledger) {
			$is_discount_expense = ((int) $account_id === 1122);
			$data['account_name'] = $ledger->account_name;
			$data['group_name']   = $is_discount_expense ? 'Expenses' : $ledger->group_name;
			$data['is_income']    = !$is_discount_expense && ((int) $ledger->parent_group === 3);
			$data['is_expense']   = $is_discount_expense || ((int) $ledger->parent_group === 4);
		}

		$data['transactions'] = $this->Accounts_model->get_ledger_report($account_id, $from, $to, true);

		$this->load->view('reports/account/ajax_drilldown_view', $data);
	}
	 function payable_salary()
  {
    $data['title'] = "Monthly Salary List";
    $data['from'] = date('M-Y');
    $this->load->model('Hr_model');
    $data['records'] = $this->Hr_model->get_emp_monthly_salary_list($data['from']);
// 	echo "<pre>";
// print_r($data['records']);
// echo "</pre>";
// exit;
    $data['salary_month'] = !empty($this->input->post('from')) 
                        ? date('Y-m', strtotime($this->input->post('from') . '-01')) 
                        : date('Y-m');  // default to current month

    $this->load->model('Accounts_model');
    $data['sundry_detors_records'] = $this->Accounts_model->get_all_general_ledger_accounts();
    $gno = "19,21";
    $data['credit_records'] = $this->Accounts_model->get_bank_cash_ledgers($gno);

    $data['main_content'] = 'accounts/emp_monthly_salary_list.php';
    $this->load->view('includes/template', $data);
  }
  function view_emp_monthly_salary()
	{

		$data['title'] = "Monthly Salary List";
		// $data['from'] = $this->input->post('from');
		$data['from'] = date('Y-m', strtotime($this->input->post('from')));

		$data['to'] = ('Y-m-t');


		if ($this->input->post('from') != '') {
			$data['from'] = $this->input->post('from');
		}

		$this->load->model('Hr_model');
		$data['records'] = $this->Hr_model->get_emp_monthly_salary_list($data['from']);
		$data['main_content'] = 'hr/emp_monthly_salary_list.php';
		$this->load->view('includes/template', $data);
	}
}
