<form action="<?php echo url('departments/add'); ?>" method="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

    <div class="modal fade add_department_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">Add Department/Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center align-items-center mb-2">
                        <div class="col-lg-10">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" checked="">
                                <label class="form-check-label fw-bold fs-7" for="flexSwitchCheckDefault">Status</label>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mb-2">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label class="required fw-bold fs-7">Department/Section Name</label>
                                <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter Department Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mb-2">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label class="form-label fw-bold fs-7">Description</label>
                                <textarea class="form-control form-control-solid" name="description" rows="3" placeholder="Enter Description"></textarea>
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