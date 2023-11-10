<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')) ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')) ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')) ?>

<form enctype="multipart/form-data" action="<?php echo url('employees/update'); ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
    <div class="card shadow-sm">
        <div class="card-header border-bottom p-3">
            <h3 class="card-title">Update Employee</h3>
        </div>
        <div class="card-body pt-4">
            <input type="hidden" name="id" value="<?php echo $editEmployee->id; ?>">

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-5">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" <?php echo ($editEmployee->status == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label fw-bold fs-7" for="flexSwitchCheckDefault">Status</label>
                    </div>
                </div>
                <div class="col-lg-5"></div>
            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Department</label>
                        <select class="form-control form-control-md" name="department_id" required>
                            <?php if (isset($editEmployee->departmentData)) { ?>
                                <option selected value="<?php echo $editEmployee->departmentData->id; ?>"><?php echo $editEmployee->departmentData->name; ?> (*) </option>
                            <?php } else { ?>
                                <option selected>N/A (*)</option>
                            <?php } ?>

                            <option>Select An Option</option>
                            <?php if (isset($departments) && !empty($departments)) { ?>
                                <?php foreach ($departments as $department) { ?>

                                    <option value="<?php echo $department->id ?>">
                                        <?php echo $department->name ?>
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Designation</label>
                        <select class="form-control form-control-md" name="designation" required>
                            <?php if (isset($editEmployee->designationData)) { ?>
                                <option selected value="<?php echo $editEmployee->designationData->id; ?>"><?php echo $editEmployee->designationData->name; ?> (*) </option>
                            <?php } else { ?>
                                <option selected>N/A (*)</option>
                            <?php } ?>

                            <option>Select An Option</option>
                            <?php if (isset($designations) && !empty($designations)) { ?>
                                <?php foreach ($designations as $designation) { ?>

                                    <option value="<?php echo $designation->id ?>">
                                        <?php echo $designation->name ?>
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo $editEmployee->name; ?>">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?php echo $editEmployee->username; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone" value="<?php echo $editEmployee->phone; ?>" required>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Enter  Email" value="<?php echo $editEmployee->email; ?>">
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7">Gender</label>
                        <select class="form-control form-control-md" name="gender">
                            <?php if ($editEmployee->gender == 1) { ?>
                                <option value="1">Male (*)</option>
                            <?php } else if ($editEmployee->gender == 2) { ?>
                                <option value="2">Female</option>
                            <?php } else if ($editEmployee->gender == 3) { ?>
                                <option value="3">Others</option>
                            <?php } ?>

                            <option value="">Select An Option</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="3">Others</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7">Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Enter Address" value="<?php echo $editEmployee->address; ?>">
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Joining Date</label>
                        <input type="date" name="joining_date" class="form-control" placeholder="Enter Joining Date" value="<?php echo $editEmployee->joining_date; ?>" required>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7">Office Shift</label>
                        <select class="form-control form-control-md" name="office_shift">

                            <?php if ($editEmployee->office_shift == 1) { ?>
                                <option value="1">Day (*)</option>
                            <?php } else if ($editEmployee->office_shift == 2) { ?>
                                <option value="2">Night</option>
                            <?php } ?>

                            <option value="">Select An Option</option>
                            <option value="1">Day</option>
                            <option value="2">Night</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Date Of Birth</label>
                        <input type="date" name="dob" class="form-control" placeholder="Enter Date Of Birth" value="<?php echo $editEmployee->dob; ?>" required>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="form-label fs-7">Country</label>
                        <input type="text" name="country" class="form-control" placeholder="Enter Country" value="<?php echo $editEmployee->country; ?>">
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