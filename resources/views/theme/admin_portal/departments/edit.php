<?php include(resource_path('/views/theme/dashboard/header.php')) ?>

<form action="<?php echo url('departments/update'); ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
    <div class="card shadow-sm">
        <div class="card-header border-bottom p-3">
            <h3 class="card-title">Update Department</h3>
        </div>
        <div class="card-body pt-4">
            <input type="hidden" name="id" value="<?php echo $editDepartment->id; ?>">

            <div class="row d-flex justify-content-center mb-3">
                <div class="col-lg-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" <?php echo ($editDepartment->status == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label fw-bold fs-7" for="flexSwitchCheckDefault">Status</label>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-3">
                <div class="col-lg-6">
                    <label class="required form-label">Department Name</label>
                    <input type="text" name="department_name" class="form-control form-control-solid p-2" placeholder="Enter Department Name" value="<?php echo $editDepartment->department_name; ?>">
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-3">
                <div class="col-lg-6">
                    <label class="required form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3"><?php echo $editDepartment->description; ?></textarea>

                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>

<?php include(resource_path('/views/theme/dashboard/footer.php')) ?>

<script>
    $(document).ready(function() {


    });
</script>