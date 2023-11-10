<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')) ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')) ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')) ?>

<form enctype="multipart/form-data" action="<?php echo url('designations/update'); ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
    <div class="card shadow-sm">
        <div class="card-header border-bottom p-3">
            <h3 class="card-title">Update Designation</h3>
        </div>
        <div class="card-body pt-4">
            <input type="hidden" name="id" value="<?php echo $editDesignation->id; ?>">

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Designation</label>
                        <input type="text" name="desination_name" class="form-control" placeholder="Enter Designation" value="<?php echo $editDesignation->name; ?>">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Department</label>
                        <select class="form-control form-control-md" name="department_id" required>

                            <?php if (isset($editDesignation->departmentData)) { ?>
                                <option selected value="<?php echo $editDesignation->departmentData->id; ?>"><?php echo $editDesignation->departmentData->name; ?> (*) </option>
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
            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label class="form-label fs-7">Note</label>
                        <textarea type="text" name="note" class="form-control" placeholder="Enter Note" rows="1"><?php echo $editDesignation->note; ?></textarea>
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