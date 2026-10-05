<?php
class InsuranceCompany extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('InsuranceCompany_model');
		$this->load->library('form_validation');
	}

	public function list()
	{
		$data['companies'] = $this->InsuranceCompany_model->get_all();
		$data['title'] = "Insurance Company List";
		$data['main_content'] = 'insurance/company_list';
		$this->load->view('includes/template', $data);
	}

	public function add()
	{

		$data['title'] = "Add Insurance Company";
		$data['main_content'] = 'insurance/company_add_form';
		$this->load->view('includes/template', $data);
		
	}

	public function save()
	{

		$data['title'] = 'Add Insurance Company';
		
		$this->form_validation->set_rules(
			'company_name',
			'Company Name',
			'required|trim'
		);

		$this->form_validation->set_rules(
			'license_registration_no',
			'License / Registration No.',
			'required|trim'
		);

		if ($this->form_validation->run() == TRUE) {

			$data = array(
				'company_name' => $this->input->post('company_name'),
				'contact_no'   => $this->input->post('contact_no'),
				'email'        => $this->input->post('email'),
				'address'      => $this->input->post('address'),
				'status'           => $this->input->post('status'),
				'license_registration_no' => $this->input->post('license_registration_no'),
				'website' => $this->input->post('website'),
				'created_at'       => date('Y-m-d H:i:s')
			);

			$this->InsuranceCompany_model->add_company($data);

			$this->session->set_flashdata('success', 'Insurance company added!');
			redirect('insurancecompany/list');
		}	else {

			$data['main_content'] = 'insurance/company_add_form';

			$this->load->view(
				'includes/template',
				$data
			);
		}
	}

	public function edit($company_id)
	{
		$data['company'] = $this->InsuranceCompany_model->get($company_id);
		$data['title'] = "Edit Insurance Company Details";
		$data['main_content'] = 'insurance/company_edit_form';
		$this->load->view('includes/template', $data);
		
	}

	public function update()
	{
		$data['title'] = 'Edit Insurance Company';
		
		$company_id = $this->input->post('company_id');


		$this->form_validation->set_rules(
			'company_name',
			'Company Name',
			'required|trim'
		);

		$this->form_validation->set_rules(
			'license_registration_no',
			'License / Registration No.',
			'required|trim'
		);

		if ($this->form_validation->run() == TRUE) {

			$data = [
				'company_name' => $this->input->post('company_name'),
				'contact_no'   => $this->input->post('contact_no'),
				'email'        => $this->input->post('email'),
				'address'      => $this->input->post('address'),
				'status'           => $this->input->post('status'),
				'license_registration_no' => $this->input->post('license_registration_no'),
				'website' => $this->input->post('website')
			];

			$this->InsuranceCompany_model->update_company($company_id, $data);

			$this->session->set_flashdata('success', 'Insurance company updated!');
			redirect('insurancecompany/list');
		}	
		else {

			$data['company'] = $this->InsuranceCompany_model
                                ->get($company_id);
			$data['main_content'] = 'insurance/company_edit_form';

			$this->load->view(
				'includes/template',
				$data
			);
		}
	}

	public function view($company_id)
	{
		$company = $this->InsuranceCompany_model
			->get($company_id);

		if (!$company) {

			$this->session->set_flashdata(
				'error',
				'Insurance Company not found.'
			);

			redirect('insurancecompany/list');
			return;
		}

		$data['title'] = 'View Insurance Company';
		$data['company'] = $company;

		$data['main_content'] = 'insurance/company_view';
		$this->load->view('includes/template', $data);
	}

	public function delete($company_id)
	{
		$this->InsuranceCompany_model->delete_company($company_id);
		$this->session->set_flashdata('success', 'Company deleted!');
		redirect('insurancecompany/list');
	}
}

