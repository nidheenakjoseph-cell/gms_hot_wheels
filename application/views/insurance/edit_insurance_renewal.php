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
        action="<?= base_url(
            'index.php/insurancerenewal/edit_renewal/'
            . $renewal->renewal_id
        ); ?>">

        <h3 class="text-lg font-semibold mb-4 border-b pb-2">
            Policy Information
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div>

                <label class="font-medium">
                    Customer / Insured
                </label>

                <input type="text"
                    value="<?= htmlspecialchars(
                        $renewal->customer_name ?? ''
                    ); ?>"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100">

            </div>

            <div>

                <label class="font-medium">
                    Insured Vehicle
                </label>

                <input type="text"
                    value="<?= htmlspecialchars(
                        $policy->vehicle_brand . ' - ' . $policy->vehicle_registration_no
                    ) ?>"
                    readonly
                    class="w-full border p-2 rounded bg-gray-100">

            </div>

            <div>
                <label class="font-medium">
                    Policy Number
                </label>

                <input name="policy_number" type="text"
                    value="<?= htmlspecialchars(
                        $policy->policy_number ?? ''
                    ); ?>"
                    class="w-full border p-2 rounded" required>

            </div>

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Insurance Company
                </label>

                <select
                    name="insurance_company_id"
                    class="w-full border p-2 rounded" required
                >

                    <option value="">
                        Select Insurance Company
                    </option>

                    <?php if (!empty($insurance_companies)) { ?>

                        <?php foreach ($insurance_companies as $company) { ?>

                            <option
                                value="<?= htmlspecialchars($company->company_id); ?>"
                                <?= ((string)$policy->insurance_company_id === (string)$company->company_id)
                                    ? 'selected'
                                    : ''; ?>
                            >
                                <?= htmlspecialchars($company->company_name); ?>
                            </option>

                        <?php } ?>

                    <?php } ?>

                </select>

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

                    <?php if (!empty($policy_types)) { ?>

                        <?php foreach ($policy_types as $type) { ?>

                            <option
                                value="<?= $type->policy_type_id; ?>"
                                <?= (
                                    (string)set_value(
                                        'policy_type_id',
                                        $policy->policy_type_id ?? ''
                                    )
                                    ===
                                    (string)$type->policy_type_id
                                )
                                    ? 'selected'
                                    : ''; ?>
                            >
                                <?= htmlspecialchars(
                                    $type->policy_type_name
                                ); ?>
                            </option>

                        <?php } ?>

                    <?php } ?>

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

                    <?php if (!empty($policy_terms)) { ?>

                        <?php foreach ($policy_terms as $term) { ?>

                            <option
                                value="<?= $term->policy_term_id; ?>"
                                <?= (
                                    (string)set_value(
                                        'policy_term_id',
                                        $policy->policy_term_id ?? ''
                                    )
                                    ===
                                    (string)$term->policy_term_id
                                )
                                    ? 'selected'
                                    : ''; ?>
                            >
                                <?= htmlspecialchars(
                                    $term->policy_term_name
                                ); ?>
                            </option>

                        <?php } ?>

                    <?php } ?>

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

                <input type="date" name="start_date"
                    value="<?= htmlspecialchars(
                        $policy->start_date ?? ''
                    ); ?>"
                    class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="font-medium">
                    Expiry Date
                </label>

                <input type="date" name="expiry_date"
                    value="<?= htmlspecialchars(
                        $policy->expiry_date ?? ''
                    ); ?>"
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

                    <option value="">
                        Select Policy Status
                    </option>

                    <option
                        value="Draft"
                        <?= (
                            ($policy->policy_status ?? '') == 'Draft'
                        ) ? 'selected' : ''; ?>
                    >
                        Draft
                    </option>

                    <option
                        value="Active"
                        <?= (
                            ($policy->policy_status ?? '') == 'Active'
                        ) ? 'selected' : ''; ?>
                    >
                        Active
                    </option>

                    <option
                        value="Suspended"
                        <?= (
                            ($policy->policy_status ?? '') == 'Suspended'
                        ) ? 'selected' : ''; ?>
                    >
                        Suspended
                    </option>

                    <option
                        value="Expired"
                        <?= (
                            ($policy->policy_status ?? '') == 'Expired'
                        ) ? 'selected' : ''; ?>
                    >
                        Expired
                    </option>

                    <option
                        value="Cancelled"
                        <?= (
                            ($policy->policy_status ?? '') == 'Cancelled'
                        ) ? 'selected' : ''; ?>
                    >
                        Cancelled
                    </option>

                </select>

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
                value="<?= htmlspecialchars(
                    set_value(
                        'sum_insured',
                        $policy->sum_insured ?? '0.00'
                    )
                ); ?>"
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
                value="<?= htmlspecialchars(
                    set_value(
                        'premium_amount',
                        $policy->premium_amount ?? '0.00'
                    )
                ); ?>"
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
                value="<?= htmlspecialchars(
                    set_value(
                        'discount_amount',
                        $policy->discount_amount ?? '0.00'
                    )
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
                    <?= (
                        set_value(
                            'vat_treatment',
                            $policy->vat_treatment ?? ''
                        ) == 'Taxable'
                    ) ? 'selected' : ''; ?>
                >
                    Taxable
                </option>

                <option
                    value="Exempt"
                    <?= (
                        set_value(
                            'vat_treatment',
                            $policy->vat_treatment ?? ''
                        ) == 'Exempt'
                    ) ? 'selected' : ''; ?>
                >
                    Exempt
                </option>

                <option
                    value="Zero Rated"
                    <?= (
                        set_value(
                            'vat_treatment',
                            $policy->vat_treatment ?? ''
                        ) == 'Zero Rated'
                    ) ? 'selected' : ''; ?>
                >
                    Zero Rated
                </option>

                <option
                    value="Out of Scope"
                    <?= (
                        set_value(
                            'vat_treatment',
                            $policy->vat_treatment ?? ''
                        ) == 'Out of Scope'
                    ) ? 'selected' : ''; ?>
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
                value="<?= htmlspecialchars(
                    set_value(
                        'vat_rate',
                        $policy->vat_rate ?? '0.00'
                    )
                ); ?>"
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
                value="<?= htmlspecialchars(
                    set_value(
                        'vat_amount',
                        $policy->vat_amount ?? '0.00'
                    )
                ); ?>"
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
                value="<?= htmlspecialchars(
                    set_value(
                        'total_premium',
                        $policy->total_premium ?? '0.00'
                    )
                ); ?>"
                class="w-full border p-2 rounded bg-gray-100"
                placeholder="0.00"
                readonly
            >
        </div>

    </div>

    <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
        Coverage Information
    </h3>

    <div id="coverage-container">

        <?php if (!empty($coverages)) { ?>

            <?php foreach ($coverages as $i => $coverage) { ?>

                <div class="coverage-row border rounded-lg p-4 mb-4 bg-gray-50">

                    <input
                        type="hidden"
                        name="coverage_id[]"
                        value="<?= htmlspecialchars(
                            $coverage->policy_coverage_id ?? ''
                        ); ?>"
                    >

                    <div class="grid grid-cols-2 gap-4">

                        <div>

                            <label class="font-medium">
                                Coverage Type
                            </label>

                            <select
                                name="coverage_type_id[]"
                                class="w-full border p-2 rounded"
                                required
                            >

                                <option value="">
                                    Select Coverage Type
                                </option>

                                <?php foreach (
                                    $coverage_types
                                    as $coverage_type
                                ) { ?>

                                    <option
                                        value="<?= $coverage_type->coverage_type_id; ?>"
                                        <?= (
                                            $coverage_type->coverage_type_id
                                            == $coverage->coverage_type_id
                                        )
                                            ? 'selected'
                                            : ''; ?>
                                    >
                                        <?= htmlspecialchars(
                                            $coverage_type->coverage_type_name
                                        ); ?>
                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                        <div>

                            <label class="font-medium">
                                Coverage Amount
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="coverage_amount[]"
                                value="<?= htmlspecialchars(
                                    $coverage->coverage_amount ?? '0.00'
                                ); ?>"
                                class="w-full border p-2 rounded"
                                required
                            >

                        </div>

                        <div>

                            <label class="font-medium">
                                Coverage Limit Type
                            </label>

                            <select
                                name="coverage_limit_type[]"
                                class="w-full border p-2 rounded"
                                required
                            >

                                <option value="">
                                    Select Limit Type
                                </option>

                                <option
                                    value="Per Accident"
                                    <?= (
                                        ($coverage->coverage_limit_type ?? '')
                                        == 'Per Accident'
                                    )
                                        ? 'selected'
                                        : ''; ?>
                                >
                                    Per Accident
                                </option>

                                <option
                                    value="Per Claim"
                                    <?= (
                                        ($coverage->coverage_limit_type ?? '')
                                        == 'Per Claim'
                                    )
                                        ? 'selected'
                                        : ''; ?>
                                >
                                    Per Claim
                                </option>

                                <option
                                    value="Annual"
                                    <?= (
                                        ($coverage->coverage_limit_type ?? '')
                                        == 'Annual'
                                    )
                                        ? 'selected'
                                        : ''; ?>
                                >
                                    Annual
                                </option>

                                <option
                                    value="Aggregate"
                                    <?= (
                                        ($coverage->coverage_limit_type ?? '')
                                        == 'Aggregate'
                                    )
                                        ? 'selected'
                                        : ''; ?>
                                >
                                    Aggregate
                                </option>

                                <option
                                    value="Unlimited"
                                    <?= (
                                        ($coverage->coverage_limit_type ?? '')
                                        == 'Unlimited'
                                    )
                                        ? 'selected'
                                        : ''; ?>
                                >
                                    Unlimited
                                </option>

                                

                            </select>

                        </div>

                        <div>

                            <label class="font-medium">
                                Deductible
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="deductible[]"
                                value="<?= htmlspecialchars(
                                    $coverage->deductible_amount ?? '0.00'
                                ); ?>"
                                class="w-full border p-2 rounded"
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

                                <option
                                    value="Fixed Amount"
                                    <?= (
                                        ($coverage->deductible_type ?? '')
                                        == 'Fixed Amount'
                                    )
                                        ? 'selected'
                                        : ''; ?>
                                >
                                    Fixed Amount
                                </option>

                                <option
                                    value="Percentage"
                                    <?= (
                                        ($coverage->deductible_type ?? '')
                                        == 'Percentage'
                                    )
                                        ? 'selected'
                                        : ''; ?>
                                >
                                    Percentage
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="mt-4">

                        <button
                            type="button"
                            class="delete-coverage-btn px-4 py-2 bg-red-600 text-white rounded"
                        >
                            Delete Coverage
                        </button>

                    </div>

                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="p-3 bg-gray-100 rounded text-gray-600 mb-4">
                No coverage information available.
            </div>

        <?php } ?>

    </div>

    <button
        type="button"
        onclick="addCoverage()"
        class="px-4 py-2 bg-green-600 text-white rounded mb-6"
    >
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
                        placeholder="Enter renewal remarks"><?= htmlspecialchars(
                            $renewal->remarks ?? ''
                        ); ?></textarea>

        </div>

    </div>

    <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
        Existing Renewal Documents
    </h3>

    <?php if (!empty($renewal_documents)) { ?>

        <div class="overflow-x-auto mb-6">

            <table class="w-full border border-gray-200">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="border p-2">
                            #
                        </th>

                        <th class="border p-2">
                            Document Type
                        </th>

                        <th class="border p-2">
                            Document Name
                        </th>

                        <th class="border p-2">
                            File
                        </th>

                        <th class="border p-2">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php
                    $document_count = 1;

                    foreach (
                        $renewal_documents
                        as $document
                    ) {
                    ?>

                        <tr>

                            <td class="border p-2">
                                <?= $document_count++; ?>
                            </td>

                            <td class="border p-2">
                                <?= htmlspecialchars(
                                    $document->document_type
                                    ?? '-'
                                ); ?>
                            </td>

                            <td class="border p-2">
                                <?= htmlspecialchars(
                                    $document->document_name
                                    ?? '-'
                                ); ?>
                            </td>

                            <td>
                                <?php if (!empty($document->file_path)) { ?>

                                <a href="<?= base_url($document->file_path); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="text-blue-600 hover:underline">
                                    View
                                </a>

                                <?php } else { ?>

                                    <span class="text-gray-500">
                                        No file
                                    </span>

                                <?php } ?>
                            </td>

                            <td class="border p-2">

                                <a href="<?= base_url(
                                    'index.php/insurancerenewal/delete_document/'
                                    . $document->document_id
                                ); ?>"
                                    onclick="return confirm(
                                        'Are you sure you want to delete this document?'
                                    );"
                                    class="text-red-600 hover:underline">

                                    Delete

                                </a>

                            </td>

                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

        <?php } else { ?>

            <div class="mb-6 p-3 bg-gray-100 rounded text-gray-600">

                No documents uploaded for this renewal.

            </div>

        <?php } ?>

        <h3 class="text-lg font-semibold mt-8 mb-4 border-b pb-2">
            Add New Renewal Documents
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

                Update Renewal

            </button>

            <a href="<?= base_url(
                'index.php/insurancerenewal/renewals'
            ); ?>"
               class="ml-3 px-6 py-2 bg-gray-300 rounded">

                Cancel

            </a>

        </div>

    </form>

