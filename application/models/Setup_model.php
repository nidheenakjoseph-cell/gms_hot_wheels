<?php
class Setup_model extends CI_Model
{
 
	public function __construct()
	{
		$this->load->helper('company_helper');
	}
	// ================================users =============================
	public function add_user_data()
	{
		$company_id = !empty($_POST['company_id']) ? (int) $_POST['company_id'] : null;
		$branch_id = !empty($_POST['branch_id']) ? (int) $_POST['branch_id'] : get_primary_branch_id();

		if (!$company_id && $branch_id) {
			$b = $this->db->select('company_id')->where('branch_id', $branch_id)->get('branches')->row();
			$company_id = $b ? (int) $b->company_id : 1;
		} elseif (!$company_id) {
			$company_id = get_current_company_id();
		}

		$data = array(
			'company_id' => $company_id,
			'first_name' => trim($_POST['first_name']),
			'last_name' => trim($_POST['last_name']),
			'email' => trim($_POST['email']),
			'username' => trim($_POST['username']),
			'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
			'role' => $_POST['role'],
			'department' => trim($_POST['department'] ?? ''),
			'contact_no' => trim($_POST['contact_number'] ?? ''),
			'status' => $_POST['status'] ?? 'Active',
			'branch_id' => $branch_id
		);
		$res = $this->db->insert('users', $data);
		$user_id = $this->db->insert_id();
		if ($user_id && $branch_id > 0) {
			$this->db->query(
				"INSERT IGNORE INTO user_branch_access (`user_id`, `branch_id`) VALUES (?, ?)",
				[$user_id, $branch_id]
			);
		}
		return $res;
	}

	public function get_all_users()
	{
		$this->db
			->select('users.*, cm.company_name, cm.company_code, b.branch_name, b.branch_code')
			->join('company_master cm', 'cm.company_id = users.company_id', 'left')
			->join('branches b', 'b.branch_id = users.branch_id', 'left');

		if (!is_super_admin()) {
			$current_company_id = get_current_company_id();
			$this->db->where('users.company_id', $current_company_id);
			$this->db->where('users.id !=', 6);
			$this->db->where_not_in('LOWER(TRIM(users.role))', ['super admin', 'superadmin', 'super_admin']);

			$permitted = get_user_allowed_branches();
			$permitted_ids = array_map(function ($branch) {
				return (int) $branch->branch_id;
			}, $permitted);
			$selected = get_selected_branch_ids();
			if (is_array($selected)) {
				$permitted_ids = array_values(array_intersect($permitted_ids, array_map('intval', $selected)));
			}
			if (empty($permitted_ids)) {
				$this->db->where('1 = 0', null, false);
			} else {
				$allowed_csv = implode(',', $permitted_ids);
				$this->db->where("(users.branch_id IN ($allowed_csv) OR users.id IN (SELECT user_id FROM user_branch_access WHERE branch_id IN ($allowed_csv)))", null, false);
			}
		}

		return $this->db
			->order_by('users.id', 'DESC')
			->get('users')
			->result();
	}

	public function get_users_for_notification($page)
	{
		$company_id = (int) get_current_company_id();

		$users = $this->db
			->distinct()
			->select('users.id AS user_id')
			->from('users')
			->join('user_menu_access uma', 'uma.user_id = users.id', 'left')
			->join('menus m', 'm.menu_id = uma.menu_id', 'left')
			->where('users.company_id', $company_id)
			->where('users.status', 'Active')
			->group_start()
				->where("LOWER(users.role) IN ('admin', 'super admin')", null, false)
				->or_group_start()
					->where('m.menu_url', $page)
					->where('uma.can_view', 1)
				->group_end()
			->group_end()
			->get()
			->result_array();

		return array_map('intval', array_column($users, 'user_id'));
	}

	public function get_super_admin_users()
	{
		$users = $this->db
			->select('id AS user_id')
			->where('company_id', (int) get_current_company_id())
			->where('status', 'Active')
			->where("LOWER(role) = 'super admin'", null, false)
			->get('users')
			->result_array();

		return array_map('intval', array_column($users, 'user_id'));
	}

	public function get_user_by_id($user_id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $user_id);
		$query = $this->db->get()->row_array();
		return $query;
	}

	public function edit_user_data()
	{
		$company_id = !empty($_POST['company_id']) ? (int) $_POST['company_id'] : null;
		$branch_id = !empty($_POST['branch_id']) ? (int) $_POST['branch_id'] : get_primary_branch_id();

		if (!$company_id && $branch_id) {
			$b = $this->db->select('company_id')->where('branch_id', $branch_id)->get('branches')->row();
			$company_id = $b ? (int) $b->company_id : 1;
		}

		$data = array(
			'first_name' => trim($_POST['first_name']),
			'last_name' => trim($_POST['last_name']),
			'email' => trim($_POST['email']),
			'username' => trim($_POST['username']),
			'role' => $_POST['role'],
			'department' => trim($_POST['department'] ?? ''),
			'contact_no' => trim($_POST['contact_number'] ?? ''),
			'status' => $_POST['status'] ?? 'Active',
			'branch_id' => $branch_id
		);

		if ($company_id > 0) {
			$data['company_id'] = $company_id;
		}

		if (!empty($_POST['password'])) {
			$data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		}

		$user_id = (int) $_POST['user_id'];
		$this->db->where('id', $user_id);
		$res = $this->db->update('users', $data);

		if ($branch_id > 0) {
			$this->db->query(
				"INSERT IGNORE INTO user_branch_access (`user_id`, `branch_id`) VALUES (?, ?)",
				[$user_id, $branch_id]
			);
		}
		return $res;
	}
	public function delete_user($id)
	{
		return $this->db->where('id', $id)
			->delete('users');
	}


	// ================================users =============================

		function get_next_code($prifix, $column, $table, $sublen)
	{

		$query = $this->db->query("select max(substr($column,$sublen,5))as count from $table where $column like '%$prifix%'");
		return $query->row('count');
	}

	public function get_active_unit_list()
	{
		$this->db->select('*');
		$this->db->from('unit_master');
		$this->db->where('active', 1);
		$query = $this->db->get()->result();
		return $query;
	}

}
