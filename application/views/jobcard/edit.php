<style>
		.modal-overlay {
			position: fixed;
			inset: 0;
			background: rgba(0, 0, 0, 0.6);
			display: none;
			align-items: center;
			justify-content: center;
			z-index: 9999;
		}

		.modal-overlay.show {
			display: flex;
		}

		.modal-box {
			background: white;
			border-radius: 12px;
			padding: 16px;
			position: relative;
		}
	</style>
<div class="w-full bg-white rounded-2xl shadow-md p-6">
	<?php if ($this->session->flashdata('success')): ?>
		<div class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
			<?= htmlspecialchars($this->session->flashdata('success')) ?>
		</div>
	<?php endif; ?>

	<?php if ($this->session->flashdata('error')): ?>
		<div class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
			<?= htmlspecialchars($this->session->flashdata('error')) ?>
		</div>
	<?php endif; ?>
	
	<form method="post" action="<?= base_url('index.php/Jobcard/updatejobcard'); ?>" class="p-6 bg-white">
		<input type="hidden" name="jobcard_id" value="<?= $jobcard_id ?>">
		<input type="hidden" name="vehicle_id" id="hiddenVehicleIdJ" value="<?= $vehicle->vehicle_id ?>">


		<div class="page-header flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-4">

			<!-- Title -->
			<h2 class="text-xl font-bold text-center lg:text-left">
				Job Card edit
			</h2>

			<!-- Action Buttons -->
			<div class="flex flex-col sm:flex-row sm:flex-wrap gap-2 justify-center lg:justify-end">

				<button type="submit"
					class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded">
					Save Job Card
				</button>

				<a href="<?= base_url('index.php/Jobcard/view/' . $jobcard_id); ?>"
					class="w-full sm:w-auto text-center px-6 py-2 bg-gray-300 rounded">
					View
				</a>
				<?php if ($jobcardstatus == "Scheduled") { ?>
					<a href="<?= base_url('index.php/Invoice/generate'); ?>"
						class="w-full sm:w-auto text-center px-6 py-2 bg-gray-300 rounded">
						Invoice
					</a>
				<?php } ?>

				<?php if ($jobcardstatus == "Scheduled") { ?>
					<a href="<?= base_url('index.php/MaterialIssue/create/' . $jobcard_id) ?>"
						class="w-full sm:w-auto text-center px-4 py-2 bg-indigo-600 text-white rounded">
						Spareparts Issue
					</a>
				<?php } ?>

				<a href="<?= base_url('index.php/Jobcard'); ?>"
					class="w-full sm:w-auto text-center px-6 py-2 bg-gray-300 rounded">
					Cancel
				</a>

			</div>
		</div>

		<hr class="border-gray-300 mb-6">
		<!-- CUSTOMER / VEHICLE INFO -->


