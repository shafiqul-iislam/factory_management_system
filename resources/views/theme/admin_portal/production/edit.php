<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')); ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')); ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')); ?>

<form enctype="multipart/form-data" action="<?php echo url('productions/update'); ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
    <div class="card shadow-sm">
        <div class="card-header border-bottom p-3">
            <h3 class="card-title">Update Production</h3>
        </div>
        <div class="card-body pt-4 edit_production">
            <input type="hidden" name="id" value="<?php echo $editProduction->id; ?>">

            <div class="row d-flex justify-content-center mb-4">
                <div class="col-lg-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" <?php echo ($editProduction->status == 1) ? 'checked' : ''; ?>>
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
                            <?php if (isset($editProduction->productData)) { ?>
                                <option selected value="<?php echo $editProduction->product_id ?>"><?php echo $editProduction->productData->name . ' (' . $editProduction->productData->category . ')' ?> (*)</option>
                            <?php } ?>


                            <option value="">Select A Product</option>
                            <?php if (isset($products) && !empty($products)) { ?>
                                <?php foreach ($products as $product) { ?>
                                    <option value="<?php echo $product->id ?>"><?php echo $product->name . ' (' . $product->category . ')' ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fw-bold fs-7">Office Shift</label>
                        <select class="form-control form-control-md" name="office_shift">

                            <?php if ($editProduction->office_shift == 1) { ?>
                                <option selected value="1">Day (*)</option>
                            <?php } else if ($editProduction->office_shift == 2) { ?>
                                <option selected value="2">Afternoon (*)</option>
                            <?php } else if ($editProduction->office_shift == 3) { ?>
                                <option selected value="3">Night (*)</option>
                            <?php } else if ($editProduction->office_shift == 4) { ?>
                                <option selected value="4">Others (*)</option>
                            <?php } ?>

                            <option>Select An Option</option>
                            <option value="1">Day</option>
                            <option value="2">Afternoon</option>
                            <option value="3">Night</option>
                            <option value="4">Others</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label required fw-bold fs-7">Production Target</label>
                        <input type="text" name="production_target" class="form-control form-control-solid" placeholder="Enter Production Target" value="<?php echo $editProduction->production_target; ?>" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fw-bold fs-7">Total Production</label>
                        <input type="text" name="total_production" class="form-control form-control-solid" placeholder="Enter Total Production" value="<?php echo $editProduction->total_production; ?>" required>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fw-bold fs-7">Supervisors <span class="fw-normal">(As Per Product's Department)</span></label>
                        <select class="form-control form-control-md" name="supervisor_id">

                            <?php if (isset($editProduction->supervisorData->designationData)) { ?>
                                <option selected value="<?php echo $editProduction->supervisor_id ?>"><?php echo $editProduction->supervisorData->name . ' (' . $editProduction->supervisorData->designationData->name . ')' ?> (*)</option>
                            <?php } ?>
                            <option value="">Select An Option</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-label fw-bold fs-7">Note</label>
                        <textarea class="form-control form-control-solid" name="note" rows="1" placeholder="Enter Note"><?php echo $editProduction->note; ?></textarea>
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

<script>
    $(document).ready(function() {

        var productSelector = $('.edit_production select[name="product_id"]');
        var supervisorSelector = $('.edit_production select[name="supervisor_id"]');

        productSelector.on('change', function() {
            var productId = $(this).val();

            var url = "<?php echo url('productions/get-employees'); ?>";
            $.ajax({
                url: url,
                type: "POST",
                dataType: "Json",
                data: {
                    "_token": "<?php echo csrf_token(); ?>",
                    'product_id': productId
                },
                error: function() {
                    console.log(error);
                },
                success: function(data) {
                    supervisorSelector.html('');
                    supervisorSelector.prepend(data.employess);
                },
            });
        });


    });
</script>