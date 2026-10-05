<?php
class Admin extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
	}

	// ----------------------------------------------------------------
	// Company Details
	// ----------------------------------------------------------------

	function company_details($company_id = null)
	{
		$data['title'] = 'Company Master';

		$action = $this->input->get('action');
		$edit_id = $company_id ?: (int) $this->input->get('company_id');

		if ($action === 'add') {
			$this->add_company();
			return;
		}

		if ($edit_id > 0) {
			$this->edit_company($edit_id);
			return;
		}

		// Company list view with branch count and user count
		$companies = $this->Admin_model->get_company_master_list();
		foreach ($companies as &$comp) {
			$comp->branch_count = $this->db->where('company_id', $comp->company_id)->count_all_results('branches');
			$comp->user_count = $this->db->where('company_id', $comp->company_id)->count_all_results('users');
			$comp->demo_status = get_company_demo_status($comp->company_id);
		}
		unset($comp);

		$data['companies'] = $companies;
		$data['main_content'] = 'company/list.php';
		$this->load->view('includes/template.php', $data);
	}

	function add_company()
	{
		$data['title'] = 'Add New Company';
		$data['auto_code'] = $this->Admin_model->generate_company_code();
		$data['company'] = null;
		$data['main_content'] = 'company/form.php';
		$this->load->view('includes/template.php', $data);
	}

	function edit_company($company_id)
	{
		$company = $this->Admin_model->get_company_by_id($company_id);
		if (!$company) {
			$this->session->set_flashdata('error', 'Company record not found.');
			redirect('Admin/company_details');
			return;
		}

		$data['title'] = 'Edit Company : ' . $company->company_name;
		$data['company'] = $company;
		$data['company_details'] = [$company]; // backward compatibility
		$data['bank_details']    = $this->Admin_model->get_company_bank_list($company_id);
		$data['stamp_details']   = $this->Admin_model->get_company_stamp_list($company_id);
		$data['demo_status']     = get_company_demo_status($company_id);

		$data['main_content'] = 'company/edit_company.php';
		$this->load->view('includes/template.php', $data);
	}

	function save_company()
	{
		$company_name = trim($this->input->post('company_name'));
		$company_code = trim($this->input->post('company_code')) ?: $this->Admin_model->generate_company_code();

		if (empty($company_name)) {
			$this->session->set_flashdata('error', 'Company name is required.');
			redirect('Admin/add_company');
			return;
		}

		$logo_upload = $this->upload_company_logo();
		if (isset($logo_upload['error'])) {
			$this->session->set_flashdata('error', $logo_upload['error']);
			redirect('Admin/add_company');
			return;
		}

		$saveData = [
			'company_code'      => $company_code,
			'company_name'      => $company_name,
			'company_address'   => trim($this->input->post('company_address')),
			'company_city'      => trim($this->input->post('company_city')),
			'company_state'     => trim($this->input->post('company_state')) ?: 'Maharashtra',
			'company_pincode'   => trim($this->input->post('company_pincode')),
			'company_country'   => trim($this->input->post('company_country')) ?: 'UAE',
			'company_email_id'  => trim($this->input->post('company_email_id')),
			'company_telephone' => trim($this->input->post('company_telephone')),
			'company_TRN'       => trim($this->input->post('company_trn')),
			'company_website'   => trim($this->input->post('website')),
			'created_by'        => $this->session->userdata('user_id'),
			'demo_enabled'      => (int) $this->input->post('demo_enabled'),
			'demo_start_date'   => trim((string)$this->input->post('demo_start_date')) ?: null,
			'demo_duration_days'=> (int) $this->input->post('demo_duration_days'),
			'demo_expiry_date'  => trim((string)$this->input->post('demo_expiry_date')) ?: null,
		];
		if (!empty($logo_upload['path'])) {
			$saveData['company_logo'] = $logo_upload['path'];
		}

		if ($saveData['demo_enabled'] === 1 && empty($saveData['demo_expiry_date'])) {
			$start = $saveData['demo_start_date'] ?: date('Y-m-d');
			$saveData['demo_start_date'] = $start;
			if ($saveData['demo_duration_days'] > 0) {
				$saveData['demo_expiry_date'] = calculate_demo_expiry_date($start, $saveData['demo_duration_days']);
			}
		}

		$company_id = $this->Admin_model->insert_company($saveData);
		if ($company_id) {
			$this->session->set_flashdata('success', 'New Company successfully created.');
			redirect('Admin/company_details');
		} else {
			$this->session->set_flashdata('error', 'Failed to create Company.');
			redirect('Admin/add_company');
		}
	}

	private function upload_company_logo()
	{
		if (empty($_FILES['company_logo']['name'])) {
			return [];
		}

		if (!$this->db->field_exists('company_logo', 'company_master')) {
			return ['error' => 'Company logo storage is not configured. Apply the company logo database migration first.'];
		}

		$upload_path = FCPATH . 'uploads/company_logos/';
		if (!is_dir($upload_path) && !mkdir($upload_path, 0755, true) && !is_dir($upload_path)) {
			return ['error' => 'Unable to create the company logo upload directory.'];
		}

		$this->load->library('upload');
		$this->upload->initialize([
			'upload_path' => $upload_path,
			'allowed_types' => 'jpg|jpeg|png|gif|webp',
			'max_size' => 2048,
			'encrypt_name' => true,
			'remove_spaces' => true,
		]);

		if (!$this->upload->do_upload('company_logo')) {
			return ['error' => strip_tags($this->upload->display_errors('', ''))];
		}

		$upload = $this->upload->data();
		return ['path' => 'uploads/company_logos/' . $upload['file_name']];
	}

	function add_company_records()
	{
		$data['title'] = 'Company Master';

		$demo_action = $this->input->post('demo_action');
		$company_id = (int) $this->input->post('company_id');
		if ($company_id <= 0) {
			$company_id = get_current_company_id();
		}

		if ($demo_action === 'save_demo' || $demo_action === 'extend_demo') {
			$payload = [
				'demo_enabled' => (int) $this->input->post('demo_enabled'),
				'demo_start_date' => trim((string) $this->input->post('demo_start_date')) === '' ? null : trim((string) $this->input->post('demo_start_date')),
				'demo_duration_days' => (int) $this->input->post('demo_duration_days'),
				'demo_expiry_date' => trim((string) $this->input->post('demo_expiry_date')) === '' ? null : trim((string) $this->input->post('demo_expiry_date')),
			];

			if ($payload['demo_enabled'] !== 1) {
				$payload['demo_enabled'] = 0;
				$payload['demo_start_date'] = null;
				$payload['demo_duration_days'] = 0;
				$payload['demo_expiry_date'] = null;
			}

			if ($payload['demo_enabled'] === 1) {
				$start_date = trim((string) $payload['demo_start_date']);
				$duration_days = (int) $payload['demo_duration_days'];
				if ($demo_action === 'extend_demo') {
					$existing_expiry = !empty($payload['demo_expiry_date']) ? $payload['demo_expiry_date'] : null;
					$now = new DateTime('now');
					$base_date = $existing_expiry && $now < new DateTime($existing_expiry . ' 23:59:59')
						? $existing_expiry
						: $now->format('Y-m-d');
					$payload['demo_start_date'] = $base_date;
					if ($duration_days > 0) {
						$payload['demo_expiry_date'] = calculate_demo_expiry_date($base_date, $duration_days);
					} elseif (!empty($existing_expiry)) {
						$payload['demo_expiry_date'] = $existing_expiry;
					}
				} else {
					if ($start_date === '') {
						$start_date = date('Y-m-d');
						$payload['demo_start_date'] = $start_date;
					}
					if ($duration_days > 0) {
						$payload['demo_expiry_date'] = calculate_demo_expiry_date($start_date, $duration_days);
					}
				}
			}

			$this->db->where('company_id', $company_id)->update('company_master', $payload);
			$this->session->set_flashdata('success', 'Demo settings saved successfully.');
			redirect('Admin/edit_company/' . $company_id);
			return;
		}

		$logo_upload = $this->upload_company_logo();
		if (isset($logo_upload['error'])) {
			$this->session->set_flashdata('error', $logo_upload['error']);
			redirect('Admin/edit_company/' . $company_id);
			return;
		}

		$company_updates = [];
		if (!empty($logo_upload['path'])) {
			$company_updates['company_logo'] = $logo_upload['path'];
		}
		$saved_id = $this->Admin_model->update_company_record_by_id($company_updates);
		$this->session->set_flashdata('success', 'Company details saved successfully.');
		$redirect_id = $company_id ?: $saved_id;
		redirect('Admin/edit_company/' . $redirect_id);
	}

	// ----------------------------------------------------------------
	// Email Settings — SMTP Configuration & Email Templates
	// ----------------------------------------------------------------

	/**
	 * Main Email Settings page (tabbed: SMTP + Templates).
	 */
	function email_settings()
	{
		$data['title']      = 'Email Settings';
		$data['company_id'] = get_current_company_id(); // single-company; extend via session if multi-company

		$data['smtp_settings']  = $this->Admin_model->get_smtp_settings($data['company_id']);
		$data['email_templates'] = $this->Admin_model->get_email_templates($data['company_id']);
		$data['companies']      = $this->Admin_model->get_all_companies();

		$data['main_content'] = 'email_settings/index.php';
		$this->load->view('includes/template.php', $data);
	}

	/**
	 * POST — Save SMTP credentials for a company.
	 */
	function save_smtp_settings()
	{
		$company_id = get_current_company_id()	;

		$payload = [
			'smtp_host'       => $this->input->post('smtp_host'),
			'smtp_port'       => (int) $this->input->post('smtp_port'),
			'smtp_encryption' => $this->input->post('smtp_encryption'),
			'smtp_username'   => $this->input->post('smtp_username'),
			'smtp_from_email' => $this->input->post('smtp_from_email'),
			'smtp_from_name'  => $this->input->post('smtp_from_name'),
			'is_active'       => 1,
		];

		// Only update password if the user actually typed a new one
		$new_password = $this->input->post('smtp_password');
		if (!empty($new_password)) {
			$payload['smtp_password'] = $new_password; // model will base64-encode
		}

		$this->Admin_model->save_smtp_settings($company_id, $payload);
		$this->session->set_flashdata('success', 'SMTP settings saved successfully.');
		redirect('Admin/email_settings');
	}

	/**
	 * POST (AJAX) — Send a test email using the saved SMTP settings.
	 * Returns JSON.
	 */
	function test_smtp()
	{
		$this->output->set_content_type('application/json');
		try {
			$this->load->library('Gms_mailer');

			$company_id = get_current_company_id();
			$test_email = trim($this->input->post('test_email'));

			if (empty($test_email) || !filter_var($test_email, FILTER_VALIDATE_EMAIL)) {
				echo json_encode(['status' => false, 'message' => 'Please enter a valid test email address.']);
				return;
			}

			$result = $this->gms_mailer->test_connection($company_id, $test_email);
			echo json_encode($result);
		} catch (Throwable $e) {
			log_message('error', 'Gms_mailer test endpoint exception: ' . $e->getMessage());
			$this->output->set_status_header(500);
			echo json_encode([
				'status'  => false,
				'message' => 'SMTP test could not be completed: ' . $e->getMessage(),
			]);
		}
	}
 
	/**
	 * POST (AJAX) — Save (insert or update) an email template.
	 * Returns JSON.
	 */
	function save_email_template()
	{
		$payload = [
			'id'           => (int) $this->input->post('template_id'),
			'company_id'   => get_current_company_id(),
			'template_key' => $this->input->post('template_key'),
			'template_name' => $this->input->post('template_name'),
			'subject'      => $this->input->post('subject'),
			'html_body'    => $this->input->post('html_body'),
			'is_active'    => 1,
		];

		// Basic validation
		if (empty($payload['template_key']) || empty($payload['subject']) || empty($payload['html_body'])) {
			echo json_encode(['status' => false, 'message' => 'Template key, subject and body are required.']);
			return;
		}

		$saved_id = $this->Admin_model->save_email_template($payload);
		echo json_encode(['status' => true, 'message' => 'Template saved successfully.', 'id' => $saved_id]);
	}

	/**
	 * POST (AJAX) — Get a single template for editing (returns JSON).
	 */
	function get_email_template()
	{
		$id = (int) $this->input->post('id');
		$row = $this->Admin_model->get_email_template_by_id($id);
		if ($row) {
			echo json_encode(['status' => true, 'data' => $row]);
		} else {
			echo json_encode(['status' => false, 'message' => 'Template not found.']);
		}
	}

	/**
	 * POST (AJAX) — Delete an email template by id.
	 */
	function delete_email_template()
	{
		$id = (int) $this->input->post('id');
		if ($id > 0) {
			$this->Admin_model->delete_email_template($id);
			echo json_encode(['status' => true, 'message' => 'Template deleted.']);
		} else {
			echo json_encode(['status' => false, 'message' => 'Invalid template id.']);
		}
	}
public function test_mailtrap()
{
    $this->load->library('email');

	$test_email = trim($this->input->post('test_email')) ?: 'customer@example.com';
	if (!filter_var($test_email, FILTER_VALIDATE_EMAIL)) {
		echo 'Please enter a valid test email address.';
		return;
	}

    $this->email->from(
        'test@gms.local',
        'GMS Test'
    );

	$this->email->to($test_email);

    $this->email->subject('GMS Mailtrap Test');

    $this->email->message('
        <h2>GMS Email Test</h2>
        <p>This is a test email from Garage Management System.</p>
        <p>Mailtrap SMTP is working successfully.</p>
    ');

    if ($this->email->send()) {

        echo 'Email sent successfully';

    } else {

        echo '<pre>';
        print_r($this->email->print_debugger());
        echo '</pre>';
    }
}

}
