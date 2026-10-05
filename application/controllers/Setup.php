<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setup extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		//  $this->is_logged_in();
		$this->load->model('Setup_model');
	}
	// ================================users =============================
	public function list_users()
	{
		// $user = $this->session->userdata('user_id');
		// if (!has_view_access($user, 'Setup/list_users')) {
		// 	$data['title'] = 'Access Denied';
		// 	$data['main_content'] = 'errors/access_control.php';
		// } else {
		$data['title'] = 'Users List';
		$data['users'] = $this->Setup_model->get_all_users();
		$data['main_content'] = 'users/list_users.php';
		// }

		$this->load->view('includes/template', $data);
	}
	public function add_user()
	{
		$this->load->model('Admin_model');
		$this->load->model('Branch_model');
		$is_super = is_super_admin();
		$current_company_id = get_current_company_id();

		$data['title'] = 'Add New User';
		$data['is_super_admin'] = $is_super;

		if ($is_super) {
			$data['companies'] = $this->Admin_model->get_company_master_list();
			$data['branches'] = $this->Branch_model->get_all();
			$data['selected_company_id'] = $current_company_id;
		} else {
			$data['companies'] = $this->db->where('company_id', $current_company_id)->get('company_master')->result();
			$data['branches'] = get_user_allowed_branches();
			$data['selected_company_id'] = $current_company_id;
		}

		$data['main_content'] = 'users/add_user.php';
		$this->load->view('includes/template', $data);
	}

	public function add_user_data()
	{
		$is_super = is_super_admin();
		$company_id = $is_super ? (int) $this->input->post('company_id') : (int) get_current_company_id();
		$branch_id = (int) $this->input->post('branch_id');
		if (!$this->can_assign_user_branch($branch_id, $company_id)) {
			$this->session->set_flashdata('error', 'Access denied: You can only assign users to branches you are permitted to manage.');
			redirect('Setup/list_users');
			return;
		}

		$_POST['company_id'] = $company_id;
		if (!$is_super) {
			// Non-super admin cannot create Super Admin users
			if (in_array(strtolower(trim((string)($_POST['role'] ?? ''))), ['super admin', 'superadmin', 'super_admin'], true)) {
				$_POST['role'] = 'Admin';
			}
		}

		$result = $this->Setup_model->add_user_data();

		if ($result) {
			$this->session->set_flashdata('success', 'User added successfully.');
		} else {
			$this->session->set_flashdata('error', 'Failed to add user.');
		}
		redirect('Setup/list_users');
	}

	public function edit_user()
	{
		$this->load->model('Admin_model');
		$this->load->model('Branch_model');
		$data['title'] = 'Edit User';
		$user_id = $this->uri->segment('3');
		$user = $this->Setup_model->get_user_by_id($user_id);
		if (!$user) {
			$this->session->set_flashdata('error', 'User not found.');
			redirect('Setup/list_users');
			return;
		}

		$is_super = is_super_admin();
		$current_company_id = get_current_company_id();

		if (!$is_super) {
			if (!$this->can_manage_user($user)) {
				$this->session->set_flashdata('error', 'Access denied: You can only edit users in your permitted company branches.');
				redirect('Setup/list_users');
				return;
			}
			$data['companies'] = $this->db->where('company_id', $current_company_id)->get('company_master')->result();
			$data['branches'] = get_user_allowed_branches();
			$data['selected_company_id'] = $current_company_id;
		} else {
			$data['companies'] = $this->Admin_model->get_company_master_list();
			$data['branches'] = $this->Branch_model->get_all();
			$data['selected_company_id'] = !empty($user['company_id']) ? (int) $user['company_id'] : $current_company_id;
		}

		$data['user'] = $user;
		$data['is_super_admin'] = $is_super;

		$data['main_content'] = 'users/edit_user.php';
		$this->load->view('includes/template', $data);
	}

	public function edit_user_data()
	{
		$user_id = (int) $this->input->post('user_id');
		$is_super = is_super_admin();
		$target = $this->Setup_model->get_user_by_id($user_id);

		if (!$is_super) {
			if (!$this->can_manage_user($target)) {
				$this->session->set_flashdata('error', 'Access denied: You can only edit users in your permitted company branches.');
				redirect('Setup/list_users');
				return;
			}
			$_POST['company_id'] = get_current_company_id();
			if (in_array(strtolower(trim((string)($_POST['role'] ?? ''))), ['super admin', 'superadmin', 'super_admin'], true)) {
				$_POST['role'] = $target['role'] !== 'Super Admin' ? $target['role'] : 'Admin';
			}
		}
		$company_id = $is_super ? (int) $this->input->post('company_id') : (int) get_current_company_id();
		if (!$this->can_assign_user_branch((int) $this->input->post('branch_id'), $company_id)) {
			$this->session->set_flashdata('error', 'Access denied: You can only assign users to branches you are permitted to manage.');
			redirect('Setup/list_users');
			return;
		}
		$_POST['company_id'] = $company_id;

		$result = $this->Setup_model->edit_user_data();

		if ($result) {
			$this->session->set_flashdata('success', 'User updated successfully.');
		} else {
			$this->session->set_flashdata('error', 'Failed to update user.');
		}
		redirect('Setup/list_users');
	}

	public function delete_user($id)
	{
		if (empty($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Invalid user ID.');
			return redirect('Setup/list_users');
		}

		$this->load->model('Setup_model');
		$target = $this->Setup_model->get_user_by_id($id);

		if (!is_super_admin()) {
			if (!$this->can_manage_user($target)) {
				$this->session->set_flashdata('error', 'Access denied: You can only delete users in your permitted company branches.');
				return redirect('Setup/list_users');
			}
		}

		if (is_super_admin($id) && (int)$id === 6) {
			$this->session->set_flashdata('error', 'Primary Super Admin account cannot be deleted.');
			return redirect('Setup/list_users');
		}

		$deleted = $this->Setup_model->delete_user($id);

		if ($deleted) {
			$this->session->set_flashdata('success', 'User deleted successfully.');
		} else {
			$this->session->set_flashdata('error', 'Failed to delete user.');
		}

		return redirect('Setup/list_users');
	}

	private function can_manage_user($user)
	{
		if (!$user || (int) $user['company_id'] !== (int) get_current_company_id() || is_super_admin($user['id'])) {
			return false;
		}

		$allowed_branches = get_user_allowed_branches();
		$allowed_ids = array_map(function ($branch) {
			return (int) $branch->branch_id;
		}, $allowed_branches);
		if (empty($allowed_ids)) {
			return false;
		}

		$user_branch_ids = [];
		$primary_branch = $this->db
			->select('branch_id')
			->where('branch_id', (int) ($user['branch_id'] ?? 0))
			->where('company_id', (int) get_current_company_id())
			->get('branches')
			->row();
		if ($primary_branch) {
			$user_branch_ids[] = (int) $primary_branch->branch_id;
		}

		$assigned_branches = $this->db
			->select('uba.branch_id')
			->from('user_branch_access uba')
			->join('branches b', 'b.branch_id = uba.branch_id')
			->where('uba.user_id', (int) $user['id'])
			->where('b.company_id', (int) get_current_company_id())
			->get()
			->result_array();
		$user_branch_ids = array_merge($user_branch_ids, array_map('intval', array_column($assigned_branches, 'branch_id')));

		return !empty(array_intersect($allowed_ids, $user_branch_ids));
	}

	private function can_assign_user_branch($branch_id, $company_id)
	{
		$branch = $this->db
			->select('branch_id')
			->where('branch_id', (int) $branch_id)
			->where('company_id', (int) $company_id)
			->where('is_active', 1)
			->get('branches')
			->row();
		if (!$branch) {
			return false;
		}

		if (is_super_admin()) {
			return true;
		}

		$allowed_ids = array_map(function ($allowed_branch) {
			return (int) $allowed_branch->branch_id;
		}, get_user_allowed_branches());
		return in_array((int) $branch_id, $allowed_ids, true)
			&& (int) $company_id === (int) get_current_company_id();
	}

	public function service_reminder_settings()
	{
		redirect('ServiceReminder/settings');
	}
	// ================================ users =============================


}

