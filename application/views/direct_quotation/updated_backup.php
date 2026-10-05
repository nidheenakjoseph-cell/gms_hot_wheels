<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- SELECT2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- SELECT2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

    html,
    body {
        height: 100%;
        margin: 0;
        overflow-x: hidden;
    }

    .content-wrapper,
    .main-content,
    .page-content {
        height: auto !important;
        overflow-y: visible !important;
    }
</style>
<div class="w-full mx-0">

    <form method="post" action="<?= base_url('index.php/Estimation/update'); ?>" class="p-6 bg-white">
        <input type="hidden" name="estimation_id" value="">

        <!-- ================================ -->

        <?php if ($this->session->flashdata('error')): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>


        <div class="page-header flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-4">

            <!-- Title -->
            <h2 class="text-xl font-bold text-center lg:text-left">
                Direct Quotation
            </h2>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row sm:flex-wrap gap-2 justify-center lg:justify-end">

                <!-- <button type="submit"
					class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded">
					Update
				</button> -->

                <!-- EDIT BUTTON -->
                <button type="button"
                    id="editBtn"
                    onclick="enableEditMode()"
                    class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded">
                    Edit
                </button>

                <!-- UPDATE BUTTON (hidden initially) -->
                <button type="submit"
                    id="updateBtn"
                    class="hidden w-full sm:w-auto px-6 py-2 bg-green-600 text-white rounded">
                    Update
                </button>
                <!-- CANCEL EDIT BUTTON -->
                <button type="button"
                    id="cancelEditBtn"
                    onclick="cancelEditMode()"
                    class="hidden px-6 py-2 bg-gray-500 text-white rounded">
                    Cancel Edit
                </button>

                <a href=""
                    class="w-full sm:w-auto text-center px-6 py-2 bg-gray-400 text-white rounded">
                    View &amp; Print
                </a>

                <a href=""
                    class="w-full sm:w-auto text-center px-6 py-2 bg-blue-400 text-white rounded">
                    Quotation
                </a>

                <a href=""
                    class="w-full sm:w-auto text-center px-6 py-2 bg-gray-300 rounded">
                    Cancel
                </a>

            </div>
        </div>

        <hr class="border-gray-300 mb-6">
        <!-- REVISION OPTION -->
        <div id="revisionWrap"
            class="hidden mt-3 px-4 py-3 
           bg-yellow-50 border border-yellow-400 rounded-lg
           text-yellow-800 font-semibold shadow-sm
           flex flex-wrap items-center gap-4">

            <!-- Checkbox -->
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox"
                    name="create_revision"
                    value="1"
                    class="w-5 h-5 accent-yellow-600">

                Create Revision
            </label>

            <!-- Last Revision -->
            <div class="flex items-center gap-2">
                <span class="text-sm">Last Rev:</span>

                <input type="text"
                    value=""
                    readonly
                    class="w-16 px-2 py-1 text-center font-bold
                   bg-gray-100 border border-gray-400 rounded">
            </div>

            <!-- Next Revision -->
            <div class="flex items-center gap-2">
                <span class="text-sm">Next Rev:</span>

                <input type="text"
                    name="revision_no"
                    value=""
                    readonly
                    class="w-16 px-2 py-1 text-center font-bold
                   bg-yellow-100 border border-yellow-500 rounded">
            </div>

        </div>

        <!-- ============================================= -->





        <!-- CUSTOMER / VEHICLE INFO -->
        <!-- VEHICLE & CUSTOMER DETAILS -->
        <!-- <div class="bg-white rounded-2xl shadow-md mb-6 p-2"> -->
        <div class="w-full mx-0">
            <h3 class="font-semibold mb-4">Vehicle & Customer Details</h3>

            <div class="relative w-full overflow-x-auto overflow-y-visible">

                <table class="w-full border mb-4 text-sm min-w-[600px]">
                    <tbody>

                        <!-- ROW 1 -->
                        <tr>
                            <td class="border p-2 font-medium">Date</td>
                            <td class="border p-2">
                                <input type="date" id="edate" name="edate" class="w-full border rounded px-2 py-1 "
                                    value="">
                            </td>

                            <td class="border p-2 font-medium">Time</td>
                            <td class="border p-2">
                                <input type="time" class="w-full border rounded px-2 py-1 "
                                    value="">
                            </td>

                            <td class="border p-2 font-medium">Estimation No</td>
                            <td class="border p-2">
                                <input type="text" class="w-full border rounded px-2 py-1 "
                                    value="">
                            </td>
                        </tr>

                        <!-- ROW 2 -->
                        <tr>
                            <td class="border p-2 font-medium">Customer Name</td>
                            <td class="border p-2">
                                <input type="text" class=" w-full border rounded px-2 py-1"
                                    value="">
                            </td>

                            <td class="border p-2 font-medium">Contact No</td>
                            <td class="border p-2">
                                <input type="text" class=" w-full border rounded px-2 py-1"
                                    value="">
                            </td>

                            <td class="border p-2 font-medium">Email</td>
                            <td class="border p-2">
                                <input type="email" class=" w-full border rounded px-2 py-1"
                                    value="">
                            </td>
                        </tr>

                        <!-- ROW 3 -->
                        <tr>
                            <td class="border p-2 font-medium">Vehicle Model</td>
                            <td class="border p-2">
                                <input type="text" class="w-full border rounded px-2 py-1 "
                                    value="">
                            </td>

                            <td class="border p-2 font-medium">Plate No</td>
                            <td class="border p-2">
                                <input type="text" class="w-full border rounded px-2 py-1 "
                                    value="">
                            </td>

                            <td class="border p-2 font-medium">VIN No</td>
                            <td class="border p-2">
                                <input type="text" class="w-full border rounded px-2 py-1 "
                                    value="">
                            </td>
                        </tr>

                        <!-- ROW 4 -->
                        <tr>
                            <!-- <td class="border p-2 font-medium">Job Card No</td>
						<td class="border p-2">
							<input type="text" class="w-full border rounded px-2 py-1">
						</td> -->

                            <td class="border p-2 font-medium">KM In</td>
                            <td class="border p-2">
                                <input type="number" name="kmin" class=" w-full border rounded px-2 py-1" value="">
                            </td>

                            <td class="border p-2 font-medium">Customer Approval</td>
                            <td class="border p-2">
                                <select class="w-full border rounded px-2 py-1" name="custapproval">
                                    <option value="">-- Select --</option>
                                    <option value="APPROVED">Approved</option>
                                    <option value="PENDING">Pending</option>
                                    <option value="REJECTED">Rejected</option>
                                </select>
                            </td>

                            <td class="border p-2 font-medium">Estimated Price</td>
                            <td class="border p-2">
                                <input type="number"
                                    step="0.01"
                                    class=" w-full border rounded px-2 py-1"
                                    name="estimatedprice"
                                    value="">
                            </td>
                        </tr>

                        <!-- ROW 5 -->
                        <tr>


                            <td class="border p-2 font-medium">Estimated Delivery Date</td>
                            <td class="border p-2">
                                <input type="date" class=" w-full border rounded px-2 py-1" name="estdeldate" value="">
                            </td>

                            <td class="border p-2 font-medium">Completion Time</td>
                            <td class="border p-2">
                                <input type="time" class=" w-full border rounded px-2 py-1" name="completiontime" value="">
                            </td>

                            <td class="border p-2 font-medium">Remark</td>
                            <td class="border p-2" colspan="5">
                                <textarea class=" w-full border rounded px-2 py-1 h-10" name="remarks"></textarea>
                            </td>
                        </tr>



                    </tbody>
                </table>
            </div>
        </div>
        <hr class="border-gray-300 mb-6">
        <!-- ====================services table========================================= -->
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">
                Services
            </h3>

            <button type="button" id="addService_set"
                class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <span class="text-lg">+</span> Add Service
            </button>
        </div>

        <!-- Table -->
        <!-- <div class="relative w-full overflow-x-auto overflow-y-visible"> -->
        <div>
            <table class="w-full border-collapse text-sm" id="serviceTable">

                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="border px-3 py-2 w-16 text-center">#</th>
                        <th class="border px-3 py-2">Service</th>
                        <th class="border px-3 py-2 w-24 text-center">Time (Hr)</th>
                        <th class="border px-3 py-2 w-32 text-right">Estimated Cost</th>
                        <th class="border px-3 py-2 w-32 text-right">Total Cost</th>
                        <th class="border px-3 py-2 w-20 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="hover:bg-gray-50 transition">
                        <!-- SL -->

                        <td class="border px-2 py-2 text-center font-medium row-number">
                            <?= 1 ?>
                        </td>

                        <!-- Service -->
                        <td class="border px-2 py-2">
                            <select name="service_id[]" id="serviceSelect"
                                class=" serviceSelect w-full border rounded-lg px-2 py-1 focus:ring-2 focus:ring-blue-300">
                                <option value="">-- Select Service --</option>
                                <option value="add_new" data-special="1">➕ Add New Service</option>

                                <?php foreach ($services_master as $sm): ?>
                                    <option value="<?= $sm->master_service_id ?>" data-cost="<?= $sm->estimated_cost ?>" data-time="<?= $sm->estimated_time ?>">
                                        <?= $sm->service_name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>

                        <!-- Time -->
                        <td class="border px-2 py-2 text-center">
                            <input type="number" step="0.1"
                                name="service_time[]"
                                class=" serviceTime w-20 border rounded-lg px-2 py-1 text-center"
                                value="">
                        </td>

                        <!-- Estimated Cost -->
                        <td class="border px-2 py-2 text-right">
                            <input type="number" step="0.01"
                                name="service_cost[]"
                                class=" serviceCost w-full border rounded-lg px-2 py-1 text-right"
                                value="">
                        </td>

                        <!-- Total -->
                        <td class="border px-2 py-2 text-right">
                            <input type="number" step="0.01"
                                name="total_cost[]"
                                class=" totalCost w-full border rounded-lg px-2 py-1 text-right bg-gray-100"
                                value="" readonly>
                        </td>

                        <!-- Action -->
                        <td class="border px-2 py-2 text-center">
                            <button type="button"
                                class=" remove-row inline-flex items-center justify-center
                                       bg-red-100 text-red-600
                                       hover:bg-red-500 hover:text-white
                                       px-3 py-1 rounded-lg transition">
                                ✕
                            </button>
                        </td>
                    </tr>

                </tbody>
                <tfoot>
                    <!-- Service Total -->
                    <tr class="bg-gray-100 font-semibold">
                        <td colspan="4" class="text-right px-3 py-2">Service Total</td>
                        <td class="px-3 py-2 text-right">
                            <input type="text"
                                id="service_total"
                                class="w-full text-right bg-gray-100"
                                readonly>
                        </td>
                        <td></td>
                    </tr>
                    <!-- ================================================= -->
                    <tr class="bg-gray-50">
                        <td colspan="4" class="text-right px-3 py-2">Discount Amount</td>
                        <td class="px-3 py-2 text-right">
                            <input type="text"
                                id="service_discount" name="service_discount" value=""
                                class="editable w-full text-right bg-gray-100">
                        </td>
                        <td></td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td colspan="4" class="text-right px-3 py-2">Taxable Amount</td>
                        <td class="px-3 py-2 text-right">
                            <input type="text"
                                id="service_taxable_amt"
                                class="w-full text-right bg-gray-100"
                                readonly>
                        </td>
                        <td></td>
                    </tr>



                    <!-- ================================================================== -->

                    <!-- VAT Amount (5%) -->
                    <tr class="bg-gray-50">
                        <td colspan="4" class="text-right px-3 py-2">Service VAT (5%)</td>
                        <td class="px-3 py-2 text-right">
                            <input type="text"
                                id="service_vat"
                                class="w-full text-right bg-gray-100"
                                readonly>
                        </td>
                        <td></td>
                    </tr>

                    <!-- Total Including VAT -->
                    <tr class="bg-gray-200 font-semibold">
                        <td colspan="4" class="text-right px-3 py-2">Service Total (Including VAT)</td>
                        <td class="px-3 py-2 text-right">
                            <input type="text"
                                id="service_total_with_vat"
                                class="w-full text-right bg-gray-100"
                                readonly>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>


            </table>
        </div>

        <!-- ///////////////////////////////////////////add original part releted data ///////////////////////////correct  -->





        <p class="text-xs text-gray-500 mt-3">
            Labour cost is calculated automatically based on time and rate.
        </p>
        <hr class="border-gray-300 mb-6">
        <!-- ==========================sapre parts======================================== -->

        <!-- <div class="bg-white rounded-xl shadow p-3 mt-4"> -->

        <h3 class="text-xl font-semibold text-gray-800 mb-6">
            Spare Parts Used
        </h3>

        <!-- New Parts -->
        <div class="mb-10">
            <h4 class="text-lg font-semibold text-blue-700 mb-3">
                Original Parts / Consumables2
            </h4>


            <div class="relative w-full overflow-x-auto overflow-y-visible">

                <table class="w-full border-collapse text-sm" id="newPartsTable">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="border px-3 py-2 w-12 text-center">✓</th>

                            <th class="border px-3 py-2 text-center w-12">SL</th>
                            <th class="border px-3 py-2 w-32 hidden">Brand</th>
                            <th class="border px-3 py-2">Part</th>
                            <th class="border px-3 py-2 text-center w-20">Qty</th>
                            <th class="border px-3 py-2 text-right w-28">Unit Price</th>
                            <th class="border px-3 py-2 text-center w-24">Markup %</th>
                            <th class="border px-3 py-2 text-right w-28">Selling Price</th>
                            <th class="border px-3 py-2 text-center w-24">Discount %</th>
                            <th class="border px-3 py-2 text-center w-24">Dis-Amount</th>
                            <th class="border px-3 py-2 text-right w-32">Total Price</th>
                            <th class="border px-3 py-2 text-center w-20">Action</th>
                            <!-- <th></th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will come here -->

                        <tr class="hover:bg-gray-50 transition">
                            <td class="border px-2 py-2 text-center">
                                <input type="checkbox"
                                    name="customer_selected[]"
                                    value=""
                                    class="w-4 h-4 accent-green-600">
                            </td>

                            <!-- SL -->
                            <td class="border px-2 py-2 text-center font-medium">

                            </td>

                            <!-- Brand -->
                            <td class="border px-2 py-2 hidden">
                                <select name="brand_id[]"
                                    class="brandSelect w-full border rounded-lg px-2 py-1">
                                    <option value="">-- Select Brand --</option>
                                    <?php foreach ($brands as $b): ?>
                                        <option value="<?= $b->brand_id ?>">
                                            <?= $b->brand_name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>


                            <!-- Part -->
                            <td class="border px-2 py-2">
                                <select name="part_id[]"
                                    class="editable partSelect w-full border rounded-lg px-2 py-1">
                                    <option value="">-- Select part First --</option>
                                    <?php foreach ($parts as $b): ?>
                                        <option value="<?= $b->part_id ?>" data-price="<?= $b->unit_price ?>">
                                            <?= $b->part_name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <textarea name="part_warrenty[]" rows="3" class="partWarrenty w-full border rounded-lg px-2 py-1"></textarea>
                            </td>

                            <!-- Qty -->
                            <td class="border px-2 py-2 text-center">
                                <input type="number" name="part_qty[]"
                                    class="editable partQty w-20 border rounded-lg px-2 py-1 text-center"
                                    value="1">
                            </td>

                            <!-- Unit Price -->
                            <td class="border px-2 py-2 text-right">
                                <input type="number" step="0.01" name="unit_price[]"
                                    class="editable unitPrice w-full border rounded-lg px-2 py-1 text-right"
                                    value="">
                            </td>

                            <!-- Markup % -->
                            <td class="border px-2 py-2 text-center">
                                <input type="number" step="0.01" name="markup[]"
                                    class="editable markup w-20 border rounded-lg px-2 py-1 text-center"
                                    value="" oninput="calculateSellingPrice(this)">
                            </td>

                            <!-- Selling Price -->
                            <td class="border px-2 py-2 text-right">
                                <input type="number" step="0.01" name="selling_price[]"
                                    class="editable sellPrice w-full border rounded-lg px-2 py-1 text-right"
                                    value="">
                            </td>

                            <!-- Discount -->
                            <td class="border px-2 py-2 text-center">
                                <input type="text" name="discount[]"
                                    onkeydown="allowNumberAndPercent(event)"
                                    oninput="this.value = this.value.replace(/[^0-9%]/g, ''); calculateDiscount(this);"
                                    class="editable discount w-20 border rounded-lg px-2 py-1 text-right"
                                    value="">
                            </td>
                            <!-- Discount amt-->
                            <td class="border px-2 py-2 text-center">
                                <input type="text" step="0.01" name="discountamt[]"
                                    class="editable discountamt w-20 border rounded-lg px-2 py-1 text-right bg-gray-100"
                                    value="" readonly>
                            </td>

                            <!-- Total -->
                            <td class="border px-2 py-2 text-right">
                                <input type="number" step="0.01" name="total_price[]"
                                    class="editable rowTotal w-full border rounded-lg px-2 py-1 text-right bg-gray-100"
                                    value="" readonly>
                            </td>

                            <!-- Action -->
                            <td class="border px-2 py-2 text-center">
                                <button type="button"
                                    class="editable remove-row inline-flex items-center justify-center
                                       bg-red-100 text-red-600
                                       hover:bg-red-500 hover:text-white
                                       px-3 py-1 rounded-lg transition">
                                    ✕
                                </button>
                            </td>

                            <td class="hidden border px-2 py-2 text-right">
                                <input type="hidden" name="part_type[]"
                                    class="rowTotal w-full border rounded-lg px-2 py-1 text-right bg-gray-100"
                                    value="" readonly>
                            </td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <!-- Parts Sub Total -->
                        <tr class="bg-gray-100 font-semibold">
                            <td colspan="10" class="text-right px-3 py-2">Parts Sub Total</td>
                            <td class="px-3 py-2 text-right">
                                <input type="text"
                                    id="parts_subtotal"
                                    class="w-full text-right bg-gray-100"
                                    readonly
                                    value="0.00">
                            </td>
                            <td></td>
                        </tr>

                        <!-- Total Discount -->
                        <tr class="bg-gray-50">
                            <td colspan="10" class="text-right px-3 py-2">Total Discount</td>
                            <td class="px-3 py-2 text-right">
                                <input type="text"
                                    id="parts_discount_total"
                                    class="w-full text-right bg-gray-100"
                                    readonly
                                    value="0.00">
                            </td>
                            <td></td>
                        </tr>

                        <!-- Taxable Amount -->
                        <tr class="bg-gray-100 font-semibold">
                            <td colspan="10" class="text-right px-3 py-2">Taxable Amount</td>
                            <td class="px-3 py-2 text-right">
                                <input type="text"
                                    id="parts_taxable"
                                    class="w-full text-right bg-gray-100"
                                    readonly
                                    value="0.00">
                            </td>
                            <td></td>
                        </tr>

                        <!-- VAT 5% -->
                        <tr class="bg-gray-50">
                            <td colspan="10" class="text-right px-3 py-2">VAT (5%)</td>
                            <td class="px-3 py-2 text-right">
                                <input type="text"
                                    id="parts_vat"
                                    class="w-full text-right bg-gray-100"
                                    readonly
                                    value="0.00">
                            </td>
                            <td></td>
                        </tr>

                        <!-- Total Including VAT -->
                        <tr class="bg-gray-200 font-semibold">
                            <td colspan="10" class="text-right px-3 py-2">Parts Total (Including VAT)</td>
                            <td class="px-3 py-2 text-right">
                                <input type="text"
                                    id="parts_total_with_vat"
                                    class="tablePartTotal w-full text-right bg-gray-100"
                                    data-table="newPartsTable"
                                    readonly
                                    value="0.00">
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>

                </table>
            </div>

            <button type="button" id="addNewPart"
                class="mb-3 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                + Add Original Part
            </button>
        </div>


        <hr class="border-gray-300 mb-6">
        <!-- Aftermarket Parts -->
        <div class="mb-10">
            <h4 class="text-lg font-semibold text-green-700 mb-3">
                Aftermarket Parts
            </h4>


            <div class="relative w-full overflow-x-auto overflow-y-visible">

                <table class="w-full border-collapse text-sm" id="aftermarketPartsTable">
                    <thead class="bg-green-50">
                        <tr>
                            <th class="border px-3 py-2 w-12 text-center">✓</th>

                            <th class="border px-3 py-2 text-center w-12">SL</th>
                            <th class="border px-3 py-2 w-32 hidden">Brand</th>
                            <th class="border px-3 py-2">Part</th>
                            <th class="border px-3 py-2 text-center w-20">Qty</th>
                            <th class="border px-3 py-2 text-right w-28">Unit Price</th>
                            <th class="border px-3 py-2 text-center w-24">Markup %</th>
                            <th class="border px-3 py-2 text-right w-28">Selling Price</th>
                            <th class="border px-3 py-2 text-center w-24">Discount %</th>
                            <th class="border px-3 py-2 text-center w-24">Dis-Amount</th>
                            <th class="border px-3 py-2 text-right w-32">Total Price</th>
                            <th class="border px-3 py-2 text-center w-20">Action</th>
                            <!-- <th></th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will come here -->

                        <tr class="hover:bg-gray-50 transition">
                            <td class="border px-2 py-2 text-center">
                                <input type="checkbox"
                                    name="customer_selected[]"
                                    value=""
                                    class="w-4 h-4 accent-green-600">
                            </td>
                            <!-- SL -->
                            <td class="border px-2 py-2 text-center font-medium">

                            </td>

                            <!-- Brand -->
                            <td class="border px-2 py-2 hidden">
                                <select name="brand_id[]"
                                    class="brandSelect w-full border rounded-lg px-2 py-1">
                                    <option value="">-- Select Brand --</option>
                                    <?php foreach ($brands as $b): ?>
                                        <option value="<?= $b->brand_id ?>">
                                            <?= $b->brand_name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>


                            <!-- Part -->
                            <td class="border px-2 py-2">
                                <select name="part_id[]"
                                    class=" partSelect w-full border rounded-lg px-2 py-1">
                                    <option value="">-- Select Brand --</option>
                                    <?php foreach ($parts as $a): ?>
                                        <option value="<?= $a->part_id ?>"><?= $a->part_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <textarea name="part_warrenty[]" rows="3" class="partWarrenty w-full border rounded-lg px-2 py-1"></textarea>

                            </td>

                            <!-- Qty -->
                            <td class="border px-2 py-2 text-center">
                                <input type="number" name="part_qty[]"
                                    class="editable partQty w-20 border rounded-lg px-2 py-1 text-center"
                                    value="">
                            </td>

                            <!-- Unit Price -->
                            <td class="border px-2 py-2 text-right">
                                <input type="number" step="0.01" name="unit_price[]"
                                    class="editable unitPrice w-full border rounded-lg px-2 py-1 text-right"
                                    value="">
                            </td>

                            <!-- Markup % -->
                            <td class="border px-2 py-2 text-center">
                                <input type="number" step="0.01" name="markup[]"
                                    class="editable markup w-20 border rounded-lg px-2 py-1 text-center"
                                    value="" oninput="calculateSellingPrice(this)">
                            </td>

                            <!-- Selling Price -->
                            <td class="border px-2 py-2 text-right">
                                <input type="number" step="0.01" name="selling_price[]"
                                    class="editable sellPrice w-full border rounded-lg px-2 py-1 text-right"
                                    value="">
                            </td>

                            <!-- Discount -->
                            <td class="border px-2 py-2 text-center">
                                <input type="text" name="discount[]"
                                    onkeydown="allowNumberAndPercent(event)"
                                    oninput="this.value = this.value.replace(/[^0-9%]/g, ''); calculateDiscount(this);"
                                    class="editable discount w-20 border rounded-lg px-2 py-1 text-right"
                                    value="">
                            </td>
                            <!-- Discount amt-->
                            <td class="border px-2 py-2 text-center">
                                <input type="text" step="0.01" name="discountamt[]"
                                    class="discountamt w-20 border rounded-lg px-2 py-1 text-right bg-gray-100"
                                    value="" readonly>
                            </td>

                            <!-- Total -->
                            <td class="border px-2 py-2 text-right">
                                <input type="number" step="0.01" name="total_price[]"
                                    class="rowTotal w-full border rounded-lg px-2 py-1 text-right bg-gray-100"
                                    value="" readonly>
                            </td>

                            <!-- Action -->
                            <td class="border px-2 py-2 text-center">
                                <button type="button"
                                    class="remove-row inline-flex items-center justify-center
                                       bg-red-100 text-red-600
                                       hover:bg-red-500 hover:text-white
                                       px-3 py-1 rounded-lg transition">
                                    ✕
                                </button>
                            </td>
                            <td class="hidden border px-2 py-2 text-right">
                                <input type="hidden" name="part_type[]"
                                    class="rowTotal w-full border rounded-lg px-2 py-1 text-right bg-gray-100"
                                    value="" readonly>
                            </td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <!-- Parts Sub Total -->
                        <tr class="bg-gray-100 font-semibold">
                            <td colspan="10" class="text-right px-3 py-2">Parts Sub Total</td>
                            <td class="px-3 py-2 text-right">
                                <input type="text"
                                    id="afterparts_subtotal"
                                    class="w-full text-right bg-gray-100"
                                    readonly
                                    value="0.00">
                            </td>
                            <td></td>
                        </tr>

                        <!-- Total Discount -->
                        <tr class="bg-gray-50">
                            <td colspan="10" class="text-right px-3 py-2">Total Discount</td>
                            <td class="px-3 py-2 text-right">
                                <input type="text"
                                    id="afterparts_discount_total"
                                    class="w-full text-right bg-gray-100"
                                    readonly
                                    value="0.00">
                            </td>
                            <td></td>
                        </tr>

                        <!-- Taxable Amount -->
                        <tr class="bg-gray-100 font-semibold">
                            <td colspan="10" class="text-right px-3 py-2">Taxable Amount</td>
                            <td class="px-3 py-2 text-right">
                                <input type="text"
                                    id="afterparts_taxable"
                                    class="w-full text-right bg-gray-100"
                                    readonly
                                    value="0.00">
                            </td>
                            <td></td>
                        </tr>

                        <!-- VAT 5% -->
                        <tr class="bg-gray-50">
                            <td colspan="10" class="text-right px-3 py-2">VAT (5%)</td>
                            <td class="px-3 py-2 text-right">
                                <input type="text"
                                    id="afterparts_vat"
                                    class="w-full text-right bg-gray-100"
                                    readonly
                                    value="0.00">
                            </td>
                            <td></td>
                        </tr>

                        <!-- Total Including VAT -->
                        <tr class="bg-gray-200 font-semibold">
                            <td colspan="10" class="text-right px-3 py-2">Parts Total (Including VAT)</td>
                            <td class="px-3 py-2 text-right">
                                <input type="text"
                                    id="afterparts_total_with_vat"
                                    class="tablePartTotal w-full text-right bg-gray-100"
                                    data-table="aftermarketPartsTable"
                                    readonly
                                    value="0.00">
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>

                </table>
            </div>

            <button type="button" id="addAftermarketPart"
                class="mb-3 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                + Add Aftermarket Part
            </button>
        </div>







        <!-- ////////////////////////////////////////end original part data -->











    </form>

