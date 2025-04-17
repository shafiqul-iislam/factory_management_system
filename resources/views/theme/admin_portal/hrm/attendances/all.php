<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')) ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')) ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')) ?>

<div class="card shadow-sm">
    <div class="card-header border-bottom d-flex align-items-center justify-content-between">
        <h4 class="card-title">Attendances</h4>
        <div class="card-toolbar">
            <button type="button" class="btn btn-primary btn-md me-3 fs-6" data-bs-toggle="modal" data-bs-target=".add_attendance_modal">
                Add Attendance
            </button>
        </div>
    </div>
    <div class="card-body py-4">
        <div class="table-responsive">
            <table class="table align-items-center mb-0" id="dt_attendances">
                <thead>
                    <tr class="text-start fs-6">
                        <th class="font-weight-bolder" style="min-width: 40px;">ID</th>
                        <th class="font-weight-bolder" style="min-width: 150px;">Employee</th>
                        <th class="font-weight-bolder" style="min-width: 150px;">Date</th>
                        <th class="font-weight-bolder" style="min-width: 150px;">Time In</th>
                        <th class="font-weight-bolder" style="min-width: 150px;">Time Out</th>
                        <th class="font-weight-bolder" style="min-width: 150px;">Work Duration</th>
                        <th class="font-weight-bolder" style="min-width: 150px;">Created By</th>
                        <th class="font-weight-bolder text-end" style="min-width: 150px;">Actions</th>
                    </tr>
                </thead>
            </table>
            <tbody class="text-mute text-start fs-7">
            </tbody>
        </div>
    </div>
</div>

<?php include(resource_path('/views/theme/admin_portal/dashboard/footer.php')) ?>
<?php include(resource_path('/views/theme/admin_portal/hrm/attendances/template/add_attendance_modal.php')) ?>

<script>
    $(document).ready(function() {
        var url = "<?php echo url('attendances/server-side-data'); ?>";

        var table = $('#dt_attendances').DataTable({
            serverSide: true,
            processing: true,
            orderable: false,
            scrollX: true,
            searching: false,
            ajax: {
                url: url,
                type: "POST",
                data: {
                    "_token": "<?php echo csrf_token(); ?>"
                },
            },
            error: function() {
                console.log(error);
            }
        });

        table.on('click', '.remove', function(e) {

            e.preventDefault();
            var deleteData = $(this).parent('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(actionType) {
                if (actionType.value == true) {
                    deleteData.submit();
                }
            });
        });
    });
</script>