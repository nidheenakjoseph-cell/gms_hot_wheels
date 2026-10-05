<div class="bg-white rounded-xl shadow p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Edit Employee</h2>

        <a href="<?= base_url('index.php/employee') ?>"
           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Employee List
        </a>
    </div>
    <!-- VALIDATION ERROR -->
    <?php if ($this->session->flashdata('error')): ?>
    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
        <?= htmlspecialchars($this->session->flashdata('error')) ?>
    </div>
<?php endif; ?>

    <form method="post"
          action="<?= base_url('index.php/Employee/update') ?>"
          enctype="multipart/form-data">

        <input type="hidden" name="employee_id"
               value="<?= $employee->employee_id ?>">

        <!-- BASIC DETAILS -->
        <h3 class="font-semibold text-gray-700 mb-2 border-b pb-1">
            Basic Details
        </h3>

        <div class="grid grid-cols-3 gap-4">

            <div>
                <label>
                Employee Name <span style="color: red;">*</span>
                </label>
                
                <input type="text" name="employee_name"
                      value="<?= isset($form_data['employee_name']) ? htmlspecialchars($form_data['employee_name']) : htmlspecialchars($employee->employee_name) ?>"
                       required class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Mobile</label>
                <input type="text" name="mobile"
                      value="<?= isset($form_data['mobile']) ? htmlspecialchars($form_data['mobile']) : htmlspecialchars($employee->mobile) ?>"
                       class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Email ID</label>
                <input type="email" name="email"
                       value="<?= isset($form_data['email']) ? htmlspecialchars($form_data['email']) : htmlspecialchars($employee->email) ?>"
                       class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Joining Date</label>
                <input type="date" name="joining_date"
                       value="<?= isset($form_data['joining_date']) ? htmlspecialchars($form_data['joining_date']) : htmlspecialchars($employee->joining_date) ?>"
                       class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Address</label>
                <textarea name="address"
               class="w-full border p-2 rounded"><?= isset($form_data['address']) ? htmlspecialchars($form_data['address']) : htmlspecialchars($employee->address) ?></textarea>
            </div>

            <div>
                <label>
                     Department <span style="color: red;">*</span>
                </label>
                <select name="department_id"  id="deptSelect"
                        class="w-full border p-2 rounded" required>
                    <?php foreach($departments as $d): ?>
                        <option value="<?= $d->department_id ?>"
                           <?= $d->department_id == (isset($form_data['department_id']) ? $form_data['department_id'] : $employee->department_id) ? 'selected' : '' ?>>
                            <?= $d->department_name ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

                <div>
                    <label>Branch</label>
                    <?= render_branch_select_dropdown('branch_id', isset($employee->branch_id) ? $employee->branch_id : null, 'w-full border p-2 rounded', true) ?>
                </div>

            <div>
                <label>
                     Designation <span style="color: red;">*</span>
                </label>
                <select name="designation_id" id="desigSelect"
                        class="w-full border p-2 rounded" required>
                    <?php foreach($designations as $ds): ?>
                        <option value="<?= $ds->designation_id ?>"
                           <?= $ds->designation_id == (isset($form_data['designation_id']) ? $form_data['designation_id'] : $employee->designation_id) ? 'selected' : '' ?>>
                            <?= $ds->designation_name ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label>Role</label>
                <select name="role"
                        class="w-full border p-2 rounded">
                    <option value="Technician" <?= $employee->role=='Technician'?'selected':'' ?>>Technician</option>
                    <option value="Advisor" <?= $employee->role=='Advisor'?'selected':'' ?>>Advisor</option>
                    <option value="Admin" <?= $employee->role=='Admin'?'selected':'' ?>>Admin</option>
                </select>
            </div>

            <div>
                <label>Software Access</label>
                <select name="software_access"
                        class="w-full border p-2 rounded">
                    <option value="Yes" <?= $employee->software_access=='Yes'?'selected':'' ?>>Yes</option>
                    <option value="No" <?= $employee->software_access=='No'?'selected':'' ?>>No</option>
                </select>
            </div>

        </div>

        <!-- PASSPORT DETAILS -->
        <h3 class="font-semibold text-gray-700 mt-6 mb-2 border-b pb-1">
            Passport Details
        </h3>

        <div class="grid grid-cols-3 gap-4">

            <div>
                <label>Passport Number</label>
                <input type="text" name="passport_number"
                       value="<?= $employee->passport_number ?>"
                       class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Passport Issue Date</label>
                <input type="date" name="passport_issue_date"
                       value="<?= $employee->passport_issue_date ?>"
                       class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Passport Expiry Date</label>
                <input type="date" name="passport_expiry_date"
                       value="<?= $employee->passport_expiry_date ?>"
                       class="w-full border p-2 rounded">
            </div>

            <div class="col-span-3">
                <label>Passport File</label>

                <?php if (!empty($employee->passport_file)): ?>

                    <?php
                        $file_path = 'uploads/passports/' . $employee->passport_file;
                        $file_ext  = strtolower(pathinfo($employee->passport_file, PATHINFO_EXTENSION));
                    ?>

                    <div class="mb-2 flex items-center gap-3">

                        <?php if (in_array($file_ext, ['jpg', 'jpeg', 'png'])): ?>
                            <img src="<?= base_url($file_path) ?>"
                                 alt="Passport"
                                 class="h-20 w-20 object-cover rounded border">
                        <?php endif; ?>

                        <a href="<?= base_url($file_path) ?>"
                           target="_blank"
                           class="text-blue-600 underline text-sm">
                            View current file (<?= htmlspecialchars($employee->passport_file) ?>)
                        </a>

                    </div>

                <?php else: ?>

                    <p class="text-gray-500 text-sm mb-2">No passport file uploaded yet.</p>

                <?php endif; ?>

                <input type="file" name="passport_file"
                       accept=".jpg,.jpeg,.png,.pdf"
                       class="w-full border p-2 rounded">

                <p class="text-xs text-gray-400 mt-1">
                    Upload a new file only if you want to replace the existing one.
                </p>
            </div>

        </div>

        <!-- BUTTONS -->
        <div class="mt-6 flex gap-3">
            <button type="submit"
                    class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Update Employee
            </button>

            <a href="<?= base_url('index.php/employee') ?>"
               class="px-6 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                Cancel
            </a>
        </div>

    </form>
    </div>
    <script>
$('#deptSelect').on('change', function() {
    let deptId = this.value;

    $.post(
        '<?= base_url("index.php/employee/get_designations_by_department") ?>', {
            department_id: deptId
        },
        function(res) {
            let options = '';
            JSON.parse(res).forEach(d => {
                options += `<option value="${d.designation_id}">${d.designation_name}</option>`;
            });
            $('#desigSelect').html(options);
        }
    );
});
</script>

