<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <h2 class="text-2xl font-bold mb-4">
        <?= htmlspecialchars($title) ?>
    </h2>

    <form
        method="POST"
        enctype="multipart/form-data"
        action="<?= base_url('index.php/insurancepolicy/add_policy'); ?>"
    >
        <div class="mb-8">

            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                Policy Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Customer / Policyholder
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="customer_id"
                        id="customer_id"
                        class="w-full border p-2 rounded" required
                    >

                        <option value="">
                            Select Customer
                        </option>

                        <?php if (!empty($customers)) {

                            foreach ($customers as $customer) { ?>

                                <option
                                    value="<?= $customer->customer_id ?>"
                                    <?= set_select(
                                        'customer_id',
                                        $customer->customer_id
                                    ); ?>
                                >

                                    <?= htmlspecialchars(
                                        $customer->name
                                    ) ?>

                                </option>

                        <?php }

                        } ?>

                    </select>

                    <?= form_error(
                        'customer_id',
                        '<small class="text-red-500">',
                        '</small>'
                    ); ?>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Insured Vehicle
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="vehicle_id"
                        id="vehicle_id"
                        class="w-full border p-2 rounded" required
                    >

                        <option value="">
                            Select Vehicle
                        </option>

                        <?php if (!empty($vehicles)) {

                            foreach ($vehicles as $vehicle) { ?>

                                <option
                                    value="<?= $vehicle->vehicle_id ?>"
                                    <?= set_select(
                                        'vehicle_id',
                                        $vehicle->vehicle_id
                                    ); ?>
                                >

                                    <?= htmlspecialchars(
                                        $vehicle->brand
                                        . ' - '
                                        . $vehicle->registration_no
                                    ) ?>

                                </option>

                        <?php }

                        } ?>

                    </select>

                    <?= form_error(
                        'vehicle_id',
                        '<small class="text-red-500">',
                        '</small>'
                    ); ?>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Policy Number
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="policy_number"
                        value="<?= set_value('policy_number'); ?>"
                        class="w-full border p-2 rounded"
                        placeholder="POL-2026-0001" required
                    >

                    <?= form_error(
                        'policy_number',
                        '<small class="text-red-500">',
                        '</small>'
                    ); ?>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Insurance Company
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="insurance_company_id"
                        class="w-full border p-2 rounded" required
                    >

                        <option value="">
                            Select Insurance Company
                        </option>

                        <?php if (!empty($insurance_companies)) {

                            foreach ($insurance_companies as $company) { ?>

                                <option
                                    value="<?= $company->company_id ?>"
                                    <?= set_select(
                                        'insurance_company_id',
                                        $company->company_id
                                    ); ?>
                                >

                                    <?= htmlspecialchars(
                                        $company->company_name
                                    ) ?>

                                </option>

                        <?php }

                        } ?>

                    </select>

                    <?= form_error(
                        'insurance_company_id',
                        '<small class="text-red-500">',
                        '</small>'
                    ); ?>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Policy Type
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="policy_type_id"
                        class="w-full border p-2 rounded" required
                    >

                        <option value="">
                            Select Policy Type
                        </option>

                        <?php if (!empty($policy_types)) {

                            foreach ($policy_types as $type) { ?>

                                <option
                                    value="<?= $type->policy_type_id ?>"
                                    <?= set_select(
                                        'policy_type_id',
                                        $type->policy_type_id
                                    ); ?>
                                >

                                    <?= htmlspecialchars(
                                        $type->policy_type_name
                                    ) ?>

                                </option>

                        <?php }

                        } ?>

                    </select>

                    <?= form_error(
                        'policy_type_id',
                        '<small class="text-red-500">',
                        '</small>'
                    ); ?>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Policy Term
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="policy_term_id"
                        class="w-full border p-2 rounded" required
                    >

                        <option value="">
                            Select Policy Term
                        </option>

                        <?php if (!empty($policy_terms)) {

                            foreach ($policy_terms as $term) { ?>

                                <option
                                    value="<?= $term->policy_term_id ?>"
                                    <?= set_select(
                                        'policy_term_id',
                                        $term->policy_term_id
                                    ); ?>
                                >

                                    <?= htmlspecialchars(
                                        $term->policy_term_name
                                    ) ?>

                                </option>

                        <?php }

                        } ?>

                    </select>

                    <?= form_error(
                        'policy_term_id',
                        '<small class="text-red-500">',
                        '</small>'
                    ); ?>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Insurance Policy Status
                    </label>

                    <select
                        name="policy_status"
                        class="w-full border p-2 rounded"
                    >

                        <option
                            value="Draft"
                            <?= set_select(
                                'policy_status',
                                'Draft',
                                TRUE
                            ); ?>
                        >
                            Draft
                        </option>

                        <option
                            value="Active"
                            <?= set_select(
                                'policy_status',
                                'Active'
                            ); ?>
                        >
                            Active
                        </option>

                        <option
                            value="Suspended"
                            <?= set_select(
                                'policy_status',
                                'Suspended'
                            ); ?>
                        >
                            Suspended
                        </option>

                        <option
                            value="Expired"
                            <?= set_select(
                                'policy_status',
                                'Expired'
                            ); ?>
                        >
                            Expired
                        </option>

                        <option
                            value="Cancelled"
                            <?= set_select(
                                'policy_status',
                                'Cancelled'
                            ); ?>
                        >
                            Cancelled
                        </option>

                    </select>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Start Date
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="date"
                        name="start_date"
                        value="<?= set_value('start_date'); ?>"
                        class="w-full border p-2 rounded" required
                    >

                    <?= form_error(
                        'start_date',
                        '<small class="text-red-500">',
                        '</small>'
                    ); ?>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Expiry Date
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="date"
                        name="expiry_date"
                        value="<?= set_value('expiry_date'); ?>"
                        class="w-full border p-2 rounded" required
                    >

                    <?= form_error(
                        'expiry_date',
                        '<small class="text-red-500">',
                        '</small>'
                    ); ?>

                </div>

            </div>
        </div>
        
        <div class="mb-8">

            <div class="flex items-center justify-between mb-4 pb-2 border-b">
                <h3 class="text-lg font-semibold text-gray-800">
                    Policy Coverage
                </h3>

                <button
                    type="button"
                    onclick="addCoverage()"
                    class="px-4 py-2 bg-green-600 text-white rounded mb-6"
                >

                    + Add Coverage

                </button>

            </div>
            
            <div id="coverage-container">

                <div class="coverage-row border border-gray-200 rounded-lg p-4 mb-4">

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                        <div>

                            <label class="font-medium">
                                Coverage Type
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="coverage_type_id[]"
                                class="w-full border p-2 rounded" required
                            >

                                <option value="">
                                    Select Coverage Type
                                </option>

                                <?php if (!empty($coverage_types)) {

                                    foreach (
                                        $coverage_types
                                        as $coverage
                                    ) { ?>

                                        <option
                                            value="<?= $coverage->coverage_type_id ?>"
                                            <?= set_select(
                                                'coverage_type_id[]',
                                                $coverage->coverage_type_id
                                            ); ?>
                                        >

                                            <?= htmlspecialchars(
                                                $coverage->coverage_type_name
                                            ) ?>

                                        </option>

                                <?php }

                                } ?>

                            </select>

                            <?php if (
                                !empty(
                                    $coverage_errors[0]['coverage_type']
                                )
                            ) { ?>

                                <small class="text-red-500">

                                    <?= htmlspecialchars(
                                        $coverage_errors[0]['coverage_type']
                                    ); ?>

                                </small>

                            <?php } ?>

                        </div>

                        <div>

                            <label class="font-medium">
                                Coverage Amount
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="coverage_amount[]"
                                class="w-full border p-2 rounded"
                                placeholder="0.00" required
                            >

                            <?php if (
                                !empty(
                                    $coverage_errors[0]['coverage_amount']
                                )
                            ) { ?>

                                <small class="text-red-500">

                                    <?= htmlspecialchars(
                                        $coverage_errors[0]['coverage_amount']
                                    ); ?>

                                </small>

                            <?php } ?>

                        </div>

                        <div>

                            <label class="font-medium">
                                Coverage Limit Type
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                name="coverage_limit_type[]"
                                class="w-full border p-2 rounded" required
                            >

                                <option value="">
                                    Select Limit Type
                                </option>

                                <option value="Per Accident">
                                    Per Accident
                                </option>

                                <option value="Per Claim">
                                    Per Claim
                                </option>

                                <option value="Annual">
                                    Annual
                                </option>

                                <option value="Aggregate">
                                    Aggregate
                                </option>

                                <option value="Unlimited">
                                    Unlimited
                                </option>

                            </select>

                            <?php if (
                                !empty(
                                    $coverage_errors[0]['coverage_limit_type']
                                )
                            ) { ?>

                                <small class="text-red-500">

                                    <?= htmlspecialchars(
                                        $coverage_errors[0]['coverage_limit_type']
                                    ); ?>

                                </small>

                            <?php } ?>

                        </div>

                        <div>

                            <label class="font-medium">
                                Deductible / Excess
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="deductible_amount[]"
                                class="w-full border p-2 rounded"
                                placeholder="0.00"
                            >

                        </div>

                        <div>

                            <label class="font-medium">
                                Deductible Type
                            </label>

                            <select
                                name="deductible_type[]"
                                class="w-full border p-2 rounded"
                            >

                                <option value="">
                                    Select Deductible Type
                                </option>

                                <option value="Fixed Amount">
                                    Fixed Amount
                                </option>

                                <option value="Percentage">
                                    Percentage
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="mb-8">

            <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
                Financial Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

            <div>

                <label class="font-medium">
                    Sum Insured / Overall Coverage Amount
                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="sum_insured"
                    value="<?= set_value('sum_insured'); ?>"
                    class="w-full border p-2 rounded"
                    placeholder="0.00" required
                >

            </div>

            <div>

                <label class="font-medium">
                    Premium Amount
                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="premium_amount"
                    id="premium_amount"
                    value="<?= set_value('premium_amount'); ?>"
                    class="w-full border p-2 rounded"
                    placeholder="0.00" required
                >

            </div>

            <div>

                <label class="font-medium">
                    Discount
                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="discount_amount"
                    id="discount"
                    value="<?= set_value(
                        'discount_amount',
                        '0.00'
                    ); ?>"
                    class="w-full border p-2 rounded"
                    placeholder="0.00"
                >

            </div>

            <div>

                <label class="font-medium">
                    VAT Treatment
                </label>

                <select
                    name="vat_treatment"
                    id="vat_treatment"
                    class="w-full border p-2 rounded"
                >

                    <option value="">
                        Select VAT Treatment
                    </option>

                    <option
                        value="Taxable"
                        <?= set_select(
                            'vat_treatment',
                            'Taxable'
                        ); ?>
                    >
                        Taxable
                    </option>

                    <option
                        value="Exempt"
                        <?= set_select(
                            'vat_treatment',
                            'Exempt'
                        ); ?>
                    >
                        Exempt
                    </option>

                    <option
                        value="Zero Rated"
                        <?= set_select(
                            'vat_treatment',
                            'Zero Rated'
                        ); ?>
                    >
                        Zero Rated
                    </option>

                    <option
                        value="Out of Scope"
                        <?= set_select(
                            'vat_treatment',
                            'Out of Scope'
                        ); ?>
                    >
                        Out of Scope
                    </option>

                </select>

            </div>

            <div>

                <label class="font-medium">
                    VAT %
                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="vat_rate"
                    id="vat_rate"
                    value="<?= set_value('vat_rate'); ?>"
                    class="w-full border p-2 rounded"
                    placeholder="5.00"
                >

            </div>

            <div>

                <label class="font-medium">
                    VAT Amount
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="vat_amount"
                    id="vat_amount"
                    class="w-full border p-2 rounded bg-gray-100"
                    placeholder="0.00"
                    readonly
                >

            </div>

            <div>

                <label class="font-medium">
                    Total Premium
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="total_premium"
                    id="total_premium"
                    class="w-full border p-2 rounded bg-gray-100"
                    placeholder="0.00"
                    readonly
                >

            </div>

        </div>

        <div class="mb-8">

            <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
                Policy Details
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>

                <label class="font-medium">
                    Customer / Policyholder
                </label>

                <input
                    type="text"
                    id="insured_person_entity"
                    class="w-full border p-2 rounded bg-gray-100"
                    placeholder="Customer / policyholder"
                    readonly
                >

            </div>

            <div>

                <label class="font-medium">
                    Beneficiary
                </label>

                <input
                    type="text"
                    name="beneficiary"
                    value="<?= set_value('beneficiary'); ?>"
                    class="w-full border p-2 rounded"
                    placeholder="Enter beneficiary"
                >

            </div>

            <div class="col-span-2">

                <label class="font-medium">
                    Policy Description
                </label>

                <textarea
                    name="policy_description"
                    rows="3"
                    class="w-full border p-2 rounded"
                    placeholder="Enter policy description"
                ><?= set_value('policy_description'); ?></textarea>

            </div>

            <div>

                <label class="font-medium">
                    Special Conditions
                </label>

                <textarea
                    name="special_conditions"
                    rows="4"
                    class="w-full border p-2 rounded"
                    placeholder="Enter special conditions"
                ><?= set_value('special_conditions'); ?></textarea>

            </div>

            <div>

                <label class="font-medium">
                    Exclusions
                </label>

                <textarea
                    name="exclusions"
                    rows="4"
                    class="w-full border p-2 rounded"
                    placeholder="Enter policy exclusions"
                ><?= set_value('exclusions'); ?></textarea>

            </div>

            <div class="col-span-2">

                <label class="font-medium">
                    Notes
                </label>

                <textarea
                    name="notes"
                    rows="4"
                    class="w-full border p-2 rounded"
                    placeholder="Enter additional notes"
                ><?= set_value('notes'); ?></textarea>

            </div>

        </div>

        <!-- <div class="mb-8">

            <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
                Cancellation Details
            </h3>

            <div class="grid grid-cols-2 gap-4">

                <div>

                    <label class="font-medium">
                        Cancellation Date
                    </label>

                    <input
                        type="date"
                        name="cancellation_date"
                        value="<?= set_value(
                            'cancellation_date'
                        ); ?>"
                        class="w-full border p-2 rounded"
                    >

                </div>

                <div>

                    <label class="font-medium">
                        Cancellation Reason
                    </label>

                    <input
                        type="text"
                        name="cancellation_reason"
                        value="<?= set_value(
                            'cancellation_reason'
                        ); ?>"
                        class="w-full border p-2 rounded"
                        placeholder="Enter cancellation reason"
                    >

                </div>

            </div>
        </div> -->

        <div class="mb-8">

            <div class="flex items-center justify-between mb-4 pb-2 border-b">
                <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
                    Policy Documents
                </h3>
                <button
                    type="button"
                    onclick="addDocument()"
                    class="px-4 py-2 bg-green-600 text-white rounded mb-6"
                >

                    + Add Document

                </button>
            </div>

            <div id="document-container">

                <div class="document-row grid grid-cols-3 gap-4 mb-4">

                    <div>

                        <label class="font-medium">
                            Document Type
                        </label>

                        <select
                            name="document_type[]"
                            class="w-full border p-2 rounded"
                        >

                            <option value="">
                                Select Document Type
                            </option>

                            <option value="Policy Document">
                                Policy Document
                            </option>

                            <option value="Schedule">
                                Schedule
                            </option>

                            <option value="Certificate">
                                Certificate
                            </option>

                            <option value="Insurance Card">
                                Insurance Card
                            </option>

                            <option value="Terms & Conditions">
                                Terms & Conditions
                            </option>

                            <option value="Endorsement">
                                Endorsement
                            </option>

                            <option value="Other">
                                Other
                            </option>

                        </select>

                    </div>

                    <div>

                        <label class="font-medium">
                            Document Name
                        </label>

                        <input
                            type="text"
                            name="document_name[]"
                            class="w-full border p-2 rounded"
                            placeholder="Document name"
                        >

                    </div>

                    <div class="flex items-end gap-2">

                        <input
                            type="file"
                            name="document_file[]"
                            class="w-full border p-2 rounded"
                            accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                        >

                    </div>

                </div>

            </div>
        </div>

        <div class="mt-4">

            <button
                type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded"
            >

                Save Policy

            </button>

            <a
                href="<?= base_url(
                    'index.php/insurancepolicy/policies'
                ); ?>"
                class="ml-3 px-6 py-2 bg-gray-300 rounded"
            >

                Cancel

            </a>

        </div>

    </form>

