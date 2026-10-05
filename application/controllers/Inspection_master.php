<?php defined('BASEPATH') or exit('No direct script access allowed');

class Inspection_master extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Inspection_model');
	}

	// List page
	public function index()
	{
		$data['items'] = $this->Inspection_model->get_all_items();

		$data['title'] = "inspection_master List";
		$data['main_content'] = 'inspection_master/list';
		$this->load->view('includes/template', $data);
	}

	// Add item
	public function add()
	{
		if ($this->input->post()) {
			$item_name = trim($this->input->post('item_name'));
			$category = trim($this->input->post('category'));
			if ($category === '__new__') {
				$category = trim($this->input->post('new_category'));
			}

			if ($category === '') {
				$this->session->set_flashdata('error', 'Please select or enter a category.');
				redirect('inspection_master/add');
			}

			if ($this->Inspection_model->item_exists_in_category($item_name, $category)) {
				$this->session->set_flashdata('error', 'This inspection item already exists in the selected category.');
				redirect('inspection_master');
			}

			$data = [
				'item_name' => $item_name,
				'category'  => $category,
				'is_active' => $this->input->post('is_active') ? 1 : 0
			];

			$this->Inspection_model->insert_item($data);
			$this->session->set_flashdata('success', 'Record saved successfully in inspection master');
			redirect('inspection_master');
		}
		$data['categories'] = $this->Inspection_model->get_categories();
		$data['title'] = "inspection_master Add";
		$data['main_content'] = 'inspection_master/add';
		$this->load->view('includes/template', $data);
	}

	// Edit item
	public function edit($id)
	{
		if ($this->input->post()) {
			$item_name = trim($this->input->post('item_name'));
			$category = trim($this->input->post('category'));
			if ($category === '__new__') {
				$category = trim($this->input->post('new_category'));
			}

			if ($category === '') {
				$this->session->set_flashdata('error', 'Please select or enter a category.');
				redirect('inspection_master/edit/' . $id);
			}

			if ($this->Inspection_model->item_exists_in_category($item_name, $category, $id)) {
				$this->session->set_flashdata('error', 'This inspection item already exists in the selected category.');
				redirect('inspection_master');
			}

			$data = [
				'item_name' => $item_name,
				'category'  => $category,
				'is_active' => $this->input->post('is_active') ? 1 : 0
			];

			$this->Inspection_model->update_item($id, $data);

			$this->session->set_flashdata('success', 'Record updated successfully in inspection master');
			redirect('inspection_master');
		}

		$data['item'] = $this->Inspection_model->get_item($id);
		$data['categories'] = $this->Inspection_model->get_categories();

		$data['title'] = "inspection_master Edit";
		$data['main_content'] = 'inspection_master/edit';
		$this->load->view('includes/template', $data);
	}

	// Delete item
	public function delete($id)
	{
		$this->Inspection_model->delete_item($id);
		redirect('inspection_master');
	}

	// =============================================


	// List page
	public function listpackage()
	{
		$data['items'] = $this->Inspection_model->get_all_packageitems();

		$data['title'] = "inspection_Package List";
		$data['main_content'] = 'Inspection_master/list-package';
		$this->load->view('includes/template', $data);
	}

	// Add item
	public function addpackage()
	{
		if ($this->input->post()) {

			$data = [
				'package_name' => $this->input->post('item_name'),
				'created_at' => date('Y-m-d H:i:s')
			];

			$this->Inspection_model->insert_packageitem($data);
			redirect('Inspection_master/listpackage');
		}
		$data['title'] = "inspection_master Add";
		$data['main_content'] = 'Inspection_master/add-package';
		$this->load->view('includes/template', $data);
	}

	// Edit item
	public function editpackage($id)
	{
		if ($this->input->post()) {

			$data = [
				'package_name' => $this->input->post('item_name'),
				'created_at' => date('Y-m-d H:i:s')
			];

			$this->Inspection_model->update_packageitem($id, $data);

			redirect('Inspection_master/listpackage');
		}

		$data['item'] = $this->Inspection_model->get_packageitem($id);

		$data['title'] = "inspection_master Edit";
		$data['main_content'] = 'inspection_master/edit-package';
		$this->load->view('includes/template', $data);
	}

	// Delete item
	public function deletepackage($id)
	{
		$this->Inspection_model->delete_packageitem($id);
		redirect('Inspection_master/listpackage');
	}
}

