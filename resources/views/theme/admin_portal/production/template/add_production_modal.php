<form action="<?php echo url('productions/add'); ?>" method="post" enctype="">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

    <div class="modal fade add_production_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">Add Production</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center align-items-center mb-3">
                        <div class="col-lg-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" checked="">
                                <label class="form-check-label fw-bold fs-7" for="flexSwitchCheckDefault">Status</label>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mb-3">

                        <!-- ***** if select a product then get department data as well which department's supervisor by ajax ******* -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-7 required mb-1">Products</label>
                                <select class="form-control form-control-md" name="product_id" required>
                                    <option value="">Select A Product</option>
                                    <?php if (isset($products) && !empty($products)) { ?>
                                        <?php foreach ($products as $product) { ?>
                                            <option value="<?php echo $product->id ?>"><?php echo $product->name . ' (' . $product->category . ')' ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7">Office Shift</label>
                                <select class="form-control form-control-md" name="office_shift">
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="required fw-bold fs-7 mb-1">Production Target</label>
                                <input type="text" name="production_target" class="form-control form-control-solid" placeholder="Enter Product Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-7 mb-1">Total Production</label>
                                <input type="text" name="total_production" class="form-control form-control-solid" placeholder="Enter Product Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-7 mb-1">Supervisors</label>
                                <select class="form-control form-control-md" name="supervisor_id">
                                    <option value="">Select An Option</option>
                                    <!-- employees -->
                                    <?php if (isset($supervisors) && !empty($supervisors)) { ?>
                                        <?php foreach ($supervisors as $supervisor) { ?>
                                            <option value="<?php echo $supervisor->id ?>"><?php echo $supervisor->username ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-7 mb-1">Note</label>
                                <textarea class="form-control form-control-solid" name="note" rows="1" placeholder="Enter Note"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    $(document).ready(function() {

        var productSelector = $('.add_production_modal select[name="product_id"]');

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
                    console.log(data);
                    // selector.html('');
                    // selector.prepend(data.options);
                    // selector.select2('');
                },
            });
        });


    });
</script>