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
                    <div class="d-flex justify-content-center">
                        <div class="positon-static loading" style="display: none;">
                            <img src="<?php echo asset('theme/assets/img/theme_img/loader/loading.svg'); ?>" alt="" width="100px" height="100px">
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center align-items-center mb-3">
                        <div class="col-lg-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" checked="">
                                <label class="form-check-label fw-bold fs-7" for="flexSwitchCheckDefault">Status</label>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-7 required mb-1">Department</label>
                                <select class="form-control form-control-md" name="department_id" required>
                                    <option value="">Select A Department</option>
                                    <?php if (isset($departments) && !empty($departments)) { ?>
                                        <?php foreach ($departments as $department) { ?>
                                            <option value="<?php echo $department->id; ?>"><?php echo $department->name; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- ***** if select a product then get department data as well which department's supervisor by ajax ******* -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-7 required mb-1">Products</label>
                                <select class="form-control form-control-md" name="product_id" required>
                                    <option value="">Select A Product</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mb-3">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-7 mb-1">Supervisors <span class="fw-normal">(As Per Product's Department)</span></label>
                                <select class="form-control form-control-md" name="supervisor_id">
                                    <option value="">Select An Option</option>
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
                        <div class="col-lg-12">
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

        var departmentSelector = $('.add_production_modal select[name="department_id"]');

        var productSelector = $('.add_production_modal select[name="product_id"]');
        var supervisorSelector = $('.add_production_modal select[name="supervisor_id"]');


        departmentSelector.on('change', function() {
            var departmentId = $(this).val();

            var url = "<?php echo url('productions/get-products-employees'); ?>";
            $.ajax({
                url: url,
                type: "POST",
                dataType: "Json",
                data: {
                    "_token": "<?php echo csrf_token(); ?>",
                    'department_id': departmentId
                },
                error: function() {
                    console.log(error);
                },
                beforeSend: function() {
                    $('.loading').fadeIn();
                },
                success: function(data) {
                    $('.loading').fadeOut();

                    productSelector.html('');
                    productSelector.prepend(data.productOptions);
                    productSelector.addClass('border-success');

                    supervisorSelector.html('');
                    supervisorSelector.prepend(data.employeeOptions);
                    supervisorSelector.addClass('border-success');
                },
            });
        });


    });
</script>