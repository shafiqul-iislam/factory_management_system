<form action="<?php echo url('products/add'); ?>" method="post" enctype="">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

    <div class="modal fade add_product_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">Add Product</h5>
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-7 required mb-1">Departments</label>
                                <select class="form-control form-control-md" name="department_id" required>
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="required fw-bold fs-7 mb-1">Name</label>
                                <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter Product Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="required fw-bold fs-7 mb-1">Product Code</label>
                                <input type="text" name="product_code" class="form-control form-control-solid" placeholder="Enter Product Code">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="required fw-bold fs-7 mb-1">Category</label>
                                <input type="text" name="category" class="form-control form-control-solid" placeholder="Enter Product Category">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="required fw-bold fs-7 mb-1">Brand</label>
                                <input type="text" name="brand" class="form-control form-control-solid" placeholder="Enter Product Brand">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="required fw-bold fs-7 mb-1">Units</label>
                                <input type="text" name="units" class="form-control form-control-solid" placeholder="Enter Product Units">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center align-items-center mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="required fw-bold fs-7 mb-1">Alert Quantity</label>
                                <input type="number" name="alert_quantity" class="form-control form-control-solid" placeholder="Enter Alert Quantity">
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