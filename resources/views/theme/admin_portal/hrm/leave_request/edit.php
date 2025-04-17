<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')) ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')) ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')) ?>

<form enctype="multipart/form-data" action="<?php echo url('leaves/update'); ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
    <div class="card shadow-sm">
        <div class="card-header border-bottom p-3">
            <h3 class="card-title">Update Leave Request</h3>
        </div>
        <div class="card-body pt-4">
            <input type="hidden" name="id" value="<?php echo $editLeave->id; ?>">

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" <?php echo ($editLeave->status == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label fw-bold fs-7" for="flexSwitchCheckDefault">Status</label>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Departments</label>
                        <select class="form-control form-control-md" name="department_id" required>

                            <?php if (isset($editLeave->departmentData)) { ?>
                                <option selected value="<?php echo $editLeave->departmentData->id; ?>"><?php echo $editLeave->departmentData->name; ?> (*) </option>
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
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Employees</label>
                        <select class="form-control form-control-md" name="employee_id" required>

                            <?php if (isset($editLeave->employeeData)) { ?>
                                <option selected value="<?php echo $editLeave->employeeData->id; ?>"><?php echo $editLeave->employeeData->name; ?> (*) </option>
                            <?php } else { ?>
                                <option selected>N/A (*)</option>
                            <?php } ?>

                            <option>Select An Option</option>
                            <?php if (isset($employees) && !empty($employees)) { ?>
                                <?php foreach ($employees as $employees) { ?>

                                    <option value="<?php echo $employees->id ?>">
                                        <?php echo $employees->name ?>
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Start Date</label>
                        <input type="text" name="start_date" class="form-control date_picker" placeholder="Enter Date" value="<?php echo $editLeave->start_date; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Finish Date</label>
                        <input type="text" name="finish_date" class="form-control date_picker" placeholder="Enter Finish Date" value="<?php echo $editLeave->finish_date; ?>" required>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Leave Type</label>
                        <input type="text" name="leave_type" class="form-control" placeholder="Enter Leave Type" value="<?php echo $editLeave->leave_type; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7">File</label>
                        <input type="file" name="file" class="form-control" placeholder="Enter File">
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-0">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label class="form-label fs-7">Leave Reason</label>
                        <textarea class="form-control" name="leave_reason" rows="1" placeholder="Enter Leave Reason"><?php echo $editLeave->leave_reason; ?></textarea>
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
        $('.date_picker').datetimepicker({
            datepicker: true,
            timepicker: false,
            format: 'Y-m-d'
        });
    });
</script>