<div class="bg-white rounded-2xl shadow-md mb-6 overflow-hidden">

    <!-- Header -->
    <div class="px-6 py-3 font-semibold text-lg bg-gray-100 border-b">
        Vehicle & Customer Details
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm border-collapse min-w-[1100px]">

            <!-- Fixed column widths -->
            <colgroup>
                <col style="width:13%;">
                <col style="width:20.33%;">
                <col style="width:13%;">
                <col style="width:20.33%;">
                <col style="width:13%;">
                <col style="width:20.33%;">
            </colgroup>

            <tbody>

                <!-- =====================================================
                     ROW 1 : DATE / TIME / BRANCH / JOB CARD
                ====================================================== -->
                <tr class="border-b">

                    <!-- Date & Time Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        Date & Time
                    </td>

                    <!-- Date + Time -->
                    <td class="px-3 py-2 align-middle">
                        <div class="flex gap-2">

                            <!-- Date -->
                            <input
                                type="date"
                                name="jobcard_date"
                                class="w-full border rounded px-2 py-1.5"
                                value="<?= htmlspecialchars($jobcard->jobcard_date ?? date('Y-m-d')) ?>"
                            >

                            <!-- Time -->
                            <input
                                type="time"
                                name="jobcard_time"
                                class="w-full border rounded px-2 py-1.5"
                                value="<?= !empty($jobcard->jobcard_time)
                                    ? htmlspecialchars($jobcard->jobcard_time)
                                    : date('H:i') ?>"
                            >

                        </div>
                    </td>


                    <?php
                    $selected_branch_id = !empty($jobcard->branch_id)
                        ? $jobcard->branch_id
                        : (!empty($estimation->branch_id)
                            ? $estimation->branch_id
                            : ($inspection->branch_id ?? null));
                    ?>

                    <!-- Branch Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        Branch
                    </td>

                    <!-- Branch -->
                    <td class="px-3 py-2 align-middle">

                        <?= render_branch_select_dropdown(
                            'branch_id',
                            $selected_branch_id
                        ) ?>

                        <input
                            type="hidden"
                            name="branch_id"
                            value="<?= htmlspecialchars($selected_branch_id ?? '') ?>"
                        >

                    </td>


                    <!-- Job Card No Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        Job Card No
                    </td>

                    <!-- Job Card No -->
                    <td class="px-3 py-2 align-middle">

                        <input
                            type="text"
                            class="w-full border rounded px-2 py-1.5 bg-gray-100"
                            value="<?= htmlspecialchars($jobcard_no ?? '') ?>"
                            readonly
                        >

                    </td>

                </tr>


                <!-- =====================================================
                     ROW 2 : CUSTOMER / ESTIMATION / CONTACT
                ====================================================== -->
                <tr class="border-b">

                    <!-- Customer Name Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        Customer Name
                    </td>

                    <!-- Customer Name -->
                    <td class="px-3 py-2 align-middle">

                        <input
                            type="text"
                            class="w-full border rounded px-2 py-1.5 bg-gray-100"
                            value="<?= htmlspecialchars(
                                $appointment->customer_name
                                    ?? $customer->name
                                    ?? ''
                            ) ?>"
                            readonly
                        >

                    </td>


                    <!-- Estimation No Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        Estimation No
                    </td>

                    <!-- Estimation No -->
                    <td class="px-3 py-2 align-middle">

                        <input
                            type="text"
                            class="w-full border rounded px-2 py-1.5 bg-gray-100"
                            value="<?= htmlspecialchars($estimation_nos ?? '') ?>"
                            readonly
                        >

                    </td>


                    <!-- Customer Contact Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        Customer Contact No
                    </td>

                    <!-- Customer Contact -->
                    <td class="px-3 py-2 align-middle">

                        <input
                            type="text"
                            class="w-full border rounded px-2 py-1.5 bg-gray-100"
                            value="<?= htmlspecialchars(
                                $appointment->phone
                                    ?? $customer->phone
                                    ?? ''
                            ) ?>"
                            readonly
                        >

                    </td>

                </tr>


                <!-- =====================================================
                     ROW 3 : VEHICLE MODEL / EMAIL / REGISTRATION
                ====================================================== -->
                <tr class="border-b">

                    <!-- Vehicle Model Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        Vehicle Model
                    </td>

                    <!-- Vehicle Model -->
                    <td class="px-3 py-2 align-middle">

                        <input
                            type="text"
                            id="vehicleModelFieldJ"
                            class="w-full border rounded px-2 py-1.5 bg-gray-100"
                            value="<?= htmlspecialchars(
                                $appointment->model
                                    ?? $vehicle->model
                                    ?? ''
                            ) ?>"
                            readonly
                        >

                    </td>


                    <!-- Email Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        Email
                    </td>

                    <!-- Email -->
                    <td class="px-3 py-2 align-middle">

                        <input
                            type="email"
                            class="w-full border rounded px-2 py-1.5 bg-gray-100"
                            value="<?= htmlspecialchars(
                                $appointment->email
                                    ?? $customer->email
                                    ?? ''
                            ) ?>"
                            readonly
                        >

                    </td>


                    <!-- Registration Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        Registration No
                    </td>

                    <!-- Registration -->
                    <td class="px-3 py-2 align-middle">

                        <select
                            id="vehicleSelectJ"
                            name="vehicle_select"
                            class="w-full border rounded px-2 py-1.5"
                        >

                            <option value="">
                                -- Select Vehicle --
                            </option>

                            <option value="ADD_NEW">
                                -- Add New Vehicle --
                            </option>

                            <?php foreach ($all_vehicles as $v): ?>

                                <option
                                    value="<?= $v->vehicle_id ?>"
                                    data-model="<?= htmlspecialchars($v->model ?? '') ?>"
                                    data-vin="<?= htmlspecialchars($v->chassis_no ?? '') ?>"
                                    data-plate="<?= htmlspecialchars($v->registration_no ?? '') ?>"
                                    <?= ($v->vehicle_id == $vehicle->vehicle_id)
                                        ? 'selected'
                                        : '' ?>
                                >
                                    <?= htmlspecialchars($v->registration_no ?? '') ?>
                                </option>

                            <?php endforeach; ?>

                        </select>


                        <!-- Existing Registration Text Field
                        <input
                            type="text"
                            id="plateNoFieldJ"
                            class="w-full border rounded px-2 py-1.5 bg-gray-100 mt-2"
                            value="<?= htmlspecialchars(
                                $appointment->registration_no
                                    ?? $vehicle->registration_no
                                    ?? ''
                            ) ?>"
                            readonly
                        >
                        -->

                    </td>

                </tr>


                <!-- =====================================================
                     ROW 4 : VIN / KM / DELIVERY DATE
                ====================================================== -->
                <tr class="border-b">

                    <!-- VIN Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        Vehicle VIN No
                    </td>

                    <!-- VIN -->
                    <td class="px-3 py-2 align-middle">

                        <input
                            type="text"
                            id="vinNoFieldJ"
                            class="w-full border rounded px-2 py-1.5 bg-gray-100"
                            value="<?= htmlspecialchars(
                                $appointment->chassis_no
                                    ?? $vehicle->chassis_no
                                    ?? ''
                            ) ?>"
                            readonly
                        >

                    </td>


                    <!-- KM Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        KM's In
                    </td>

                    <!-- KM -->
                    <td class="px-3 py-2 align-middle">

                        <input
                            type="number"
                            name="kmin"
                            step="0.01"
                            min="0"
                            class="w-full border rounded px-2 py-1.5"
                            value="<?= htmlspecialchars($kms ?? '') ?>"
                        >

                    </td>


                    <!-- Estimated Delivery Date Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        Estimated Delivery Date
                    </td>

                    <!-- Estimated Delivery Date -->
                    <td class="px-3 py-2 align-middle">

                        <input
                            type="date"
                            name="estdate"
                            value="<?= htmlspecialchars(
                                $jobcard->expected_delivery_date
                                    ?? $estimation->est_delivery_date
                                    ?? ''
                            ) ?>"
                            class="w-full border rounded px-2 py-1.5"
                        >

                    </td>

                </tr>


                <!-- =====================================================
                     ROW 5 : COMPLETION TIME / REMARK / STATUS
                ====================================================== -->
                <tr>

                    <!-- Completion Time Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        Completion Time
                    </td>

                    <!-- Completion Time -->
                    <td class="px-3 py-2 align-middle">

                        <input
                            type="time"
                            name="ctime"
                            value="<?= htmlspecialchars(
                                $jobcard->completion_time
                                    ?? $estimation->est_completion_time
                                    ?? ''
                            ) ?>"
                            class="w-full border rounded px-2 py-1.5"
                        >

                    </td>


                    <!-- Remark Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        Remark
                    </td>

                    <!-- Remark -->
                    <td class="px-3 py-2 align-middle">

                        <textarea
                            name="remarks"
                            class="w-full border rounded px-2 py-1.5 min-h-[42px] resize-y"
                        ><?= htmlspecialchars($estimation->remarks ?? '') ?></textarea>

                    </td>


                    <!-- Status Label -->
                    <td class="px-3 py-2 font-medium bg-gray-50 border-r align-middle whitespace-nowrap">
                        Status
                    </td>

                    <!-- Status -->
                    <td class="px-3 py-2 align-middle">

                        <select
                            name="status"
                            class="w-full border rounded px-2 py-1.5"
                        >

                            <option value="">
                                Select Status
                            </option>

                            <option
                                value="Scheduled"
                                <?= ($jobcard->status == 'Scheduled')
                                    ? 'selected'
                                    : '' ?>
                            >
                                Scheduled
                            </option>

                            <option
                                value="In Progress"
                                <?= ($jobcard->status == 'In Progress')
                                    ? 'selected'
                                    : '' ?>
                            >
                                In Progress
                            </option>

                            <option
                                value="Finished"
                                <?= (
                                    $jobcard->status == 'Finished'
                                    || empty($jobcard->status)
                                )
                                    ? 'selected'
                                    : '' ?>
                            >
                                Finished
                            </option>

                            <option
                                value="Service Completed"
                                <?= ($jobcard->status == 'Service Completed') ? 'selected' : '' ?>
                            >
                                Service Completed
                            </option>

                        </select>

                    </td>

                </tr>

            </tbody>
        </table>
    </div>
