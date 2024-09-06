<form class="form" action="<?php echo url('settings/upload-logo'); ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

    <div class="modal fade upload_logo_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase">Upload Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center align-items-center mb-3">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label class="required fw-bold fs-7 mb-1">Logo</label>
                                <input type="file" name="logo" class="form-control form-control-solid">
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