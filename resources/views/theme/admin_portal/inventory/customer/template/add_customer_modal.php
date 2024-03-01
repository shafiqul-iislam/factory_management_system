<form action="<?php echo url('customers/add'); ?>" method="post" enctype="">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

    <div class="modal fade add_customer_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">Add Customer</h5>
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
                                <label class="required fw-bold fs-7 mb-1">Name</label>
                                <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter Customer Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="required fw-bold fs-7 mb-1">Email</label>
                                <input type="text" name="email" class="form-control form-control-solid" placeholder="Enter Email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="required fw-bold fs-7 mb-1">Phone</label>
                                <input type="text" name="phone" class="form-control form-control-solid" placeholder="Enter Phone" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="required fw-bold fs-7 mb-1">Address</label>
                                <input type="text" name="address" class="form-control form-control-solid" placeholder="Enter Address" required>
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