</div>

<script>

$(document).ready(function () {

    $('#customer_id').change(function () {

        var customer_id = $(this).val();

        var customer_name =
            $('#customer_id option:selected')
                .text()
                .trim();

        if (customer_id !== '') {

            $('#insured_person_entity')
                .val(customer_name);

        } else {

            $('#insured_person_entity')
                .val('');

        }

        $('#vehicle_id').html(
            '<option value="">Select Vehicle</option>'
        );

        if (customer_id === '') {

            return;

        }

        $.ajax({

            url:
                '<?= base_url(
                    "index.php/insurancepolicy/get_vehicles_by_customer"
                ) ?>',

            type: 'POST',
            data: {
                customer_id: customer_id
            },
            dataType: 'json',

            success: function (vehicles) {

                $.each(
                    vehicles,
                    function (index, vehicle) {

                        $('#vehicle_id').append(

                            $('<option>', {

                                value:
                                    vehicle.vehicle_id,

                                text:
                                    vehicle.brand
                                    + ' - '
                                    + vehicle.registration_no

                            })

                        );

                    }
                );

            }

        });

    });

    $('#vehicle_id').change(function () {

        var vehicle_id = $(this).val();

        if (vehicle_id === '') {

            $('#customer_id').val('');

            $('#insured_person_entity').val('');

            return;

        }

        $.ajax({

            url:
                '<?= base_url(
                    "index.php/insurancepolicy/get_vehicle_customer"
                ) ?>',

            type: 'POST',
            data: {
                vehicle_id: vehicle_id
            },
            dataType: 'json',

            success: function (vehicle) {

                if (
                    vehicle &&
                    vehicle.customer_id
                ) {

                    var selectedVehicle =
                        vehicle_id;

                    $('#customer_id')
                        .val(vehicle.customer_id);

                    var customerName =
                        $('#customer_id option:selected')
                            .text()
                            .trim();

                    $('#insured_person_entity')
                        .val(customerName);

                    $('#vehicle_id')
                        .val(selectedVehicle);

                }

            }

        });

    });

    calculatePremium();

});

