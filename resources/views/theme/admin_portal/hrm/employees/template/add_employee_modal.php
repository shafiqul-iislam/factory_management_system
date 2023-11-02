<form action="<?php echo url('users/add'); ?>" method="post">
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
                            <div class="form-group">
                                <label class="form-label fs-7">Role</label>
                                <select class="form-control form-control-md" name="role">
                                    <option>Select An Option</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Staff</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7">Profile Type</label>
                                <select class="form-control form-control-md" name="profile_type">
                                    <option>Select An Option</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Staff</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter Username">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7">Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
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
                                <label class="form-label fs-7">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fs-7">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter Address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="profile_status" checked="">
                                <label class="form-check-label fw-bold fs-7" for="flexSwitchCheckDefault">Status</label>
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