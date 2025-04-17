<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')); ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')); ?>
<?php include(resource_path('/views/theme/admin_portal/global/error_alert.php')); ?>

<div class="card shadow-sm">
    <div class="card-header border-bottom d-flex align-items-center justify-content-between">
        <h4 class="card-title">Customers</h4>
        <div class="card-toolbar">
            <button type="button" class="btn btn-primary btn-md me-3 fs-6" data-bs-toggle="modal" data-bs-target=".add_customer_modal">
                Add Customer
            </button>
        </div>
    </div>
    <div class="card-body py-4">
        <div class="table-responsive">
            <table class="table align-items-center mb-0" id="dt_customers">
                <thead>
                    <tr class="text-start fs-6">
                        <th class="font-weight-bolder" style="min-width: 40px;">ID</th>
                        <th class="font-weight-bolder" style="min-width: 100px;">Name</th>
                        <th class="font-weight-bolder" style="min-width: 100px;">Email</th>
                        <th class="font-weight-bolder" style="min-width: 100px;">Phone</th>
                        <th class="font-weight-bolder" style="min-width: 200px;">Address</th>
                        <th class="font-weight-bolder" style="min-width: 80px;">Status</th>
                        <th class="font-weight-bolder" style="min-width: 90px;">Created By</th>
                        <th class="font-weight-bolder" style="min-width: 90px;">Created At</th>
                        <th class="font-weight-bolder text-end" style="min-width: 100px;">Actions</th>
                    </tr>
                </thead>
            </table>
            <tbody class="text-mute text-start fs-7">
            </tbody>
        </div>
    </div>
</div>

<?php include(resource_path('/views/theme/admin_portal/dashboard/footer.php')); ?>
<?php include(resource_path('/views/theme/admin_portal/inventory/customer/template/add_customer_modal.php')); ?>

<script>
    $(document).ready(function() {
        var url = "<?php echo url('customers/server-side-data'); ?>";

        var table = $('#dt_customers').DataTable({
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