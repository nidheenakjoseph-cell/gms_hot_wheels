<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scrap_collection extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Scrap_collection_model');
        $this->load->model('Scrap_category_model');
        $this->load->helper(array('form', 'url', 'branch_helper'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['collections'] = $this->Scrap_collection_model->get_all();
        $data['title'] = 'Scrap Collection';
        $data['main_content'] = 'scrap_collection/list';
        $this->load->view('includes/template', $data);
    }

    public function list()
    {
        $this->index();
    }

    public function add()
    {
        $data['title'] = 'Add Scrap Collection';
        $data['categories'] = $this->Scrap_category_model->get_active_categories();
        $data['collection'] = null;
        $data['main_content'] = 'scrap_collection/form';
        $this->load->view('includes/template', $data);
    }

    public function edit($id)
    {
        $data['collection'] = $this->Scrap_collection_model->get($id);
        if (!$data['collection']) {
            $this->session->set_flashdata('error', 'Collection entry not found.');
            redirect('scrap_collection');
        }

        $data['title'] = 'Edit Scrap Collection';
        $data['categories'] = $this->Scrap_category_model->get_active_categories();
        $data['main_content'] = 'scrap_collection/form';
        $this->load->view('includes/template', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('collection_date', 'Collection Date', 'required');
        $this->form_validation->set_rules('category_id', 'Scrap Category', 'required');
        // $this->form_validation->set_rules('source', 'Source', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
        $this->form_validation->set_rules('purchase_cost', 'Purchase Cost', 'numeric');

        $id = $this->input->post('id');

        if ($this->form_validation->run() === false) {
            $data['title'] = $id ? 'Edit Scrap Collection' : 'Add Scrap Collection';
            $data['categories'] = $this->Scrap_category_model->get_active_categories();
            $data['collection'] = (object) $this->input->post();
            $data['main_content'] = 'scrap_collection/form';
            $this->load->view('includes/template', $data);
            return;
        }

        $record = [
            'collection_date' => date('Y-m-d', strtotime($this->input->post('collection_date'))),
            'category_id' => $this->input->post('category_id'),
            'branch_id' => $this->input->post('branch_id') ?: get_primary_branch_id(),
            'source' => $this->input->post('source'),
            'quantity' => $this->input->post('quantity'),
            'purchase_cost' => $this->input->post('purchase_cost'),
            'remarks' => $this->input->post('remarks'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($id) {
            $this->Scrap_collection_model->update($id, $record);
            $this->session->set_flashdata('success', 'Collection entry updated.');
        } else {
            $record['created_at'] = date('Y-m-d H:i:s');
            $this->Scrap_collection_model->insert($record);
            $this->session->set_flashdata('success', 'Collection entry added.');
        }

        redirect('scrap_collection');
    }

    public function delete($id)
    {
        $this->Scrap_collection_model->delete($id);
        $this->session->set_flashdata('success', 'Collection entry deleted.');
        redirect('scrap_collection');
    }
}

