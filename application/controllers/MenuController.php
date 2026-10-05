<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuController extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Menu_model');
		$this->load->helper('company_helper');
	}

	private function get_current_user_accessible_menu_ids()
	{
		if (is_super_admin()) {
			return 'all';
		}

		$current_user_id = (int) $this->session->userdata('user_id');
		$user_menus = $this->db->select('menu_id')
			->where('user_id', $current_user_id)
			->where('(can_view = 1 OR can_view IS NULL)', null, false)
			->get('user_menu_access')
			->result_array();

		$assigned_ids = array_map('intval', array_column($user_menus, 'menu_id'));
		if (empty($assigned_ids)) {
			return ['assigned' => [], 'visible' => []];
		}

		// Filter to active menus only
		$active_menus = $this->db->select('menu_id, parent_id')
			->where_in('menu_id', $assigned_ids)
			->where('is_active', 1)
			->get('menus')
			->result_array();

		$active_assigned_ids = array_map('intval', array_column($active_menus, 'menu_id'));

		// Also include parent IDs for structural display if child menus are accessible
		$parent_ids = [];
		foreach ($active_menus as $m) {
			if (!empty($m['parent_id']) && (int) $m['parent_id'] > 0) {
				$parent_ids[] = (int) $m['parent_id'];
			}
		}

		$visible_ids = array_values(array_unique(array_merge($active_assigned_ids, $parent_ids)));

		return [
			'assigned' => $active_assigned_ids,
			'visible'  => $visible_ids
		];
	}

	// List all menus - restricted to Super Admin only
	public function index()
	{
		if (!is_super_admin()) {
			deny_page_access();
		}

		$data['title'] 	 = "Menu";

		$data['menu_tree'] = $this->Menu_model->get_menu_tree();
		$data['main_content'] = 'users/menu_list.php';
		$this->load->view('includes/template', $data);
	}

	// Add new menu/submenu - restricted to Super Admin only
	public function add()
	{
		if (!is_super_admin()) {
			deny_page_access();
		}

		$data['title'] 	 = "Menu";
		$data['parents'] = $this->Menu_model->get_parent_menus();
		$data['main_content'] = 'users/menu_form.php';
		$this->load->view('includes/template', $data);
	}

	// Edit existing menu - restricted to Super Admin only
	public function edit($id)
	{
		if (!is_super_admin()) {
			deny_page_access();
		}

		$data['title'] 	 = "Menu";
		$data['menu'] = $this->Menu_model->get_menu($id);
		$data['parents'] = $this->Menu_model->get_parent_menus();
		$data['main_content'] = 'users/menu_form.php';
		$this->load->view('includes/template', $data);
	}

	// Save new or updated menu - restricted to Super Admin only
	public function save()
	{
		if (!is_super_admin()) {
			deny_page_access();
		}

		$menu_id = $this->input->post('menu_id');
		$menu = [
			'menu_name' => $this->input->post('menu_name'),
			'menu_url'  => $this->input->post('menu_url'),
			'parent_id' => $this->input->post('parent_id') ?: NULL,
			'is_active' => $this->input->post('is_active') ? 1 : 0
		];

		// auto-sort if empty
		if (empty($this->input->post('sort_order'))) {
			$parent_id = $menu['parent_id'];
			$max_order = $this->db->select_max('sort_order')
				->where('parent_id', $parent_id)
				->get('menus')->row()->sort_order ?? 0;
			$menu['sort_order'] = $max_order + 1;
		} else {
			$menu['sort_order'] = $this->input->post('sort_order');
		}

		$this->Menu_model->save_menu($menu, $menu_id);
		redirect('MenuController/index');
	}

	// Delete a menu - restricted to Super Admin only
	public function delete($id)
	{
		if (!is_super_admin()) {
			deny_page_access();
		}

		$this->db->where('menu_id', $id)->delete('menus');
		redirect('MenuController/index');
	}

	public function deactivate($id)
	{
		if (!is_super_admin()) {
			deny_page_access();
		}

		$this->db->where('menu_id', $id)->update('menus', ['is_active' => 0]);
		redirect('MenuController/index');
	}

	public function reactivate($id)
	{
		if (!is_super_admin()) {
			deny_page_access();
		}

		$this->db->where('menu_id', $id)->update('menus', ['is_active' => 1]);
		redirect('MenuController/index');
	}

	public function access_control()
	{
		$data['title'] 	 = "User Access Control";
		$is_super = is_super_admin();
		$current_company_id = get_current_company_id();

		$this->db->select('u.*, cm.company_name, cm.company_code, b.branch_name, b.branch_code');
		$this->db->from('users u');
		$this->db->join('company_master cm', 'cm.company_id = u.company_id', 'left');
		$this->db->join('branches b', 'b.branch_id = u.branch_id', 'left');

		if (!$is_super) {
			// Limit to users within the logged-in user's company
			$this->db->where('u.company_id', $current_company_id);
			// Do not allow managing super admin accounts
			$this->db->where('u.id !=', 6);
			$this->db->where_not_in('LOWER(TRIM(u.role))', ['super admin', 'superadmin', 'super_admin']);

			// Also apply branch filter if user is restricted to certain branches
			$allowed_branch_ids = get_selected_branch_ids();
			if ($allowed_branch_ids !== 'all' && is_array($allowed_branch_ids) && !empty($allowed_branch_ids)) {
				$this->db->where_in('u.branch_id', $allowed_branch_ids);
			}
		}

		$this->db->order_by('u.company_id ASC, u.first_name ASC, u.username ASC');
		$data['users'] = $this->db->get()->result();

		if ($is_super) {
			$data['menus'] = $this->db->order_by('sort_order')->get('menus')->result();
		} else {
			$accessible = $this->get_current_user_accessible_menu_ids();
			if (!empty($accessible['visible'])) {
				$data['menus'] = $this->db->where_in('menu_id', $accessible['visible'])
					->where('is_active', 1)
					->order_by('sort_order')
					->get('menus')
					->result();
			} else {
				$data['menus'] = [];
			}
		}
		$data['is_super_admin'] = $is_super;

		$comp_row = $this->db->where('company_id', $current_company_id)->get('company_master')->row();
		$data['company_name'] = $comp_row ? $comp_row->company_name : 'Current Company';

		$data['main_content'] = 'users/menu_access.php';
		$this->load->view('includes/template', $data);
	}

	public function get_user_access($user_id)
	{
		$user_id = (int) $user_id;
		$is_super = is_super_admin();
		$current_company_id = get_current_company_id();

		$user = $this->db->select('u.*, cm.company_name')
			->from('users u')
			->join('company_master cm', 'cm.company_id = u.company_id', 'left')
			->where('u.id', $user_id)
			->get()
			->row();

		if (!$user) {
			$this->output->set_status_header(404);
			echo json_encode(['error' => 'User not found']);
			return;
		}

		// Security: Non-super admin can only manage users within their company
		if (!$is_super) {
			if ((int)$user->company_id !== (int)$current_company_id || is_super_admin($user->id)) {
				$this->output->set_status_header(403);
				echo json_encode(['error' => 'Access denied: You can only view and manage users within your company.']);
				return;
			}
		}

		// Fetch menus according to user role:
		// Super Admin sees all system menus; other users only see the menus they have access to.
		$accessible = $this->get_current_user_accessible_menu_ids();
		if ($is_super) {
			$menus = $this->db->order_by('sort_order')->get('menus')->result();
		} else {
			if (!empty($accessible['visible'])) {
				$menus = $this->db->where_in('menu_id', $accessible['visible'])
					->where('is_active', 1)
					->order_by('sort_order')
					->get('menus')
					->result();
			} else {
				$menus = [];
			}
		}

		$user_access = $this->db->where('user_id', $user_id)
			->get('user_menu_access')
			->result_array();
		$access_ids = array_map('intval', array_column($user_access, 'menu_id'));

		$user_company_id = ((int)$user->company_id > 0) ? (int)$user->company_id : resolve_company_id($user_id);

		// If target user is super admin, allow all active branches; otherwise scope to their company
		if (is_super_admin($user_id)) {
			$branches = $this->db->where('is_active', 1)
				->order_by('company_id ASC, is_main_branch DESC, branch_name ASC')
				->get('branches')
				->result();
		} else {
			$branches_qb = $this->db->where('company_id', $user_company_id)
				->where('is_active', 1);

			// If current admin has specific branch limits within their company
			if (!$is_super) {
				$my_branches = get_selected_branch_ids();
				if ($my_branches !== 'all' && is_array($my_branches) && !empty($my_branches)) {
					$branches_qb->where_in('branch_id', $my_branches);
				} else {
					$allowed_branches_obj = get_user_allowed_branches();
					if (!empty($allowed_branches_obj)) {
						$branch_ids_list = array_map(function($b) { return (int)$b->branch_id; }, $allowed_branches_obj);
						$branches_qb->where_in('branch_id', $branch_ids_list);
					}
				}
			}

			$branches = $branches_qb->order_by('is_main_branch DESC, branch_name ASC')
				->get('branches')
				->result();
		}

		$has_explicit_branch_access = $this->db->where('user_id', $user_id)->count_all_results('user_branch_access') > 0;
		if ($has_explicit_branch_access) {
			$user_branch_access = $this->db->where('user_id', $user_id)
				->get('user_branch_access')
				->result_array();
			$allowed_branch_ids = array_map('intval', array_column($branches, 'branch_id'));
			$branch_access_ids = array_values(array_intersect(
				array_map('intval', array_column($user_branch_access, 'branch_id')),
				$allowed_branch_ids
			));
		} else {
			// Default unconfigured users to all active branches in their company
			$branch_access_ids = array_map('intval', array_column($branches, 'branch_id'));
		}

		$html = '<ul class="space-y-2">';
		if (empty($menus)) {
			$html .= '<li class="text-gray-500 italic p-2">No accessible menu items available to assign.</li>';
		} else {
			foreach ($menus as $m) {
				if (empty($m->parent_id)) {
					// Submenus for this parent
					$subs = array_filter($menus, fn($sm) => (int)$sm->parent_id === (int)$m->menu_id);

					// If non-super admin and this parent has no accessible submenus and the admin does not have direct access to the parent itself, skip it
					if (!$is_super && empty($subs) && !in_array((int)$m->menu_id, $accessible['assigned'], true)) {
						continue;
					}

					$checked = in_array((int)$m->menu_id, $access_ids, true) ? 'checked' : '';
					$html .= '<li><label class="font-semibold cursor-pointer flex items-center gap-2">
	                        <input type="checkbox" class="menu-checkbox parent-menu rounded text-blue-600 focus:ring-blue-500" data-id="' . $m->menu_id . '" value="' . $m->menu_id . '" ' . $checked . '> ' . htmlspecialchars($m->menu_name) . '
	                      </label>';

					if ($subs) {
						$html .= '<ul class="pl-6 mt-2 space-y-1 border-l border-gray-200 ml-2">';
						foreach ($subs as $sm) {
							$checked = in_array((int)$sm->menu_id, $access_ids, true) ? 'checked' : '';
							$html .= '<li><label class="cursor-pointer flex items-center gap-2 text-gray-700">
	                                <input type="checkbox" class="menu-checkbox submenu rounded text-blue-600 focus:ring-blue-500" data-parent="' . $m->menu_id . '" value="' . $sm->menu_id . '" ' . $checked . '> ' . htmlspecialchars($sm->menu_name) . '
	                              </label></li>';
						}
						$html .= '</ul>';
					}

					$html .= '</li>';
				}
			}
		}
		$html .= '</ul>';

		header('Content-Type: application/json');
		echo json_encode([
			'menu_html'   => $html,
			'branch_ids'  => $branch_access_ids,
			'branches'    => $branches
		]);
	}

	public function save_user_access()
	{
		// Accept either JSON body or regular form POST
		$raw = $this->input->raw_input_stream;
		$data = json_decode($raw, true);
		if (!is_array($data)) {
			// fallback to form-encoded POST
			$data = [
				'user_id'   => $this->input->post('user_id'),
				'menu_ids'  => $this->input->post('menu_ids') ?: [],
				'branch_ids'=> $this->input->post('branch_ids') ?: []
			];
		}

		$user_id = isset($data['user_id']) ? (int) $data['user_id'] : null;
		$menu_ids = isset($data['menu_ids']) && is_array($data['menu_ids']) ? array_map('intval', $data['menu_ids']) : [];
		$branch_ids = isset($data['branch_ids']) && is_array($data['branch_ids']) ? array_map('intval', $data['branch_ids']) : [];

		// Remove duplicate IDs to avoid unique key conflicts
		$menu_ids = array_values(array_unique($menu_ids));
		$branch_ids = array_values(array_unique($branch_ids));

		$this->output->set_content_type('application/json');

		if (empty($user_id)) {
			$this->output->set_status_header(400);
			echo json_encode(['status' => 'error', 'message' => 'Missing user_id']);
			return;
		}

		// Security check: non-super admin can only save users within their company
		$is_super = is_super_admin();
		$current_company_id = get_current_company_id();

		$target_user = $this->db->where('id', $user_id)->get('users')->row();
		if (!$target_user) {
			$this->output->set_status_header(404);
			echo json_encode(['status' => 'error', 'message' => 'User not found']);
			return;
		}

		if (!$is_super) {
			if ((int)$target_user->company_id !== (int)$current_company_id || is_super_admin($target_user->id)) {
				$this->output->set_status_header(403);
				echo json_encode(['status' => 'error', 'message' => 'Access denied: You can only manage users within your company.']);
				return;
			}
		}

		// Determine manageable menus:
		// Super Admin can manage all active menus.
		// Non-super admins can ONLY manage menus they have access to.
		$manageable_menu_ids = [];
		if ($is_super) {
			$active_menus = $this->db->select('menu_id')->where('is_active', 1)->get('menus')->result_array();
			$manageable_menu_ids = array_map('intval', array_column($active_menus, 'menu_id'));
			$menu_ids = array_values(array_intersect($menu_ids, $manageable_menu_ids));
		} else {
			$accessible = $this->get_current_user_accessible_menu_ids();
			$manageable_menu_ids = !empty($accessible['visible']) ? $accessible['visible'] : [];
			$menu_ids = array_values(array_intersect($menu_ids, $manageable_menu_ids));
		}

		// Determine manageable branches:
		// Super Admin can manage all branches across companies.
		// Non-super admins can ONLY manage branches belonging to their company and allowed to them.
		$allowed_admin_branch_ids = null;
		if (!$is_super) {
			$my_branches = get_selected_branch_ids();
			if ($my_branches !== 'all' && is_array($my_branches) && !empty($my_branches)) {
				$allowed_admin_branch_ids = array_map('intval', $my_branches);
			} else {
				$allowed_branches_obj = get_user_allowed_branches();
				if (!empty($allowed_branches_obj)) {
					$allowed_admin_branch_ids = array_map(function($b) { return (int)$b->branch_id; }, $allowed_branches_obj);
				}
			}
		}

		if (!empty($branch_ids)) {
			$branches_query = $this->db->select('branch_id')
				->where('is_active', 1)
				->where_in('branch_id', $branch_ids);
			if (!$is_super) {
				$branches_query->where('company_id', $current_company_id);
				if (!empty($allowed_admin_branch_ids)) {
					$branches_query->where_in('branch_id', $allowed_admin_branch_ids);
				}
			}
			$valid_branch_ids = array_map('intval', array_column(
				$branches_query->get('branches')->result_array(),
				'branch_id'
			));
			$branch_ids = array_values(array_intersect($branch_ids, $valid_branch_ids));
		}

		if (empty($branch_ids)) {
			$this->output->set_status_header(400);
			echo json_encode(['status' => 'error', 'message' => 'Select at least one active branch before saving access.']);
			return;
		}

		// Ensure parent menus of selected submenus are included for proper navigation rendering
		if (!empty($menu_ids)) {
			$parents_to_add = $this->db->select('parent_id')
				->where_in('menu_id', $menu_ids)
				->where('parent_id IS NOT NULL', null, false)
				->where('parent_id >', 0)
				->get('menus')
				->result_array();
			foreach ($parents_to_add as $p) {
				if (!empty($p['parent_id'])) {
					$p_id = (int) $p['parent_id'];
					if ($is_super || in_array($p_id, $manageable_menu_ids, true)) {
						$menu_ids[] = $p_id;
					}
				}
			}
			$menu_ids = array_values(array_unique($menu_ids));
		}

		// Use a transaction to ensure atomicity
		$this->db->trans_begin();
		try {
			// Super admin replaces all menu access.
			// Non-super admins only replace menu access within the menus they have permission to manage.
			if ($is_super) {
				$this->db->where('user_id', $user_id)->delete('user_menu_access');
			} elseif (!empty($manageable_menu_ids)) {
				$this->db->where('user_id', $user_id)
					->where_in('menu_id', $manageable_menu_ids)
					->delete('user_menu_access');
			}
			$deleted_menu_count = $this->db->affected_rows();
			$inserted_menu_count = 0;
			foreach ($menu_ids as $mid) {
				$this->db->query(
					"INSERT IGNORE INTO user_menu_access (`user_id`,`menu_id`,`can_view`) VALUES (?, ?, 1)",
					[$user_id, (int) $mid]
				);
				$inserted_menu_count += $this->db->affected_rows();
			}

			// Delete existing branch access within allowed scope and insert the new set
			if ($is_super) {
				$this->db->where('user_id', $user_id)->delete('user_branch_access');
			} else {
				$del_branch_qb = $this->db->where('user_id', $user_id);
				if (!empty($allowed_admin_branch_ids)) {
					$del_branch_qb->where_in('branch_id', $allowed_admin_branch_ids);
				}
				$del_branch_qb->delete('user_branch_access');
			}
			$deleted_branch_count = $this->db->affected_rows();
			$inserted_branch_count = 0;

			foreach ($branch_ids as $bid) {
				$this->db->query(
					"INSERT IGNORE INTO user_branch_access (`user_id`,`branch_id`) VALUES (?, ?)",
					[$user_id, (int) $bid]
				);
				$inserted_branch_count += $this->db->affected_rows();
			}

			if ($user_id === (int) $this->session->userdata('user_id')) {
				$this->session->set_userdata('selected_branch_ids', 'all');
			}

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->output->set_status_header(500);
				echo json_encode(['status' => 'error', 'message' => 'Database error saving access']);
				return;
			}
			$this->db->trans_commit();

			echo json_encode([
				'status' => 'success',
				'message' => 'Access rights saved successfully!',
				'deleted_menu_count' => $deleted_menu_count ?? 0,
				'inserted_menu_count' => $inserted_menu_count ?? 0,
				'deleted_branch_count' => $deleted_branch_count ?? 0,
				'inserted_branch_count' => $inserted_branch_count ?? 0
			]);
		} catch (Exception $e) {
			$this->db->trans_rollback();
			$this->output->set_status_header(500);
			echo json_encode(['status' => 'error', 'message' => 'Exception: ' . $e->getMessage()]);
		}
	}
}

