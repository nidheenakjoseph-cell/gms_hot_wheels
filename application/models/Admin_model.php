<?php
class Admin_model extends CI_Model
{
	function get_company_master_list($company_id = null)
	{
		$this->db->from('company_master');
		if ($company_id !== null && (int) $company_id > 0) {
			$this->db->where('company_id', (int) $company_id);
		}
		return $this->db->order_by('company_id', 'ASC')->get()->result();
	}

	function get_company_by_id($company_id)
	{
		return $this->db->where('company_id', (int)$company_id)->get('company_master')->row();
	}

	function get_company_bank_list($company_id = null)
	{
		if ($company_id) {
			$this->db->where('company_id', (int)$company_id);
		}
		return $this->db->get('company_bank_details')->result();
	}

	function get_company_stamp_list($company_id = null)
	{
		if ($company_id) {
			$this->db->where('company_id', (int)$company_id);
		}
		return $this->db->get('company_stamp_image')->result();
	}

	function generate_company_code()
	{
		$last = $this->db->select('company_code')->order_by('company_id', 'DESC')->limit(1)->get('company_master')->row();
		if (!$last || empty($last->company_code)) {
			return 'CMP01';
		}
		$num = intval(preg_replace('/[^0-9]/', '', $last->company_code)) + 1;
		return 'CMP' . str_pad($num, 2, '0', STR_PAD_LEFT);
	}

	function insert_company($data)
	{
		$this->db->insert('company_master', $data);
		return $this->db->insert_id();
	}

	function update_company_record_by_id($additional_data = [])
	{
		$id = (int) $this->input->post('company_id');
		if ($id <= 0) {
			$id = 1;
		}

		$data = array(
			'company_name' => $this->input->post('company_name'),
			'company_address' => $this->input->post('company_address'),
			'company_city' => $this->input->post('company_city'),
			'company_state' => $this->input->post('company_state') ?: 'Maharashtra',
			'company_pincode' => $this->input->post('company_pincode'),
			'company_country' => $this->input->post('company_country'),
			'company_email_id' => $this->input->post('company_email_id'),
			'company_telephone' => $this->input->post('company_telephone'),
			'company_TRN' => $this->input->post('company_trn'),
			'company_website' => $this->input->post('website'),
		);

		if ($this->input->post('company_code')) {
			$data['company_code'] = trim($this->input->post('company_code'));
		}
		$data = array_merge($data, $additional_data);

		if ($this->db->field_exists('demo_enabled', 'company_master')) {
			$data['demo_enabled'] = (int) $this->input->post('demo_enabled');
			$demo_start_date = trim((string) $this->input->post('demo_start_date'));
			$demo_expiry_date = trim((string) $this->input->post('demo_expiry_date'));
			$data['demo_start_date'] = $demo_start_date === '' ? null : $demo_start_date;
			$data['demo_duration_days'] = (int) $this->input->post('demo_duration_days');
			$data['demo_expiry_date'] = $demo_expiry_date === '' ? null : $demo_expiry_date;
		}
		$this->db->where('company_id', $id);
		$this->db->update('company_master', $data);

		if (isset($_POST['bname'])) {
			for ($i = 0; $i < count($_POST['bname']); $i++) {
				if ($_POST['bname'][$i] != '') {
					$data = array(
						'company_id' => $id,
						'bank_name' => $_POST['bname'][$i],
						'bank_account' => $_POST['bacc'][$i],
						'bank_branch' => $_POST['bbranch'][$i],
						'bank_iban' => $_POST['biban'][$i],
						'bank_swift' => $_POST['bswift'][$i],
					);
					$this->db->insert('company_bank_details', $data);
				}
			}
		}

		if (isset($_POST['bname_old'])) {
			for ($i = 0; $i < count($_POST['bname_old']); $i++) {
				$trans_id = $_POST['trans_id'][$i];
				$data = array(
					'company_id' => $id,
					'bank_name' => $_POST['bname_old'][$i],
					'bank_account' => $_POST['bacc_old'][$i],
					'bank_branch' => $_POST['bbranch_old'][$i],
					'bank_iban' => $_POST['biban_old'][$i],
					'bank_swift' => $_POST['bswift_old'][$i],
				);
				$this->db->where('bid', $trans_id);
				$res = $this->db->update('company_bank_details', $data);
			}
		}

		if (isset($_POST['image_name'])) {
			for ($i = 0; $i < count($_POST['image_name']); $i++) {
				if ($_POST['image_name'][$i] != '' && !empty($_FILES['stamp_image']['tmp_name'][$i])) {
					$stamp_image = base64_encode(file_get_contents($_FILES['stamp_image']['tmp_name'][$i]));
					$data = array(
						'company_id' => $id,
						'stamp_name' => $_POST['image_name'][$i],
						'stamp_image' => $stamp_image,
					);
					$this->db->insert('company_stamp_image', $data);
				}
			}
		}

		$uid = $this->session->userdata('user_id');
		$page_name = explode('index.php/', $_SERVER['PHP_SELF']);
		$ci = get_instance();
		$ci->load->helper('log');
		$log_msg = add_log_entry($uid, 2, isset($page_name[1]) ? $page_name[1] : 'company_details', 'company_master', 'company_id', $id);
		return $id;
	}

