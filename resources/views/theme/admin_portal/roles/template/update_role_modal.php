<form action="<?php echo url('roles/update'); ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

    <div class="modal fade update_role_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">Update Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="row d-flex justify-content-center mb-2">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label class="required fw-bold fs-7 mb-2">Role Name</label>
                                <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter Role Name" required>
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

<script>
    $(document).ready(function() {

        $(document).on('click', '.role_edit_btn', function(){

            var roleId = $(this).attr('data-role-id');
            var roleName = $(this).attr('data-role-name');            

            var idInput = $('.update_role_modal input[name="id"]');
            var roleNameInput = $('.update_role_modal input[name="name"]');

            idInput.val(roleId);
            roleNameInput.val(roleName);
        });

 });
 </script>