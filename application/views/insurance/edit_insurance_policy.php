<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <div class="flex items-center justify-between mb-6">

        <div>
            <h2 class="text-2xl font-bold text-gray-800">
                <?= htmlspecialchars($title) ?>
            </h2>
        </div>

    </div>

    <?php if ($this->session->flashdata('success')) : ?>

        <div class="mb-5 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
            <?= htmlspecialchars($this->session->flashdata('success')); ?>
        </div>

    <?php endif; ?>

    <form method="post"
        action="<?= base_url('index.php/insurancepolicy/edit_policy/' . $policy->policy_id); ?>"
        enctype="multipart/form-data">

        <div class="mb-8">

            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                Policy Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Customer / Policyholder <span class="text-red-500">*</span>
                    </label>

                    <select name="customer_id"
                        id="customer_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                        <option value="">Select Customer</option>

                        <?php foreach ($customers as $customer) : ?>
                            <option value="<?= $customer->customer_id; ?>"
                                <?= ($policy->customer_id == $customer->customer_id) ? 'selected' : ''; ?>>

                                <?= htmlspecialchars($customer->name); ?>

                            </option>
                        <?php endforeach; ?>

                    </select>

                    <?= form_error(
                        'customer_id',
                        '<small class="text-red-500 block mt-1">',
                        '</small>'
                    ); ?>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Insured Vehicle <span class="text-red-500">*</span>
                    </label>

                    <select name="vehicle_id"
                            id="vehicle_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                        <option value="">
                            Select Vehicle
                        </option>

                    </select>

                    <?= form_error(
                        'vehicle_id',
                        '<small class="text-red-500 block mt-1">',
                        '</small>'
                    ); ?>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Policy Number <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                        name="policy_number"
                        value="<?= htmlspecialchars($policy->policy_number ?? ''); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                    <?= form_error(
                        'policy_number',
                        '<small class="text-red-500 block mt-1">',
                        '</small>'
                    ); ?>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Insurance Company <span class="text-red-500">*</span>
                    </label>

                    <select name="insurance_company_id"
                        id="insurance_company_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                        <option value="">
                            Select Insurance Company
                        </option>

                        <?php foreach ($insurance_companies as $company) : ?>

                            <option value="<?= $company->company_id; ?>"
                                <?= ($policy->insurance_company_id == $company->company_id) ? 'selected' : ''; ?>>

                                <?= htmlspecialchars($company->company_name); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                    <?= form_error(
                        'insurance_company_id',
                        '<small class="text-red-500 block mt-1">',
                        '</small>'
                    ); ?>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Policy Type <span class="text-red-500">*</span>
                    </label>

                    <select name="policy_type_id"
                        id="policy_type_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                        <option value="">
                            Select Policy Type
                        </option>

                        <?php foreach ($policy_types as $type) : ?>

                            <option value="<?= $type->policy_type_id; ?>"
                                <?= ($policy->policy_type_id == $type->policy_type_id) ? 'selected' : ''; ?>>

                                <?= htmlspecialchars($type->policy_type_name); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                    <?= form_error(
                        'policy_type_id',
                        '<small class="text-red-500 block mt-1">',
                        '</small>'
                    ); ?>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Policy Term <span class="text-red-500">*</span>
                    </label>

                    <select name="policy_term_id"
                        id="policy_term_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                        <option value="">
                            Select Policy Term
                        </option>

                        <?php foreach ($policy_terms as $term) : ?>

                            <option value="<?= $term->policy_term_id; ?>"
                                <?= ($policy->policy_term_id == $term->policy_term_id) ? 'selected' : ''; ?>>

                                <?= htmlspecialchars($term->policy_term_name); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                    <?= form_error(
                        'policy_term_id',
                        '<small class="text-red-500 block mt-1">',
                        '</small>'
                    ); ?>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Policy Status
                    </label>

                    <select name="policy_status"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2">

                        <option value="Draft"
                            <?= ($policy->policy_status == 'Draft') ? 'selected' : ''; ?>>
                            Draft
                        </option>

                        <option value="Active"
                            <?= ($policy->policy_status == 'Active') ? 'selected' : ''; ?>>
                            Active
                        </option>

                        <option value="Suspended"
                            <?= ($policy->policy_status == 'Suspended') ? 'selected' : ''; ?>>
                            Suspended
                        </option>

                        <option value="Expired"
                            <?= ($policy->policy_status == 'Expired') ? 'selected' : ''; ?>>
                            Expired
                        </option>

                        <option value="Cancelled"
                            <?= ($policy->policy_status == 'Cancelled') ? 'selected' : ''; ?>>
                            Cancelled
                        </option>

                    </select>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Start Date <span class="text-red-500">*</span>
                    </label>

                    <input type="date"
                        name="start_date"
                        value="<?= htmlspecialchars($policy->start_date ?? ''); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                        <?= form_error(
                            'start_date',
                            '<small class="text-red-500 block mt-1">',
                            '</small>'
                        ); ?>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Expiry Date <span class="text-red-500">*</span>
                    </label>

                    <input type="date"
                        name="expiry_date"
                        value="<?= htmlspecialchars($policy->expiry_date ?? ''); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                        <?= form_error(
                            'expiry_date',
                            '<small class="text-red-500 block mt-1">',
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

                <button type="button"
                    onclick="addCoverage()"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">

                    + Add Coverage

                </button>

            </div>

            <div id="coverage-container">

                <?php if (!empty($policy_coverages)) : ?>

                    <?php foreach ($policy_coverages as $index => $coverage) : ?>

                        <div class="coverage-row border border-gray-200 rounded-lg p-4 mb-4">

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                                <div>

                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Coverage Type
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <select name="coverage_type_id[]"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                                        <option value="">Select Coverage Type</option>

                                        <?php foreach ($coverage_types as $type) : ?>

                                            <option value="<?= $type->coverage_type_id; ?>"
                                                <?= ($coverage->coverage_type_id == $type->coverage_type_id)
                                                    ? 'selected'
                                                    : ''; ?>>

                                                <?= htmlspecialchars($type->coverage_type_name); ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                    <?php if (!empty($coverage_errors[$index]['coverage_type'])) : ?>

                                        <small class="text-red-500 block mt-1">
                                            <?= htmlspecialchars(
                                                $coverage_errors[$index]['coverage_type']
                                            ); ?>
                                        </small>

                                    <?php endif; ?>

                                </div>

                                <div>

                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Coverage Amount <span class="text-red-500">*</span>
                                    </label>

                                    <input type="number"
                                        step="0.01"
                                        min="0"
                                        name="coverage_amount[]"
                                        value="<?= htmlspecialchars($coverage->coverage_amount ?? '0.00'); ?>"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2"
                                        placeholder="0.00" required>

                                    <?php if (!empty($coverage_errors[$index]['coverage_amount'])) : ?>

                                        <small class="text-red-500 block mt-1">
                                            <?= htmlspecialchars(
                                                $coverage_errors[$index]['coverage_amount']
                                            ); ?>
                                        </small>

                                    <?php endif; ?>

                                </div>

                                <div>

                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Coverage Limit Type <span class="text-red-500">*</span>
                                    </label>

                                    <select name="coverage_limit_type[]"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                                        <option value="">Select Limit Type</option>

                                        <option value="Per Accident"
                                            <?= ($coverage->coverage_limit_type == 'Per Accident')
                                                ? 'selected'
                                                : ''; ?>>
                                            Per Accident
                                        </option>

                                        <option value="Per Claim"
                                            <?= ($coverage->coverage_limit_type == 'Per Claim')
                                                ? 'selected'
                                                : ''; ?>>
                                            Per Claim
                                        </option>

                                        <option value="Annual"
                                            <?= ($coverage->coverage_limit_type == 'Annual')
                                                ? 'selected'
                                                : ''; ?>>
                                            Annual
                                        </option>

                                        <option value="Aggregate"
                                            <?= ($coverage->coverage_limit_type == 'Aggregate')
                                                ? 'selected'
                                                : ''; ?>>
                                            Aggregate
                                        </option>

                                        <option value="Unlimited"
                                            <?= ($coverage->coverage_limit_type == 'Unlimited')
                                                ? 'selected'
                                                : ''; ?>>
                                            Unlimited
                                        </option>

                                    </select>

                                    <?php if (!empty($coverage_errors[$index]['coverage_limit_type'])) : ?>

                                        <small class="text-red-500 block mt-1">
                                            <?= htmlspecialchars(
                                                $coverage_errors[$index]['coverage_limit_type']
                                            ); ?>
                                        </small>

                                    <?php endif; ?>

                                </div>

                                <div>

                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Deductible / Excess
                                    </label>

                                    <input type="number"
                                        step="0.01"
                                        min="0"
                                        name="deductible_amount[]"
                                        value="<?= htmlspecialchars($coverage->deductible_amount ?? '0.00'); ?>"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2"
                                        placeholder="0.00">

                                </div>

                                <div>

                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Deductible Type
                                    </label>

                                    <select name="deductible_type[]"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2">

                                        <option value="">
                                            Select Deductible Type
                                        </option>

                                        <option value="Fixed Amount"
                                            <?= ($coverage->deductible_type == 'Fixed Amount') ? 'selected' : ''; ?>>
                                            Fixed Amount
                                        </option>

                                        <option value="Percentage"
                                            <?= ($coverage->deductible_type == 'Percentage') ? 'selected' : ''; ?>>
                                            Percentage
                                        </option>

                                    </select>

                                </div>

                                <div class="md:col-span-2 lg:col-span-3">

                                    <button type="button"
                                            onclick="this.closest('.coverage-row').remove()"
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">

                                        Remove Coverage

                                    </button>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php else : ?>

                    <div class="coverage-row border border-gray-200 rounded-lg p-4 mb-4">

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                            <div>

                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Coverage Type
                                    <span class="text-red-500">*</span>
                                </label>

                                <select name="coverage_type_id[]"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2">

                                    <option value="">
                                        Select Coverage Type
                                    </option>

                                    <?php foreach ($coverage_types as $type) : ?>

                                        <option value="<?= $type->coverage_type_id; ?>">

                                            <?= htmlspecialchars($type->coverage_type_name); ?>

                                        </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                            <div>

                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Coverage Amount
                                </label>

                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="coverage_amount[]"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2"
                                       placeholder="0.00">

                            </div>

                            <div>

                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Coverage Limit Type
                                </label>

                                <select name="coverage_limit_type[]"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2">

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

                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Deductible / Excess
                                </label>

                                <input type="number"
                                    step="0.01"
                                    min="0"
                                    name="deductible_amount[]"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2"
                                    placeholder="0.00">

                            </div>

                            <div>

                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Deductible Type
                                </label>

                                <select name="deductible_type[]"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2">

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

                <?php endif; ?>

            </div>

        </div>

        <div class="mb-8">

            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                Financial Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Sum Insured / Overall Coverage Amount
                    </label>

                    <input type="number"
                        step="0.01"
                        min="0"
                        name="sum_insured"
                        value="<?= htmlspecialchars($policy->sum_insured ?? '0.00'); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2"
                        placeholder="0.00" required>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Premium Amount
                    </label>

                    <input type="number"
                        step="0.01"
                        min="0"
                        name="premium_amount"
                        id="premium_amount"
                        value="<?= htmlspecialchars($policy->premium_amount ?? '0.00'); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2" required>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Discount
                    </label>

                    <input type="number"
                        step="0.01"
                        min="0"
                        name="discount_amount"
                        id="discount_amount"
                        value="<?= htmlspecialchars($policy->discount_amount ?? '0.00'); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2">

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        VAT Treatment
                    </label>

                    <select name="vat_treatment"
                        id="vat_treatment"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2">

                        <option value="">
                            Select VAT Treatment
                        </option>

                        <option value="Taxable"
                            <?= ($policy->vat_treatment == 'Taxable') ? 'selected' : ''; ?>>
                            Taxable
                        </option>

                        <option value="Exempt"
                            <?= ($policy->vat_treatment == 'Exempt') ? 'selected' : ''; ?>>
                            Exempt
                        </option>

                        <option value="Zero Rated"
                            <?= ($policy->vat_treatment == 'Zero Rated') ? 'selected' : ''; ?>>
                            Zero Rated
                        </option>

                        <option value="Out of Scope"
                            <?= ($policy->vat_treatment == 'Out of Scope') ? 'selected' : ''; ?>>
                            Out of Scope
                        </option>

                    </select>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        VAT %
                    </label>

                    <input type="number"
                        step="0.01"
                        min="0"
                        name="vat_rate"
                        id="vat_rate"
                        value="<?= htmlspecialchars($policy->vat_rate ?? '0.00'); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2">

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        VAT Amount
                    </label>

                    <input type="number"
                        step="0.01"
                        name="vat_amount"
                        id="vat_amount"
                        value="<?= htmlspecialchars($policy->vat_amount ?? '0.00'); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100"
                        readonly>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Total Premium
                    </label>

                    <input type="number"
                        step="0.01"
                        name="total_premium"
                        id="total_premium"
                        value="<?= htmlspecialchars($policy->total_premium ?? '0.00'); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100"
                        readonly>

                </div>

            </div>

        </div>

        <div class="mb-8">

            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                Policy Details
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Customer / Policyholder
                    </label>

                    <input type="text"
                        id="insured_person_entity"
                        value="<?= htmlspecialchars($policy->insured_person_entity ?? ''); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100"
                        readonly>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Beneficiary
                    </label>

                    <input type="text"
                        name="beneficiary"
                        value="<?= htmlspecialchars($policy->beneficiary ?? ''); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2">

                </div>

                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Policy Description
                    </label>

                    <textarea name="policy_description"
                        rows="3"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2"><?= htmlspecialchars($policy->policy_description ?? ''); ?></textarea>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Special Conditions
                    </label>

                    <textarea name="special_conditions"
                        rows="4"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2"><?= htmlspecialchars($policy->special_conditions ?? ''); ?></textarea>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Exclusions
                    </label>

                    <textarea name="exclusions"
                        rows="4"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2"><?= htmlspecialchars($policy->exclusions ?? ''); ?></textarea>

                </div>

                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Notes
                    </label>

                    <textarea name="notes"
                        rows="4"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2"><?= htmlspecialchars($policy->notes ?? ''); ?></textarea>

                </div>

            </div>

        </div>

        <!-- <div class="mb-8">

            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                Cancellation Details
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Cancellation Date
                    </label>

                    <input type="date"
                        name="cancellation_date"
                        value="<?= htmlspecialchars($policy->cancellation_date ?? ''); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2">

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Cancellation Reason
                    </label>

                    <input type="text"
                        name="cancellation_reason"
                        value="<?= htmlspecialchars($policy->cancellation_reason ?? ''); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2"
                        placeholder="Enter cancellation reason">

                </div>

            </div>

        </div> -->

        <div class="mb-8">

            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">
                Existing Policy Documents
            </h3>

            <?php if (!empty($policy_documents)) : ?>

                <div class="overflow-x-auto">

                    <table class="w-full border border-gray-200 rounded-lg">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="p-3 text-left text-sm font-semibold">
                                    SL No
                                </th>

                                <th class="p-3 text-left text-sm font-semibold">
                                    Document Type
                                </th>

                                <th class="p-3 text-left text-sm font-semibold">
                                    Document Name
                                </th>

                                <th class="p-3 text-left text-sm font-semibold">
                                    File
                                </th>

                                <th class="p-3 text-center text-sm font-semibold">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $sl = 1; ?>

                            <?php foreach ($policy_documents as $document) : ?>

                                <tr class="border-t">

                                    <td class="p-3">
                                        <?= $sl++; ?>
                                    </td>

                                    <td class="p-3">
                                        <?= htmlspecialchars(
                                            $document->document_type ?? '-'
                                        ); ?>
                                    </td>

                                    <td class="p-3">
                                        <?= htmlspecialchars(
                                            $document->document_name ?? '-'
                                        ); ?>
                                    </td>

                                    <td class="p-3">
                                        <?= htmlspecialchars(
                                            $document->file_name ?? '-'
                                        ); ?>
                                    </td>

                                    <td class="p-3 text-center">

                                        <?php if (!empty($document->file_path)) : ?>

                                            <a href="<?= base_url($document->file_path); ?>"
                                               target="_blank"
                                               class="inline-block px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">

                                                View

                                            </a>

                                        <?php endif; ?>

                                        <a href="<?= base_url(
                                            'index.php/insurancepolicy/delete_policy_document/' .
                                            $document->document_id .
                                            '/' .
                                            $policy->policy_id
                                        ); ?>"
                                           onclick="return confirm('Are you sure you want to delete this document?');"
                                           class="inline-block px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm ml-1">

                                            Delete

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php else : ?>

                <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg text-gray-500">

                    No documents uploaded for this policy.

                </div>

            <?php endif; ?>

        </div>

        <div class="mb-8">

            <div class="flex items-center justify-between mb-4 pb-2 border-b">

                <h3 class="text-lg font-semibold text-gray-800">
                    Add New Policy Documents
                </h3>

                <button type="button"
                        onclick="addDocument()"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg">

                    + Add Document

                </button>

            </div>

            <div id="document-container">

                <div class="document-row grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Document Type
                        </label>

                        <select name="document_type[]"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2">

                            <option value="">
                                Select Type
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

                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Document Name
                        </label>

                        <input type="text"
                            name="document_name[]"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2"
                            placeholder="Enter document name">

                    </div>

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            File
                        </label>

                        <input type="file"
                            name="document_file[]"
                            accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2">

                    </div>

                </div>

            </div>

            <p class="text-xs text-gray-500 mt-2">

                Allowed files: PDF, JPG, JPEG, PNG, DOC, DOCX.
                Maximum size: 10 MB.

            </p>

        </div>

        <div class="mt-4">

            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded">

                Update Policy

            </button>

            <a href="<?= base_url('index.php/insurancepolicy/policies'); ?>"
               class="ml-3 px-6 py-2 bg-gray-300 rounded">

                Cancel

            </a>

        </div>

    </form>