</div>
<div id="serviceModal"
    class="fixed inset-0 z-50 hidden bg-black/50 flex items-center justify-center">

    <!-- fixed inset-0 z-50 hidden bg-black/40 flex items-center justify-center -->
    <div class="bg-white rounded-xl w-full max-w-md p-4 relative">
        <h3 class="text-lg font-semibold mb-3">Add New Service</h3>

        <div class="mb-3">
            <label class="text-sm font-medium">Service Name</label>
            <input type="text" id="new_service_name"
                class="w-full border rounded px-2 py-1">
        </div>

        <div class="mb-3">
            <label class="text-sm font-medium">Service Type</label>
            <select id="new_service_type"
                class="w-full border rounded px-2 py-1">
                <option value="SERVICE">Service</option>
                <option value="LABOUR">Labour</option>
                <option value="OTHER">Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="text-sm font-medium">Estimated Cost</label>
            <input type="number" step="0.01" id="new_service_cost"
                class="w-full border rounded px-2 py-1">
        </div>

        <div class="mb-3">
            <label class="text-sm font-medium">Estimated Time (mins)</label>
            <input type="number" id="new_service_time"
                class="w-full border rounded px-2 py-1">
        </div>

        <div class="flex justify-end gap-2">
            <button onclick="closeServiceModal()"
                class="px-3 py-1 border rounded">
                Cancel
            </button>
            <button onclick="saveNewService()"
                class="px-4 py-1 bg-blue-600 text-white rounded">
                Save
            </button>
        </div>
    </div>
