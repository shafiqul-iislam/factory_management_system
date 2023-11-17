<form enctype="multipart/form-data" method="POST" action="<?php echo url('holidays/add'); ?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

    <div class="modal fade add_holiday_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">Add Holiday</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body px-6">
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status" checked="">
                                <label class="form-check-label fw-bold fs-7" for="flexSwitchCheckDefault">Status</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7 required">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7 required">Start Date</label>
                                <input type="text" name="start_date" class="form-control date_picker" placeholder="Enter Date" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7 required">Finish Date</label>
                                <input type="text" name="finish_date" class="form-control date_picker" placeholder="Enter Time In" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7">Note</label>
                                <textarea class="form-control" name="note"rows="1" placeholder="Enter Note"></textarea>
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

<script>
    $(document).ready(function() {
        $('.date_picker').datetimepicker({
            datepicker: true,
            timepicker: false,
            format: 'Y-m-d'
        });
    });
</script>