function addCoverage()
{

    let container =
        document.getElementById(
            'coverage-container'
        );

    let row =
        document.createElement('div');

    row.className =
        'coverage-row border border-gray-200 rounded-lg p-4 mb-4';

    row.innerHTML = `

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <div>

                <label class="font-medium">

                    Coverage Type
                    <span class="text-red-500">*</span>

                </label>

                <select
                    name="coverage_type_id[]"
                    class="w-full border p-2 rounded"
                >

                    <option value="">
                        Select Coverage Type
                    </option>

                    <?php
                    if (!empty($coverage_types)) {

                        foreach (
                            $coverage_types
                            as $coverage
                        ) {
                    ?>

                        <option
                            value="<?= $coverage->coverage_type_id ?>"
                        >

                            <?= htmlspecialchars(
                                $coverage->coverage_type_name
                            ) ?>

                        </option>

                    <?php
                        }
                    }
                    ?>

                </select>

            </div>

            <div>

                <label class="font-medium">

                    Coverage Amount
                    <span class="text-red-500">*</span>

                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="coverage_amount[]"
                    class="w-full border p-2 rounded"
                    placeholder="0.00"
                >

            </div>

            <div>

                <label class="font-medium">

                    Coverage Limit Type
                    <span class="text-red-500">*</span>

                </label>

                <select
                    name="coverage_limit_type[]"
                    class="w-full border p-2 rounded"
                >

                    <option value="">
                        Select Limit Type
                    </option>

                    <option value="Per Accident">
                        Per Accident
                    </option>

                    <option value="Per Claim">
                        Per Claim
                    </option>

                    <option value="Annual">
                        Annual
                    </option>

                    <option value="Aggregate">
                        Aggregate
                    </option>

                    <option value="Unlimited">
                        Unlimited
                    </option>

                </select>

            </div>

            <div>

                <label class="font-medium">

                    Deductible / Excess

                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="deductible_amount[]"
                    class="w-full border p-2 rounded"
                    placeholder="0.00"
                >

            </div>

            <div>

                <label class="font-medium">

                    Deductible Type

                </label>

                <select
                    name="deductible_type[]"
                    class="w-full border p-2 rounded"
                >

                    <option value="">
                        Select Deductible Type
                    </option>

                    <option value="Fixed Amount">
                        Fixed Amount
                    </option>

                    <option value="Percentage">
                        Percentage
                    </option>

                </select>

            </div>

            <div class="col-span-2">

                <button
                    type="button"
                    onclick="this.closest('.coverage-row').remove()"
                    class="px-4 py-2 bg-red-600 text-white rounded"
                >

                    Remove Coverage

                </button>

            </div>

        </div>

    `;

    container.appendChild(row);

}

