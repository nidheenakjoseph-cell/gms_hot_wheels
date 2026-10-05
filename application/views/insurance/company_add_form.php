<div class="w-full bg-white rounded-2xl shadow-md p-6">

    <h2 class="text-2xl font-bold mb-4"><?= htmlspecialchars($title) ?></h2>

    <?php if (validation_errors()) { ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <?= validation_errors(); ?>
        </div>
    <?php } ?>
    
    <form method="POST" action="<?= base_url('index.php/insurancecompany/save'); ?>">

        <div class="grid grid-cols-2 gap-4">

            <div>
                <label class="font-medium">Company Name <span class="text-red-500">*</span></label>
                <input type="text" name="company_name"
                       class="w-full border p-2 rounded" placeholder="New India Assurance" required>
            </div>

            <div> 
                <label class="font-medium">License / Registration No. <span class="text-red-500">*</span></label> 
                <input type="text" name="license_registration_no" class="w-full border p-2 rounded" placeholder="Enter license / registration number" required> 
            </div>

            <div>
                <label class="font-medium">Contact Number</label>
                <input type="text" name="contact_no"
                       class="w-full border p-2 rounded" placeholder="9876543210">
            </div>

            <div>
                <label class="font-medium">Email</label>
                <input type="email" name="email"
                       class="w-full border p-2 rounded" placeholder="support@company.com">
            </div>

            <div class="col-span-2">
                <label class="font-medium">Address</label>
                <textarea name="address"
                          class="w-full border p-2 rounded"
                          placeholder="Company full address"></textarea>
            </div>

            <div> 
                <label class="font-medium">Website</label> 
                <input type="url" name="website" class="w-full border p-2 rounded" placeholder="https://www.company.com"> 
            </div>

            <div> 
                <label class="font-medium"> Status </label> 
                <select name="status" required class="w-full border p-2 rounded"> 
                    <option value="1" selected>Active</option> 
                    <option value="0">Inactive</option> 
                </select> 
            </div>

        </div>

        <br>

        <button class="px-6 py-2 bg-blue-600 text-white rounded">
            Save Company
        </button>

        <a href="<?= base_url('index.php/insurancecompany/list'); ?>"
           class="ml-3 px-6 py-2 bg-gray-300 rounded">
            Cancel
        </a>

    </form>
</div>
