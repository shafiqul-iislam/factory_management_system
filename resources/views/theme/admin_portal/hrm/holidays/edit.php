<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')) ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')) ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')) ?>

<form enctype="multipart/form-data" action="<?php echo url('holidays/update'); ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
    <div class="card shadow-sm">
        <div class="card-header border-bottom p-3">
            <h3 class="card-title">Update Holiday</h3>
        </div>
        <div class="card-body pt-4">
            <input type="hidden" name="id" value="<?php echo $editHoliday->id; ?>">


            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" <?php echo ($editHoliday->status == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label fw-bold fs-7" for="flexSwitchCheckDefault">Status</label>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo $editHoliday->title; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Start Date</label>
                        <input type="text" name="start_date" class="form-control date_picker" placeholder="Enter Start Date" value="<?php echo $editHoliday->start_date; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7 required">Finish Date</label>
                        <input type="text" name="finish_date" class="form-control date_picker" placeholder="Enter Time In" value="<?php echo $editHoliday->finish_date; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7">Note</label>
                        <textarea class="form-control" name="note" rows="1" placeholder="Enter Note"><?php echo $editHoliday->note; ?></textarea>
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