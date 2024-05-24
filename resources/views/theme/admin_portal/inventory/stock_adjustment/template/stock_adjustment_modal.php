<form action="<?php echo url('stocks/add'); ?>" method="post" enctype="">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

    <div class="modal fade add_new_stock_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">Stock Adjustment</h5>
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
                                <label class="required fw-bold fs-7 mb-1">Products</label>
                                <select class="form-control form-control-md" name="product_code" required>
                                    <option value="">Select A Product</option>
                                    <?php if (isset($products) && !empty($products)) { ?>
                                        <?php foreach ($products as $product) { ?>
                                            <option value="<?php echo $product->product_code ?>"><?php echo $product->name . ' (' . $product->category . ')' ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="required fw-bold fs-7 mb-1">Stock</label>
                                <input type="text" name="stock_quantity" class="form-control form-control-solid" placeholder="Enter Stock Quantity" required>
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