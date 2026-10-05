<div class="w-full bg-white rounded-2xl shadow-md p-6 mt-6 max-w-5xl mx-auto">
    <div class="flex items-center justify-between border-b border-gray-200 pb-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Add New Company</h2>
            <p class="text-sm text-gray-500 mt-1">Configure company organization details and demo access duration</p>
        </div>

        <a href="<?= base_url('index.php/Admin/company_details') ?>"
            class="px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition text-sm">
            ← Back to Companies
        </a>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
            <?= htmlspecialchars($this->session->flashdata('error')) ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('index.php/Admin/save_company') ?>" method="post" class="space-y-6" autocomplete="off" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <!-- Company Code -->
            <div class="md:col-span-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Company Code <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="company_code"
                    required
                    value="<?= htmlspecialchars($auto_code ?? '') ?>"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none uppercase">
            </div>

            <!-- Company Name -->
            <div class="md:col-span-8">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Company Name <span class="text-red-500">*</span>
                </label>
                <input type="text"
                    name="company_name"
                    required
                    placeholder="e.g. Apex Auto Services LLC"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="md:col-span-12">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Company Logo</label>
                <input type="file" name="company_logo" accept=".jpg,.jpeg,.png,.gif,.webp,image/jpeg,image/png,image/gif,image/webp"
                    class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm">
                <p class="mt-1 text-xs text-gray-500">JPG, PNG, GIF, or WebP; maximum 2 MB.</p>
            </div>

            <!-- Address -->
            <div class="md:col-span-12">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Address <span class="text-red-500">*</span></label>
                <input type="text"
                    name="company_address"
                    required
                    placeholder="Street, Building, Area..."
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- City -->
            <div class="md:col-span-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">City <span class="text-red-500">*</span></label>
                <input type="text"
                    name="company_city"
                    required
                    placeholder="e.g. Dubai"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- State -->
            <div class="md:col-span-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">State / Province</label>
                <input type="text"
                    name="company_state"
                    placeholder="e.g. Dubai"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Country -->
            <div class="md:col-span-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Country <span class="text-red-500">*</span></label>
                <input type="text"
                    name="company_country"
                    required
                    value="UAE"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- PO Box / Pincode -->
            <div class="md:col-span-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">PO Box / Pincode</label>
                <input type="text"
                    name="company_pincode"
                    placeholder="e.g. 12345"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Email -->
            <div class="md:col-span-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email"
                    name="company_email_id"
                    placeholder="contact@company.com"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Telephone -->
            <div class="md:col-span-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Telephone</label>
                <input type="text"
                    name="company_telephone"
                    placeholder="e.g. +971 4 234 5678"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- TRN -->
            <div class="md:col-span-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1">TRN (Tax Registration Number)</label>
                <input type="text"
                    name="company_trn"
                    placeholder="15-digit TRN Number"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Website -->
            <div class="md:col-span-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Website</label>
                <input type="text"
                    name="website"
                    placeholder="www.company.com"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
        </div>

        <!-- Demo Access Settings Box -->
        <div class="border border-blue-200 rounded-xl bg-blue-50/60 p-6 mt-4">
            <div class="flex items-center justify-between mb-4 border-b border-blue-200 pb-3">
                <div>
                    <h3 class="text-base font-bold text-gray-800">Demo Access & Expiration Settings</h3>
                    <p class="text-xs text-gray-500">Configure whether this company operates on a time-limited demo</p>
                </div>
                <label class="inline-flex items-center gap-2 text-sm font-semibold text-gray-800 cursor-pointer">
                    <input type="checkbox" name="demo_enabled" id="demo_enabled_chk" value="1" class="w-4 h-4 text-blue-600 rounded">
                    Enable Demo Access
                </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4" id="demo_fields">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Demo Start Date</label>
                    <input type="date" name="demo_start_date" id="demo_start_date" value="<?= date('Y-m-d') ?>" class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Demo Duration</label>
                    <select name="demo_duration_days" id="demo_duration_days" class="w-full border rounded-lg px-3 py-2 text-sm">
                        <option value="0">Custom Expiry Date</option>
                        <option value="7">7 Days</option>
                        <option value="14" selected>14 Days</option>
                        <option value="30">30 Days</option>
                        <option value="60">60 Days</option>
                        <option value="90">90 Days</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Demo Expiry Date</label>
                    <input type="date" name="demo_expiry_date" id="demo_expiry_date" value="<?= date('Y-m-d', strtotime('+14 days')) ?>" class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
            <a href="<?= base_url('index.php/Admin/company_details') ?>"
                class="px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                Cancel
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition shadow-sm">
                Save Company
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
</script>
