<div class="w-full bg-white rounded-2xl shadow-md p-6 mt-6 max-w-5xl mx-auto">
	<div class="flex items-center justify-between border-b border-gray-200 pb-4 mb-6">
		<div>
			<h2 class="text-2xl font-bold text-gray-800">Edit Company : <?= htmlspecialchars($company->company_name) ?></h2>
			<p class="text-sm text-gray-500 mt-1">Configure company profile, demo access expiry, and banking details</p>
		</div>

		<a href="<?= base_url('index.php/Admin/company_details') ?>"
			class="px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition text-sm">
			← Back to Companies
		</a>
	</div>

	<?php if ($this->session->flashdata('success')): ?>
		<div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
			<?= htmlspecialchars($this->session->flashdata('success')) ?>
		</div>
	<?php endif; ?>

	<?php if ($this->session->flashdata('error')): ?>
		<div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
			<?= htmlspecialchars($this->session->flashdata('error')) ?>
		</div>
	<?php endif; ?>

	<form id="main" method="post"
		action="<?= base_url('index.php/Admin/add_company_records') ?>"
		autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="company_id" value="<?= (int) $company->company_id; ?>">

		<!-- Company Code & Name -->
		<div class="grid grid-cols-1 md:grid-cols-12 gap-4 mb-4 items-center">
			<label class="md:col-span-2 font-semibold text-gray-700">Company Code <span class="text-red-500">*</span></label>
			<div class="md:col-span-4">
				<input type="text" name="company_code" id="company_code"
					class="w-full border rounded-lg px-3 py-2 uppercase font-medium bg-gray-50"
					value="<?= htmlspecialchars($company->company_code); ?>" required>
			</div>

			<label class="md:col-span-2 font-semibold text-gray-700">Company Name <span class="text-red-500">*</span></label>
			<div class="md:col-span-4">
				<input type="text" name="company_name" id="company_name"
					class="w-full border rounded-lg px-3 py-2"
					value="<?= htmlspecialchars($company->company_name); ?>" required>
			</div>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-12 gap-4 mb-4 items-center">
			<label class="md:col-span-2 font-semibold text-gray-700">Company Logo</label>
			<div class="md:col-span-4">
				<?php if (!empty($company->company_logo)): ?>
					<img src="<?= base_url($company->company_logo) ?>" alt="Current company logo" class="mb-2 h-16 max-w-48 object-contain">
				<?php endif; ?>
				<input type="file" name="company_logo" accept=".jpg,.jpeg,.png,.gif,.webp,image/jpeg,image/png,image/gif,image/webp"
					class="w-full border rounded-lg px-3 py-2 text-sm">
				<p class="mt-1 text-xs text-gray-500">JPG, PNG, GIF, or WebP; maximum 2 MB.</p>
			</div>
		</div>

		<!-- Address / City -->
		<div class="grid grid-cols-1 md:grid-cols-12 gap-4 mb-4 items-center">
			<label class="md:col-span-2 font-semibold text-gray-700">Address <span class="text-red-500">*</span></label>
			<div class="md:col-span-4">
				<input type="text" name="company_address" id="company_address"
					class="w-full border rounded-lg px-3 py-2"
					value="<?= htmlspecialchars($company->company_address); ?>" required>
			</div>

			<label class="md:col-span-2 font-semibold text-gray-700">City <span class="text-red-500">*</span></label>
			<div class="md:col-span-4">
				<input type="text" name="company_city" id="company_city"
					class="w-full border rounded-lg px-3 py-2"
					value="<?= htmlspecialchars($company->company_city); ?>" required>
			</div>
		</div>

		<!-- PO Box / Country -->
		<div class="grid grid-cols-1 md:grid-cols-12 gap-4 mb-4 items-center">
			<label class="md:col-span-2 font-semibold text-gray-700">PO Box / Pincode</label>
			<div class="md:col-span-4">
				<input type="text" name="company_pincode" id="company_pincode"
					class="w-full border rounded-lg px-3 py-2"
					value="<?= htmlspecialchars($company->company_pincode ?? ''); ?>">
			</div>

			<label class="md:col-span-2 font-semibold text-gray-700">Country <span class="text-red-500">*</span></label>
			<div class="md:col-span-4">
				<input type="text" name="company_country" id="company_country"
					class="w-full border rounded-lg px-3 py-2"
					value="<?= htmlspecialchars($company->company_country); ?>" required>
			</div>
		</div>

		<!-- Email / Telephone -->
		<div class="grid grid-cols-1 md:grid-cols-12 gap-4 mb-4 items-center">
			<label class="md:col-span-2 font-semibold text-gray-700">Email</label>
			<div class="md:col-span-4">
				<input type="email" name="company_email_id" id="company_email_id"
					class="w-full border rounded-lg px-3 py-2"
					value="<?= htmlspecialchars($company->company_email_id ?? ''); ?>">
			</div>

			<label class="md:col-span-2 font-semibold text-gray-700">Telephone</label>
			<div class="md:col-span-4">
				<input type="text" name="company_telephone" id="company_telephone"
					class="w-full border rounded-lg px-3 py-2"
					value="<?= htmlspecialchars($company->company_telephone ?? ''); ?>">
			</div>
		</div>

		<!-- TRN / Website -->
		<div class="grid grid-cols-1 md:grid-cols-12 gap-4 mb-6 items-center">
			<label class="md:col-span-2 font-semibold text-gray-700">TRN No</label>
			<div class="md:col-span-4">
				<input type="text" name="company_trn" id="company_trn"
					class="w-full border rounded-lg px-3 py-2"
					value="<?= htmlspecialchars($company->company_TRN ?? ''); ?>">
			</div>

			<label class="md:col-span-2 font-semibold text-gray-700">Website</label>
			<div class="md:col-span-4">
				<input type="text" name="website" id="website"
					class="w-full border rounded-lg px-3 py-2"
					value="<?= htmlspecialchars($company->company_website ?? ''); ?>">
			</div>
		</div>

		<!-- Demo Access Settings Box -->
		<div class="border border-blue-200 rounded-xl bg-blue-50/70 p-6 mb-6">
			<div class="flex items-center justify-between mb-4 border-b border-blue-200 pb-3">
				<div>
					<h3 class="text-base font-bold text-gray-800">Demo Access & Expiration Settings</h3>
					<p class="text-xs text-gray-500">Enable or limit system access for this company via expiration date</p>
				</div>
				<label class="inline-flex items-center gap-2 text-sm font-semibold text-gray-800 cursor-pointer">
					<input type="checkbox" name="demo_enabled" value="1" <?= !empty($company->demo_enabled) ? 'checked' : ''; ?> class="w-4 h-4 text-blue-600 rounded">
					Enable Demo Access
				</label>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
				<label class="md:col-span-2 text-sm font-semibold text-gray-700">Demo Start Date</label>
				<div class="md:col-span-4">
					<input type="date" name="demo_start_date" id="demo_start_date" class="w-full border rounded-lg px-3 py-2 text-sm bg-white"
						value="<?= !empty($company->demo_start_date) ? $company->demo_start_date : ''; ?>">
				</div>

				<label class="md:col-span-2 text-sm font-semibold text-gray-700">Demo Duration</label>
				<div class="md:col-span-4">
					<select name="demo_duration_days" id="demo_duration_days" class="w-full border rounded-lg px-3 py-2 text-sm bg-white">
						<option value="0" <?= empty($company->demo_duration_days) ? 'selected' : ''; ?>>Custom / None</option>
						<option value="7" <?= (!empty($company->demo_duration_days) && (int)$company->demo_duration_days === 7) ? 'selected' : ''; ?>>7 Days</option>
						<option value="14" <?= (!empty($company->demo_duration_days) && (int)$company->demo_duration_days === 14) ? 'selected' : ''; ?>>14 Days</option>
						<option value="30" <?= (!empty($company->demo_duration_days) && (int)$company->demo_duration_days === 30) ? 'selected' : ''; ?>>30 Days</option>
						<option value="60" <?= (!empty($company->demo_duration_days) && (int)$company->demo_duration_days === 60) ? 'selected' : ''; ?>>60 Days</option>
						<option value="90" <?= (!empty($company->demo_duration_days) && (int)$company->demo_duration_days === 90) ? 'selected' : ''; ?>>90 Days</option>
					</select>
				</div>
			</div>

			<div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center mt-4">
				<label class="md:col-span-2 text-sm font-semibold text-gray-700">Expiry Date</label>
				<div class="md:col-span-4">
					<input type="date" name="demo_expiry_date" id="demo_expiry_date" class="w-full border rounded-lg px-3 py-2 text-sm bg-white"
						value="<?= !empty($company->demo_expiry_date) ? $company->demo_expiry_date : ''; ?>">
				</div>

				<div class="md:col-span-6 flex gap-2 justify-end">
					<button type="submit" name="demo_action" value="save_demo" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm transition">
						Save Demo Settings
					</button>
					<button type="submit" name="demo_action" value="extend_demo" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm transition">
						Extend Demo
					</button>
				</div>
			</div>
		</div>

		<!-- BANK TABLE -->
		<div class="border border-gray-200 rounded-xl p-5 mb-6 bg-white">
			<div class="flex items-center justify-between mb-3 border-b pb-2">
				<h3 class="text-base font-bold text-gray-800">Company Bank Details</h3>
				<a id="add_row" class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-xs font-semibold cursor-pointer shadow-sm">
					+ Add Bank Account
				</a>
			</div>
			<div class="overflow-x-auto">
				<table class="w-full border border-gray-300 text-sm" id="tab_logic">
					<thead class="bg-gray-100 text-gray-700">
						<tr>
							<th class="border px-3 py-2 text-left">Bank Name</th>
							<th class="border px-3 py-2 text-left">Account</th>
							<th class="border px-3 py-2 text-left">Branch</th>
							<th class="border px-3 py-2 text-left">IBAN</th>
							<th class="border px-3 py-2 text-left">SWIFT</th>
							<th class="border px-3 py-2 text-center w-16">Action</th>
						</tr>
					</thead>
					<tbody id="mytbbody">
						<?php if (!empty($bank_details)): ?>
							<?php foreach ($bank_details as $r): ?>
								<tr class="text-[13px]">
									<td class="border px-2 py-1">
										<input type="text" name="bname_old[]" class="w-full border rounded px-2 py-1 text-sm"
											value="<?= htmlspecialchars($r->bank_name); ?>" required>
									</td>
									<td class="border px-2 py-1">
										<input type="text" name="bacc_old[]" class="w-full border rounded px-2 py-1 text-sm"
											value="<?= htmlspecialchars($r->bank_account); ?>">
									</td>
									<td class="border px-2 py-1">
										<input type="text" name="bbranch_old[]" class="w-full border rounded px-2 py-1 text-sm"
											value="<?= htmlspecialchars($r->bank_branch); ?>">
									</td>
									<td class="border px-2 py-1">
										<input type="text" name="biban_old[]" class="w-full border rounded px-2 py-1 text-sm"
											value="<?= htmlspecialchars($r->bank_iban); ?>">
									</td>
									<td class="border px-2 py-1">
										<input type="text" name="bswift_old[]" class="w-full border rounded px-2 py-1 text-sm"
											value="<?= htmlspecialchars($r->bank_swift); ?>">
									</td>
									<td class="border px-2 py-1 text-center">
										<input type="hidden" name="trans_id[]" value="<?= $r->bid; ?>">
										<a href="javascript:confirmcancel(<?= $r->bid; ?>)"
											class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs inline-block">
											🗑
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>

						<tr id="addr0" class="text-[13px]">
							<td class="border px-2 py-1">
								<input type="text" name="bname[]" class="w-full border rounded px-2 py-1 text-sm" placeholder="Bank Name">
							</td>
							<td class="border px-2 py-1">
								<input type="text" name="bacc[]" class="w-full border rounded px-2 py-1 text-sm" placeholder="Account No">
							</td>
							<td class="border px-2 py-1">
								<input type="text" name="bbranch[]" class="w-full border rounded px-2 py-1 text-sm" placeholder="Branch">
							</td>
							<td class="border px-2 py-1">
								<input type="text" name="biban[]" class="w-full border rounded px-2 py-1 text-sm" placeholder="IBAN">
							</td>
							<td class="border px-2 py-1">
								<input type="text" name="bswift[]" class="w-full border rounded px-2 py-1 text-sm" placeholder="SWIFT">
							</td>
							<td class="border px-2 py-1 text-center">
								<a id="delete_row" onclick="remove_row(0)"
									class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs cursor-pointer inline-block">
									🗑
								</a>
							</td>
						</tr>
						<tr id="addr1"></tr>
					</tbody>
				</table>
			</div>
		</div>

		<!-- STAMP TABLE -->
		<div class="border border-gray-200 rounded-xl p-5 mb-6 bg-white">
			<div class="flex items-center justify-between mb-3 border-b pb-2">
				<h3 class="text-base font-bold text-gray-800">Company Stamp / Seal Images</h3>
				<a id="add_new_row" class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 rounded text-xs font-semibold cursor-pointer shadow-sm">
					+ Add Stamp
				</a>
			</div>
			<div class="overflow-x-auto">
				<table class="w-full border border-gray-300 text-sm" id="tab_stamp">
					<thead class="bg-gray-100 text-gray-700">
						<tr>
							<th class="border px-3 py-2 text-left">Name</th>
							<th class="border px-3 py-2 text-center">Stamp Preview</th>
							<th class="border px-3 py-2 text-center w-16">Action</th>
						</tr>
					</thead>
					<tbody id="mystamp">
						<?php if (!empty($stamp_details)): ?>
							<?php foreach ($stamp_details as $r): ?>
								<tr class="text-[13px]">
									<td class="border px-2 py-1">
										<input type="text" name="image_name_old[]"
											class="w-full border rounded px-2 py-1 text-sm"
											value="<?= htmlspecialchars($r->stamp_name); ?>" required>
									</td>
									<td class="border px-2 py-1 text-center">
										<?php $binary = base64_decode(str_replace(" ", "+", $r->stamp_image)); ?>
										<img class="mx-auto h-20 w-20 object-contain rounded border"
											src="<?php if ($binary != '') echo 'data:;base64,' . base64_encode($binary); ?>">
									</td>
									<td class="border px-2 py-1 text-center">
										<input type="hidden" name="img_id[]" value="<?= $r->img_id; ?>">
										<a href="javascript:confirmcancel_image(<?= $r->img_id; ?>)"
											class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs inline-block">
											🗑
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>

						<tr id="new_addr0" class="text-[13px]">
							<td class="border px-2 py-1">
								<input type="text" name="image_name[]" class="w-full border rounded px-2 py-1 text-sm" placeholder="Stamp Name">
							</td>
							<td class="border px-2 py-1">
								<input type="file" name="stamp_image[]" class="w-full border rounded px-2 py-1 text-sm">
							</td>
							<td class="border px-2 py-1 text-center">
								<a id="delete_row1" onclick="remove_stamp_row(0)"
									class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs cursor-pointer inline-block">
									🗑
								</a>
							</td>
						</tr>
						<tr id="new_addr1"></tr>
					</tbody>
				</table>
			</div>
		</div>

		<!-- SUBMIT BUTTONS -->
		<div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
			<a href="<?= base_url('index.php/Admin/company_details') ?>"
				class="px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
				Cancel
			</a>
			<button type="submit"
				class="px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition shadow-sm">
				Save Company Details
			</button>
		</div>
	</form>
