<div class="flex items-center justify-between bg-gray-200 px-4 py-3 rounded-t-lg">

	<h1 class="text-xl font-medium text-gray-700">
		Expense Entry
	</h1>

	<a href="<?php echo base_url('index.php/Accounts/expense_list'); ?>"
		class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
		← Back to List
	</a>


</div>

<form method="post" action="<?php echo base_url('index.php/Accounts/save_expense'); ?>" enctype="multipart/form-data">
	<div class="bg-white shadow rounded-xl p-6 space-y-6">
		<div class="grid grid-cols-12 gap-4">

			<div class="col-span-12 md:col-span-3">
				<label class="text-sm">Date</label>
				<input type="date" name="expense_date" class="w-full border rounded px-3 py-2"
					value="<?php echo date('Y-m-d'); ?>" required>
			</div>

			<div class="col-span-12 md:col-span-3">
				<label class="text-sm">Description</label>
				<input type="text" name="desp"
					class="w-full border rounded px-3 py-2" required>
				<label class="text-sm hidden">Expense Ledger</label>
				<select name="expense_ledger_id" class="w-full border rounded px-3 py-2 select2 hidden">
					<!-- <option value="">Select</option> -->

					<option value="9" selected>Direct Expense</option>
				</select>
			</div>

			<div class="col-span-12 md:col-span-3">
				<label class="text-sm">Amount</label>
				<input type="number" step="any" name="amount"
					class="w-full border rounded px-3 py-2 text-right" required>
			</div>

			<div class="col-span-12 md:col-span-3">
				<label class="text-sm">Paid Through</label>
				<select name="payment_mode" class="w-full border rounded px-3 py-2" required>
					<option value="CASH">Cash</option>
					<option value="BANK">Bank</option>
					<option value="CREDIT">Credit</option>
				</select>
			</div>

		</div>

		<div class="grid grid-cols-12 gap-4">

			<div class="col-span-12 md:col-span-6">
				<label class="text-sm">Remarks</label>
				<input type="text" name="remarks" class="w-full border rounded px-3 py-2">
			</div>

			<div class="col-span-12 md:col-span-6">
				<label class="text-sm">Attachment</label>
				<input type="file" name="expense_doc" class="w-full border rounded px-3 py-2">
			</div>

		</div>

		<div class="flex justify-end gap-3 pt-4">

			<a href="<?php echo base_url('index.php/Accounts/expense_list'); ?>"
				class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
				Cancel
			</a>

			<button type="submit"
				class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
				Save Expense
			</button>


		</div>

	</div>
</form>