</div>



<!-- ========================================= script fncs======================== -->
<script>
    $(document).ready(function() {

        const tableBody = $("#serviceTable tbody");

        // =========================
        // INIT SELECT2
        // =========================
        function initSelect2() {
            $('.serviceSelect').select2({
                width: '100%'
            });
        }

        initSelect2();

        // =========================
        // ADD NEW ROW
        // =========================
        $("#addService_set").on("click", function() {

            const rowCount = $("#serviceTable tbody tr").length + 1;

            let newRow = `
        <tr class="hover:bg-gray-50 transition">

            <td class="border px-2 py-2 text-center font-medium row-number">
                ${rowCount}
            </td>

            <td class="border px-2 py-2">
                <select name="service_id[]"
                    class="serviceSelect w-full border rounded-lg px-2 py-1">

                    <option value="">-- Select Service --</option>

                    <option value="add_new">
                        ➕ Add New Service
                    </option>

                    <?php foreach ($services_master as $sm): ?>
                        <option
                            value="<?= $sm->master_service_id ?>"
                            data-cost="<?= $sm->estimated_cost ?>"
                            data-time="<?= $sm->estimated_time ?>">

                            <?= $sm->service_name ?>

                        </option>
                    <?php endforeach; ?>

                </select>
            </td>

            <td class="border px-2 py-2 text-center">
                <input type="number"
                    step="0.1"
                    name="service_time[]"
                    class="serviceTime w-20 border rounded-lg px-2 py-1 text-center">
            </td>

            <td class="border px-2 py-2 text-right">
                <input type="number"
                    step="0.01"
                    name="service_cost[]"
                    class="serviceCost w-full border rounded-lg px-2 py-1 text-right">
            </td>

            <td class="border px-2 py-2 text-right">
                <input type="number"
                    step="0.01"
                    name="total_cost[]"
                    class="totalCost w-full border rounded-lg px-2 py-1 text-right bg-gray-100"
                    readonly>
            </td>

            <td class="border px-2 py-2 text-center">
                <button type="button"
                    class="remove-row bg-red-100 text-red-600 hover:bg-red-500 hover:text-white px-3 py-1 rounded-lg">
                    ✕
                </button>
            </td>

        </tr>
        `;

            tableBody.append(newRow);

            initSelect2();

            updateRowNumbers();
        });

        // =========================
        // SELECT SERVICE
        // =========================
        let activeServiceSelect = null;

        $(document).on('select2:select', '.serviceSelect', function(e) {

            const selectedValue = e.params.data.id;

            const select = this;

            const row = $(this).closest('tr');

            // =====================
            // OPEN MODAL
            // =====================
            if (selectedValue === 'add_new') {

                activeServiceSelect = select;

                $('#serviceModal').removeClass('hidden');

                return;
            }

            // =====================
            // NORMAL SERVICE
            // =====================
            const option = e.params.data.element;

            let cost = $(option).data('cost') || 0;
            let time = $(option).data('time') || 0;

            row.find('.serviceCost').val(cost);
            row.find('.serviceTime').val(time);

            calculateRow(row);

            calculateAll();
        });

        // =========================
        // CLOSE MODAL
        // =========================
        window.closeServiceModal = function() {

            $('#serviceModal').addClass('hidden');

            $('#new_service_name').val('');
            $('#new_service_type').val('SERVICE');
            $('#new_service_cost').val('');
            $('#new_service_time').val('');
        };

        // =========================
        // SAVE NEW SERVICE
        // =========================
        window.saveNewService = function() {

            const serviceName = $('#new_service_name').val().trim();

            const serviceType = $('#new_service_type').val();

            const cost = $('#new_service_cost').val();

            const time = $('#new_service_time').val();

            if (serviceName === '') {

                alert('Service name required');

                return;
            }

            $.ajax({

                url: "<?= base_url('index.php/ServiceMaster/save_ajax') ?>",

                type: "POST",

                dataType: "json",

                data: {
                    service_name: serviceName,
                    service_type: serviceType,
                    estimated_cost: cost,
                    estimated_time: time
                },

                success: function(res) {

                    if (res.status === 'success') {

                        const service = res.service;

                        let newOption = new Option(
                            service.service_name,
                            service.master_service_id,
                            true,
                            true
                        );

                        $(newOption).attr('data-cost', service.estimated_cost);
                        $(newOption).attr('data-time', service.estimated_time);

                        $('.serviceSelect').append(newOption);

                        // SET VALUE
                        $(activeServiceSelect)
                            .append(newOption)
                            .val(service.master_service_id)
                            .trigger('change');

                        // AUTO FILL
                        const row = $(activeServiceSelect).closest('tr');

                        row.find('.serviceCost').val(service.estimated_cost);

                        row.find('.serviceTime').val(service.estimated_time);

                        calculateRow(row);

                        calculateAll();

                        closeServiceModal();

                    } else {

                        alert(res.message);
                    }
                },

                error: function() {

                    alert('Error saving service');
                }

            });
        };

        // =========================
        // REMOVE ROW
        // =========================
        $(document).on('click', '.remove-row', function() {

            if ($("#serviceTable tbody tr").length == 1) {

                alert('At least one row required');

                return;
            }

            $(this).closest('tr').remove();

            updateRowNumbers();

            calculateAll();
        });

        // =========================
        // INPUT CALCULATION
        // =========================
        $(document).on('input', '.serviceTime, .serviceCost', function() {

            const row = $(this).closest('tr');

            calculateRow(row);

            calculateAll();
        });

        // =========================
        // DISCOUNT
        // =========================
        $('#service_discount').on('input', function() {

            calculateAll();
        });

        // =========================
        // CALCULATE ROW
        // =========================
        function calculateRow(row) {

            let time = parseFloat(row.find('.serviceTime').val()) || 0;

            let cost = parseFloat(row.find('.serviceCost').val()) || 0;

            let total = time * cost;

            row.find('.totalCost').val(total.toFixed(2));
        }

        // =========================
        // CALCULATE FOOTER
        // =========================
        function calculateAll() {

            let total = 0;

            $('.totalCost').each(function() {

                total += parseFloat($(this).val()) || 0;
            });

            let discount = parseFloat($('#service_discount').val()) || 0;

            let taxable = total - discount;

            if (taxable < 0) {
                taxable = 0;
            }

            let vat = taxable * 0.05;

            let grand = taxable + vat;

            $('#service_total').val(total.toFixed(2));

            $('#service_taxable_amt').val(taxable.toFixed(2));

            $('#service_vat').val(vat.toFixed(2));

            $('#service_total_with_vat').val(grand.toFixed(2));
        }

        // =========================
        // UPDATE SERIAL NO
        // =========================
        function updateRowNumbers() {

            $('#serviceTable tbody tr').each(function(index) {

                $(this).find('.row-number').text(index + 1);
            });
        }

    });