</div>
		<!-- ============================================== -->

		<div class="bg-white rounded-2xl shadow-md mt-6 overflow-hidden">

			<div class="px-6 py-3 font-semibold text-lg bg-gray-100 border-b">
				Services
			</div>

			<div class="p-4">
				<div class="overflow-x-auto">
					<table class="w-full text-sm border-collapse min-w-[900px]" id="serviceTable">

						<thead>
							<tr class="bg-gray-50 border">
								<th class="border px-3 py-2 w-[90px] text-center">Sl No</th>
								<th class="border px-3 py-2">Service</th>
								<th class="border px-3 py-2 text-center">Estimated Time</th>
								<th class="border px-3 py-2 text-center">Estimated Cost</th>
								<th class="border px-3 py-2 text-center">Total Cost</th>
								<th class="border px-3 py-2 text-center">Technician</th>
								<!-- <th class="border px-3 py-2 w-[90px] text-center">Actions</th> -->
							</tr>
						</thead>
						<tbody>
							<?php
							// foreach ($job_descriptions as $i => $s):
							$service_grand_total = 0;
							foreach ($services_used as $i => $s):
								$service_grand_total += (float) $s->total_cost;
							?>
								<tr class="border hover:bg-gray-50">
									<td class="border px-3 py-2 text-center font-medium"><?= $i + 1 ?></td>

									<td class="border px-3 py-2">
										<select name="service_name2242[]"
											class="w-full border rounded px-2 py-1 serviceSelect" disabled>
											<option value="">-- Select 345 --</option>
											<?php foreach ($services_master as $sm): ?>
												<option value="<?= $sm->master_service_id ?>"
													<?= $sm->master_service_id == $s->service_id ? 'selected' : '' ?>>
													<?= $sm->service_name ?>
												</option>
											<?php endforeach; ?>
										</select>

										<!-- Hidden field actually submitted -->
										<input type="hidden" name="service_name[]" value="<?= $s->service_id ?>">
									</td>

									<td class="border px-3 py-2">

										<input name="service_esttime[]" value="<?= $s->estimated_time ?>"
											class="w-full border rounded px-2 py-1 text-center partQty" readonly>
									</td>
									<td class="border px-3 py-2">

										<input name="service_estcost[]" value="<?= $s->estimated_cost ?>"
											class="w-full border rounded px-2 py-1 text-center partQty" readonly>
									</td>



									<td class="border px-3 py-2">

										<input name="service_amt[]" value="<?= $s->total_cost ?>"
											class="w-full border rounded px-2 py-1 text-center partQty" readonly>
									</td>

									<!-- Technician Dropdown -->
									<td class="border px-3 py-2">
										<select name="technician_id[]"
											class="w-full border rounded-lg px-2 py-2 focus:ring-2 focus:ring-blue-300">
											<option value="">-- Select Technician --</option>
											<?php foreach ($technicians as $t): ?>
												<option value="<?= $t->employee_id ?>"
													<?= isset($s->employee_id) && $s->employee_id == $t->employee_id ? 'selected' : '' ?>>
													<?= $t->employee_name ?>
												</option>
											<?php endforeach; ?>

										</select>


									</td>


									<!-- <td class="border px-3 py-2 text-center">
									<button type="button"
										class="remove-row text-red-600 hover:bg-red-50 px-3 py-1 rounded">
										✕
									</button>
								</td> -->
								</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr class="bg-gray-100 font-semibold border">
								<td class="border px-3 py-2 text-center" colspan="4">
									Total
								</td>

								<td class="border px-3 py-2 text-center">
									<?= number_format($service_grand_total, 2) ?>
								</td>

								<td class="border px-3 py-2"></td>
							</tr>
						</tfoot>

					</table>
				</div>
				   


				<!-- <button type="button" id="addService"
					class="mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow-sm">
					+ Add Service
				</button> -->
			</div>
		</div>
		<!-- ============================================  -->
		<div class="bg-white rounded-2xl shadow-md mt-6 overflow-hidden">

			<div class="px-6 py-3 font-semibold text-lg bg-gray-100 border-b">
				Spare Parts Used
			</div>

			<div class="overflow-x-auto">
				<table class="w-full text-sm border-collapse min-w-[900px]" id="partsTable">
					<thead>
						<tr class="bg-gray-50 border">
							<th class="border px-3 py-2 w-[50px] text-center">#</th>
							<th class="border px-3 py-2 w-[300px] text-center">Part</th>
							<th class="border px-3 py-2 w-[150px] text-center">Part Type</th>
							<th class="border px-3 py-2 w-[100px] text-center">Qty</th>
							<th class="border px-3 py-2 w-[100px] text-center">Unit Price</th>
							<th class="border px-3 py-2 w-[100px] text-center">Discount Amt</th>
							<th class="border px-3 py-2 w-[100px] text-center">Total Cost</th>
							<!-- <th class="border px-3 py-2 w-[70px] text-center">Action</th> -->
						</tr>
					</thead>
					<tbody>
						<?php
						$parts_grand_total = 0;
						foreach ($parts_used as $i => $p):
							$parts_grand_total += (float) $p->total_price;
						?>
							<tr class="border hover:bg-gray-50">
								<td class="border px-3 py-2 text-center font-medium"><?= $i + 1 ?></td>

								<td class="border px-3 py-2">
									<select name="part_id[]"
										class="w-full border rounded px-2 py-1" disabled>
										<?php foreach ($parts as $part): ?>
											<option value="<?= $part->part_id ?>"
												<?= $part->part_id == $p->part_id ? 'selected' : '' ?>>
												<?= $part->part_name ?>
											</option>
										<?php endforeach; ?>
									</select>

									<!-- Hidden input for submission -->
									<input type="hidden" name="part_id[]" value="<?= $p->part_id ?>">
								</td>
								<td class="border px-3 py-2">
									<input name="part_type[]" value="<?= $p->part_type ?>"
										class="w-full border rounded px-2 py-1 text-center parttype" readonly>
								</td>

								<td class="border px-3 py-2">
									<input name="part_qty[]" value="<?= $p->qty ?>"
										class="w-full border rounded px-2 py-1 text-center partQty" readonly>
								</td>
								<td class="border px-3 py-2">
									<input name="part_sellprice[]" value="<?= $p->selling_price ?>"
										class="w-full border rounded px-2 py-1 text-center sellprice" readonly>
								</td>
								<td class="border px-3 py-2">
									<input name="part_disamt[]" value="<?= !empty($p->disamount) ? $p->disamount : '' ?>"

										class="w-full border rounded px-2 py-1 text-center disamt" readonly>
								</td>
								<td class="border px-3 py-2">
									<input name="part_totalprice[]" value="<?= $p->total_price ?>"
										class="w-full border rounded px-2 py-1 text-center totalprice" readonly>
								</td>



								<!-- <td class="border px-3 py-2 text-center">
									<button type="button"
										class="remove-row text-red-600 hover:bg-red-50 px-3 py-1 rounded">
										✕
									</button>
								</td> -->
							</tr>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr class="bg-gray-100 font-semibold border">
							<td class="border px-3 py-2 text-center" colspan="6">
								Total Parts Cost
							</td>

							<td class="border px-3 py-2 text-center">
								<?= number_format($parts_grand_total, 2) ?>
							</td>
						</tr>
					</tfoot>

				</table>
			</div>

			<!-- <button type="button" id="addPart"
					class="mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow-sm">
					+ Add Part
				</button> -->
		</div>
		<!-- ========================================================================== -->
		<div class="bg-white rounded-2xl shadow-md mt-6 overflow-hidden">

			<div class="px-6 py-3 font-semibold text-lg bg-gray-100 border-b">
				Sublet Services
			</div>

			<div class="overflow-x-auto">
				<table class="w-full text-sm border-collapse min-w-[900px]" id="subletTable">
					<thead>
						<tr class="bg-gray-50 border">
							<th class="border px-3 py-2 w-[90px] text-center">Sl No</th>
							<th class="border px-3 py-2">Description</th>

							<th class="border px-3 py-2 text-center">Amount</th>

						</tr>
					</thead>
					<tbody>
						<?php
						//
						$subletservice_grand_total = 0;
						foreach ($job_descriptions as $i => $s):
							$subletservice_grand_total += (float) $s->amount;
						?>
							<tr class="border hover:bg-gray-50">
								<td class="border px-3 py-2 text-center font-medium"><?= $i + 1 ?></td>

								<td class="border px-3 py-2">
									<input name="sublet[]" value="<?= $s->description ?>"
										class="w-full border rounded px-2 py-1 text-center partQty" readonly>
								</td>



								<td class="border px-3 py-2">

									<input name="jobservice_amt[]" value="<?= $s->amount ?>"
										class="w-full border rounded px-2 py-1 text-center partQty" readonly>
								</td>

							</tr>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr class="bg-gray-100 font-semibold border">
							<td class="border px-3 py-2 text-center" colspan="2">
								Total
							</td>

							<td class="border px-3 py-2 text-center">
								<?= number_format($subletservice_grand_total, 2) ?>
							</td>


						</tr>
					</tfoot>

				</table>
			</div>
			<!-- <button type="button" id="addService"
					class="mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow-sm">
					+ Add Service
				</button> -->
		</div>
	</form>

	<!-- ========================================================================== -->
		<div class="bg-white rounded-2xl shadow-md mt-6 overflow-hidden">

			<div class="px-6 py-3 font-semibold text-lg bg-gray-100 border-b">
				Purchase Invoice for Spare Parts
			</div>

			<?php
