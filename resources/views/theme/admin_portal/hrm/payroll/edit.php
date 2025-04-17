<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')) ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')) ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')) ?>

<form enctype="multipart/form-data" action="<?php echo url('payrolls/update'); ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
    <div class="card shadow-sm">
        <div class="card-header border-bottom p-3">
            <h3 class="card-title">Update Payroll</h3>
        </div>
        <div class="card-body pt-4">
            <input type="hidden" name="id" value="<?php echo $editPayroll->id; ?>">

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" <?php echo ($editPayroll->status == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label fw-bold fs-7" for="flexSwitchCheckDefault">Status</label>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Date</label>
                        <input type="text" name="date" class="form-control date_picker" placeholder="Enter Date" value="<?php echo $editPayroll->date; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Employees</label>
                        <select class="form-control form-control-md" name="employee_id" required>

                            <?php if (isset($editPayroll->employeeData)) { ?>
                                <option selected value="<?php echo $editPayroll->employeeData->id; ?>"><?php echo $editPayroll->employeeData->name; ?> (*) </option>
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
                        <label class="form-label fs-7 required">Method</label>
                        <select class="form-control form-control-md" name="method" required>

                            <?php if ($editPayroll->method == 1) { ?>
                                <option value="1">Cash (*)</option>
                            <?php } else if ($editPayroll->method == 2) { ?>
                                <option value="2">Cheque (*)</option>
                            <?php } else { ?>
                                <option value="3">Others (*)</option>
                            <?php } ?>
                            <option value="">Select An Option</option>
                            <option value="1">Cash</option>
                            <option value="2">Cheque</option>
                            <option value="3">Others</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Amount</label>
                        <input type="number" name="amount" class="form-control" placeholder="Enter Amount" value="<?php echo $editPayroll->amount; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-0">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label class="form-label fs-7">Note</label>
                        <textarea class="form-control" name="note" rows="1" placeholder="Enter Note"><?php echo $editPayroll->note; ?></textarea>
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