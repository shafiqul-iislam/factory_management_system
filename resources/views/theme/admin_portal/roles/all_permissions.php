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
                <img class="" alt="loading" src="https://zalcrm.com/assets/media/svg/avatars/loading.svg">
            </div>
        </div>

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="users_panel_tab" data-bs-toggle="pill" data-bs-target="#users_panel" type="button" role="tab" aria-controls="users_panel" aria-selected="true">User</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Customers</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Department</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="users_panel" role="tabpanel" aria-labelledby="users_panel_tab">
                <div class="row">
                    <div class="col-lg-6 fv-row">
                        <h4>Role</h4>
                        <div class="form-check form-check-custom form-check-solid my-3">
                            <input class="form-check-input" name="role_module" type="checkbox" <?php echo (array_key_exists("role_update", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Module
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid my-3">
                            <input class="form-check-input" name="role_add" type="checkbox" <?php echo (array_key_exists("role_update", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Add
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid my-3">
                            <input class="form-check-input" name="role_edit" type="checkbox" <?php echo (array_key_exists("role_update", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Edit
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="role_update" id="flexCheckbox30" <?php echo (array_key_exists("role_update", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Update
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid my-3">
                            <input class="form-check-input" name="role_delete" type="checkbox" <?php echo (array_key_exists("role_update", $permissions)) ? 'checked' : ''; ?>>
                            <label class="form-check-label ps-1 fs-6" for="flexCheckChecked">
                                Delete
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6 fv-row">
                        <h4>User</h4>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="users_module" id="flexCheckbox30" <?php echo (array_key_exists("users_module", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Module
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="users_add" id="flexCheckbox30" <?php echo (array_key_exists("users_add", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Add
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="users_delete" id="flexCheckbox30" <?php echo (array_key_exists("users_delete", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Delete
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="users_edit" id="flexCheckbox30" <?php echo (array_key_exists("users_edit", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Edit
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mt-3">
                            <input class="form-check-input h-25px w-25px" type="checkbox" name="users_update" id="flexCheckbox30" <?php echo (array_key_exists("users_update", $permissions)) ? 'checked' : ''; ?> />
                            <label class="form-check-label ps-1 fs-6" for="flexCheckbox30">
                                Update
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
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
            var url = "<?php echo url('permissions/upated'); ?>";
            jQuery.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: {
                    "role": role,
                    "permission": permission,
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $("#loading").fadeIn();
                },
                error: function(data) {
                    console.log(data);
                },
                success: function(data) {
                    $("#loading").fadeOut();
                    // console.log(data);
                }
            });
        });
    });
</script>