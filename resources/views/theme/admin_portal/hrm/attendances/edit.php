<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')) ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')) ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')) ?>

<form enctype="multipart/form-data" action="<?php echo url('attendances/update'); ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
    <div class="card shadow-sm">
        <div class="card-header border-bottom p-3">
            <h3 class="card-title">Update Attendance</h3>
        </div>
        <div class="card-body pt-4">
            <input type="hidden" name="id" value="<?php echo $editAttendance->id; ?>">

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Employee</label>
                        <select class="form-control form-control-md" name="employee_id" required>

                            <?php if (isset($editAttendance->employeeData)) { ?>
                                <option selected value="<?php echo $editAttendance->employeeData->id; ?>"><?php echo $editAttendance->employeeData->name; ?> (*) </option>
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
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Date</label>
                        <input type="text" name="date" class="form-control date_picker" placeholder="Enter Date" value="<?php echo $editAttendance->date; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Time In</label>
                        <input type="text" name="time_in" class="form-control time_picker" placeholder="Enter Time In" value="<?php echo $editAttendance->time_in; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Time Out</label>
                        <input type="text" name="time_out" class="form-control time_picker" placeholder="Enter Time Out" value="<?php echo $editAttendance->time_out; ?>" required>
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