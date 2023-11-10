<form enctype="multipart/form-data" method="POST" action="<?php echo url('employees/add'); ?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

    <div class="modal fade add_employee_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">Add Employee</h5>
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
                                <label class="form-label fs-7 required">Department</label>
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
                                <label class="form-label fs-7 required">Designation</label>
                                <select class="form-control form-control-md" name="designation" required>
                                    <option>Select An Option</option>
                                    <?php if (isset($designations) && !empty($designations)) { ?>
                                        <?php foreach ($designations as $designation) { ?>

                                            <option value="<?php echo $designation->id ?>">
                                                <?php echo $designation->name ?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7 required">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7 required">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7 required">Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter Phone" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter Email">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7">Gender</label>
                                <select class="form-control form-control-md" name="gender">
                                    <option>Select An Option</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter Address">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7 required">Joining Date</label>
                                <input type="date" name="joining_date" class="form-control" placeholder="Enter Joining Date" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7">Office Shift</label>
                                <select class="form-control form-control-md" name="office_shift">
                                    <option>Select An Option</option>
                                    <option value="1">Day</option>
                                    <option value="2">Night</option>
                                </select>
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