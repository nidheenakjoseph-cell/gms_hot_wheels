<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Branches extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Branch_model');
        $this->load->helper(array('form', 'url', 'branch_helper'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->list();
    }

    public function list()
    {
        $data['title'] = 'Branch Master';
        $data['branches'] = $this->Branch_model->get_all();
        $data['main_content'] = 'branches/list';
        $this->load->view('includes/template', $data);
    }

    public function add()
    {
        $this->load->model('Admin_model');
        $data['title'] = 'Add New Branch';
        $data['branch'] = null;
        $data['companies'] = $this->Admin_model->get_company_master_list();
        $data['selected_company_id'] = (int) ($this->input->get('company_id') ?: get_current_company_id());
        $data['auto_code'] = $this->Branch_model->generate_branch_code();
        $data['main_content'] = 'branches/form';
        $this->load->view('includes/template', $data);
    }

    public function edit($branch_id)
    {
        $branch = $this->Branch_model->get($branch_id);
        if (!$branch) {
            $this->session->set_flashdata('error', 'Branch record not found.');
            redirect('branches');
        }

        $this->load->model('Admin_model');
        $data['title'] = 'Edit Branch : ' . $branch->branch_name;
        $data['branch'] = $branch;
        $data['companies'] = $this->Admin_model->get_company_master_list();
        $data['selected_company_id'] = (int) $branch->company_id;
        $data['auto_code'] = $branch->branch_code;
        $data['main_content'] = 'branches/form';
        $this->load->view('includes/template', $data);
    }

    public function save()
    {
        $branch_id = $this->input->post('branch_id');
        $branch_code = trim($this->input->post('branch_code'));
        $branch_name = trim($this->input->post('branch_name'));
        $company_id = (int) $this->input->post('company_id');

        $this->form_validation->set_rules('company_id', 'Company', 'required|numeric');
        $this->form_validation->set_rules('branch_name', 'Branch Name', 'required|trim');
        $this->form_validation->set_rules('branch_code', 'Branch Code', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            if ($branch_id) {
                $this->edit($branch_id);
            } else {
                $this->add();
            }
            return;
        }

        if ($company_id <= 0) {
            $company_id = get_current_company_id();
        }

        $saveData = [
            'company_id'     => $company_id,
            'branch_code'    => $branch_code,
            'branch_name'    => $branch_name,
            'phone'          => trim($this->input->post('phone')),
            'email'          => trim($this->input->post('email')),
            'address'        => trim($this->input->post('address')),
            'trn_no'         => trim($this->input->post('trn_no')),
            'is_active'      => $this->input->post('is_active') ? 1 : 0,
            'is_main_branch' => $this->input->post('is_main_branch') ? 1 : 0,
        ];

        if ($branch_id) {
            $this->Branch_model->update($branch_id, $saveData);
            $this->session->set_flashdata('success', 'Branch successfully updated.');
        } else {
            $saveData['created_by'] = $this->session->userdata('user_id');
            $new_branch_id = $this->Branch_model->insert($saveData);
            if ($new_branch_id && $this->session->userdata('user_id')) {
                $this->db->query(
                    "INSERT IGNORE INTO user_branch_access (`user_id`, `branch_id`) VALUES (?, ?)",
                    [(int) $this->session->userdata('user_id'), (int) $new_branch_id]
                );
            }
            $this->session->set_flashdata('success', 'New Branch successfully created.');
        }

        redirect('branches');
    }

    public function toggle_status($branch_id)
    {
        $branch = $this->Branch_model->get($branch_id);
        if (!$branch) {
            $this->session->set_flashdata('error', 'Branch record not found.');
            redirect('branches');
        }

        if ($branch->is_main_branch) {
            $this->session->set_flashdata('error', 'Main Branch cannot be deactivated.');
            redirect('branches');
        }

        $newStatus = $branch->is_active ? 0 : 1;
        $this->Branch_model->update($branch_id, ['is_active' => $newStatus]);
        $this->session->set_flashdata('success', 'Branch status updated.');
        redirect('branches');
    }

    /**
     * AJAX Endpoint: Switch active selected branch(es) in session
     */
    public function switch_session()
    {
        $branches = $this->input->post('branches');
        
        if (empty($branches) || $branches === 'all' || (is_array($branches) && in_array('all', $branches))) {
            $this->session->set_userdata('selected_branch_ids', 'all');
            echo json_encode(['success' => true, 'mode' => 'all']);
            return;
        }

        if (!is_array($branches)) {
            $branches = [$branches];
        }

        $clean_ids = array_values(array_filter(array_map('intval', $branches)));

        if (empty($clean_ids)) {
            $this->session->set_userdata('selected_branch_ids', 'all');
            echo json_encode(['success' => true, 'mode' => 'all']);
            return;
        }

        $this->session->set_userdata('selected_branch_ids', $clean_ids);
        echo json_encode(['success' => true, 'mode' => 'filtered', 'selected' => $clean_ids]);
    }
}

