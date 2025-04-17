<form enctype="multipart/form-data" method="POST" action="<?php echo url('designations/add'); ?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

    <div class="modal fade add_designation_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">Add Designation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body px-6">
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7 required">Designation</label>
                                <input type="text" name="desination_name" class="form-control" placeholder="Enter Designation" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7 required">Departments</label>
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
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label fs-7">Note</label>
                                <textarea type="text" name="note" class="form-control" placeholder="Enter Note" rows="1"></textarea>
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