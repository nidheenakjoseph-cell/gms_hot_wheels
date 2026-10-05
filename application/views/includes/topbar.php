<?php
	if (!function_exists('get_selected_branch_ids')) {
		$this->load->helper('branch_helper');
	}
	$all_active_branches = get_user_allowed_branches();
	$selected_branch_ids = get_selected_branch_ids();

	$selected_label = 'All Branches';
	if (is_array($selected_branch_ids)) {
		if (count($selected_branch_ids) === 1) {
			foreach ($all_active_branches as $b) {
				if ((int)$b->branch_id === (int)$selected_branch_ids[0]) {
					$selected_label = $b->branch_name;
					break;
				}
			}
		} else {
			if (count($selected_branch_ids) === count($all_active_branches) && count($all_active_branches) > 1) {
				$selected_label = 'All Branches';
			} else {
				$selected_label = count($selected_branch_ids) . ' Branches Selected';
			}
		}
	}
?>
<?php

if ($selected_branch_ids === 'all') {

	$selected_label = 'All Branches';

} elseif (is_array($selected_branch_ids)) {

	$count = count($selected_branch_ids);

	if ($count === 0) {

		$selected_label = 'Select Branch';

	} elseif ($count === 1) {

		$selected_label = 'Select Branch';

		foreach ($all_active_branches as $b) {

			if (
				(int)$b->branch_id ===
				(int)$selected_branch_ids[0]
			) {
				$selected_label = $b->branch_name;
				break;
			}

		}

	} else {

		$selected_label = $count . ' Branches';

	}

} else {

	$selected_label = 'Select Branch';

}
?>



<?php if ($demo_warning = $this->session->flashdata('demo_warning')): ?>
<div id="demo-warning-alert" style="display:flex; align-items:flex-start; gap:12px; background:#fff7ed; border:1px solid #fed7aa;
 border-left:4px solid #f59e0b; padding:14px 20px; margin:0 0 0 0; font-family:'Inter',system-ui,sans-serif; font-size:14px; color:#92400e;
 box-shadow:0 2px 8px rgba(245,158,11,0.12); position:relative; z-index:9999;">
    <svg style="width:20px;height:20px;flex-shrink:0;margin-top:1px;color:#f59e0b" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M12 9v3m0 3h.01M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
    </svg>
    <div>
        <p style="font-weight:700;margin:0 0 2px">Demo Expiry Warning</p>
        <p style="margin:0;opacity:.9"><?= htmlspecialchars($demo_warning) ?></p>
    </div>
    <button onclick="document.getElementById('demo-warning-alert').style.display='none'"
        style="position:absolute;top:10px;right:14px;background:none;border:none;cursor:pointer;font-size:18px;color:#92400e;line-height:1" title="Dismiss">×</button>
</div>
<?php endif; ?>

<!-- <?php if ($error_flash = $this->session->flashdata('error')): ?>
<div role="alert" style="padding:14px 20px;background:#fef2f2;border-bottom:1px solid #fecaca;color:#7f1d1d;font-size:14px">
	<?= htmlspecialchars($error_flash) ?>
</div>
<?php endif; ?> -->

<?php if ($grn_flash = $this->session->flashdata('grn_error')): ?>
<div id="grn-error-alert" style="display:flex; align-items:flex-start; gap:12px; background:#fef2f2; border:1px solid #fecaca;
 border-left:4px solid #ef4444; padding:14px 20px; margin:0 0 0 0; font-family:'Inter',system-ui,sans-serif; font-size:14px; color:#7f1d1d;
 box-shadow:0 2px 8px rgba(239,68,68,0.12);
 position:relative; z-index:9999;">
    <svg style="width:20px;height:20px;flex-shrink:0;margin-top:1px;color:#ef4444" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
    </svg>
    <div>
        <p style="font-weight:700;margin:0 0 2px">Validation Error</p>
        <p style="margin:0;opacity:.9"><?= htmlspecialchars($grn_flash) ?></p>
    </div>
    <button onclick="document.getElementById('grn-error-alert').style.display='none'"
        style="position:absolute;top:10px;right:14px;background:none;border:none;cursor:pointer;font-size:18px;color:#7f1d1d;line-height:1" title="Dismiss">×</button>
