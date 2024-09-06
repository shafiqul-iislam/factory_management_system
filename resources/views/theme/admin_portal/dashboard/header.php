<!DOCTYPE html>

<!-- =========================================================
* Factory Management System
==============================================================
* Created by: SkeyIT
* Copyright SkeyIT 2023
=========================================================
 -->
<!-- start -->
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="" <?php echo asset('theme/assets/'); ?>" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Admin Portal</title>
  <meta name="description" content="" />
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?php echo asset('/theme/assets/img/favicon/favicon.ico'); ?>" />
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="<?php echo asset('/theme/assets/vendor/fonts/boxicons.css'); ?>" />
  <!-- Core CSS -->
  <link rel="stylesheet" href="<?php echo asset('/theme/assets/vendor/css/core.css'); ?>" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?php echo asset('/theme/assets/vendor/css/theme-default.css'); ?>" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?php echo asset('/theme/assets/css/demo.css'); ?>" />
  <link rel="stylesheet" href="<?php echo asset('/theme/assets/vendor/jquery.datetimepicker.css'); ?>" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?php echo asset('/theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css'); ?>" />
  <link rel="stylesheet" href="<?php echo asset('/theme/assets/vendor/libs/apex-charts/apex-charts.css'); ?>" />
  <!-- Page CSS -->
  <!-- Helpers -->
  <script src="<?php echo asset('/theme/assets/vendor/js/helpers.js'); ?>"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="<?php echo asset('/theme/assets/js/config.js'); ?>"></script>

  <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet" />

  <meta name="csrf-token" content="<?php echo csrf_token(); ?>">
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      <?php
      $authUserData = auth()->user();
      $userRolePermissions = getPermissions();
      ?>
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand">
          <a href="#" class="app-brand-link">
            <img src="<?php echo asset('/storage/app/logo/' . generalSettings()->logo); ?>" alt="">
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">

          <!-- Dashboard -->

          <li class="menu-item">
            <a href="<?php echo url('home'); ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Dashboard</div>
            </a>
          </li>


          <!-- departments -->
          <?php if (checkPermission($userRolePermissions, 'department_module')) { ?>
            <li class="menu-item <?php echo request()->is('departments') ? 'active' : ''; ?>">
              <a href="<?php echo url('departments'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Departments/Sections</div>
              </a>
            </li>
          <?php } ?>

          <!-- roles -->
          <?php if (checkPermission($userRolePermissions, 'role_module')) { ?>
            <li class="menu-item <?php echo request()->is('roles') ? 'active' : ''; ?>">
              <a href="<?php echo url('roles'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Role</div>
              </a>
            </li>
          <?php } ?>

          <!-- users -->
          <?php if (checkPermission($userRolePermissions, 'user_module')) { ?>
            <li class="menu-item <?php echo request()->is('users') ? 'active' : ''; ?>">
              <a href="<?php echo url('users'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Users</div>
              </a>
            </li>
          <?php } ?>

          <!-- hrm -->
          <?php if (checkPermission($userRolePermissions, 'employee_module') || checkPermission($userRolePermissions, 'designation_module') || checkPermission($userRolePermissions, 'attendance_module') || checkPermission($userRolePermissions, 'holiday_module') || checkPermission($userRolePermissions, 'leave_request_module') || checkPermission($userRolePermissions, 'payroll_module')) { ?>

            <li class="menu-item <?php echo request()->is('employees*', 'designations', 'attendances', 'holidays', 'leaves') ? 'active open' : ''; ?>">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">HRM</div>
              </a>

              <ul class="menu-sub">
                <?php if (checkPermission($userRolePermissions, 'employee_module')) { ?>
                  <li class="menu-item <?php echo request()->is('employees') ? 'active' : ''; ?>">
                    <a href="<?php echo url('employees'); ?>" class="menu-link">
                      <div data-i18n="Without menu">Employees</div>
                    </a>
                  </li>
                <?php } ?>

                <?php if (checkPermission($userRolePermissions, 'designation_module')) { ?>
                  <li class="menu-item <?php echo request()->is('designations') ? 'active' : ''; ?>">
                    <a href="<?php echo url('designations'); ?>" class="menu-link">
                      <div data-i18n="Without menu">Designations</div>
                    </a>
                  </li>
                <?php } ?>

                <?php if (checkPermission($userRolePermissions, 'attendance_module')) { ?>
                  <li class="menu-item <?php echo request()->is('attendances') ? 'active' : ''; ?>">
                    <a href="<?php echo url('attendances'); ?>" class="menu-link">
                      <div data-i18n="Without menu">Attendances</div>
                    </a>
                  </li>
                <?php } ?>

                <?php if (checkPermission($userRolePermissions, 'holiday_module')) { ?>
                  <li class="menu-item <?php echo request()->is('holidays') ? 'active' : ''; ?>">
                    <a href="<?php echo url('holidays'); ?>" class="menu-link">
                      <div data-i18n="Without menu">Holidays</div>
                    </a>
                  </li>
                <?php } ?>

                <?php if (checkPermission($userRolePermissions, 'leave_request_module')) { ?>
                  <li class="menu-item <?php echo request()->is('leaves') ? 'active' : ''; ?>">
                    <a href="<?php echo url('leaves'); ?>" class="menu-link">
                      <div data-i18n="Without menu">Leave Request</div>
                    </a>
                  </li>
                <?php } ?>

                <?php if (checkPermission($userRolePermissions, 'payroll_module')) { ?>
                  <li class="menu-item <?php echo request()->is('payrolls') ? 'active' : ''; ?>">
                    <a href="<?php echo url('payrolls'); ?>" class="menu-link">
                      <div data-i18n="Without menu">Payroll</div>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </li>
          <?php } ?>

          <!-- products -->
          <li class="menu-item <?php echo request()->is('products') ? 'active' : ''; ?>">
            <a href="<?php echo url('products'); ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-collection"></i>
              <div data-i18n="Basic">Products</div>
            </a>
          </li>

          <!-- production -->
          <li class="menu-item <?php echo request()->is('production') ? 'active' : ''; ?>">
            <a href="<?php echo url('production'); ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-collection"></i>
              <div data-i18n="Basic">Production</div>
            </a>
          </li>

          <!-- production -->
          <?php if (checkPermission($userRolePermissions, 'customer_module')) { ?>
            <li class="menu-item <?php echo request()->is('customers') ? 'active' : ''; ?>">
              <a href="<?php echo url('customers'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Customers</div>
              </a>
            </li>
          <?php } ?>


          <li class="menu-item <?php echo request()->is('employees*', 'designations', 'attendances', 'holidays', 'leaves') ? 'active open' : ''; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-layout"></i>
              <div data-i18n="Layouts">Inventory</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item <?php echo request()->is('employees') ? 'active' : ''; ?>">
                <a href="<?php echo url('employees'); ?>" class="menu-link">
                  <div data-i18n="Without menu">Employees</div>
                </a>
              </li>
              <li class="menu-item <?php echo request()->is('designations') ? 'active' : ''; ?>">
                <a href="<?php echo url('designations'); ?>" class="menu-link">
                  <div data-i18n="Without menu">Designations</div>
                </a>
              </li>
              <li class="menu-item <?php echo request()->is('attendances') ? 'active' : ''; ?>">
                <a href="<?php echo url('attendances'); ?>" class="menu-link">
                  <div data-i18n="Without menu">Attendance</div>
                </a>
              </li>
            </ul>
          </li>

          <!-- Layouts -->
          <!-- <li class="menu-item <?php echo request()->is('patients') ? 'show' : ''; ?>">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Patients</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item <?php echo request()->is('patients') ? 'active' : ''; ?>">
                  <a href="<?php echo url('patients'); ?>" class="menu-link">
                    <div data-i18n="Without menu">Patients</div>
                  </a>
                </li>
                <li class="menu-item <?php echo request()->is('payments') ? 'active' : ''; ?>">
                  <a href="<?php echo url('payments'); ?>" class="menu-link">
                    <div data-i18n="Without menu">Payments</div>
                  </a>
                </li>
              </ul>
            </li> -->

          <!-- Layouts -->
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-layout"></i>
              <div data-i18n="Layouts">Layouts</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item">
                <a href="layouts-without-menu.html" class="menu-link">
                  <div data-i18n="Without menu">Without menu</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="layouts-without-navbar.html" class="menu-link">
                  <div data-i18n="Without navbar">Without navbar</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="layouts-container.html" class="menu-link">
                  <div data-i18n="Container">Container</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="layouts-fluid.html" class="menu-link">
                  <div data-i18n="Fluid">Fluid</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="layouts-blank.html" class="menu-link">
                  <div data-i18n="Blank">Blank</div>
                </a>
              </li>
            </ul>
          </li>

          <li class="menu-item">
            <form method="POST" action="<?php echo route('logout'); ?>">
              <?php //echo csrf_field(); 
              ?>
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
              <button type="submit" class="menu-link btn btn-sm">
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Logout</span>
              </button>
            </form>
          </li>


        </ul>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">

        <div class="navbar-nav-right d-flex align-items-center px-3 pt-2" id="navbar-collapse">
          <!-- Search -->
          <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
              <i class="bx bx-search fs-4 lh-0"></i>
              <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
            </div>
          </div>
          <!-- /Search -->

          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                  <img src="<?php echo asset('/theme/assets/img/avatars/1.png'); ?>" alt class="w-px-40 h-auto rounded-circle" />
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <span class="fw-semibold d-block">John Doe</span>
                        <small class="text-muted">Admin</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                    <i class="bx bx-user me-2"></i>
                    <span class="align-middle">My Profile</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                    <i class="bx bx-cog me-2"></i>
                    <span class="align-middle">Settings</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                    <span class="d-flex align-items-center align-middle">
                      <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                      <span class="flex-grow-1 align-middle">Billing</span>
                      <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                    </span>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider"></div>
                </li>
                <li>
                  <form method="POST" action="<?php echo route('logout'); ?>">
                    <?php //echo csrf_field(); 
                    ?>
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />

                    <button type="submit" class="dropdown-item btn btn-sm">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle fs-6">Logout</span>
                    </button>
                  </form>
                </li>
              </ul>
            </li>
            <!--/ User -->
          </ul>
        </div>

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">