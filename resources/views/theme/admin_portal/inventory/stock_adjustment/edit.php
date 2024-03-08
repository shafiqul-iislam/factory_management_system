<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')); ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')); ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')); ?>

<form enctype="multipart/form-data" action="<?php echo url('stocks/update'); ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
    <div class="card shadow-sm">
        <div class="card-header border-bottom p-3">
            <h3 class="card-title">Update Stock</h3>
        </div>
        <div class="card-body pt-4 edit_production">
            <input type="hidden" name="id" value="">

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status">
                        <label class="form-check-label fw-bold fs-7" for="flexSwitchCheckDefault">Status</label>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>

            <div class="row d-flex justify-content-center mb-3">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fw-bold fs-7 required">Products</label>
                        <select class="form-control form-control-md" name="product_id" required>
                            <option value="">Select A Product</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="fw-bold fs-7 mb-1">Current Stock</label>
                        <input type="text" name="stock_quantity" class="form-control form-control-solid" placeholder="Enter Stock Quantity" disabled>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fw-bold fs-7">Adjust Stock</label>
                        <input type="text" name="adjust_stock" class="form-control form-control-solid" placeholder="Enter Adjust Stock">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fw-bold fs-7 mb-1">Note</label>
                        <textarea class="form-control form-control-solid" name="note" rows="1" placeholder="Enter Note"></textarea>
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