</div>
<?php endif; ?>
<?php
	$header_actions = [
		['label' => 'Inspection', 'url' => 'Inspection', 'controller' => 'Inspection', 'class' => 'inspection-btn'],
		['label' => 'Estimation', 'url' => 'Estimation', 'controller' => 'Estimation', 'class' => 'estimation-btn'],
		['label' => 'Quotation', 'url' => 'Quotation', 'controller' => 'Quotation', 'class' => 'quotation-btn'],
		['label' => 'Job Card', 'url' => 'Jobcard', 'controller' => 'Jobcard', 'class' => 'jobcard-btn'],
		['label' => 'Direct Quotations', 'url' => 'DirectQuotation', 'controller' => 'DirectQuotation', 'class' => 'quotation-btn'],
		['label' => 'Direct Invoice', 'url' => 'DirectInvoice', 'controller' => 'DirectInvoice', 'class' => 'quotation-btn'],
	];
	$header_actions = array_values(array_filter($header_actions, function ($action) {
		return user_can_access_page($action['controller'], 'index');
	}));
?>
<div class="topbar">

	<!-- LEFT -->
	<div class="topbar-left">
		<button id="sidebar-toggle" class="md:hidden text-xl">☰</button>
		<h1 class="dashboard-title">Dashboard</h1>
	</div>

	<!-- RIGHT -->
	<div class="topbar-right">

		<!-- DESKTOP ACTION BUTTONS hidden-->
		<?php if (!empty($header_actions)): ?>
		<div class="topbar-actions md:flex items-center">
			<?php foreach ($header_actions as $action): ?>
				<a href="<?= base_url('index.php/' . $action['url']); ?>" class="topbar-btn <?= $action['class']; ?>">
					<?= htmlspecialchars($action['label'], ENT_QUOTES, 'UTF-8'); ?>
				</a>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<!-- MOBILE ACTION DROPDOWN -->
		<?php if (!empty($header_actions)): ?>
		<div class="relative md:hidden">
			<button id="mobile-actions-btn"
				class="border px-3 py-1 rounded text-sm font-semibold">
				Actions ▾
			</button>

			<div id="mobile-actions-menu"
				class="hidden absolute right-0 mt-2 bg-white shadow-lg rounded-lg border p-3 space-y-2 z-50">
				<?php foreach ($header_actions as $action): ?>
					<a href="<?= base_url('index.php/' . $action['url']); ?>" class="topbar-btn <?= $action['class']; ?> block">
						<?= htmlspecialchars($action['label'], ENT_QUOTES, 'UTF-8'); ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>

<!-- 🏢 MULTI-BRANCH SELECTOR -->
<div class="relative inline-block text-left ml-2 flex-shrink-0">

	<button id="branch-selector-btn"
	type="button"
	class="inline-flex items-center gap-2 px-3 py-1.5
	       bg-blue-50 text-blue-700 hover:bg-blue-100
	       border border-blue-200 rounded-lg
	       text-xs font-semibold transition shadow-sm
	       max-w-[180px]">

	<i class="fas fa-building flex-shrink-0"></i>

	<span class="truncate max-w-[110px]"
	      title="<?= htmlspecialchars($selected_label) ?>">
		<?= htmlspecialchars($selected_label) ?>
	</span>

	<i class="fas fa-chevron-down text-[10px] flex-shrink-0"></i>

