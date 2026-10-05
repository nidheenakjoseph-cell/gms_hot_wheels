<style>
.select2-container {
    width: 100% !important;
}

.select2-container .select2-selection--single {
    height: 44px !important;
    border: 1px solid #d1d5db !important;
    border-radius: 0.5rem !important;
    background-color: #fff !important;
}

.select2-container .select2-selection--single .select2-selection__rendered {
    line-height: 42px !important;
    padding-left: 16px !important;
    font-size: 0.875rem !important;
    color: #374151 !important;
}

.select2-container .select2-selection--single .select2-selection__arrow {
    height: 42px !important;
    right: 8px !important;
}

.select2-container--default.select2-container--focus
.select2-selection--single {
    border-color: #3b82f6 !important;
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2) !important;
}

.select2-dropdown {
    border: 1px solid #d1d5db !important;
    border-radius: 0.5rem !important;
}

.select2-search__field {
    border: 1px solid #d1d5db !important;
    border-radius: 0.375rem !important;
    padding: 6px 8px !important;
}

.select2-results__option {
    font-size: 0.875rem !important;
    padding: 8px 12px !important;
}

.select2-results__option--highlighted {
    background-color: #2563eb !important;
    color: white !important;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<div class="min-h-screen bg-gray-100 p-6">
  <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-xl p-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
      <div>
        <div class="flex items-center gap-3">
          <h2 class="text-2xl font-bold text-gray-800">User Access & Branch Permissions</h2>
          <?php if (!empty($is_super_admin)): ?>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-800 border border-purple-200">
              ★ Super Admin Mode (All Companies)
            </span>
          <?php else: ?>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200">
              Company Scope: <?= htmlspecialchars($company_name ?? 'My Company') ?>
            </span>
          <?php endif; ?>
        </div>
        <p class="text-sm text-gray-500 mt-1">Configure user navigation menu visibility and allowed organization branches</p>
      </div>
   
        <a href="<?php echo base_url('index.php/MenuController'); ?>"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm font-semibold self-start md:self-auto">
          Back to Menu List
        </a>
      
    </div>

    <!-- User Dropdown -->
<div class="mb-6 bg-blue-50/60 p-4 border border-blue-100 rounded-xl">

    <label class="block text-sm font-semibold text-gray-800 mb-1">
        Select User
        <span class="text-red-500">*</span>
    </label>

    <select id="userSelect"
            class="user-select"
            onchange="loadUserAccess(this.value)">

        <option value=""></option>

        <?php foreach ($users as $u): ?>
            <option value="<?= $u->id ?>">
                <?= htmlspecialchars($u->username) ?>
                (<?= htmlspecialchars($u->role ?? 'User') ?>)
                <?php if (!empty($is_super_admin) && !empty($u->company_name)): ?>
                    — [Company: <?= htmlspecialchars($u->company_name) ?>]
                <?php elseif (!empty($u->branch_name)): ?>
                    — [Branch: <?= htmlspecialchars($u->branch_name) ?>]
                <?php endif; ?>
            </option>
        <?php endforeach; ?>

    </select>

    <p class="text-xs text-gray-500 mt-1">
        <?php if (!empty($is_super_admin)): ?>
            As Super Admin, you can select and configure access for users across all companies.
        <?php else: ?>
            You can select and configure access for users within your company (<?= htmlspecialchars($company_name ?? '') ?>).
        <?php endif; ?>
    </p>

</div>

    <!-- 2 Column Access Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

      <!-- Branch Access Container -->
      <div class="border border-gray-200 rounded-xl p-5 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-3">
          <h3 class="font-bold text-gray-800 text-base flex items-center gap-2">
            <i class="fas fa-building text-blue-600"></i> Branch Access Permissions
          </h3>
          <span class="text-xs bg-blue-100 text-blue-800 px-2 py-0.5 rounded font-semibold">Branch Scope</span>
        </div>
        
        <div id="branchTree" class="p-3 bg-gray-50 rounded-lg text-sm text-gray-800 min-h-[300px]">
          <p class="text-gray-500 italic">Select a user to load branch access...</p>
        </div>
      </div>

      <!-- Menu Access Tree -->
      <div class="border border-gray-200 rounded-xl p-5 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-3">
          <h3 class="font-bold text-gray-800 text-base flex items-center gap-2">
            <i class="fas fa-sitemap text-purple-600"></i> Menu Access Rights
          </h3>
          <span class="text-xs bg-purple-100 text-purple-800 px-2 py-0.5 rounded font-semibold">
            <?= !empty($is_super_admin) ? 'Full System Menus' : 'Your Accessible Menus' ?>
          </span>
        </div>

        <div id="menuTree" class="p-3 bg-gray-50 rounded-lg text-sm text-gray-800 min-h-[300px] max-h-[500px] overflow-y-auto">
          <p class="text-gray-500 italic">Select a user to load menus...</p>
        </div>
      </div>

    </div>

    <!-- Save Button -->
    <div class="mt-8 text-center border-t border-gray-200 pt-6">
      <button onclick="saveAccess()"
              class="bg-green-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-green-700 transition shadow-md inline-flex items-center gap-2 text-sm">
        <i class="fas fa-check-circle"></i> Save Access & Branch Rights
      </button>
    </div>
  </div>
</div>

<script>
let allActiveBranches = [];

function loadUserAccess(userId) {
  if (!userId) {
    document.getElementById('menuTree').innerHTML = '<p class="text-gray-500 italic">Select a user to load menus...</p>';
    document.getElementById('branchTree').innerHTML = '<p class="text-gray-500 italic">Select a user to load branch access...</p>';
    return;
  }

  fetch('<?php echo site_url("MenuController/get_user_access/"); ?>' + userId)
    .then(res => res.json())
    .then(data => {
      document.getElementById('menuTree').innerHTML = data.menu_html;
      allActiveBranches = data.branches || [];
      renderBranchTree(data.branches || [], data.branch_ids || []);
    })
    .catch(err => {
      console.error(err);
      document.getElementById('menuTree').innerHTML = '<p class="text-red-500 font-semibold">Error loading access. Please retry.</p>';
      document.getElementById('branchTree').innerHTML = '<p class="text-red-500 font-semibold">Error loading access. Please retry.</p>';
    });
}

function renderBranchTree(branches, assignedIds) {
  if (!branches || branches.length === 0) {
    document.getElementById('branchTree').innerHTML = '<p class="text-gray-500 italic">No active branches found.</p>';
    return;
  }

  const allChecked = branches.length > 0 && branches.every(b => assignedIds.includes(parseInt(b.branch_id)));

  let html = '<div class="space-y-2">';
  html += '<label class="font-bold flex items-center gap-2 cursor-pointer pb-2 border-b border-gray-200 text-gray-900">';
  html += '<input type="checkbox" id="selectAllBranches" class="rounded text-blue-600 focus:ring-blue-500" ' + (allChecked ? 'checked' : '') + '> Select All Branches';
  html += '</label>';

  branches.forEach(b => {
    const isChecked = assignedIds.includes(parseInt(b.branch_id)) ? 'checked' : '';
    const escName = (b.branch_name || '').replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
    const escCode = (b.branch_code || '').replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
    html += '<label class="flex items-center gap-2 p-2 hover:bg-white rounded-lg cursor-pointer transition border border-transparent hover:border-gray-200">';
    html += '<input type="checkbox" class="user-branch-option rounded text-blue-600 focus:ring-blue-500" value="' + b.branch_id + '" ' + isChecked + '>';
    html += '<span class="font-medium text-gray-800">' + escName + ' <span class="text-xs text-gray-400">(' + escCode + ')</span></span>';
    if (parseInt(b.is_main_branch) === 1) {
      html += '<span class="ml-auto text-[10px] bg-purple-100 text-purple-700 px-2 py-0.5 rounded font-bold">Main</span>';
    }
    html += '</label>';
  });

  html += '</div>';
  document.getElementById('branchTree').innerHTML = html;

  const selectAll = document.getElementById('selectAllBranches');
  if (selectAll) {
    selectAll.addEventListener('change', function() {
      const isChecked = this.checked;
      document.querySelectorAll('#branchTree .user-branch-option').forEach(cb => cb.checked = isChecked);
    });
  }

  document.querySelectorAll('#branchTree .user-branch-option').forEach(cb => {
    cb.addEventListener('change', function() {
      const total = document.querySelectorAll('#branchTree .user-branch-option').length;
      const checkedCount = document.querySelectorAll('#branchTree .user-branch-option:checked').length;
      if (selectAll) {
        selectAll.checked = (total === checkedCount && total > 0);
      }
    });
  });
}

// Handle parent-child menu checkbox behavior
document.addEventListener('change', function(e) {
  if (e.target.classList.contains('parent-menu')) {
    let parentId = e.target.dataset.id;
    document.querySelectorAll('.submenu[data-parent="' + parentId + '"]').forEach(cb => {
      cb.checked = e.target.checked;
    });
  } else if (e.target.classList.contains('submenu')) {
    let parentId = e.target.dataset.parent;
    let parentCb = document.querySelector('.parent-menu[data-id="' + parentId + '"]');
    if (parentCb) {
      if (e.target.checked) {
        parentCb.checked = true;
      } else {
        const anyChecked = document.querySelectorAll('.submenu[data-parent="' + parentId + '"]:checked').length > 0;
        parentCb.checked = anyChecked;
      }
    }
  }
});

// Save Access
function saveAccess() {
  const userId = document.getElementById('userSelect').value;
  if (!userId) {
    alert('Please select a user first.');
    return;
  }

  const checkedMenus = Array.from(document.querySelectorAll('.menu-checkbox:checked'))
                            .map(cb => cb.value);

  const checkedBranches = Array.from(document.querySelectorAll('#branchTree .user-branch-option:checked'))
                              .map(cb => parseInt(cb.value))
                              .filter(val => !isNaN(val) && val > 0);

  if (checkedBranches.length === 0) {
    alert('Select at least one branch before saving access.');
    return;
  }

  fetch('<?php echo site_url("MenuController/save_user_access"); ?>', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      user_id: userId,
      menu_ids: checkedMenus,
      branch_ids: checkedBranches
    })
  })
  .then(res => {
    return res.text().then(text => {
      let data = null;
      try { data = JSON.parse(text); } catch (e) { }
      if (!res.ok) {
        const msg = data && data.message ? data.message : (text || 'Error saving access. Please try again.');
        alert(msg);
        throw new Error(msg);
      }
      return data || {};
    });
  })
  .then(resp => {
    let msg = resp.message || 'Access rights and branch permissions saved successfully!';
    // if (typeof resp.inserted_branch_count !== 'undefined') {
    //   msg += '\nBranches removed: ' + (resp.deleted_branch_count || 0) + ', inserted: ' + (resp.inserted_branch_count || 0);
    //   msg += '\nMenus removed: ' + (resp.deleted_menu_count || 0) + ', inserted: ' + (resp.inserted_menu_count || 0);
    // }
    alert(msg);
    loadUserAccess(userId);
  })
  .catch(err => {
    console.error(err);
    if (!err.message) alert('Error saving access. Please try again.');
  });
}
</script>

<script>
$(document).ready(function() {

    $('#userSelect').select2({
        width: '100%',
        placeholder: '-- Select User --',
        allowClear: true
    });

});
</script>