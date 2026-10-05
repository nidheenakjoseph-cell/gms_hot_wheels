<?php
class Employee extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Employee_model');
	}

	public function add()
	{
	$data['title'] = "Employee";
	$data['departments'] = $this->Employee_model->get_departments();
	$data['form_data'] = $this->session->flashdata('form_data');
	$data['main_content'] = 'employee/addemployee';
	$this->load->view('includes/template', $data);
	}

	public function save()
	{
    $name       = trim($this->input->post('employee_name'));
    $mobile     = trim($this->input->post('mobile'));
    $email      = trim($this->input->post('email'));
    $dept_id    = $this->input->post('department_id');
    $desig_id   = $this->input->post('designation_id');

    // Strip spaces, dashes, and parentheses (common international formatting)
    $mobile_clean = preg_replace('/[\s\-\(\)]/', '', $mobile);

    // Preserve all submitted data so the form can be refilled on error
    $formData = $this->input->post();

    // Employee Name â€” required, letters/spaces only
    if ($name === '') {
        $this->session->set_flashdata('error', 'Employee name is required.');
        $this->session->set_flashdata('form_data', $formData);
        redirect('employee/add');
        return;
    }

    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        $this->session->set_flashdata('error', 'Employee name should only contain letters and spaces.');
        $this->session->set_flashdata('form_data', $formData);
        redirect('employee/add');
        return;
    }

    // Mobile â€” if provided, allow optional + prefix (country code) and 7-15 digits (international friendly)
    if ($mobile !== '' && !preg_match('/^\+?[0-9]{7,15}$/', $mobile_clean)) {
        $this->session->set_flashdata('error', 'Please enter a valid mobile number.');
        $this->session->set_flashdata('form_data', $formData);
        redirect('employee/add');
        return;
    }

    // Email â€” if provided, must be valid format
    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->session->set_flashdata('error', 'Please enter a valid email address.');
        $this->session->set_flashdata('form_data', $formData);
        redirect('employee/add');
        return;
    }

    // Department â€” required
    if (empty($dept_id)) {
        $this->session->set_flashdata('error', 'Please select a department.');
        $this->session->set_flashdata('form_data', $formData);
        redirect('employee/add');
        return;
    }

    // Designation â€” required
    if (empty($desig_id)) {
        $this->session->set_flashdata('error', 'Please select a designation.');
        $this->session->set_flashdata('form_data', $formData);
        redirect('employee/add');
        return;
    }

    // Store the cleaned mobile number (no stray formatting characters) before saving
    $postData = $formData;
    $postData['mobile'] = $mobile_clean;

    $this->Employee_model->save_employee($postData);
    redirect('Employee');
	} 

	public function index()
	{
			$data['title'] = "Employee List";
		$this->load->model('Employee_model');
		$data['employees'] = $this->Employee_model->get_all_employees();
		$data['main_content'] = 'employee/list';
		$this->load->view('includes/template', $data);
	}

	public function delete($id)
	{
		// Get employee record first
		$employee = $this->db->where('employee_id', $id)
			->get('employees')
			->row();

		if (!$employee) {
			redirect('Employee');
		}

		/* ===============================
			DELETE PASSPORT FILE
			=============================== */

		if (
			!empty($employee->passport_file) &&
			file_exists('./uploads/passports/' . $employee->passport_file)
		) {

			unlink('./uploads/passports/' . $employee->passport_file);
		}

		/* ===============================
			DELETE USER ACCOUNT
			=============================== */

		$this->db->where('employee_id', $id)
			->delete('users');

		/* ===============================
			DELETE EMPLOYEE
			=============================== */

		$this->db->where('employee_id', $id)
			->delete('employees');

		redirect('Employee');
	}

	public function edit($id)

	{
			$data['title'] = "Edit Employee";
		$this->load->model('Employee_model');

		$data['employee'] = $this->Employee_model->get_employee($id);
        $data['form_data'] = $this->session->flashdata('form_data');
		$data['departments'] = $this->Employee_model->get_departments();
		$dept_id_for_designations = isset($data['form_data']['department_id']) ? $data['form_data']['department_id'] : $data['employee']->department_id;
		$data['designations'] = $this->Employee_model->get_designations_by_department($dept_id_for_designations);
		$data['main_content'] = 'employee/edit';
		$this->load->view('includes/template', $data);
	}

	public function update() 
{
    $employee_id = $this->input->post('employee_id');
    $name        = trim($this->input->post('employee_name'));
    $mobile      = trim($this->input->post('mobile'));
    $email       = trim($this->input->post('email'));
    $dept_id     = $this->input->post('department_id');
    $desig_id    = $this->input->post('designation_id');

    $mobile_clean = preg_replace('/[\s\-\(\)]/', '', $mobile);

    $formData = $this->input->post();

    // Employee Name â€” required, letters/spaces only
    if ($name === '') {
        $this->session->set_flashdata('error', 'Employee name is required.');
        $this->session->set_flashdata('form_data', $formData);
        redirect('employee/edit/' . $employee_id);
        return;
    }

    if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        $this->session->set_flashdata('error', 'Employee name should only contain letters and spaces.');
        $this->session->set_flashdata('form_data', $formData);
        redirect('employee/edit/' . $employee_id);
        return;
    }

    // Mobile
    if ($mobile !== '' && !preg_match('/^\+?[0-9]{7,15}$/', $mobile_clean)) {
        $this->session->set_flashdata('error', 'Please enter a valid mobile number.');
        $this->session->set_flashdata('form_data', $formData);
        redirect('employee/edit/' . $employee_id);
        return;
    }

    // Email
    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->session->set_flashdata('error', 'Please enter a valid email address.');
        $this->session->set_flashdata('form_data', $formData);
        redirect('employee/edit/' . $employee_id);
        return;
    }

    // Department
    if (empty($dept_id)) {
        $this->session->set_flashdata('error', 'Please select a department.');
        $this->session->set_flashdata('form_data', $formData);
        redirect('employee/edit/' . $employee_id);
        return;
    }

    // Designation
    if (empty($desig_id)) {
        $this->session->set_flashdata('error', 'Please select a designation.');
        $this->session->set_flashdata('form_data', $formData);
        redirect('employee/edit/' . $employee_id);
        return;
    }

    $postData = $formData;
    $postData['mobile'] = $mobile_clean;

    $this->load->model('Employee_model');
    $this->Employee_model->update_employee($employee_id, $postData);
    redirect('Employee');
}
	/* =====================================================
       SAVE DEPARTMENT (AJAX)
       URL: index.php/employee/save_department
       ===================================================== */
	public function save_department()
	{
		$department_name = trim($this->input->post('name'));

		if ($department_name === '') {
			echo json_encode([
				'status' => false,
				'message' => 'Department name is required'
			]);
			return;
		}

		// Optional: prevent duplicates
		$exists = $this->db
			->where('department_name', $department_name)
			->get('departments')
			->row();

		if ($exists) {
			echo json_encode([
				'status' => false,
				'message' => 'Department already exists'
			]);
			return;
		}

		$this->Employee_model->save_department($department_name);

    echo json_encode([
        'status' => true,
        'message' => 'Department added successfully',
        'department_id' => $this->db->insert_id(),
        'department_name' => $department_name
    ]);
}

	/* =====================================================
       SAVE DESIGNATION (AJAX)
       URL: index.php/employee/save_designation
       ===================================================== */
	public function save_designation()
	{
		$department_id = $this->input->post('department_id');
		$designation   = trim($this->input->post('name'));

		if (!$department_id || $designation === '') {
			echo json_encode([
				'status' => false,
				'message' => 'Department and designation are required'
			]);
			return;
		}

		// Optional: prevent duplicate designation per department
		$exists = $this->db
			->where('department_id', $department_id)
			->where('designation_name', $designation)
			->get('designations')
			->row();

		if ($exists) {
			echo json_encode([
				'status' => false,
				'message' => 'Designation already exists in this department'
			]);
			return;
		}

		$this->Employee_model->save_designation($department_id, $designation);

    echo json_encode([
        'status' => true,
        'message' => 'Designation added successfully',
        'designation_id' => $this->db->insert_id(),
        'designation_name' => $designation
    ]);
}

	public function get_designations_by_department()
	{
		$department_id = $this->input->post('department_id');

		if (!$department_id) {
			echo json_encode([]);
			return;
		}

		$designations = $this->Employee_model
			->get_designations_by_department($department_id);

		echo json_encode($designations);
	}
}