</button>

	<div id="branch-selector-menu"
		class="hidden absolute right-0 top-full mt-2
		       w-64 max-w-[calc(100vw-20px)]
		       bg-white shadow-xl rounded-xl
		       border border-gray-200 p-3
		       z-[9999]">

		<p class="text-xs font-bold text-gray-500 uppercase tracking-wider
		          mb-2 border-b border-gray-100 pb-1">
			Select Branch Filter
		</p>

		<!-- All Branches -->
		<label class="flex items-center gap-2 p-1.5
		              hover:bg-gray-50 rounded cursor-pointer
		              text-xs font-semibold text-gray-800
		              border-b border-gray-100 mb-1">

			<input type="checkbox"
				id="branch-option-all"
				class="branch-checkbox rounded text-blue-600 focus:ring-blue-500"
				value="all"
				<?= ($selected_branch_ids === 'all') ? 'checked' : '' ?>>

			<span>All Branches</span>
		</label>

		<!-- Individual Branches -->
		<div class="space-y-1 max-h-48 overflow-y-auto">

			<?php foreach ($all_active_branches as $b): ?>

				<?php
					$isChecked =
						($selected_branch_ids === 'all') ||
						(
							is_array($selected_branch_ids) &&
							in_array((int)$b->branch_id, $selected_branch_ids)
						);
				?>

				<label class="flex items-center gap-2 p-1.5
				              hover:bg-gray-50 rounded cursor-pointer
				              text-xs text-gray-700">

					<input type="checkbox"
						class="branch-checkbox branch-single-option
						       rounded text-blue-600 focus:ring-blue-500"
						value="<?= $b->branch_id ?>"
						<?= $isChecked ? 'checked' : '' ?>>

					<span class="truncate">
						<?= htmlspecialchars($b->branch_name) ?>
					</span>

					<?php if ($b->is_main_branch): ?>
						<span class="text-[10px]
						             bg-purple-100 text-purple-700
						             px-1.5 py-0.5 rounded
						             font-bold ml-auto flex-shrink-0">
							Main
						</span>
					<?php endif; ?>

				</label>

			<?php endforeach; ?>

		</div>

		<div class="mt-3 pt-2 border-t border-gray-100 flex justify-end">

			<button type="button"
				id="apply-branch-switch"
				class="px-3 py-1
				       bg-blue-600 hover:bg-blue-700
				       text-white rounded
				       text-xs font-semibold
				       shadow-sm transition">
				Apply Filter
			</button>

		</div>

	</div>

</div>


		<!-- 🔔 NOTIFICATION -->
		<div class="relative ml-2">
			<button id="notif-btn" class="text-xl relative">
				🔔
				<span id="notif-count"
					class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1 rounded-full hidden">
					0
				</span>
			</button>

			<div id="notif-menu"
				class="hidden absolute right-0 mt-2 w-72 bg-white shadow-lg rounded-lg border z-50">
				<div id="notif-list" class="max-h-60 overflow-y-auto">
					<p class="text-center text-gray-500 p-2">Loading...</p>
				</div>
			</div>
		</div>

		<!-- 🔒 LOGOUT -->
		<p class="text-gray-500">Welcome, <b><?= $this->session->userdata('username'); ?></b></p>
		<a href="<?= site_url('Login/logout'); ?>"
			onclick="return confirm('Are you sure you want to log out?');"
			class="ml-2 text-gray-600 hover:text-red-500 transition"
			title="Logout">
			<i class="fas fa-sign-out-alt text-lg"></i>
		</a>

	</div>

</div>


