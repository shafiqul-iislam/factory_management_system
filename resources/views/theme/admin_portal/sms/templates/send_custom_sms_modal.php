<form action="<?php echo url('sms-templates/send-sms'); ?>" method="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

    <div class="modal fade send_custom_sms_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">Send SMS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body px-6">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7">Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7">Message</label>
                                <input type="text" name="message" class="form-control" placeholder="Enter Message">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>