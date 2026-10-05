<div class="bg-white shadow rounded-xl p-6">
	<div>
		<h5 class="text-lg font-semibold text-gray-700">
			Tax Details
			(<?php echo isset($from_date) ? date('d-M-Y', strtotime($from_date)) : ''; ?>
			to
			<?php echo isset($to_date) ? date('d-M-Y', strtotime($to_date)) : ''; ?>)
		</h5>

		<!-- ================= SALES VAT ================= -->
		<h6 class="mt-8 text-md font-semibold text-gray-700">Sales / Output VAT (Invoice Wise)</h6>
		<div class="overflow-x-auto">
			<table class="min-w-full border border-gray-200 text-sm">
				<thead class="bg-gray-100">
					<tr>
						<th class="border px-3 py-2">Sr.No</th>
						<th class="border px-3 py-2">Date</th>
						<th class="border px-3 py-2">Invoice No</th>
						<th class="border px-3 py-2">Customer</th>
						<th class="border px-3 py-2 text-right">Taxable</th>
						<th class="border px-3 py-2 text-right">VAT</th>
						<th class="border px-3 py-2 text-right">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$sales_tax = 0; 
					$sales_vat = 0;
					if(!empty($sales_records)){
						$i=1;
						foreach($sales_records as $row){
							$total = $row->taxable + $row->vat;
							$sales_tax += $row->taxable;
							$sales_vat += $row->vat;
					?>
					<tr>
						<td class="border px-3 py-2"><?php echo $i++; ?></td>
						<td class="border px-3 py-2"><?php echo date('d-M-Y',strtotime($row->invoice_date)); ?></td>
						<td class="border px-3 py-2"><?php echo $row->invoice_no; ?></td>
						<td class="border px-3 py-2"><?php echo $row->customer_name; ?></td>
						<!-- <td class="border px-3 py-2 text-right"><?php echo number_format($row->taxable,2); ?></td> -->
						 <td class="border px-3 py-2 text-right">
    <?= number_format((float) ($row->taxable ?? 0), 2); ?>
</td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($row->vat,2); ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($total,2); ?></td>
					</tr>
					<?php }} else { ?>
					<tr><td colspan="7" class="text-center py-4">No Sales VAT Records</td></tr>
					<?php } ?>
				</tbody>
				<tfoot class="bg-gray-100 font-semibold">
					<tr>
						<td colspan="4" class="border px-3 py-2">Total</td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($sales_tax,2); ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($sales_vat,2); ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($sales_tax+$sales_vat,2); ?></td>
					</tr>
				</tfoot>
			</table>
		</div>


		<!-- ================= PURCHASE VAT ================= -->
		<h6 class="mt-10 text-md font-semibold text-gray-700">Purchase / Input VAT (GRN Wise)</h6>
		<div class="overflow-x-auto">
			<table class="min-w-full border border-gray-200 text-sm">
				<thead class="bg-gray-100">
					<tr>
						<th class="border px-3 py-2">Sr.No</th>
						<th class="border px-3 py-2">Date</th>
						<th class="border px-3 py-2">GRN No</th>
						<th class="border px-3 py-2">Supplier</th>
						<th class="border px-3 py-2 text-right">Taxable</th>
						<th class="border px-3 py-2 text-right">VAT</th>
						<th class="border px-3 py-2 text-right">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$pur_tax = 0; 
					$pur_vat = 0;
					if(!empty($purchase_records)){
						$i=1;
						foreach($purchase_records as $row){
							$total = $row->taxable + $row->vat;
							$pur_tax += $row->taxable;
							$pur_vat += $row->vat;
					?>
					<tr>
						<td class="border px-3 py-2"><?php echo $i++; ?></td>
						<td class="border px-3 py-2"><?php echo date('d-M-Y',strtotime($row->grn_date)); ?></td>
						<td class="border px-3 py-2"><?php echo $row->grn_code; ?></td>
						<td class="border px-3 py-2"><?php echo $row->supplier_name; ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($row->taxable,2); ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($row->vat,2); ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($total,2); ?></td>
					</tr>
					<?php }} else { ?>
					<tr><td colspan="7" class="text-center py-4">No Purchase VAT Records</td></tr>
					<?php } ?>
				</tbody>
				<tfoot class="bg-gray-100 font-semibold">
					<tr>
						<td colspan="4" class="border px-3 py-2">Total</td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($pur_tax,2); ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($pur_vat,2); ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($pur_tax+$pur_vat,2); ?></td>
					</tr>
				</tfoot>
			</table>
		</div>


		<!-- ================= PURCHASE VAT (SRN WISE) ================= -->
		<h6 class="mt-10 text-md font-semibold text-gray-700">Purchase / Input VAT (SRN Wise)</h6>
		<div class="overflow-x-auto">
			<table class="min-w-full border border-gray-200 text-sm">
				<thead class="bg-gray-100">
					<tr>
						<th class="border px-3 py-2">Sr.No</th>
						<th class="border px-3 py-2">Date</th>
						<th class="border px-3 py-2">SRN No</th>
						<th class="border px-3 py-2">Supplier</th>
						<th class="border px-3 py-2 text-right">Taxable</th>
						<th class="border px-3 py-2 text-right">VAT</th>
						<th class="border px-3 py-2 text-right">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$srn_tax = 0; 
					$srn_vat = 0;
					if(!empty($srn_records)){
						$i=1;
						foreach($srn_records as $row){
							$total = $row->taxable + $row->vat;
							$srn_tax += $row->taxable;
							$srn_vat += $row->vat;
					?>
					<tr>
						<td class="border px-3 py-2"><?php echo $i++; ?></td>
						<td class="border px-3 py-2"><?php echo date('d-M-Y',strtotime($row->srn_date)); ?></td>
						<td class="border px-3 py-2"><?php echo $row->srn_no; ?></td>
						<td class="border px-3 py-2"><?php echo $row->supplier_name; ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($row->taxable,2); ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($row->vat,2); ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($total,2); ?></td>
					</tr>
					<?php }} else { ?>
					<tr><td colspan="7" class="text-center py-4">No SRN VAT Records</td></tr>
					<?php } ?>
				</tbody>
				<tfoot class="bg-gray-100 font-semibold">
					<tr>
						<td colspan="4" class="border px-3 py-2">Total</td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($srn_tax,2); ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($srn_vat,2); ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($srn_tax+$srn_vat,2); ?></td>
					</tr>
				</tfoot>
			</table>
		</div>

		<!-- ================= VOUCHER VAT ================= -->
		<h6 class="mt-10 text-md font-semibold text-gray-700">Voucher VAT</h6>
		<div class="overflow-x-auto">
			<table class="min-w-full border border-gray-200 text-sm">
				<thead class="bg-gray-100">
					<tr>
						<th class="border px-3 py-2">Sr.No</th>
						<th class="border px-3 py-2">Date</th>
						<th class="border px-3 py-2">Voucher No</th>
						<th class="border px-3 py-2">Type</th>
						<th class="border px-3 py-2">VAT Direction</th>
						<th class="border px-3 py-2 text-right">Taxable</th>
						<th class="border px-3 py-2 text-right">VAT</th>
						<th class="border px-3 py-2 text-right">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$voucher_input_vat = 0;
					$voucher_output_vat = 0;
					if (!empty($voucher_records) && (!empty($voucher_records->input) || !empty($voucher_records->output))) {
						$i = 1;
						$voucher_rows = array_merge($voucher_records->input, $voucher_records->output);
						foreach ($voucher_rows as $row) {
							$voucher_vat = (float)($row->vat_amount ?? 0);
							$voucher_taxable = (float)($row->taxable_amount ?? 0);
							if ((int)$row->account_id === 228) {
								$voucher_output_vat += $voucher_vat;
								$direction = 'Output (Cr)';
							} else {
								$voucher_input_vat += $voucher_vat;
								$direction = 'Input (Dr)';
							}
					?>
					<tr>
						<td class="border px-3 py-2"><?php echo $i++; ?></td>
						<td class="border px-3 py-2"><?php echo date('d-M-Y', strtotime($row->voucher_date)); ?></td>
						<td class="border px-3 py-2"><?php echo htmlspecialchars($row->voucher_code ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
						<td class="border px-3 py-2"><?php echo htmlspecialchars($row->voucher_type ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
						<td class="border px-3 py-2"><?php echo $direction; ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($voucher_taxable, 2); ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($voucher_vat, 2); ?></td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($voucher_taxable + $voucher_vat, 2); ?></td>
					</tr>
					<?php } } else { ?>
					<tr><td colspan="8" class="text-center py-4">No Voucher VAT Records</td></tr>
					<?php } ?>
				</tbody>
				<tfoot class="bg-gray-100 font-semibold">
					<tr>
						<td colspan="6" class="border px-3 py-2">Total Voucher VAT</td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($voucher_input_vat + $voucher_output_vat, 2); ?></td>
						<td class="border px-3 py-2 text-right">Output: <?php echo number_format($voucher_output_vat, 2); ?> / Input: <?php echo number_format($voucher_input_vat, 2); ?></td>
					</tr>
				</tfoot>
			</table>
		</div>


		<!-- ================= VAT SUMMARY ================= -->
		<h6 class="mt-10 text-md font-semibold text-gray-700">VAT Computation Summary</h6>
		<div class="overflow-x-auto">
			<table class="min-w-full border border-gray-200 text-sm">
				<tbody>
					<tr>
						<td class="border px-3 py-2">Total Output VAT (Sales + Vouchers)</td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($sales_vat + $voucher_output_vat,2); ?></td>
					</tr>
					<tr>
						<td class="border px-3 py-2">Less : Total Input VAT (GRN)</td>
						<td class="border px-3 py-2 text-right"><?php echo number_format($pur_vat,2); ?></td>
					</tr>
					<tr>
						<td class="border px-3 py-2">Less : Total Input VAT (SRN + Vouchers)</td>
						<td class="border px-3 py-2 text-right"><?php echo number_format(($srn_vat ?? 0) + $voucher_input_vat,2); ?></td>
					</tr>
					<tr class="bg-gray-100 font-semibold">
						<td class="border px-3 py-2">Net VAT Payable / Refundable</td>
						<td class="border px-3 py-2 text-right">
							<?php echo number_format($sales_vat + $voucher_output_vat - $pur_vat - ($srn_vat ?? 0) - $voucher_input_vat,2); ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>
