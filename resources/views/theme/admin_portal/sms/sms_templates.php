<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')) ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')) ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')) ?>

<div class="card shadow-sm">
    <div class="card-header border-bottom d-flex align-items-center justify-content-between">
        <h4 class="card-title">SMS Templates</h4>
        <div class="card-toolbar">
            <button type="button" class="btn btn-primary btn-md me-3 fs-6" data-bs-toggle="modal" data-bs-target=".send_custom_sms_modal">
                Send Custom SMS
            </button>
        </div>
    </div>
    <div class="card-body py-4">
        <div class="table-responsive">
            <table class="table align-items-center mb-0" id="dt_users">
                <thead>
                    <tr class="text-start fs-6">
                        <th class="font-weight-bolder" style="min-width: 20px;">ID</th>
                        <th class="font-weight-bolder" style="min-width: 100px;">Username</th>
                        <th class="font-weight-bolder" style="min-width: 100px;">Role</th>
                        <th class="font-weight-bolder" style="min-width: 150px;">Profile Type</th>
                        <th class="font-weight-bolder" style="min-width: 100px;">Phone</th>
                        <th class="font-weight-bolder" style="min-width: 100px;">Email</th>
                        <th class="font-weight-bolder" style="min-width: 100px;">Status</th>
                        <th class="font-weight-bolder" style="min-width: 100px;">Created By</th>
                        <th class="font-weight-bolder" style="min-width: 100px;">Created At</th>
                        <th class="font-weight-bolder text-end" style="min-width: 100px;">Actions</th>
                    </tr>
                </thead>
            </table>
            <tbody class="text-mute text-start fs-7">
            </tbody>
        </div>
    </div>
</div>


<?php include(resource_path('/views/theme/admin_portal/dashboard/footer.php')) ?>
<?php include(resource_path('/views/theme/admin_portal/sms/templates/send_custom_sms_modal.php')) ?>