<script>
	document.getElementById('mobile-actions-btn')?.addEventListener('click', function() {
		document.getElementById('mobile-actions-menu').classList.toggle('hidden');
	});

	(function() {
		const notifBtn = document.getElementById('notif-btn');
		const notifMenu = document.getElementById('notif-menu');
		const notifList = document.getElementById('notif-list');
		const notifCount = document.getElementById('notif-count');
		const notificationsUrl = '<?= site_url('Notification'); ?>';
		const unreadCountUrl = '<?= site_url('Notification/unread_count'); ?>';
		const markAllUrl = '<?= site_url('Notification/mark_all_as_read'); ?>';
		const siteRoot = '<?= rtrim(site_url(), '/'); ?>/';

		if (!notifBtn || !notifMenu || !notifList || !notifCount) return;

		function updateCount(count) {
			const unread = Number(count) || 0;
			notifCount.textContent = unread > 99 ? '99+' : unread;
			notifCount.classList.toggle('hidden', unread === 0);
		}

		function escapeHtml(value) {
			const element = document.createElement('div');
			element.textContent = value == null ? '' : String(value);
			return element.innerHTML;
		}

		function renderNotifications(items) {
			notifList.innerHTML = '';
			if (!items.length) {
				notifList.innerHTML = '<p class="text-center text-gray-500 p-3">No notifications</p>';
				return;
			}

			items.forEach(function(notification) {
				const row = document.createElement('button');
				row.type = 'button';
				row.className = 'w-full text-left p-3 border-b hover:bg-gray-50 ' + (Number(notification.read_flag) === 0 ? 'bg-blue-50' : 'bg-white');
				row.innerHTML = '<div class="flex items-start gap-2"><span class="text-blue-600">' + (Number(notification.read_flag) === 0 ? '&#8226;' : '&#10003;') + '</span><div class="min-w-0"><p class="text-sm text-gray-800">' + escapeHtml(notification.message) + '</p>' + (notification.details ? '<p class="text-xs text-gray-500 mt-1">' + escapeHtml(notification.details) + '</p>' : '') + '<small class="text-gray-400">' + escapeHtml(notification.msg_date) + '</small></div></div>';
				row.addEventListener('click', function() {
					fetch('<?= site_url('Notification/mark_as_read'); ?>/' + encodeURIComponent(notification.msg_id), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
						.then(function() {
							if (notification.redirect_url) {
								window.location.href = siteRoot + String(notification.redirect_url).replace(/^\/+/, '');
							} else {
								loadNotifications();
							}
						});
				});
				notifList.appendChild(row);
			});
		}

		function loadNotifications() {
			fetch(notificationsUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
				.then(function(response) { return response.json(); })
				.then(function(data) { updateCount(data.unread_count); renderNotifications(data.notifications || []); })
				.catch(function() { notifList.innerHTML = '<p class="text-center text-red-500 p-3">Unable to load notifications</p>'; });
		}

		notifBtn.addEventListener('click', function() {
			notifMenu.classList.toggle('hidden');
			if (!notifMenu.classList.contains('hidden')) loadNotifications();
		});

		document.addEventListener('click', function(event) {
			if (!notifMenu.contains(event.target) && !notifBtn.contains(event.target)) {
				notifMenu.classList.add('hidden');
			}
		});

		const markAll = document.createElement('button');
		markAll.type = 'button';
		markAll.className = 'w-full border-t p-2 text-xs text-blue-600 hover:bg-gray-50';
		markAll.textContent = 'Mark all as read';
		markAll.addEventListener('click', function() {
			fetch(markAllUrl, { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' } }).then(loadNotifications);
		});
		notifMenu.appendChild(markAll);

		fetch(unreadCountUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
			.then(function(response) { return response.json(); })
			.then(function(data) { updateCount(data.count); });
		setInterval(function() {
			fetch(unreadCountUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
				.then(function(response) { return response.json(); })
				.then(function(data) { updateCount(data.count); });
		}, 20000);
	})();


	// Branch Selector JS
	document.getElementById('branch-selector-btn')?.addEventListener('click', function(e) {
		e.stopPropagation();
		document.getElementById('branch-selector-menu').classList.toggle('hidden');
	});

	document.addEventListener('click', function(e) {
		const btn = document.getElementById('branch-selector-btn');
		const menu = document.getElementById('branch-selector-menu');
		if (menu && !menu.contains(e.target) && !btn.contains(e.target)) {
			menu.classList.add('hidden');
		}
	});

	document.getElementById('branch-option-all')?.addEventListener('change', function() {
		const isChecked = this.checked;
		document.querySelectorAll('.branch-single-option').forEach(function(cb) {
			cb.checked = isChecked;
		});
	});

	document.querySelectorAll('.branch-single-option').forEach(function(cb) {
		cb.addEventListener('change', function() {
			const total = document.querySelectorAll('.branch-single-option').length;
			const checked = document.querySelectorAll('.branch-single-option:checked').length;
			const allCb = document.getElementById('branch-option-all');
			if (allCb) {
				allCb.checked = (total === checked);
			}
		});
	});

	document.getElementById('apply-branch-switch')?.addEventListener('click', function() {
		let selected = [];
		const allCb = document.getElementById('branch-option-all');
		if (allCb && allCb.checked) {
			selected = ['all'];
		} else {
			document.querySelectorAll('.branch-single-option:checked').forEach(function(cb) {
				selected.push(cb.value);
			});
		}

		if (selected.length === 0) {
			selected = ['all'];
		}

		$.ajax({
			url: '<?= base_url("index.php/branches/switch_session") ?>',
			type: 'POST',
			data: { branches: selected },
			dataType: 'json',
			success: function() {
				window.location.reload();
			},
			error: function() {
				window.location.reload();
			}
		});
	});

</script>
<style>

/* =========================================
   TOPBAR
========================================= */

.topbar {
    display: flex;
    align-items: center;
    width: 100%;
    min-height: 70px;
    padding: 8px 20px;
    box-sizing: border-box;
    background: #fff;
    gap: 15px;
    overflow: visible;
}

/* =========================================
   LEFT - DASHBOARD
========================================= */

.topbar-left {
    display: flex;
    align-items: center;
    flex: 0 0 auto;
    width: 120px;
}

.dashboard-title {
    margin: 0;
    padding: 0;
    font-size: 21px;
    font-weight: 700;
    line-height: 1.2;
    white-space: nowrap;
    color: #1f2937;
}

/* =========================================
   RIGHT SECTION
========================================= */

.topbar-right {
	display: flex;
	align-items: center;
	gap: 8px;
	min-width: 0;
	flex-shrink: 1;
}

/* =========================================
   ACTION BUTTONS
========================================= */

.topbar-actions {
	display: flex;
	align-items: center;
	gap: 6px;
	flex-shrink: 1;
	min-width: 0;
}

.topbar-actions a {
	white-space: nowrap;
}

/* =========================================
   BUTTONS
========================================= */

.topbar-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-height: 40px;
    padding: 6px 11px;

    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    line-height: 1.2;

    text-decoration: none;
    color: #fff;

    white-space: nowrap;
    text-align: center;

    transition: all 0.2s ease;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);

    box-sizing: border-box;
}

/* Button colors */

.inspection-btn {
    background: #0dcaf0;
}

.estimation-btn {
    background: #ffc107;
    color: #000;
}

.jobcard-btn {
    background: #198754;
}

.quotation-btn {
    background: #0d6efd;
    color: #fff;
}

/* Hover */

.topbar-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    opacity: 0.95;
}

/* =========================================
   BRANCH SELECTOR
========================================= */

#branch-selector-btn {
    white-space: nowrap;
    min-height: 40px;
    padding: 6px 10px !important;
}

/* =========================================
   NOTIFICATION
========================================= */

#notif-btn {
    width: 36px;
    height: 36px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;
}

/* =========================================
   WELCOME
========================================= */
.topbar-right > p {
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
	max-width: 150px;
	margin: 0;
}

/* .topbar-right > p {
    margin: 0;
    padding: 0;

    font-size: 14px;
    line-height: 1.3;

    white-space: nowrap;
    flex-shrink: 0;
} */

/* =========================================
   LOGOUT
========================================= */

.topbar-right > a {
	flex-shrink: 0;
}

.topbar {
	position: relative;
	overflow: visible;
}
/* =========================================
   SCREEN WIDTH 1200px OR LESS
========================================= */

@media (max-width: 1200px) {

    .topbar {
        padding: 8px 12px;
        gap: 10px;
    }

    .topbar-left {
        width: 105px;
    }

    .dashboard-title {
        font-size: 19px;
    }

    .topbar-right {
        gap: 5px;
    }

    .topbar-actions {
        gap: 4px;
    }

    .topbar-btn {
        min-height: 38px;
        padding: 5px 8px;
        font-size: 11px;
    }

    #branch-selector-btn {
        min-height: 38px;
        padding: 5px 8px !important;
        font-size: 11px;
    }

    .topbar-right > p {
        font-size: 12px;
    }

    #notif-btn {
        width: 32px;
        height: 32px;
    }
}

