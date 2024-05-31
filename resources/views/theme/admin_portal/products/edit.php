<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')); ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')); ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')); ?>

<form enctype="multipart/form-data" action="<?php echo url('products/update'); ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
    <div class="card shadow-sm">
        <div class="card-header border-bottom p-3">
            <h3 class="card-title">Update Product</h3>
        </div>
        <div class="card-body pt-4">
            <input type="hidden" name="id" value="<?php echo $editProduct->id; ?>">

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" <?php echo ($editProduct->status == 1) ? 'checked' : ''; ?>>
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

                            <?php if (isset($editProduct->departmentData)) { ?>
                                <option selected value="<?php echo $editProduct->departmentData->id; ?>"><?php echo $editProduct->departmentData->name; ?> (*) </option>
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
                        <label class="required fw-bold fs-7 mb-1">Name</label>
                        <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter Product Name" value="<?php echo $editProduct->name; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="required fw-bold fs-7 mb-1">Product Code</label>
                        <input type="text" name="product_code" class="form-control form-control-solid" placeholder="Enter Product Code" value="<?php echo $editProduct->product_code; ?>">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="required fw-bold fs-7 mb-1">Category</label>
                        <input type="text" name="category" class="form-control form-control-solid" placeholder="Enter Product Category" value="<?php echo $editProduct->category; ?>">
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="required fw-bold fs-7 mb-1">Brand</label>
                        <input type="text" name="brand" class="form-control form-control-solid" placeholder="Enter Product Brand" value="<?php echo $editProduct->brand; ?>">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="required fw-bold fs-7 mb-1">Units</label>
                        <input type="text" name="units" class="form-control form-control-solid" placeholder="Enter Product Units" value="<?php echo $editProduct->units; ?>">
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mb-0">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="required fw-bold fs-7 mb-1">Alert Quantity</label>
                        <input type="number" name="alert_quantity" class="form-control form-control-solid" placeholder="Enter Alert Quantity" value="<?php echo $editProduct->alert_quantity; ?>">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fs-7">Note</label>
                        <textarea class="form-control" name="note" rows="1" placeholder="Enter Note"><?php echo $editProduct->note; ?></textarea>
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