</script>

<!-- original part script -->
<script>
    $(document).ready(function() {

        let activePartSelect = null;

        // =========================================================
        // INIT SELECT2
        // =========================================================
        function initPartSelect2(element = '.partSelect') {

            $(element).select2({
                width: '100%',
                placeholder: '-- Select Part --'
            });

        }

        initPartSelect2();

        // =========================================================
        // ADD NEW ROW
        // =========================================================
        $('#addNewPart').on('click', function() {

            let rowCount = $('#newPartsTable tbody tr').length + 1;

            let newRow = `
        <tr class="hover:bg-gray-50 transition">

            <!-- CHECKBOX -->
            <td class="border px-2 py-2 text-center">
                <input type="checkbox"
                    name="customer_selected[]"
                    class="w-4 h-4 accent-green-600">
            </td>

            <!-- SERIAL -->
            <td class="border px-2 py-2 text-center font-medium row-number">
                ${rowCount}
            </td>

            <!-- BRAND -->
            <td class="border px-2 py-2 hidden">
                <select name="brand_id[]"
                    class="brandSelect w-full border rounded-lg px-2 py-1">

                    <option value="">-- Select Brand --</option>

                    <?php foreach ($brands as $b): ?>
                        <option value="<?= $b->brand_id ?>">
                            <?= $b->brand_name ?>
                        </option>
                    <?php endforeach; ?>

                </select>
            </td>

            <!-- PART -->
            <td class="border px-2 py-2">

                <select name="part_id[]"
                    class="partSelect w-full border rounded-lg px-2 py-1">

                    <option value=""></option>

                    <option value="add_new">
                        ➕ Add New Part
                    </option>
                    <?php foreach ($parts as $p): ?>
                        <option
                            value="<?= $p->part_id ?>"
                            data-price="<?= $p->unit_price ?>">

                            <?= $p->part_name ?>

                        </option>
                    <?php endforeach; ?>

                </select>

                <textarea
                    name="part_warrenty[]"
                    rows="2"
                    class="partWarrenty w-full border rounded-lg px-2 py-1 mt-2"></textarea>

            </td>

            <!-- QTY -->
            <td class="border px-2 py-2 text-center">
                <input type="number"
                    name="part_qty[]"
                    class="partQty w-20 border rounded-lg px-2 py-1 text-center"
                    value="1"
                    min="1">
            </td>

            <!-- UNIT PRICE -->
            <td class="border px-2 py-2 text-right">
                <input type="number"
                    step="0.01"
                    name="unit_price[]"
                    class="unitPrice w-full border rounded-lg px-2 py-1 text-right"
                    value="0">
            </td>

            <!-- MARKUP -->
            <td class="border px-2 py-2 text-center">
                <input type="number"
                    step="0.01"
                    name="markup[]"
                    class="markup w-20 border rounded-lg px-2 py-1 text-center"
                    value="0">
            </td>

            <!-- SELL PRICE -->
            <td class="border px-2 py-2 text-right">
                <input type="number"
                    step="0.01"
                    name="selling_price[]"
                    class="sellPrice w-full border rounded-lg px-2 py-1 text-right"
                    value="0">
            </td>

            <!-- DISCOUNT -->
            <td class="border px-2 py-2 text-center">
                <input type="number"
                    step="0.01"
                    name="discount[]"
                    class="discount w-20 border rounded-lg px-2 py-1 text-right"
                    value="0">
            </td>

            <!-- DISCOUNT AMOUNT -->
            <td class="border px-2 py-2 text-center">
                <input type="text"
                    name="discountamt[]"
                    class="discountamt w-full border rounded-lg px-2 py-1 text-right bg-gray-100"
                    value="0.00"
                    readonly>
            </td>

            <!-- TOTAL -->
            <td class="border px-2 py-2 text-right">
                <input type="text"
                    name="total_price[]"
                    class="rowTotal w-full border rounded-lg px-2 py-1 text-right bg-gray-100"
                    value="0.00"
                    readonly>
            </td>

            <!-- ACTION -->
            <td class="border px-2 py-2 text-center">
                <button type="button"
                    class="remove-part-row inline-flex items-center justify-center
                    bg-red-100 text-red-600
                    hover:bg-red-500 hover:text-white
                    px-3 py-1 rounded-lg transition">
                    ✕
                </button>
            </td>

        </tr>
        `;

            $('#newPartsTable tbody').append(newRow);

            let lastRow = $('#newPartsTable tbody tr:last');

            initPartSelect2(lastRow.find('.partSelect'));

            calculatePartsTotals();

        });

        // =========================================================
        // PART SELECT
        // =========================================================
        $(document).on('select2:select', '.partSelect', function(e) {

            let selectedId = e.params.data.id;

            activePartSelect = this;

            // ADD NEW PART
            if (selectedId === 'add_new') {

                $(this).val(null).trigger('change');

                $('#addPartModal').removeClass('hidden');

                return;
            }

            // NORMAL PART
            let row = $(this).closest('tr');

            let option = e.params.data.element;

            let price = parseFloat($(option).data('price')) || 0;

            row.find('.unitPrice').val(price.toFixed(2));

            row.find('.sellPrice').val(price.toFixed(2));

            calculatePartRow(row);

        });

        // =========================================================
        // SAVE NEW PART
        // =========================================================
        window.submitAddPart = function() {

            let partName = $('#new_part_name').val().trim();

            let unitPrice = $('#new_part_price').val();

            if (partName === '') {

                alert('Part name required');

                return;
            }

            $.ajax({

                url: "<?= base_url('index.php/SpareParts/save_ajax') ?>",

                type: "POST",

                dataType: "json",

                data: {
                    part_name: partName,
                    unit_price: unitPrice
                },

                success: function(res) {

                    if (res.status === 'success') {

                        let part = res.part;

                        let option = new Option(
                            part.part_name,
                            part.part_id,
                            true,
                            true
                        );

                        option.dataset.price = part.unit_price;

                        $(activePartSelect)
                            .append(option)
                            .trigger('change');

                        let row = $(activePartSelect).closest('tr');

                        row.find('.unitPrice').val(part.unit_price);

                        row.find('.sellPrice').val(part.unit_price);

                        calculatePartRow(row);

                        closeAddPartModal();

                    } else {

                        alert(res.message);

                    }

                },

                error: function() {

                    alert('Error saving part');

                }

            });

        };

        // =========================================================
        // CLOSE MODAL
        // =========================================================
        window.closeAddPartModal = function() {

            $('#addPartModal').addClass('hidden');

            $('#new_part_name').val('');

            $('#new_part_price').val('');

        };

        // =========================================================
        // REMOVE ROW
        // =========================================================
        $(document).on('click', '.remove-part-row', function() {

            if ($('#newPartsTable tbody tr').length === 1) {

                alert('At least one row required');

                return;
            }

            $(this).closest('tr').remove();

            updatePartRowNumbers();

            calculatePartsTotals();

        });

        // =========================================================
        // INPUT EVENTS
        // =========================================================
        $(document).on(
            'input',
            '.partQty, .unitPrice, .markup, .sellPrice, .discount',
            function() {

                let row = $(this).closest('tr');

                // AUTO SELL PRICE FROM MARKUP
                let unitPrice = parseFloat(row.find('.unitPrice').val()) || 0;

                let markup = parseFloat(row.find('.markup').val()) || 0;

                let sellingPrice = unitPrice + ((unitPrice * markup) / 100);

                row.find('.sellPrice').val(sellingPrice.toFixed(2));

                calculatePartRow(row);

            }
        );

        // =========================================================
        // CALCULATE SINGLE ROW
        // =========================================================
        function calculatePartRow(row) {

            let qty = parseFloat(row.find('.partQty').val()) || 0;

            let sellPrice = parseFloat(row.find('.sellPrice').val()) || 0;

            let discount = parseFloat(row.find('.discount').val()) || 0;

            let subtotal = qty * sellPrice;

            let discountAmt = (subtotal * discount) / 100;

            let total = subtotal - discountAmt;

            row.find('.discountamt').val(discountAmt.toFixed(2));

            row.find('.rowTotal').val(total.toFixed(2));

            calculatePartsTotals();

        }

        // =========================================================
        // GRAND TOTAL
        // =========================================================
        function calculatePartsTotals() {

            let subtotal = 0;

            let discountTotal = 0;

            $('#newPartsTable tbody tr').each(function() {

                subtotal += parseFloat($(this).find('.rowTotal').val()) || 0;

                discountTotal += parseFloat($(this).find('.discountamt').val()) || 0;

            });

            let taxable = subtotal;

            let vat = taxable * 0.05;

            let grand = taxable + vat;

            $('#parts_subtotal').val(subtotal.toFixed(2));

            $('#parts_discount_total').val(discountTotal.toFixed(2));

            $('#parts_taxable').val(taxable.toFixed(2));

            $('#parts_vat').val(vat.toFixed(2));

            $('#parts_total_with_vat').val(grand.toFixed(2));

        }

        // =========================================================
        // UPDATE SERIAL
        // =========================================================
        function updatePartRowNumbers() {

            $('#newPartsTable tbody tr').each(function(index) {

                $(this).find('.row-number').text(index + 1);

            });

        }

    });
