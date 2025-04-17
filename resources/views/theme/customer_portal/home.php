<?php include(resource_path('/views/theme/customer_portal/dashboard/header.php')); ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')); ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')); ?>


<h1 class="text-center">Welcome To Customer Portal <br> Mr. <?php echo $loginCustomerData->name; ?></h1>

<?php include(resource_path('/views/theme/customer_portal/dashboard/footer.php')); ?>