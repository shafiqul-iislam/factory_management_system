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
        <div class="app-brand demo">
          <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
              <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                  <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z" id="path-1"></path>
                  <path d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z" id="path-3"></path>
                  <path d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z" id="path-4"></path>
                  <path d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z" id="path-5"></path>
                </defs>
                <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                    <g id="Icon" transform="translate(27.000000, 15.000000)">
                      <g id="Mask" transform="translate(0.000000, 8.000000)">
                        <mask id="mask-2" fill="white">
                          <use xlink:href="#path-1"></use>
                        </mask>
                        <use fill="#696cff" xlink:href="#path-1"></use>
                        <g id="Path-3" mask="url(#mask-2)">
                          <use fill="#696cff" xlink:href="#path-3"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                        </g>
                        <g id="Path-4" mask="url(#mask-2)">
                          <use fill="#696cff" xlink:href="#path-4"></use>
                          <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                        </g>
                      </g>
                      <g id="Triangle" transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                        <use fill="#696cff" xlink:href="#path-5"></use>
                        <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
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