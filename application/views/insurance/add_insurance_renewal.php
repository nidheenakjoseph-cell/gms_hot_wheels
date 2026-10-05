<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <h2 class="text-2xl font-bold mb-4">
        <?= htmlspecialchars($title) ?>
    </h2>

    <?php if (validation_errors()) { ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <?= validation_errors(); ?>
        </div>
    <?php } ?>

    <form method="POST"
          enctype="multipart/form-data"
          action="<?= base_url('index.php/insurancerenewal/add_renewal'); ?>">

        <h3 class="text-lg font-semibold mb-4 border-b pb-2">
            Policy Information
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div>

                <label class="font-medium">
                    Existing Policy <span class="text-red-500">*</span>
                </label>

                <select name="policy_id"
                        id="policy_id"
                        required
                        class="w-full border p-2 rounded">

                    <option value="">Select Policy</option>

                    <?php if (!empty($policies)) {
                        foreach ($policies as $policy) { ?>

                            <option value="<?= $policy->policy_id ?>">
                                <?= htmlspecialchars($policy->policy_number) ?>
                            </option>

                    <?php }
                    } ?>

                </select>

            </div>

            <div>
                <label class="font-medium">
                    Insured Vehicle
                </label>

                <input type="text"
                       name="vehicle_id"
                       id="vehicle_id"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-medium">
                    Insurance Company
                </label>

                <input type="text"
                       name="insurance_company_name"
                       id="insurance_company_name"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-medium">
                    Policy Type
                </label>

                <input type="text"
                       name="policy_type_name"
                       id="policy_type_name"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-medium">
                    Policy Term
                </label>

                <input type="text"
                       name="policy_term_name"
                       id="policy_term_name"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-medium">
                    Expiry Date
                </label>

                <input type="date"
                       name="previous_expiry_date"
                       id="previous_expiry_date"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-medium">
                    Customer / Insured
                </label>

                <input type="text"
                       name="customer_name"
                       id="customer_name"
                       readonly
                       class="w-full border p-2 rounded bg-gray-100">
            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Renewal Information
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="font-medium">
                    New Policy Number
                </label>

                <input type="text"
                       name="new_policy_number"
                       class="w-full border p-2 rounded"
                       placeholder="Enter renewed policy number" required>
            </div>

            <div>
                <label class="font-medium">
                    Insurance Company
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
            </div>

            <div>
                <label class="font-medium">
                    Policy Type
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
                <label class="font-medium">
                    Start Date
                </label>

                <input type="date"
                       name="new_start_date"
                       class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="font-medium">
                    Expiry Date
                </label>

                <input type="date"
                       name="new_expiry_date"
                       class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="font-medium">
                    Renewal Request Date
                </label>

                <input type="date"
                       name="renewal_request_date"
                       value="<?= date('Y-m-d') ?>"
                       class="w-full border p-2 rounded" required>
            </div>

             <div>

                    <label class="font-medium">
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

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Previous Financial Information
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="font-medium">
                    Sum Insured / Overall Coverage Amount
                </label>

                <input type="number"
                    step="0.01"
                    name="previous_sum_insured"
                    id="previous_sum_insured"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-medium">
                    Premium Amount
                </label>

                <input type="number"
                    step="0.01"
                    name="previous_premium_amount"
                    id="previous_premium_amount"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-medium">
                    Discount
                </label>

                <input type="number"
                    step="0.01"
                    name="previous_discount_amount"
                    id="previous_discount_amount"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-medium">
                    VAT Treatment
                </label>

                <input type="text"
                    name="previous_vat_treatment"
                    id="previous_vat_treatment"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-medium">
                    VAT %
                </label>

                <input type="number"
                    step="0.01"
                    name="previous_vat_rate"
                    id="previous_vat_rate"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-medium">
                    VAT Amount
                </label>

                <input type="number"
                    step="0.01"
                    name="previous_vat_amount"
                    id="previous_vat_amount"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100">
            </div>

            <div>
                <label class="font-medium">
                    Total Premium
                </label>

                <input type="number"
                    step="0.01"
                    name="previous_total_premium"
                    id="previous_total_premium"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100">
            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Renewal Financial Information
        </h3>

        <div class="grid grid-cols-2 gap-4">

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

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Previous Coverage Information
        </h3>

        <div id="previous_coverage_container">

            <div class="text-gray-500 p-3 bg-gray-50 rounded">
                Select a policy to load previous coverage information.
            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            New Coverage Information
        </h3>

        <div id="new_coverage_container">

            <div class="coverage-row border rounded-lg p-4 mb-4 bg-gray-50">

                <div class="grid grid-cols-2 gap-4">

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
                        </label>

                        <input type="number"
                            step="0.01"
                            name="coverage_amount[]"
                            class="w-full border p-2 rounded"
                            placeholder="0.00" required>
                    </div>

                    <div>
                        <label class="font-medium">
                            Coverage Limit Type
                        </label>

                        <select name="coverage_limit_type[]"
                                class="w-full border p-2 rounded" required>

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

                        <input type="number"
                            step="0.01"
                            name="deductible[]"
                            class="w-full border p-2 rounded"
                            placeholder="0.00">
                    </div>

                    <div>
                        <label class="font-medium">
                            Deductible Type
                        </label>

                        <select name="deductible_type[]"
                                class="w-full border p-2 rounded">

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

                <div class="mt-4">
                    <button type="button"
                            class="remove-new-coverage px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Remove
                    </button>
                </div>

            </div>

        </div>

        <button type="button"
                id="add_new_coverage"
                class="mt-2 px-4 py-2 bg-green-600 text-white rounded">
            + Add Coverage
        </button>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Renewal Details
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div class="col-span-2">
                <label class="font-medium">
                    Remarks
                </label>

                <textarea name="remarks"
                          rows="4"
                          class="w-full border p-2 rounded"
                          placeholder="Enter renewal remarks"></textarea>
            </div>

        </div>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Renewal Documents
        </h3>

        <div id="document-container">

            <div class="document-row grid grid-cols-3 gap-4 mb-4">

                <div>
                    <label class="font-medium">
                        Document Type
                    </label>

                    <select name="document_type[]"
                            class="w-full border p-2 rounded">

                        <option value="">
                            Select Document Type
                        </option>

                        <option value="Renewed Policy Document">
                            Renewed Policy Document
                        </option>

                        <option value="Schedule">
                            Schedule
                        </option>

                        <option value="Certificate">
                            Certificate
                        </option>

                        <option value="Endorsement">
                            Endorsement
                        </option>

                        <option value="Terms & Conditions">
                            Terms & Conditions
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

                    <input type="text"
                           name="document_name[]"
                           class="w-full border p-2 rounded"
                           placeholder="Document name">
                </div>

                <div>
                    <label class="font-medium">
                        Upload Document
                    </label>

                    <input type="file"
                           name="document_file[]"
                           class="w-full border p-2 rounded"
                           accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                </div>

            </div>

        </div>

        <button type="button"
                onclick="addDocument()"
                class="px-4 py-2 bg-green-600 text-white rounded mb-6">
            + Add Document
        </button>

        <div class="mt-4">

            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded">
                Save Renewal
            </button>

            <a href="<?= base_url('index.php/insurancerenewal/renewals'); ?>"
               class="ml-3 px-6 py-2 bg-gray-300 rounded">
                Cancel
            </a>

        </div>

    </form>