/* =========================================
   SCREEN WIDTH 1050px OR LESS
========================================= */

@media (max-width: 1050px) {

    .topbar {
        padding: 7px 8px;
        gap: 7px;
    }

    .topbar-left {
        width: 95px;
    }

    .dashboard-title {
        font-size: 17px;
    }

    .topbar-right {
        gap: 4px;
    }

    .topbar-actions {
        gap: 3px;
    }

    .topbar-btn {
        min-height: 36px;
        padding: 5px 6px;
        font-size: 10px;
    }

    #branch-selector-btn {
        min-height: 36px;
        padding: 5px 6px !important;
        font-size: 10px;
    }

    .topbar-right > p {
        font-size: 11px;
    }
}

/* =========================================
   MOBILE
========================================= */

@media (max-width: 768px) {

    .topbar {
        min-height: 60px;
        padding: 8px 12px;
        justify-content: space-between;
    }

    .topbar-left {
        width: auto;
    }

    .dashboard-title {
        font-size: 18px;
    }

    .topbar-right {
        gap: 6px;
    }

    /* Hide desktop buttons */
    .topbar-actions {
        display: none !important;
    }

    /* Show mobile Actions button */
    .relative.md\:hidden {
        display: block;
    }

    .topbar-right > p {
        font-size: 12px;
    }
}


	/* Hover effects */
	.topbar-btn:hover {
		transform: translateY(-1px);
		box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
		opacity: 0.95;
	}
</style>