$invoices = [];

foreach ($purchased_spareparts as $item) {
    $invoice = $item->supplier_ref;

    if (!isset($invoices[$invoice])) {
        $invoices[$invoice] = [
            'invoice_no' => $invoice,
			'supplier_name' => $item->supplier_name,
            'grand_total' => $item->grand_total,
            'parts' => []
        ];
    }

    $invoices[$invoice]['parts'][] = $item;
}
?>

<div class="overflow-x-auto">
    <table class="w-full text-sm border-collapse">
        <thead>
			<tr class="bg-gray-100">
				<th class="border px-3 py-2 w-16">Sl No</th>
				<th class="border px-3 py-2">Invoice No</th>
				<th class="border px-3 py-2">Supplier</th>
				<th class="border px-3 py-2">Spare Part</th>
				<th class="border px-3 py-2 text-right">Amount</th>
				<th class="border px-3 py-2 text-right">Invoice Total</th>
			</tr>
		</thead>

       <tbody>

<?php
$sl = 1;
$total = 0;

foreach ($invoices as $invoice):

    $parts = $invoice['parts'];
    $rowspan = count($parts);
    $total += $invoice['grand_total'];

    foreach ($parts as $index => $part):

        $part_name = !empty($part->part_name)
            ? htmlspecialchars($part->part_name)
            : htmlspecialchars($part->desc);
