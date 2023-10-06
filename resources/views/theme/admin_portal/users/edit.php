<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')) ?>
<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')) ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')) ?>

<form action="<?php echo url('users/update'); ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
    <div class="card shadow-sm">
        <div class="card-header border-bottom p-3">
            <h3 class="card-title">Update User</h3>
        </div>
        <div class="card-body pt-4">
            <input type="hidden" name="id" value="<?php echo $userData->id; ?>">
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7">Role</label>
                        <select class="form-control form-control-md" name="role">
                            <?php if ($userData->role == 1) { ?>
                                <option selected value="1">Admin (*)</option>
                            <?php } else if ($userData->role == 2) { ?>
                                <option selected value="2">Staff (*)</option>
                            <?php } else { ?>
                                <option selected value="">N/A (*)</option>
                            <?php } ?>
                            <option>Select An Option</option>
                            <option value="1">Admin</option>
                            <option value="2">Staff</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7">Profile Type</label>
                        <select class="form-control form-control-md" name="profile_type">
                            <?php if ($userData->profile_type == 1) { ?>
                                <option selected value="1">Admin (*)</option>
                            <?php } else if ($userData->profile_type == 2) { ?>
                                <option selected value="2">Staff (*)</option>
                            <?php } else { ?>
                                <option selected value="">N/A (*)</option>
                            <?php } ?>
                            <option>Select An Option</option>
                            <option value="1">Admin</option>
                            <option value="2">Staff</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-3">
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7">Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $userData->name; ?>" placeholder="Enter Name">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7">Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $userData->username; ?>" placeholder="Enter Username">
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $userData->phone; ?>" placeholder="Enter Phone">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7">Email</label>
                        <input type="text" name="email" class="form-control" value="<?php echo $userData->email; ?>" placeholder="Enter Email">
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center mb-3">
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7">Address</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $userData->address; ?>" placeholder="Enter Address">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="profile_status" <?php echo ($userData->profile_status == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label fw-bold fs-7" for="flexSwitchCheckDefault">Status</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

<?php include(resource_path('/views/theme/admin_portal/dashboard/footer.php')) ?>

<script>
    $(document).ready(function() {


    });
</script>