function addDocument()
{

    let container =
        document.getElementById(
            'document-container'
        );

    let row =
        document.createElement('div');

    row.className =
        'document-row grid grid-cols-3 gap-4 mb-4';

    row.innerHTML = `

        <div>

            <label class="font-medium">
                Document Type
            </label>

            <select
                name="document_type[]"
                class="w-full border p-2 rounded"
            >

                <option value="">
                    Select Document Type
                </option>

                <option value="Policy Document">
                    Policy Document
                </option>

                <option value="Schedule">
                    Schedule
                </option>

                <option value="Certificate">
                    Certificate
                </option>

                <option value="Insurance Card">
                    Insurance Card
                </option>

                <option value="Terms & Conditions">
                    Terms & Conditions
                </option>

                <option value="Endorsement">
                    Endorsement
                </option>

                <option value="Other">
                    Other
                </option>

            </select>

        </div>

        <div>

            <label class="font-medium">
                Document Name
            </label>

            <input
                type="text"
                name="document_name[]"
                class="w-full border p-2 rounded"
                placeholder="Document name"
            >

        </div>

        <div class="flex items-end gap-2">

            <input
                type="file"
                name="document_file[]"
                class="w-full border p-2 rounded"
                accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
            >

            <button
                type="button"
                onclick="this.closest('.document-row').remove()"
                class="px-3 py-2 bg-red-600 text-white rounded"
            >

                Remove

            </button>

        </div>

    `;

    container.appendChild(row);

}

function calculatePremium()
{

    var premium =
        parseFloat(
            $('#premium_amount').val()
        ) || 0;

    var discount =
        parseFloat(
            $('#discount').val()
        ) || 0;

    var vatRate =
        parseFloat(
            $('#vat_rate').val()
        ) || 0;

    var vatTreatment =
        $('#vat_treatment').val();

    var netPremium =
        premium - discount;

    if (netPremium < 0) {

        netPremium = 0;

    }

    var vatAmount = 0;

    if (
        vatTreatment === 'Taxable'
    ) {

        vatAmount =
            (
                netPremium
                * vatRate
            ) / 100;

    }

    var totalPremium =
        netPremium + vatAmount;

    $('#vat_amount').val(
        vatAmount.toFixed(2)
    );

    $('#total_premium').val(
        totalPremium.toFixed(2)
    );

}

$(document).on(
    'input change',
    '#premium_amount, #discount, #vat_rate, #vat_treatment',
    function () {

        calculatePremium();

    }
);

</script>