</div>

<script>

$(document).ready(function () {

    var existingCustomerId =
        "<?= $policy->customer_id ?? ''; ?>";

    var existingVehicleId =
        "<?= $policy->vehicle_id ?? ''; ?>";

    function loadVehicles(customerId, selectedVehicleId)
    {
        var vehicleSelect = $('#vehicle_id');

        vehicleSelect.html(
            '<option value="">Loading vehicles...</option>'
        );

        if (!customerId) {
            vehicleSelect.html(
                '<option value="">Select Vehicle</option>'
            );
            return;
        }

        $.ajax({
            url: "<?= base_url('index.php/insurancepolicy/get_vehicles_by_customer'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                customer_id: customerId
            },

            success: function (vehicles)
            {
                vehicleSelect.html(
                    '<option value="">Select Vehicle</option>'
                );

                if (vehicles && vehicles.length > 0) {

                    $.each(vehicles, function (index, vehicle)
                    {
                        var selected =
                            (String(vehicle.vehicle_id) === String(selectedVehicleId))
                            ? 'selected'
                            : '';

                        vehicleSelect.append(
                            '<option value="' +
                            vehicle.vehicle_id +
                            '" ' +
                            selected +
                            '>' +

                            escapeHtml(vehicle.brand || '') +
                            ' - ' +
                            escapeHtml(vehicle.registration_no || '') +

                            '</option>'
                        );
                    });

                } else {

                    vehicleSelect.html(
                        '<option value="">No vehicles found</option>'
                    );

                }
            },

            error: function ()
            {
                vehicleSelect.html(
                    '<option value="">Unable to load vehicles</option>'
                );
            }
        });
    }

    $('#customer_id').on('change', function()
    {
        var customerId = $(this).val();

        var customerName =
            $('#customer_id option:selected')
                .text()
                .trim();

        if (customerId) {

            $('#insured_person_entity')
                .val(customerName);

        } else {

            $('#insured_person_entity')
                .val('');
        }

        $('#vehicle_id').html(
            '<option value="">Loading vehicles...</option>'
        );

        if (!customerId) {

            $('#vehicle_id').html(
                '<option value="">Select Vehicle</option>'
            );
            loadAllVehicles();
            return;
        }

        loadVehicles(customerId, '');

    });

    $('#vehicle_id').on('change', function ()
    {
        var vehicleId = $(this).val();

        if (!vehicleId) {

            $('#customer_id').val('');

            $('#insured_person_entity').val('');

            return;
        }

        $.ajax({

            url: "<?= base_url('index.php/insurancepolicy/get_vehicle_customer'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                vehicle_id: vehicleId
            },

            success: function (vehicle)
            {
                if (
                    vehicle &&
                    vehicle.customer_id
                ) {

                    $('#customer_id')
                        .val(vehicle.customer_id);

                    var customerName =
                        $('#customer_id option:selected')
                            .text()
                            .trim();

                    $('#insured_person_entity')
                        .val(customerName);

                    $('#vehicle_id')
                        .val(vehicleId);
                }
            },

            error: function ()
            {
                console.log(
                    'Unable to get vehicle customer.'
                );
            }
        });
    });

    if (existingCustomerId) {

        var selectedCustomerName =
            $('#customer_id option:selected')
                .text()
                .trim();

        $('#insured_person_entity')
            .val(selectedCustomerName);

        loadVehicles(
            existingCustomerId,
            existingVehicleId
        );
    }

    function loadAllVehicles(selectedVehicleId = '')
    {
        var vehicleSelect = $('#vehicle_id');

        vehicleSelect.html(
            '<option value="">Loading vehicles...</option>'
        );

        $.ajax({
            url: "<?= base_url('index.php/insurancepolicy/get_all_vehicles'); ?>",
            type: "POST",
            dataType: "json",

            success: function(vehicles)
            {
                vehicleSelect.html(
                    '<option value="">Select Vehicle</option>'
                );

                if (vehicles && vehicles.length > 0) {

                    $.each(vehicles, function(index, vehicle)
                    {
                        var selected =
                            (String(vehicle.vehicle_id) === String(selectedVehicleId))
                            ? 'selected'
                            : '';

                        vehicleSelect.append(
                            '<option value="' +
                            vehicle.vehicle_id +
                            '" ' +
                            selected +
                            '>' +
                            escapeHtml(vehicle.brand || '') +
                            ' - ' +
                            escapeHtml(vehicle.registration_no || '') +
                            '</option>'
                        );
                    });

                } else {

                    vehicleSelect.html(
                        '<option value="">No vehicles found</option>'
                    );
                }
            },

            error: function()
            {
                vehicleSelect.html(
                    '<option value="">Unable to load vehicles</option>'
                );
            }
        });
    }

    function calculatePremium()
    {

        var premium =
            parseFloat(
                $('#premium_amount').val()
            ) || 0;

        var discount =
            parseFloat(
                $('#discount_amount').val()
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

        if (vatTreatment === 'Taxable') {

            vatAmount =
                (netPremium * vatRate) / 100;

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

    $('#premium_amount, #discount_amount, #vat_rate, #vat_treatment')
        .on(
            'input change',
            function () {

                calculatePremium();

            }
        );

    calculatePremium();

});

function addCoverage()
{

    var container =
        document.getElementById(
            'coverage-container'
        );

    var row =
        document.createElement('div');

    row.className =
        'coverage-row border border-gray-200 rounded-lg p-4 mb-4';

    row.innerHTML = `

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-1">

                    Coverage Type
                    <span class="text-red-500">*</span>

                </label>

                <select name="coverage_type_id[]"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2">

                    <option value="">
                        Select Coverage Type
                    </option>

                    <?php foreach ($coverage_types as $type) : ?>

                        <option value="<?= $type->coverage_type_id; ?>">

                            <?= htmlspecialchars(
                                $type->coverage_type_name
                            ); ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-1">

                    Coverage Amount

                </label>

                <input type="number"
                    step="0.01"
                    min="0"
                    name="coverage_amount[]"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2"
                    placeholder="0.00">

            </div>

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-1">

                    Coverage Limit Type

                </label>

                <select name="coverage_limit_type[]"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2">

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

                <label class="block text-sm font-medium text-gray-700 mb-1">

                    Deductible / Excess

                </label>

                <input type="number"
                    step="0.01"
                    min="0"
                    name="deductible_amount[]"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2"
                    placeholder="0.00">

            </div>

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-1">

                    Deductible Type

                </label>

                <select name="deductible_type[]"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2">

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

            <div class="md:col-span-2 lg:col-span-3">

                <button type="button"
                    onclick="this.closest('.coverage-row').remove()"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">

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
        'document-row grid grid-cols-1 md:grid-cols-3 gap-4 mb-4';

    row.innerHTML = `

        <div>

            <label class="font-medium block mb-1">
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

function removeDocument(button)
{

    $(button)
        .closest('.document-row')
        .remove();

}

function escapeHtml(text)
{

    return $('<div>')
        .text(text)
        .html();

}

</script>
