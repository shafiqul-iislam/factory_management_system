<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')); ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')); ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')); ?>

<div class="card shadow-sm">
    <div class="card-header border-bottom d-flex align-items-center justify-content-between">
        <h4 class="card-title">Permissions (<?php echo $role->name; ?>)</h4>
    </div>
    <div class="card-body py-4">

        <div class="d-flex justify-content-center">
            <div class="position-fixed symbol symbol-100px" id="loading" style="display: none;">
                <img class="" width="150px" alt="loading" src="https://zalcrm.com/assets/media/svg/avatars/loading.svg">
            </div>
        </div>

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="users_panel_tab" data-bs-toggle="pill" data-bs-target="#users_panel" type="button" role="tab" aria-controls="users_panel" aria-selected="true">User</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="customer_panel_tab" data-bs-toggle="pill" data-bs-target="#customer_panel" type="button" role="tab" aria-controls="customer_panel" aria-selected="false">Customer</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="department_panel_tab" data-bs-toggle="pill" data-bs-target="#department_panel" type="button" role="tab" aria-controls="department_panel" aria-selected="false">Department</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="hrm_panel_tab" data-bs-toggle="pill" data-bs-target="#hrm_panel" type="button" role="tab" aria-controls="hrm_panel" aria-selected="false">HRM</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="users_panel" role="tabpanel" aria-labelledby="users_panel_tab">
                <div class="row">
                    <div class="col-lg-6 fv-row">
                        <h4>Role</h4>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input" name="role_module" type="checkbox" <?php echo (array_key_exists("role_module", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Module
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input" name="role_add" type="checkbox" <?php echo (array_key_exists("role_add", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Add
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input" name="role_edit" type="checkbox" <?php echo (array_key_exists("role_edit", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Edit
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="role_update" id="flexCheckbox30" <?php echo (array_key_exists("role_update", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Update
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input" name="role_delete" type="checkbox" <?php echo (array_key_exists("role_delete", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Delete
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6 fv-row">
                        <h4>User</h4>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="user_module" id="flexCheckbox30" <?php echo (array_key_exists("user_module", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Module
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="user_add" id="flexCheckbox30" <?php echo (array_key_exists("user_add", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Add
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="user_delete" id="flexCheckbox30" <?php echo (array_key_exists("user_delete", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Delete
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="user_edit" id="flexCheckbox30" <?php echo (array_key_exists("user_edit", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Edit
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="user_update" id="flexCheckbox30" <?php echo (array_key_exists("user_update", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Update
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="customer_panel" role="tabpanel" aria-labelledby="customer_panel_tab">
                <div class="row">
                    <div class="col-lg-6 fv-row">
                        <h4>Customer</h4>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input" name="customer_module" type="checkbox" <?php echo (array_key_exists("customer_module", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Module
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input" name="customer_add" type="checkbox" <?php echo (array_key_exists("customer_add", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Add
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input" name="customer_edit" type="checkbox" <?php echo (array_key_exists("customer_edit", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Edit
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="customer_update" id="flexCheckbox30" <?php echo (array_key_exists("customer_update", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Update
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input" name="customer_delete" type="checkbox" <?php echo (array_key_exists("customer_delete", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Delete
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="department_panel" role="tabpanel" aria-labelledby="department_panel_tab">
                <div class="row">
                    <div class="col-lg-6 fv-row">
                        <h4>Department</h4>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input" name="department_module" type="checkbox" <?php echo (array_key_exists("department_module", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Module
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input" name="department_add" type="checkbox" <?php echo (array_key_exists("department_add", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Add
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input" name="department_edit" type="checkbox" <?php echo (array_key_exists("department_edit", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Edit
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="department_update" id="flexCheckbox30" <?php echo (array_key_exists("department_update", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Update
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input" name="department_delete" type="checkbox" <?php echo (array_key_exists("department_delete", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Delete
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- hrm panel -->
            <div class="tab-pane fade show" id="hrm_panel" role="tabpanel" aria-labelledby="hrm_panel_tab">
                <div class="row">
                    <div class="col-lg-4 mb-2 mb-lg-4 fv-row">
                        <h4>Employee</h4>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input" name="employee_module" type="checkbox" <?php echo (array_key_exists("employee_module", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Module
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input" name="employee_add" type="checkbox" <?php echo (array_key_exists("employee_add", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Add
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input" name="employee_edit" type="checkbox" <?php echo (array_key_exists("employee_edit", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Edit
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="employee_update" id="flexCheckbox30" <?php echo (array_key_exists("employee_update", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Update
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input" name="employee_delete" type="checkbox" <?php echo (array_key_exists("employee_delete", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Delete
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2 mb-lg-4 fv-row">
                        <h4>Designation</h4>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="designation_module" id="flexCheckbox30" <?php echo (array_key_exists("designation_module", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Module
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="designation_add" id="flexCheckbox30" <?php echo (array_key_exists("designation_add", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Add
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="designation_delete" id="flexCheckbox30" <?php echo (array_key_exists("designation_delete", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Delete
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="designation_edit" id="flexCheckbox30" <?php echo (array_key_exists("designation_edit", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Edit
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="designation_update" id="flexCheckbox30" <?php echo (array_key_exists("designation_update", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Update
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2 mb-lg-4 fv-row">
                        <h4>Attendance</h4>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="attendance_module" id="flexCheckbox30" <?php echo (array_key_exists("attendance_module", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Module
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="attendance_add" id="flexCheckbox30" <?php echo (array_key_exists("attendance_add", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Add
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="attendance_delete" id="flexCheckbox30" <?php echo (array_key_exists("attendance_delete", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Delete
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="attendance_edit" id="flexCheckbox30" <?php echo (array_key_exists("attendance_edit", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Edit
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="attendance_update" id="flexCheckbox30" <?php echo (array_key_exists("attendance_update", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Update
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2 mb-lg-4 fv-row">
                        <h4>Holiday</h4>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="holiday_module" id="flexCheckbox30" <?php echo (array_key_exists("holiday_module", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Module
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="holiday_add" id="flexCheckbox30" <?php echo (array_key_exists("holiday_add", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Add
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="holiday_delete" id="flexCheckbox30" <?php echo (array_key_exists("holiday_delete", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Delete
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="holiday_edit" id="flexCheckbox30" <?php echo (array_key_exists("holiday_edit", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Edit
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="holiday_update" id="flexCheckbox30" <?php echo (array_key_exists("holiday_update", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Update
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2 mb-lg-4 fv-row">
                        <h4>Leave Request</h4>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="leave_request_module" id="flexCheckbox30" <?php echo (array_key_exists("leave_request_module", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Module
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="leave_request_add" id="flexCheckbox30" <?php echo (array_key_exists("leave_request_add", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Add
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="leave_request_delete" id="flexCheckbox30" <?php echo (array_key_exists("leave_request_delete", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Delete
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="leave_request_edit" id="flexCheckbox30" <?php echo (array_key_exists("leave_request_edit", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Edit
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="leave_request_update" id="flexCheckbox30" <?php echo (array_key_exists("leave_request_update", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Update
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 fv-row">
                        <h4>Payroll</h4>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="payroll_module" id="flexCheckbox30" <?php echo (array_key_exists("payroll_module", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Module
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="payroll_add" id="flexCheckbox30" <?php echo (array_key_exists("payroll_add", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Add
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="payroll_delete" id="flexCheckbox30" <?php echo (array_key_exists("payroll_delete", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Delete
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="payroll_edit" id="flexCheckbox30" <?php echo (array_key_exists("payroll_edit", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Edit
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-2">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="payroll_update" id="flexCheckbox30" <?php echo (array_key_exists("payroll_update", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Update
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include(resource_path('/views/theme/admin_portal/dashboard/footer.php')) ?>

<script>
    $(document).ready(function() {
        var role = <?php echo $role->id ?>;

        $('input').on('click', function() {
            var permission = $(this).attr('name');

            //send to controller by ajax
            var url = "<?php echo url('permissions/update'); ?>";
            jQuery.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "role": role,
                    "permission": permission,
                },
                beforeSend: function() {
                    $("#loading").fadeIn();
                },
                error: function(data) {
                    console.log(data);
                },
                success: function(data) {
                    $("#loading").fadeOut();
                }
            });
        });
    });
</script>