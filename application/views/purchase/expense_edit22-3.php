
<div class="flex items-center justify-between bg-gray-200 px-4 py-3 rounded-t-lg">

	<h1 class="text-xl font-medium text-gray-700">Edit Expense</h1>

	<a href="<?php echo base_url('index.php/Accounts/expense_list'); ?>"
		class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
		← Back to List
	</a>


</div>

<form method="post"
	action="<?php echo base_url('index.php/Accounts/update_expense/' . $expense->expense_id); ?>"
	enctype="multipart/form-data">

	<div class="bg-white shadow rounded-xl p-6 space-y-6">

		<div class="grid grid-cols-12 gap-4">

			<div class="col-span-12 md:col-span-3">
				<label class="text-sm">Date</label>
				<input type="date" name="expense_date"
					class="w-full border rounded px-3 py-2"
					value="<?php echo $expense->expense_date; ?>" required>
			</div>

			<div class="col-span-12 md:col-span-3">
				<label class="text-sm">Description</label>
				<input type="text" name="desp"
					class="w-full border rounded px-3 py-2"
					value="<?php echo $expense->description; ?>" required>

				<select name="expense_ledger_id"
					class="hidden">
					<option value="9" selected>Direct Expense</option>
				</select>
			</div>

			<div class="col-span-12 md:col-span-3">
				<label class="text-sm">Amount</label>
				<input type="number" step="any" name="amount"
					class="w-full border rounded px-3 py-2 text-right"
					value="<?php echo $expense->amount; ?>" required>
			</div>

			<div class="col-span-12 md:col-span-3">
				<label class="text-sm">Paid Through</label>
				<select name="payment_mode"
					class="w-full border rounded px-3 py-2">
					<option value="CASH" <?php if ($expense->payment_mode == 'CASH') echo 'selected'; ?>>Cash</option>
					<option value="BANK" <?php if ($expense->payment_mode == 'BANK') echo 'selected'; ?>>Bank</option>
					<option value="CREDIT" <?php if ($expense->payment_mode == 'CREDIT') echo 'selected'; ?>>Credit</option>
				</select>
			</div>

		</div>

		<div class="grid grid-cols-12 gap-4">

			<div class="col-span-12 md:col-span-6">
				<label class="text-sm">Remarks</label>
				<input type="text" name="remarks"
					class="w-full border rounded px-3 py-2"
					value="<?php echo $expense->remarks; ?>">
			</div>

			<div class="col-span-12 md:col-span-6">
				<label class="text-sm">Attachment</label>
				<input type="file" name="expense_doc"
					class="w-full border rounded px-3 py-2">

				<?php if (!empty($document)) { ?>
					<a target="_blank"
						class="text-blue-600 underline"
						href="<?php echo base_url('uploads/expenses/' . $document->doc_path); ?>">
						View Existing
					</a>
				<?php } ?>
			</div>

		</div>

	

			<div class="flex justify-end gap-3 pt-4">

			<a href="<?php echo base_url('index.php/Accounts/expense_list'); ?>"
				class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
				Cancel
			</a>

			<button type="submit"
				class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
				Update Expense
			</button>


		</div>


	</div>
</form>