</script>


<script>
    function addPartRow(tableId, parttype) {

        partCounters[tableId]++;
        let brandOptions = '<option value="">-- Select Brand --</option>';
        let partsOptions = '<option value="">-- Select Part --</option>';
        if (parttype === "New Parts") {

            brandOptions += `
        <?php foreach ($newbrands as $brand): ?>
            <option value="<?= $brand->brand_id ?>">
                <?= $brand->brand_name ?>
            </option>
        <?php endforeach; ?>`;
            partsOptions += `<option value="add_new_parts" data-addtype="new">➕ Add New Part</option>
        <?php foreach ($Newparts as $newpart): ?>
            <option value="<?= $newpart->part_id ?>" data-price="<?= $newpart->unit_price ?>">
                <?= $newpart->part_name ?> 
            </option>
        <?php endforeach; ?>`;

        } else if (parttype === "Aftermarket Parts") {

            brandOptions += `
        <?php foreach ($afterbrands as $brand): ?>
            <option value="<?= $brand->brand_id ?>">
                <?= $brand->brand_name ?>
            </option>
        <?php endforeach; ?>`;

            partsOptions += `<option value="add_after_parts" data-addtype="after">➕ Add Aftermarket Part</option>
        <?php foreach ($afterparts as $afterpart): ?>
            <option value="<?= $afterpart->part_id ?>" data-price="<?= $afterpart->unit_price ?>">
                <?= $afterpart->part_name ?> 
            </option>
        <?php endforeach; ?>`;

        } else if (parttype === "Used Parts") {

            brandOptions += `
        <?php foreach ($usedbrands as $brand): ?>
            <option value="<?= $brand->brand_id ?>">
                <?= $brand->brand_name ?>
            </option>
        <?php endforeach; ?>`;

            partsOptions += `<option value="add_used_parts" data-addtype="used">➕ Add Used Part</option>
        <?php foreach ($usedparts as $usedpart): ?>
            <option value="<?= $usedpart->part_id ?>"  data-price="<?= $usedpart->unit_price ?>">
                <?= $usedpart->part_name ?>
            </option>
        <?php endforeach; ?>`;
        }
        const row = `
   		 <tr class="hover:bg-gray-50 transition">
		<td class="border px-2 py-2 text-center">
			<input type="checkbox"
				name="customer_selected[]"
				value=""
				class="customerSelected w-4 h-4 accent-green-600"
				 >
		</td>


        <td class="border px-2 py-2 text-center font-medium">
            ${partCounters[tableId]}
        </td>

        <!-- Brand -->
        <td class="border px-2 py-2 hidden">
            <select name="brand_id[]"
                    class="brandSelect w-full border rounded-lg px-2 py-1">
                ${brandOptions}
            </select>
        </td>

        <!-- Part -->
        <td class="border px-2 py-2">
            <select name="part_id[]"
                    class="partSelect w-full border rounded-lg px-2 py-1">
                ${partsOptions}
            </select>
			<textarea name="part_warrenty[]" rows="3"  class="partWarrenty w-full border rounded-lg px-2 py-1"></textarea>
        </td>

        <!-- Qty -->
        <td class="border px-2 py-2 text-center">
            <input type="number" name="part_qty[]"
                   class="partQty w-20 border rounded-lg px-2 py-1 text-center"
                   value="1" min="1">
        </td>

        <!-- Unit Price -->
        <td class="border px-2 py-2 text-right">
            <input type="number" step="0.01" name="unit_price[]"
                   class="unitPrice w-full border rounded-lg px-2 py-1 text-right"
                   value="0.00">
        </td>

        <!-- Markup -->
        <td class="border px-2 py-2 text-center">
            <input type="number" step="0.01" name="markup[]"
                   class="markup w-20 border rounded-lg px-2 py-1 text-center"
                   value="0"
                   oninput="calculateSellingPrice(this)">
        </td>

        <!-- Selling -->
        <td class="border px-2 py-2 text-right">
            <input type="number" step="0.01" name="selling_price[]"
                   class="sellPrice w-full border rounded-lg px-2 py-1 text-right"
                   value="0.00">
        </td>

        <!-- Discount -->
        <td class="border px-2 py-2 text-center">
            <input type="text" name="discount[]"
                   class="discount w-20 border rounded-lg px-2 py-1 text-center"
                   value="0"
                   onkeydown="allowNumberAndPercent(event)"
                   oninput="this.value=this.value.replace(/[^0-9%]/g,'');calculateDiscount(this);">
        </td>

        <!-- Discount Amount -->
        <td class="border px-2 py-2 text-center">
            <input type="number" step="0.01" name="discountamt[]"
                   class="discountamt w-20 border rounded-lg px-2 py-1 text-right bg-gray-100"
                   value="0.00" readonly>
        </td>

        <!-- Total -->
        <td class="border px-2 py-2 text-right">
            <input type="number" step="0.01" name="total_price[]"
                   class="rowTotal w-full border rounded-lg px-2 py-1 text-right bg-gray-100"
                   value="0.00" readonly>
        </td>

        <!-- Action -->
        <td class="border px-2 py-2 text-center">
            <button type="button"
                    class="remove-row bg-red-100 text-red-600
                           hover:bg-red-500 hover:text-white
                           px-3 py-1 rounded-lg transition">
                ✕
            </button>
        </td>
		<td class="hidden border px-2 py-2 text-center">
             <input type="hidden" name="part_type[]"
                   class="parttype w-full border rounded-lg px-2 py-1 text-right bg-gray-100"
                   value="${parttype}" readonly>
        </td>
    	</tr>`;

        document.querySelector(`#${tableId} tbody`)
            .insertAdjacentHTML("beforeend", row);

        $('.partSelect').select2({
            width: '100%'
        });
    }

    document.getElementById("addNewPart")
        .addEventListener("click", () => addPartRow("newPartsTable", "New Parts"));

    document.getElementById("addAftermarketPart")
        .addEventListener("click", () => addPartRow("aftermarketPartsTable", "Aftermarket Parts"));

    document.getElementById("addUsedPart")
        .addEventListener("click", () => addPartRow("usedPartsTable", "Used Parts"));


    document.addEventListener('change', function(e) {

        if (e.target.classList.contains("jobAmount")) {
            calculateJobTotals();
            debounceGrandTotal();
        }



        /* ===============================
           BRAND CHANGE → LOAD PARTS
           =============================== */
        if (e.target.classList.contains('brandSelect')) {

            const brandId = e.target.value;
            const row = e.target.closest('tr');
            const partSelect = row.querySelector('.partSelect');

            if (!brandId) {
                partSelect.innerHTML = '<option value="">-- Select Brand First --</option>';
                return;
            }

            partSelect.innerHTML = '<option value="">Loading...</option>';

            fetch('<?= base_url("index.php/Estimation/get_parts_by_brand") ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'brand_id=' + brandId
                })
                .then(res => res.json())
                .then(parts => {

                    let options = '<option value="">-- Select Part --</option>';

                    parts.forEach(p => {
                        options += `
                    <option value="${p.part_id}" data-price="${p.unit_price}">
                        ${p.part_name}
                    </option>`;
                    });

                    partSelect.innerHTML = options;
                });

        }

        /* ===============================
           PART CHANGE → CHECKBOX SYNC
           =============================== */
        if (e.target.classList.contains('partSelect')) {

            const row = e.target.closest('tr');
            const checkbox = row.querySelector('.customerSelected');
            const partId = e.target.value;

            if (!checkbox) return;

            if (partId) {
                checkbox.value = partId;
                checkbox.disabled = false;
            } else {
                checkbox.value = '';
                checkbox.checked = false;
                checkbox.disabled = true;
            }
        }

    });

    document.addEventListener("click", function(e) {

        const btn = e.target.closest(".remove-row");
        if (!btn) return;

        const table = btn.closest("table");
        const tableId = table.id;

        btn.closest("tr").remove();

        debounceGrandTotal();
        renumberTable(tableId);
    });

    function renumberTable(tableId) {

        let colIndex = 0;

        if (tableId === "serviceTable") colIndex = 0;
        if (tableId === "newPartsTable") colIndex = 1;
        if (tableId === "aftermarketPartsTable") colIndex = 1;
        if (tableId === "usedPartsTable") colIndex = 1;
        if (tableId === "jobDescTable") colIndex = 0;

        document.querySelectorAll(`#${tableId} tbody tr`)
            .forEach((row, i) => {

                let cells = row.querySelectorAll("td");

                if (cells[colIndex])
                    cells[colIndex].innerText = i + 1;

            });
    }
</script>