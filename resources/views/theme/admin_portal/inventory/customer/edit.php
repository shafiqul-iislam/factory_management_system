<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')); ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')); ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')); ?>

<form enctype="multipart/form-data" action="<?php echo url('customers/update'); ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
    <div class="card shadow-sm">
        <div class="card-header border-bottom p-3">
            <h3 class="card-title">Update Customer</h3>
        </div>
        <div class="card-body pt-4">
            <input type="hidden" name="id" value="<?php echo $editCustomer->id; ?>">

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" <?php echo ($editCustomer->status == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label fw-bold fs-7" for="flexSwitchCheckDefault">Status</label>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="required fw-bold fs-7 mb-1">Name</label>
                        <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter Warehouse Name" value="<?php echo $editCustomer->name; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="required fw-bold fs-7 mb-1">Email</label>
                        <input type="text" name="email" class="form-control form-control-solid" placeholder="Enter Email" value="<?php echo $editCustomer->email; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="required fw-bold fs-7 mb-1">Phone</label>
                        <input type="text" name="phone" class="form-control form-control-solid" placeholder="Enter Phone" value="<?php echo $editCustomer->phone; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="required fw-bold fs-7 mb-1">Address</label>
                        <input type="text" name="address" class="form-control form-control-solid" placeholder="Enter Address" value="<?php echo $editCustomer->address; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-0">
                <div class="col-lg-8">
                    <div class="form-group">
                        <label class="form-label fs-7">Note</label>
                        <textarea class="form-control" name="note" rows="1" placeholder="Enter Note"><?php echo $editCustomer->note; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

<?php include(resource_path('/views/theme/admin_portal/dashboard/footer.php')); ?>