<div class="min-h-screen bg-gray-100 p-6">

	<div class="w-full bg-white shadow-lg rounded-xl p-8">
		<div class="flex justify-between items-center mb-6">
			<h2 class="text-2xl font-bold">Edit User Details</h2>
			<a href="<?php echo base_url('index.php/Setup/list_users'); ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">List Records</a>
		</div>

		<form action="<?php echo base_url('index.php/Setup/edit_user_data'); ?>" method="POST">

		    <input type="hidden" id="user_id" name="user_id" required="required" value='<?php echo $user['id']; ?>' class="form-control ">
                        
			<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
				<!-- Company -->
				<div>
					<label class="block text-sm font-medium mb-1">Company <span class="text-red-500">*</span></label>
					<select name="company_id" id="company_id" required class="w-full border rounded-lg px-3 py-2 bg-white">
						<option value="">Select Company</option>
						<?php if (!empty($companies)): ?>
							<?php foreach ($companies as $c): ?>
								<option value="<?= $c->company_id ?>" <?= ((int)$selected_company_id === (int)$c->company_id) ? 'selected' : '' ?>>
									<?= htmlspecialchars($c->company_name . ' (' . $c->company_code . ')') ?>
								</option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>

				<!-- Branch -->
				<div>
					<label class="block text-sm font-medium mb-1">Branch <span class="text-red-500">*</span></label>
					<select name="branch_id" id="branch_id" required class="w-full border rounded-lg px-3 py-2 bg-white">
						<option value="">Select Branch</option>
						<?php if (!empty($branches)): ?>
							<?php foreach ($branches as $b): ?>
								<option value="<?= $b->branch_id ?>" data-company-id="<?= $b->company_id ?>" <?= ((int)($user['branch_id'] ?? 0) === (int)$b->branch_id) ? 'selected' : '' ?>>
									<?= htmlspecialchars($b->branch_name . ($b->is_main_branch ? ' (Main Branch)' : '')) ?>
								</option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>

				<div>
					<label class="block text-sm font-medium mb-1">First Name</label>
					<input type="text" name="first_name" class="border rounded-lg px-4 py-2 w-full" value="<?php echo $user['first_name']; ?>" required>
				</div>

				<div>
					<label class="block text-sm font-medium mb-1">Last Name</label>
					<input type="text" name="last_name" class="border rounded-lg px-4 py-2 w-full" value="<?php echo $user['last_name']; ?>" required>
				</div>

				<div>
					<label class="block text-sm font-medium mb-1">Email</label>
					<input type="email" name="email" class="border rounded-lg px-4 py-2 w-full"  value="<?php echo $user['email']; ?>" required>
				</div>

				<!-- Username -->
				<div>
					<label class="block text-sm font-medium mb-1">Username</label>
					<input type="text" name="username" class="w-full border rounded-lg px-3 py-2"  value="<?php echo $user['username']; ?>" required />
				</div>

				<!-- Password -->
				<div class="relative">
					<label class="block text-sm font-medium mb-1">Password</label>
					<div class="relative">
						<input type="password" name="password" id="passwordField" placeholder="Leave blank to keep current password" class="w-full border rounded-lg px-3 py-2 pr-10" />
						<button type="button" id="togglePassword" class="absolute inset-y-0 right-3 flex items-center text-gray-600">
							👁️
						</button>
					</div>
				</div>

				<!-- Role -->
				<div>
					<label class="block text-sm font-medium mb-1">Role</label>
					<select name="role" required
						class="w-full border rounded-lg px-3 py-2">
						<option value="">Select Role</option>
						<?php if (!empty($is_super_admin) || $user['role'] == "Super Admin"): ?>
							<option value="Super Admin" <?= ($user['role'] == "Super Admin") ? 'selected' : '' ?>>Super Admin</option>
						<?php endif; ?>
						<option value="Admin" <?= ($user['role'] == "Admin") ? 'selected' : '' ?>>Admin</option>
						<option value="Manager" <?= ($user['role'] == "Manager") ? 'selected' : '' ?>>Manager</option>
						<option value="Employee" <?= ($user['role'] == "Employee") ? 'selected' : '' ?>>Employee</option>
						<option value="Guest" <?= ($user['role'] == "Guest") ? 'selected' : '' ?>>Guest</option>
					</select>
				</div>

				<!-- Department -->
				<div>
					<label class="block text-sm font-medium mb-1">Department</label>
					<input type="text" name="department" class="w-full border rounded-lg px-3 py-2"  value="<?php echo $user['department']; ?>" />
				</div>

				<!-- Contact Number -->
				<div>
					<label class="block text-sm font-medium mb-1">Contact Number</label>
					<input type="number" name="contact_number"  value="<?php echo $user['contact_no']; ?>" 
						class="w-full border rounded-lg px-3 py-2" />
				</div>

				<!-- Status -->
				<div>
					<label class="block text-sm font-medium mb-1">Status</label>
					<select name="status"
						class="w-full border rounded-lg px-3 py-2">
						<option value="Active"  <?= ($user['status'] == "Active") ? 'selected' : '' ?>>Active</option>
						<option value="Inactive"  <?= ($user['status'] == "Inactive") ? 'selected' : '' ?>>Inactive</option>
					</select>
				</div>

				<!-- Submit Button -->
				<div class="col-span-1 md:col-span-3 text-center mt-6">
					<button type="submit"
						class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition font-medium">
						Update User
					</button>

					<a href="<?php echo base_url('index.php/Setup/list_users'); ?>"
						class="bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-300 transition font-medium ml-3">
						Cancel
					</a>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	const toggleBtn = document.getElementById('togglePassword');
	const pwd = document.getElementById('passwordField');

	if (toggleBtn && pwd) {
		toggleBtn.addEventListener('click', () => {
			pwd.type = pwd.type === 'password' ? 'text' : 'password';
		});
	}

	const companySelect = document.getElementById('company_id');
	const branchSelect = document.getElementById('branch_id');
	const currentSelectedBranch = '<?= (string)($user['branch_id'] ?? '') ?>';
	const allBranchOptions = Array.from(branchSelect.querySelectorAll('option[data-company-id]'));

	function filterBranches(isInitial = false) {
		const selectedComp = companySelect.value;
		branchSelect.innerHTML = '<option value="">Select Branch</option>';
		let matchFound = false;
		let firstMatch = null;
		allBranchOptions.forEach(opt => {
			if (!selectedComp || opt.getAttribute('data-company-id') === selectedComp) {
				const clone = opt.cloneNode(true);
				if (isInitial && clone.value === currentSelectedBranch) {
					clone.selected = true;
					matchFound = true;
				}
				branchSelect.appendChild(clone);
				if (!firstMatch) firstMatch = clone.value;
			}
		});
		if (!matchFound && firstMatch) {
			branchSelect.value = firstMatch;
		}
	}

	if (companySelect && branchSelect) {
		companySelect.addEventListener('change', () => filterBranches(false));
		filterBranches(true);
	}
</script>