</div>

<script>
	$(document).ready(function() {
		var i = 1;
		$("#add_row").click(function() {
			$('#addr' + i).html("<td><input type='text' name='bname[]' id='bname' tabindex='2' class='w-full border rounded px-2 py-1 text-sm' placeholder='Bank Name' required></td><td><input type='text' name='bacc[]' id='bacc' tabindex='3' class='w-full border rounded px-2 py-1 text-sm' placeholder='Account No'></td><td><input type='text' name='bbranch[]' id='bbranch' tabindex='3' class='w-full border rounded px-2 py-1 text-sm' placeholder='Branch'></td><td><input type='text' name='biban[]' id='biban' tabindex='3' class='w-full border rounded px-2 py-1 text-sm' placeholder='IBAN'></td><td><input type='text' name='bswift[]' id='bswift' tabindex='3' class='w-full border rounded px-2 py-1 text-sm' placeholder='SWIFT'></td><td class='text-center'><a onclick='remove_row(" + i + ");' class='bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs cursor-pointer inline-block'>🗑</a></td>");
			$('#mytbbody tr:last').after('<tr id="addr' + (i + 1) + '"></tr>');
			i++;
		});

		var j = 1;
		$("#add_new_row").click(function() {
			$('#new_addr' + j).html("<td><input type='text' name='image_name[]' class='w-full border rounded px-2 py-1 text-sm' placeholder='Stamp Name' required></td><td><input type='file' name='stamp_image[]' class='w-full border rounded px-2 py-1 text-sm'></td><td class='text-center'><a onclick='remove_stamp_row(" + j + ");' class='bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs cursor-pointer inline-block'>🗑</a></td>");
			$('#mystamp tr:last').after('<tr id="new_addr' + (j + 1) + '"></tr>');
			j++;
		});

		const startInput = document.getElementById('demo_start_date');
		const durationSelect = document.getElementById('demo_duration_days');
		const expiryInput = document.getElementById('demo_expiry_date');

		function updateExpiry() {
			const days = parseInt(durationSelect.value, 10);
			const startVal = startInput.value;
			if (!startVal || days <= 0) return;

			const dt = new Date(startVal);
			dt.setDate(dt.getDate() + days);
			const yyyy = dt.getFullYear();
			const mm = String(dt.getMonth() + 1).padStart(2, '0');
			const dd = String(dt.getDate()).padStart(2, '0');
			expiryInput.value = `${yyyy}-${mm}-${dd}`;
		}

		if (durationSelect && startInput) {
			durationSelect.addEventListener('change', updateExpiry);
			startInput.addEventListener('change', updateExpiry);
		}
	});

	function remove_row(append_id) {
		$('#addr' + append_id).remove();
	}

	function remove_stamp_row(append_id) {
		$('#new_addr' + append_id).remove();
	}

	function confirmcancel(id) {
		if (confirm("Are you sure you want to Delete this Bank Record?")) {
			$.ajax({
				url: "<?= base_url('index.php/Ajax/delete_record') ?>",
				type: "POST",
				data: {
					table_name: 'company_bank_details',
					where_key: 'bid',
					where_val: id
				},
				success: function(msg) {
					if (msg == 1) {
						location.reload();
					} else {
						alert("Cannot delete record.");
					}
				},
			});
			return true;
		}
		return false;
	}

	function confirmcancel_image(id) {
		if (confirm("Are you sure you want to Delete this Stamp Image?")) {
			$.ajax({
				url: "<?= base_url('index.php/Ajax/delete_record') ?>",
				type: "POST",
				data: {
					table_name: 'company_stamp_image',
					where_key: 'img_id',
					where_val: id
				},
				success: function(msg) {
					if (msg == 1) {
						location.reload();
					} else {
						alert("Cannot delete record.");
					}
				},
			});
			return true;
		}
		return false;
	}
</script>