	// ================================================================
	// SMTP SETTINGS METHODS
	// ================================================================

	/**
	 * Fetch SMTP settings for a given company. Returns row or FALSE.
	 */
	function get_smtp_settings($company_id = 1)
	{
		$query = $this->db->get_where('company_smtp_settings', ['company_id' => $company_id]);
		$row = $query->row();
		if ($row && $row->smtp_password !== '') {
			// Decode stored password for display (masked in view)
			$row->smtp_password = base64_decode($row->smtp_password);
		}
		return $row;
	}

	/**
	 * Insert or update SMTP settings for a company.
	 */
	function save_smtp_settings($company_id = 1, $data = [])
	{
		// Encode password before storing
		if (!empty($data['smtp_password'])) {
			$data['smtp_password'] = base64_encode($data['smtp_password']);
		}
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['company_id'] = $company_id;

		// Check if a row already exists
		$existing = $this->db->get_where('company_smtp_settings', ['company_id' => $company_id])->row();
		if ($existing) {
			$this->db->where('company_id', $company_id);
			return $this->db->update('company_smtp_settings', $data);
		} else {
			return $this->db->insert('company_smtp_settings', $data);
		}
	}

	/**
	 * Get raw (base64-encoded) SMTP password for actual sending — do NOT decode in view.
	 */
	function get_smtp_settings_raw($company_id = 1)
	{
		return $this->db->get_where('company_smtp_settings', ['company_id' => $company_id])->row();
	}

	// ================================================================
	// EMAIL TEMPLATE METHODS
	// ================================================================

	/**
	 * Get all active email templates, optionally filtered by company.
	 */ 
	function get_email_templates($company_id = null)
	{
		$this->db->select('et.*, cm.company_name');
		$this->db->from('email_templates et');
		$this->db->join('company_master cm', 'cm.company_id = et.company_id', 'left');
		if ($company_id !== null) {
			$this->db->where('et.company_id', $company_id);
		}
		$this->db->order_by('et.company_id, et.template_name', 'ASC');
		return $this->db->get()->result();
	}

	/**
	 * Get a single template by its PK id.
	 */
	function get_email_template_by_id($id)
	{
		return $this->db->get_where('email_templates', ['id' => $id])->row();
	}

	/**
	 * Insert or update an email template.
	 * If $data['id'] exists and > 0 → update, else insert.
	 */
	function save_email_template($data = [])
	{
		$data['updated_at'] = date('Y-m-d H:i:s');
		$id = isset($data['id']) ? (int)$data['id'] : 0;
		unset($data['id']);

		if ($id > 0) {
			$this->db->where('id', $id);
			$this->db->update('email_templates', $data);
			return $id;
		} else {
			$this->db->insert('email_templates', $data);
			return $this->db->insert_id();
		}
	}

	/**
	 * Delete (hard) an email template by id.
	 */
	function delete_email_template($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('email_templates');
	}

	/**
	 * Get all companies for dropdown.
	 */
	function get_all_companies()
	{
		return $this->db->select('company_id, company_name')->get('company_master')->result();
	}

}