</div>

<script>

function addDocument() {

    let container = document.getElementById('document-container');

    let row = document.createElement('div');

    row.className = 'document-row grid grid-cols-3 gap-4 mb-4';

    row.innerHTML = `
        <div>
            <label class="font-medium">
                Document Type
            </label>

            <select name="document_type[]"
                    class="w-full border p-2 rounded">

                <option value="">
                    Select Document Type
                </option>

                <option value="Renewed Policy Document">
                    Renewed Policy Document
                </option>

                <option value="Schedule">
                    Schedule
                </option>

                <option value="Certificate">
                    Certificate
                </option>

                <option value="Endorsement">
                    Endorsement
                </option>

                <option value="Terms & Conditions">
                    Terms & Conditions
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

            <input type="text"
                   name="document_name[]"
                   class="w-full border p-2 rounded"
                   placeholder="Document name">
        </div>

        <div class="flex items-end gap-2">

            <input type="file"
                   name="document_file[]"
                   class="w-full border p-2 rounded"
                   accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">

            <button type="button"
                    onclick="this.closest('.document-row').remove()"
                    class="px-3 py-2 bg-red-600 text-white rounded">
                Remove
            </button>

        </div>
    `;

    container.appendChild(row);
}

$(document).ready(function () {

    $('#policy_id').on('change', function () {

        var policy_id = $(this).val();

        if (policy_id === '') {

            $('#insurance_company_name').val('');
            $('#policy_type_name').val('');
            $('#policy_term_name').val('');
            $('#previous_expiry_date').val('');
            $('#customer_name').val('');
            $('#previous_sum_insured').val('');
            $('#vehicle_id').val('');
            $('#previous_premium_amount').val('');
            $('#previous_discount_amount').val('');
            $('#previous_vat_treatment').val('');
            $('#previous_vat_rate').val('');
            $('#previous_vat_amount').val('');
            $('#previous_total_premium').val('');
            
            $('#previous_coverage_container').html(`
                <div class="text-gray-500 p-3 bg-gray-50 rounded">
                    Select a policy to load previous coverage information.
                </div>
            `);

            return;
        }

        $.ajax({

            url: '<?= base_url("index.php/insurancerenewal/get_policy_for_renewal") ?>',
            type: 'POST',
            data: {
                policy_id: policy_id
            },
            dataType: 'json',

            success: function (response) {

                console.log(response);

                if (response) {

                    $('#previous_policy_number')
                        .val(response.policy_number || '');

                    $('#insurance_company_name')
                        .val(response.company_name || '');

                    $('#vehicle_id').val(
                        (response.vehicle_brand || '') +
                        ' - ' +
                        (response.vehicle_registration_no || '')
                    );

                    $('#policy_type_name')
                        .val(response.policy_type_name || '');

                    $('#policy_term_name')
                        .val(response.policy_term_name || '');

                    $('#previous_expiry_date')
                        .val(response.expiry_date || '');

                    $('#customer_name')
                        .val(response.customer_name || '');

                    $('#previous_sum_insured')
                        .val(response.sum_insured || '');

                    $('#previous_premium_amount')
                        .val(response.premium_amount || '');

                    $('#previous_discount_amount')
                        .val(response.discount_amount || '');

                    $('#previous_vat_treatment')
                        .val(response.vat_treatment || '');

                    $('#previous_vat_rate')
                        .val(response.vat_rate || '');

                    $('#previous_vat_amount')
                        .val(response.vat_amount || '');

                    $('#previous_total_premium')
                        .val(response.total_premium || '');

                }

            },

            error: function (xhr, status, error) {

                console.log('Policy AJAX Error:');
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);

            }

        });

        $.ajax({

            url: '<?= base_url("index.php/insurancerenewal/get_policy_coverages") ?>',
            type: 'POST',
            data: {
                policy_id: policy_id
            },
            dataType: 'json',

            success: function (response) {

                $('#previous_coverage_container').html('');

                if (response && response.length > 0) {

                    $.each(response, function (index, coverage) {

                        var coverageHtml = `

                            <div class="border rounded-lg p-4 mb-4 bg-gray-50">

                                <h4 class="font-semibold text-gray-700 mb-4">
                                    Coverage ${index + 1}
                                </h4>

                                <div class="grid grid-cols-2 gap-4">

                                    <div>

                                        <label class="font-medium">
                                            Coverage Type
                                        </label>

                                        <input type="text"
                                               value="${coverage.coverage_type_name || ''}"
                                               readonly
                                               class="w-full border p-2 rounded bg-gray-100">

                                    </div>

                                    <div>

                                        <label class="font-medium">
                                            Coverage Amount
                                        </label>

                                        <input type="number"
                                               value="${coverage.coverage_amount || 0}"
                                               readonly
                                               class="w-full border p-2 rounded bg-gray-100">

                                    </div>

                                    <div>

                                        <label class="font-medium">
                                            Coverage Limit Type
                                        </label>

                                        <input type="text"
                                               value="${coverage.coverage_limit_type || ''}"
                                               readonly
                                               class="w-full border p-2 rounded bg-gray-100">

                                    </div>

                                    <div>

                                        <label class="font-medium">
                                            Deductible / Excess
                                        </label>

                                        <input type="number"
                                               value="${coverage.deductible_amount || 0}"
                                               readonly
                                               class="w-full border p-2 rounded bg-gray-100">

                                    </div>

                                    <div>

                                        <label class="font-medium">
                                            Deductible Type
                                        </label>

                                        <input type="text"
                                               value="${coverage.deductible_type || ''}"
                                               readonly
                                               class="w-full border p-2 rounded bg-gray-100">

                                    </div>

                                </div>

                            </div>

                        `;

                        $('#previous_coverage_container')
                            .append(coverageHtml);

                    });

                } else {

                    $('#previous_coverage_container').html(`
                        <div class="text-gray-500 p-3 bg-gray-50 rounded">
                            No coverage information found for this policy.
                        </div>
                    `);

                }

            },

            error: function (xhr, status, error) {

                console.log('Coverage AJAX Error:');
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);

                $('#previous_coverage_container').html(`
                    <div class="text-red-500 p-3 bg-red-50 rounded">
                        Unable to load previous coverage information.
                    </div>
                `);

            }

        });

    });

    $('#add_new_coverage').on('click', function () {

        var coverageRow = `
            <div class="coverage-row border rounded-lg p-4 mb-4 bg-gray-50">

                <div class="grid grid-cols-2 gap-4">

                    <div>

                        <label class="font-medium">
                            Coverage Type
                        </label>

                        <select name="coverage_type_id[]"
                                class="w-full border p-2 rounded">

                            <option value="">
                                Select Coverage Type
                            </option>

                            <?php if (!empty($coverage_types)) : ?>

                                <?php foreach ($coverage_types as $coverage) : ?>

                                    <option value="<?= $coverage->coverage_type_id ?>">
                                        <?= htmlspecialchars($coverage->coverage_type_name) ?>
                                    </option>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </select>

                    </div>

                    <div>

                        <label class="font-medium">
                            Coverage Amount
                        </label>

                        <input type="number"
                               step="0.01"
                               name="coverage_amount[]"
                               class="w-full border p-2 rounded"
                               placeholder="0.00">

                    </div>

                    <div>

                        <label class="font-medium">
                            Coverage Limit Type
                        </label>

                        <select name="coverage_limit_type[]"
                                class="w-full border p-2 rounded">

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

                        <input type="number"
                               step="0.01"
                               name="deductible[]"
                               class="w-full border p-2 rounded"
                               placeholder="0.00">

                    </div>

                    <div>

                        <label class="font-medium">
                            Deductible Type
                        </label>

                        <select name="deductible_type[]"
                                class="w-full border p-2 rounded">

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

                <div class="mt-4">

                    <button type="button"
                            class="remove-new-coverage px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">

                        Remove

                    </button>

                </div>

            </div>
        `;

        $('#new_coverage_container').append(coverageRow);

    });

    $(document).on('click', '.remove-new-coverage', function () {

        $(this).closest('.coverage-row').remove();

    });


});

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
