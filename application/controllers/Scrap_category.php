<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scrap_category extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Scrap_category_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['categories'] = $this->Scrap_category_model->get_all_with_stock();
        $data['title'] = 'Scrap Categories';
        $data['main_content'] = 'scrap_category/list';
        $this->load->view('includes/template', $data);
    }

    public function list()
    {
        $this->index();
    }

    public function add()
    {
        $data['title'] = 'Add Scrap Category';
        $data['category'] = null;
        $data['scrap_units'] = $this->Scrap_category_model->get_active_scrap_units();   
        $data['main_content'] = 'scrap_category/form';
        $this->load->view('includes/template', $data);
    }

    public function edit($id)
    {
        $data['category'] = $this->Scrap_category_model->get($id);
        if (!$data['category']) {
            $this->session->set_flashdata('error', 'Scrap category not found.');
            redirect('scrap_category');
        }

        $data['title'] = 'Edit Scrap Category';
        $data['scrap_units'] = $this->Scrap_category_model->get_active_scrap_units();
        $data['main_content'] = 'scrap_category/form';
        $this->load->view('includes/template', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('category_name', 'Category Name', 'required');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        // $this->form_validation->set_rules('default_rate', 'Default Rate', 'required|numeric');
        $this->form_validation->set_rules('is_active', 'Status', 'required');

        $id = $this->input->post('id');

        if ($this->form_validation->run() === false) {
            $data['title'] = $id ? 'Edit Scrap Category' : 'Add Scrap Category';
            $data['category'] = (object) $this->input->post();
            $data['scrap_units'] = $this->Scrap_category_model->get_active_scrap_units();
            $data['main_content'] = 'scrap_category/form';
            $this->load->view('includes/template', $data);
            return;
        }

        $record = [
            'category_name' => $this->input->post('category_name'),
            'unit' => $this->input->post('unit'),
            'default_rate' => $this->input->post('default_rate'),
            'description' => $this->input->post('description'),
            'is_active' => $this->input->post('is_active'),
        ];

        if ($id) {
            $this->Scrap_category_model->update($id, $record);
            $this->session->set_flashdata('success', 'Scrap category updated.');
        } else {
            $this->Scrap_category_model->insert($record);
            $this->session->set_flashdata('success', 'Scrap category created.');
        }

        redirect('scrap_category');
    }

    public function unit_search()
    {
        $term = $this->input->get('q');
        $units = $this->Scrap_category_model->search_active_scrap_units($term);

        $results = array_map(function ($unit) {
            return [
                'id' => $unit->unit_abbr,
                'text' => sprintf('%s (%s)', $unit->unit_name, $unit->unit_abbr),
            ];
        }, $units);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['results' => $results]));
    }

    public function add_unit_ajax()
    {
        $unit_name = trim($this->input->post('unit_name'));
        $unit_abbr = trim($this->input->post('unit_abbr'));

        if (!$unit_name || !$unit_abbr) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => false, 'message' => 'Unit name and abbreviation are required.']));
        }

        $existing = $this->Scrap_category_model->get_scrap_unit_by_name_abbr($unit_name, $unit_abbr);
        if ($existing) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => true,
                    'id' => $existing->unit_abbr,
                    'text' => sprintf('%s (%s)', $existing->unit_name, $existing->unit_abbr),
                ]));
        }

        $insert_id = $this->Scrap_category_model->insert_scrap_unit($unit_name, $unit_abbr);
        if ($insert_id) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'success' => true,
                    'id' => $unit_abbr,
                    'text' => sprintf('%s (%s)', $unit_name, $unit_abbr),
                ]));
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['success' => false, 'message' => 'Unable to save unit.']));
    }

    public function delete($id)
    {
        $category = $this->Scrap_category_model->get($id);
        if (!$category) {
            $this->session->set_flashdata('error', 'Scrap category not found.');
            redirect('scrap_category');
        }

        if ($this->Scrap_category_model->is_used($id)) {
            $this->session->set_flashdata('error', 'Cannot delete scrap category because it is used in scrap collection or sales records.');
            redirect('scrap_category');
        }

        $this->Scrap_category_model->delete($id);
        $this->session->set_flashdata('success', 'Scrap category deleted.');
        redirect('scrap_category');
    }
}

