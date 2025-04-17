<form enctype="multipart/form-data" method="POST" action="<?php echo url('attendances/add'); ?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

    <div class="modal fade add_attendance_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">Add Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body px-6">
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7 required">Employees</label>
                                <select class="form-control form-control-md" name="employee_id" required>
                                    <option>Select An Option</option>
                                    <?php if (isset($employees) && !empty($employees)) { ?>
                                        <?php foreach ($employees as $employees) { ?>

                                            <option value="<?php echo $employees->id ?>">
                                                <?php echo $employees->name ?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7 required">Date</label>
                                <input type="text" name="date" class="form-control date_picker" placeholder="Enter Date" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7 required">Time In</label>
                                <input type="text" name="time_in" class="form-control time_picker" placeholder="Enter Time In" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7 required">Time Out</label>
                                <input type="text" name="time_out" class="form-control time_picker" placeholder="Enter Time Out" required>
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

        $('.time_picker').datetimepicker({
            datepicker: false,
            format: 'H:i',
        });

    });
</script>