?>

<tr class="hover:bg-gray-50">

    <?php if ($index == 0): ?>
        <td class="border px-3 py-2 text-center align-top" rowspan="<?= $rowspan ?>">
            <?= $sl++ ?>
        </td>

        <td class="border px-3 py-2 align-top" rowspan="<?= $rowspan ?>">
            <?= htmlspecialchars($invoice['invoice_no']) ?>
        </td>

        <td class="border px-3 py-2 align-top" rowspan="<?= $rowspan ?>">
            <?= htmlspecialchars($invoice['supplier_name']) ?>
        </td>
    <?php endif; ?>

    <td class="border px-3 py-2">
        <div class="font-medium">
            <?= $part_name ?>
        </div>

        <div class="text-xs text-gray-500 mt-1">
            Qty:
            <strong><?= $part->quantity ?> <?= $part->unit_name ?></strong>
        </div>
    </td>

    <td class="border px-3 py-2 text-right">
        <div><?= number_format($part->total,2) ?></div>

        <?php if($part->discount > 0): ?>
            <div class="text-red-600 text-xs">
                Discount: <?= number_format($part->discount,2) ?>
            </div>
        <?php endif; ?>

        <?php if($part->vat_amt > 0): ?>
            <div class="text-blue-600 text-xs">
                VAT: <?= number_format($part->vat_amt,2) ?>
            </div>
        <?php endif; ?>
    </td>

    <?php if ($index == 0): ?>
        <td class="border px-3 py-2 text-right font-semibold align-top"
            rowspan="<?= $rowspan ?>">
            <?= number_format($invoice['grand_total'],2) ?>
        </td>
    <?php endif; ?>