</div>

<script>

function addDocument()
{
    let container =
        document.getElementById('document-container');

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

function addCoverage()
{
    let container =
        document.getElementById('coverage-container');

    let row =
        document.createElement('div');

    row.className =
        'coverage-row border rounded-lg p-4 mb-4 bg-gray-50';

    row.innerHTML = `

        <input
            type="hidden"
            name="coverage_id[]"
            value=""
        >

        <div class="grid grid-cols-2 gap-4">

            <div>

                <label class="font-medium">
                    Coverage Type
                </label>

                <select
                    name="coverage_type_id[]"
                    class="w-full border p-2 rounded"
                    required
                >

                    <option value="">
                        Select Coverage Type
                    </option>

                    <?php foreach (
                        $coverage_types
                        as $coverage_type
                    ) { ?>

                        <option
                            value="<?= $coverage_type->coverage_type_id; ?>"
                        >
                            <?= htmlspecialchars(
                                $coverage_type->coverage_type_name
                            ); ?>
                        </option>

                    <?php } ?>

                </select>

            </div>

            <div>

                <label class="font-medium">
                    Coverage Amount
                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="coverage_amount[]"
                    value="0.00"
                    class="w-full border p-2 rounded"
                    required
                >

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
                    Deductible
                </label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    name="deductible[]"
                    value="0.00"
                    class="w-full border p-2 rounded"
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

        <div class="mt-4">

            <button
                type="button"
                onclick="this.closest('.coverage-row').remove()"
                class="px-4 py-2 bg-red-600 text-white rounded"
            >
                Remove
            </button>

        </div>

    `;

    container.appendChild(row);
}

document.addEventListener('click', function (e) {

    if (!e.target.classList.contains('delete-coverage-btn')) {
        return;
        
    }

    const button = e.target;

    const row = button.closest('.coverage-row');

    if (!row) {
        
        return;
    }

    const coverageInput = row.querySelector(
        'input[name="coverage_id[]"]'
    );

    const coverageId = coverageInput
        ? coverageInput.value
        : '';

    if (!coverageId) {
        row.remove();
        return;
    }

    if (!confirm(
        'Are you sure you want to delete this coverage?'
    )) {
        return;
    }

    const deleteInput =
        document.createElement('input');

    deleteInput.type = 'hidden';

    deleteInput.name =
        'delete_coverage_id[]';

    deleteInput.value =
        coverageId;

    document
        .getElementById('coverage-container')
        .appendChild(deleteInput);

    row.remove();
});

</script>