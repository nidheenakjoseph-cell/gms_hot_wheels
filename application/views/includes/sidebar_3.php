<style>
	/* Main menu (parent items) */
	.sidebar nav .has-submenu>a {
		font-weight: 600;
		/* Bold */
		font-size: 0.9rem;
		/* One size smaller */
		/* font-weight: 600;          
    font-size: 1rem;             */
		color: #1f2937;
		/* Gray-800 */
		padding: 10px 16px;
		display: block;
		background-color: #f9fafb;
		/* subtle background */
		border-radius: 6px;
		margin: 4px 0;
	}

	/* Hover effect for parent menu */
	.sidebar nav .has-submenu>a:hover {
		background-color: #e5e7eb;
		/* Gray-200 */
	}

	.sidebar nav .has-submenu.open>a,
	.sidebar nav .submenu a.active {
		background-color: #dbeafe;
		color: #1d4ed8;
		font-weight: 700;
	}

	.sidebar nav .submenu a.active {
		border-left: 3px solid #2563eb;
		padding-left: 9px;
	}

	/* Submenu container */
	.sidebar nav .submenu {
		padding-left: 18px;
		margin-top: 2px;
	}

	/* Submenu items */
	.sidebar nav .submenu a {
		font-size: 0.875rem;
		/* Smaller font */
		font-weight: 400;
		/* Normal weight */
		color: #4b5563;
		/* Gray-600 */
		padding: 6px 12px;
		display: block;
		border-radius: 4px;
	}

	/* Submenu hover */
	.sidebar nav .submenu a:hover {
		background-color: #f3f4f6;
		/* Gray-100 */
		color: #111827;
		/* Dark */
	}

	/* Dashboard link styling */
	.sidebar nav>a.active {
		font-weight: 700;
		background-color: #2563eb;
		/* Blue-600 */
		color: white;
		padding: 10px 16px;
		border-radius: 6px;
		margin-bottom: 8px;
	}
</style>

<!-- =============================================== -->
<aside id="sidebar" class="sidebar flex flex-col">
	<div class="brand flex items-center gap-3 px-4 py-3">
		<?php $company_profile = get_current_company_details(); ?>
		<img src="<?= htmlspecialchars(get_current_company_logo_url('public/images/logoauto1.png', $company_profile), ENT_QUOTES, 'UTF-8') ?>"
			alt="<?= htmlspecialchars($company_profile->company_name ?? 'GMS Logo', ENT_QUOTES, 'UTF-8') ?>"
			class="w-auto">
		<?php if (!empty($company_profile->company_name)): ?>
			<span class="min-w-0 truncate font-semibold"><?= htmlspecialchars($company_profile->company_name, ENT_QUOTES, 'UTF-8') ?></span>
		<?php endif; ?>

	</div>


	<nav>
		<!-- 🧭 Fixed Dashboard Link -->
		<?php $current_route = strtolower(trim($this->uri->uri_string(), '/')); ?>
		<a href="<?php echo base_url('index.php/Dashboard'); ?>"
			class="<?php echo ($current_route === '' || $current_route === 'dashboard') ? 'active' : ''; ?>">Dashboard</a>
		<?php
		// ✅ Get user ID from session
		$user_id = $this->session->userdata('user_id');

		// ✅ Fetch menus user can access
		$this->db->select('m.*');
		$this->db->from('menus m');
		$this->db->join('user_menu_access uma', 'uma.menu_id = m.menu_id');
		$this->db->where('uma.user_id', $user_id);
		$this->db->where('m.is_active', 1);
		$this->db->order_by('m.sort_order', 'ASC');
		$menus = $this->db->get()->result();

		// ✅ Build parent → child tree
		$menu_tree = [];
		foreach ($menus as $menu) {
			$menu_tree[$menu->parent_id][] = $menu;
		}

		function sidebar_menu_has_active($tree, $parent_id, $current_route)
		{
			if (!isset($tree[$parent_id])) return false;

			foreach ($tree[$parent_id] as $menu) {
				$menu_route = strtolower(trim((string) $menu->menu_url, '/'));
				if ($menu_route !== '' && $current_route === $menu_route) return true;
				if (sidebar_menu_has_active($tree, $menu->menu_id, $current_route)) return true;
			}

			return false;
		}

		// ✅ Recursive renderer (keeps your HTML layout)
		function render_sidebar_menu($tree, $parent_id = 0, $current_route = '')
		{
			if (!isset($tree[$parent_id])) return;

			foreach ($tree[$parent_id] as $menu) {
				$has_sub = isset($tree[$menu->menu_id]);
				$url = $menu->menu_url ? base_url('index.php/' . $menu->menu_url) : '#';
				$menu_route = strtolower(trim((string) $menu->menu_url, '/'));
				$is_current = $menu_route !== '' && ($current_route === $menu_route);

				if ($has_sub) {
					$is_open = $is_current || sidebar_menu_has_active($tree, $menu->menu_id, $current_route);
					echo '<div class="has-submenu' . ($is_open ? ' menu-open' : '') . '">';
					echo '<a href="' . $url . '" class="' . ($is_open ? 'active' : '') . '">' . htmlspecialchars($menu->menu_name) . ' </a>';
					echo '<div class="submenu">';
					render_sidebar_menu($tree, $menu->menu_id, $current_route);
					echo '</div></div>';
				} else {
					echo '<a href="' . $url . '" class="' . ($is_current ? 'active' : '') . '">' . htmlspecialchars($menu->menu_name) . '</a>';
				}
			}
		}




		// ✅ Render all top-level menus (parent_id = 0 or NULL)
		if (isset($menu_tree[0])) {
			render_sidebar_menu($menu_tree, 0, $current_route);
		} elseif (isset($menu_tree[null])) {
			render_sidebar_menu($menu_tree, null, $current_route);
		} else {
			echo '<p class="text-gray-500 px-4 py-2">No menus assigned.</p>';
		}
		?>
	</nav>
</aside>

<!-- Main content -->
<div class="flex-1 flex flex-col overflow-auto md:ml-[260px]">