</tr>

<?php
    endforeach;
endforeach;
?>

<tr class="bg-gray-100 font-semibold">
    <td colspan="5" class="border px-3 py-3 text-right">
        Grand Total
    </td>
    <td class="border px-3 py-3 text-right">
        <?= number_format($total,2) ?>
    </td>
</tr>

</tbody>
    </table>
					</div>
		</div>



<!-- ADD NEW VEHICLE MODAL (Jobcard) -->
<div id="addVehicleModalJ" class="modal-overlay">
	<div class="modal-box w-full max-w-2xl">
		<div class="flex justify-between items-center mb-4 pb-3 border-b">
			<h2 class="text-xl font-bold">Add New Vehicle</h2>
			<button type="button" onclick="closeVehicleModalJ()" class="text-2xl font-bold text-gray-500 hover:text-gray-700">&times;</button>
		</div>

		<form id="addVehicleFormJ" method="post" action="<?= base_url('index.php/Customer/save_vehicle_ajax') ?>">
			<input type="hidden" name="customer_id" value="<?= $appointment->customer_id ?? $customer->customer_id ?? '' ?>">

			<div class="space-y-4">
				<div>
					<label class="block text-sm font-medium mb-1">Brand <span class="text-red-500">*</span></label>
					<select name="brand_id" id="newVehicleBrandJ" class="w-full border rounded px-3 py-2">
						<option value="">-- Select Brand --</option>
						<?php if (!empty($vehicle_brands)): ?>
							<?php foreach ($vehicle_brands as $b): ?>
								<option value="<?= $b->brand_id ?>"><?= $b->brand_name ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>

				<div>
					<label class="block text-sm font-medium mb-1">Model <span class="text-red-500">*</span></label>
					<select name="model_id" id="newVehicleModelJ" class="w-full border rounded px-3 py-2">
						<option value="">-- Select Brand First --</option>
					</select>
				</div>

				<div>
					<label class="block text-sm font-medium mb-1">Registration No (Plate) <span class="text-red-500">*</span></label>
					<input type="text" name="registration_no" id="newVehicleRegistrationJ" class="w-full border rounded px-3 py-2">
				</div>

				<div>
					<label class="block text-sm font-medium mb-1">VIN/Chassis No</label>
					<input type="text" name="chassis_no" class="w-full border rounded px-3 py-2">
				</div>

				<div>
					<label class="block text-sm font-medium mb-1">Engine No</label>
					<input type="text" name="engine_no" class="w-full border rounded px-3 py-2">
				</div>

				<div>
					<label class="block text-sm font-medium mb-1">Year</label>
					<input type="number" name="year" class="w-full border rounded px-3 py-2" min="1900" max="2100">
				</div>

				<div>
					<label class="block text-sm font-medium mb-1">Color</label>
					<input type="text" name="color" class="w-full border rounded px-3 py-2">
				</div>

				<div>
					<label class="block text-sm font-medium mb-1">Variant</label>
					<input type="text" name="variant" class="w-full border rounded px-3 py-2">
				</div>
			</div>

			<div class="flex gap-2 mt-6 justify-end">
				<button type="button" onclick="closeVehicleModalJ()" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Cancel</button>
				<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add Vehicle</button>
			</div>
		</form>
	</div>
</div>


<!-- ========================================= script fncs======================== -->
<script>
	function updateVehicleDetailsJ() {
		const select = document.getElementById('vehicleSelectJ');
		if (!select) return;

		const selectedValue = select.value;
		const hiddenVehicleId = document.getElementById('hiddenVehicleIdJ');
		const modelInput = document.getElementById('vehicleModelFieldJ');
		const vinInput = document.getElementById('vinNoFieldJ');
		// const plateInput = document.getElementById('plateNoFieldJ');

		// If "Add New" option selected, open modal
		if (selectedValue === 'ADD_NEW') {
			openVehicleModalJ();
			select.value = '';
			return;
		}

		if (hiddenVehicleId) {
			hiddenVehicleId.value = selectedValue;
		}

		if (!selectedValue) {
			return;
		}

		const option = select.options[select.selectedIndex];

		if (modelInput) {
			modelInput.value = option.dataset.model || '';
		}
		if (vinInput) {
			vinInput.value = option.dataset.vin || '';
		}
		// if (plateInput) {
		// 	plateInput.value = option.dataset.plate || '';
		// }
	}

	// Open vehicle modal (jobcard)
	function openVehicleModalJ() {
		document.getElementById('addVehicleModalJ').classList.add('show');
	}

	// Close vehicle modal (jobcard)
	function closeVehicleModalJ() {
		document.getElementById('addVehicleModalJ').classList.remove('show');
	}

	// Attach modal event listeners after DOM is ready so modal elements exist
	document.addEventListener('DOMContentLoaded', function() {
		const brandSelectJ = document.getElementById('newVehicleBrandJ');
		const modelSelectJ = document.getElementById('newVehicleModelJ');
		const addVehicleFormJ = document.getElementById('addVehicleFormJ');
		const addVehicleModalJ = document.getElementById('addVehicleModalJ');

		

		if (brandSelectJ) brandSelectJ.addEventListener('change', function() {
			const brandId = this.value;

			if (!brandId) {
				if (modelSelectJ) {
					modelSelectJ.innerHTML = '<option value="">-- Select Brand First --</option>';
				}
				return;
			}

			fetch('<?= base_url('index.php/Customer/get_models_by_brand') ?>/' + encodeURIComponent(brandId), {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: 'brand_id=' + encodeURIComponent(brandId)
			})
			.then(response => response.json())
			.then(data => {
				let options = '<option value="">-- Select Model --</option>';
				if (data && data.length > 0) {
					data.forEach(model => {
						options += `<option value="${model.model_id}">${model.model_name}</option>`;
					});
				}
				if (modelSelectJ) modelSelectJ.innerHTML = options;
			})
			.catch(error => {
				console.error('Error fetching models:', error);
				if (modelSelectJ) modelSelectJ.innerHTML = '<option value="">-- Error Loading Models --</option>';
			});
		});

		if (addVehicleFormJ) addVehicleFormJ.addEventListener('submit', function(e) {
		e.preventDefault();

		const brandEl = document.getElementById('newVehicleBrandJ');
		const modelEl = document.getElementById('newVehicleModelJ');
		const regEl = document.getElementById('newVehicleRegistrationJ');

		if (!brandEl || !brandEl.value) {
			alert('Please select a brand');
			if (brandEl) brandEl.focus();
			return;
		}
		if (!modelEl || !modelEl.value) {
			alert('Please select a model');
			if (modelEl) modelEl.focus();
			return;
		}
		if (!regEl || !regEl.value.trim()) {
			alert('Please enter the registration number');
			if (regEl) regEl.focus();
			return;
		}

		const formData = new FormData(this);
		console.log('Saving vehicle', [...formData.entries()]);

		fetch('<?= base_url('index.php/Customer/save_vehicle_ajax') ?>', {
			method: 'POST',
			body: formData
		})
		.then(response => response.json())
		.then(data => {
			console.log('Vehicle save response', data);
			if (data.status === 'success') {
				alert('Vehicle added successfully!');
				closeVehicleModalJ();
				location.reload();
			} else {
				alert('Error: ' + (data.message || 'Unknown error'));
			}
		})
		.catch(error => {
			console.error('Error adding vehicle:', error);
			alert('Error adding vehicle');
		});
	});

	if (addVehicleModalJ) addVehicleModalJ.addEventListener('click', function(e) {
		if (e.target === this) {
			closeVehicleModalJ();
		}
	});
	const vehicleSelectJ = document.getElementById('vehicleSelectJ');

			if (vehicleSelectJ) {
				vehicleSelectJ.addEventListener('change', updateVehicleDetailsJ);
			}
	});
	document.addEventListener('DOMContentLoaded', function () {
    const branchSelect = document.querySelector('select[name="branch_id"]');

    if (branchSelect) {
        branchSelect.disabled = true;
    }
});
	</script>
