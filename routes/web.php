<?php

use App\Models\Designation;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPortal\UserController;
use App\Http\Controllers\AdminPortal\Sms\SmsController;
use App\Http\Controllers\AdminPortal\Role\RoleController;
use App\Http\Controllers\AdminPortal\Email\EmailController;
use App\Http\Controllers\AdminPortal\HRM\HolidayController;
use App\Http\Controllers\AdminPortal\HRM\PayrollController;
use App\Http\Controllers\AdminPortal\HRM\EmployeeController;
use App\Http\Controllers\AdminPortal\HRM\AttendanceController;
use App\Http\Controllers\AdminPortal\HRM\DesignationController;
use App\Http\Controllers\AdminPortal\Role\PermissionController;
use App\Http\Controllers\CustomerPortal\CustomerAuthController;
use App\Http\Controllers\CustomerPortal\CustomerHomeController;
use App\Http\Controllers\AdminPortal\HRM\LeaveRequestController;
use App\Http\Controllers\AdminPortal\Product\ProductsController;
use App\Http\Controllers\AdminPortal\Settings\SettingsController;
use App\Http\Controllers\AdminPortal\Inventory\CustomerController;
use App\Http\Controllers\AdminPortal\Inventory\WarehouseController;
use App\Http\Controllers\AdminPortal\Department\DepartmentController;
use App\Http\Controllers\AdminPortal\Production\ProductionController;
use App\Http\Controllers\AdminPortal\Inventory\StockAdjustmentController;

use App\Http\Controllers\CustomerPortal\PaymentController as CustomerPaymentController;
use App\Http\Controllers\CustomerPortal\Gateways\PaystackController as CustomerPaystackController;
use App\Http\Controllers\CustomerPortal\Gateways\SSLCommerzController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// after login
Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('theme.admin_portal.index');
    })->name('home');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect('/home');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/home');
    })->name('dashboard');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


Route::middleware(['auth', 'permission:user_module'])
    ->prefix('users')
    ->name('users.')
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('all');
        Route::post('/add', [UserController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('/update', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('delete');
        Route::post('/server-side-users', [UserController::class, 'serverSideAllUsers'])->name('server-side-users');
    });

Route::middleware(['auth'])
    ->prefix('roles')
    ->name('roles.')
    ->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('all');
        Route::post('/add', [RoleController::class, 'add'])->name('add');
        Route::post('/update', [RoleController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [RoleController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [RoleController::class, 'serverSideAllRoles'])->name('server-side-data');

        Route::get('permissions/{id}', [PermissionController::class, 'permissions'])->name('permissions');
    });

Route::middleware(['auth'])
    ->prefix('permissions')
    ->name('permissions.')
    ->group(function () {
        Route::post('/update', [PermissionController::class, 'updatePermission'])->name('update');
    });

Route::middleware(['auth', 'permission:department_module'])
    ->prefix('departments')
    ->name('departments.')
    ->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('all');
        Route::middleware(['permission:department_add'])->post('/add', [DepartmentController::class, 'add'])->name('add');
        Route::middleware(['permission:department_edit'])->get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit');
        Route::middleware(['permission:department_update'])->post('/update', [DepartmentController::class, 'update'])->name('update');
        Route::middleware(['permission:department_delete'])->delete('/delete/{id}', [DepartmentController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [DepartmentController::class, 'serverSideAllDepartments'])->name('server-side-data');
    });


Route::middleware(['auth', 'permission:employee_module'])
    ->prefix('employees')
    ->name('employees.')
    ->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('all');
        Route::post('/add', [EmployeeController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
        Route::post('/update', [EmployeeController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [EmployeeController::class, 'serverSideAllEmployees'])->name('server-side-data');
    });


Route::middleware(['auth', 'permission:designation_module'])
    ->prefix('designations')
    ->name('designations.')
    ->group(function () {
        Route::get('/', [DesignationController::class, 'index'])->name('all');
        Route::post('/add', [DesignationController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [DesignationController::class, 'edit'])->name('edit');
        Route::post('/update', [DesignationController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [DesignationController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [DesignationController::class, 'serverSideAllDesignations'])->name('server-side-data');
    });


Route::middleware(['auth', 'permission:attendance_module'])
    ->prefix('attendances')
    ->name('attendances.')
    ->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('all');
        Route::post('/add', [AttendanceController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [AttendanceController::class, 'edit'])->name('edit');
        Route::post('/update', [AttendanceController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AttendanceController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [AttendanceController::class, 'serverSideAllAttendances'])->name('server-side-data');
    });


Route::middleware(['auth', 'permission:holiday_module'])
    ->prefix('holidays')
    ->name('holidays.')
    ->group(function () {
        Route::get('/', [HolidayController::class, 'index'])->name('all');
        Route::post('/add', [HolidayController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [HolidayController::class, 'edit'])->name('edit');
        Route::post('/update', [HolidayController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [HolidayController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [HolidayController::class, 'serverSideAllHolidays'])->name('server-side-data');
    });

Route::middleware(['auth', 'permission:leave_request_module'])
    ->prefix('leaves')
    ->name('leaves.')
    ->group(function () {
        Route::get('/', [LeaveRequestController::class, 'index'])->name('all');
        Route::post('/add', [LeaveRequestController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [LeaveRequestController::class, 'edit'])->name('edit');
        Route::post('/update', [LeaveRequestController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [LeaveRequestController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [LeaveRequestController::class, 'serverSideAllLeaves'])->name('server-side-data');
    });


Route::middleware(['auth', 'permission:payroll_module'])
    ->prefix('payrolls')
    ->name('payrolls.')
    ->group(function () {
        Route::get('/', [PayrollController::class, 'index'])->name('all');
        Route::post('/add', [PayrollController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [PayrollController::class, 'edit'])->name('edit');
        Route::post('/update', [PayrollController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [PayrollController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [PayrollController::class, 'serverSideAllPayrolls'])->name('server-side-data');
    });

Route::middleware(['auth'])
    ->prefix('products')
    ->name('products.')
    ->group(function () {
        Route::get('/', [ProductsController::class, 'index'])->name('all');
        Route::post('/add', [ProductsController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('edit');
        Route::post('/update', [ProductsController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProductsController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [ProductsController::class, 'serverSideAllProducts'])->name('server-side-data');
    });


Route::middleware(['auth'])
    ->prefix('productions')
    ->name('productions.')
    ->group(function () {
        Route::get('/', [ProductionController::class, 'index'])->name('all');
        Route::post('/add', [ProductionController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [ProductionController::class, 'edit'])->name('edit');
        Route::post('/update', [ProductionController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProductionController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [ProductionController::class, 'serverSideAllProductions'])->name('server-side-data');

        Route::post('/get-products-employees', [ProductionController::class, 'getProductEmployees'])->name('get-products-employees');
    });


//*********** inventory *************
// warehouse
Route::middleware(['auth'])
    ->prefix('warehouses')
    ->name('warehouses.')
    ->group(function () {
        Route::get('/', [WarehouseController::class, 'index'])->name('all');
        Route::post('/add', [WarehouseController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [WarehouseController::class, 'edit'])->name('edit');
        Route::post('/update', [WarehouseController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [WarehouseController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [WarehouseController::class, 'serverSideAllWarehouses'])->name('server-side-data');
    });


// customer
Route::middleware(['auth', 'permission:customer_module'])
    ->prefix('customers')
    ->name('customers.')
    ->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('all');
        Route::post('/add', [CustomerController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit');
        Route::post('/update', [CustomerController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CustomerController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [CustomerController::class, 'serverSideAllCustomers'])->name('server-side-data');
    });


// stock adjustment
Route::middleware(['auth'])
    ->prefix('stocks')
    ->name('stocks.')
    ->group(function () {
        Route::get('/', [StockAdjustmentController::class, 'index'])->name('all');
        Route::post('/add', [StockAdjustmentController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [StockAdjustmentController::class, 'edit'])->name('edit');
        Route::post('/update', [StockAdjustmentController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [StockAdjustmentController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [StockAdjustmentController::class, 'serverSideAllStocks'])->name('server-side-data');
    });


// sms templates
Route::middleware(['auth'])
    ->prefix('sms-templates')
    ->name('sms-templates.')
    ->group(function () {
        Route::get('/', [SmsController::class, 'index'])->name('all');
        // Route::post('/add', [StockAdjustmentController::class, 'add'])->name('add');
        // Route::get('/edit/{id}', [StockAdjustmentController::class, 'edit'])->name('edit');
        // Route::post('/update', [StockAdjustmentController::class, 'update'])->name('update');
        // Route::delete('/delete/{id}', [StockAdjustmentController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [StockAdjustmentController::class, 'serverSideAllStocks'])->name('server-side-data');

        Route::post('/send-sms', [SmsController::class, 'sendCustomSms'])->name('send-sms');
    });

// email templates
Route::middleware(['auth'])
    ->prefix('email-templates')
    ->name('email-templates.')
    ->group(function () {
        Route::get('/', [EmailController::class, 'index'])->name('all');
        // Route::post('/add', [EmailController::class, 'add'])->name('add');
        // Route::get('/edit/{id}', [EmailController::class, 'edit'])->name('edit');
        // Route::post('/update', [EmailController::class, 'update'])->name('update');
        // Route::delete('/delete/{id}', [EmailController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [EmailController::class, 'serverSideAllEmails'])->name('server-side-data');

        Route::get('/send-email', [EmailController::class, 'sendCustomEmail'])->name('send-email');
    });

Route::middleware(['auth'])
    ->prefix('settings')
    ->name('settings.')
    ->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings');
        Route::post('/update-general-settings', [SettingsController::class, 'updateGeneralSettings'])->name('update-general-settings');

        Route::post('/upload-logo', [SettingsController::class, 'uploadLogo'])->name('upload-logo');
    });




// ############# need to add balance module ##############


################## cutomer portal ##############################

Route::middleware(['guest'])
    ->group(function () {
        Route::get('/customer-login', [CustomerAuthController::class, 'auth']);
        Route::post('/customer-login', [CustomerAuthController::class, 'authLogin'])->name('customer-login');

        Route::get('/customer-signup', [CustomerAuthController::class, 'customerSignup']);
        Route::post('/customer-signup', [CustomerAuthController::class, 'customerSignupStore'])->name('customer-signup');
    });


Route::middleware(['auth:customer'])
    ->group(function () {
        Route::get('/customer-logout', [CustomerAuthController::class, 'authLogout'])->name('customer-logout');
    });


Route::middleware(['auth:customer'])->prefix('customer-portal')
    ->name('customer-portal.')
    ->group(function () {
        Route::get('/home', [CustomerHomeController::class, 'index'])->name('home');
    });

Route::get('/payment', [CustomerPaymentController::class, 'payment'])->name('payment');
Route::get('/paystack-success', [CustomerPaystackController::class, 'success'])->name('paystack-success');

Route::post('/sslcommerz-success', [SSLCommerzController::class, 'success'])->name('sslcommerz-success');
Route::post('/sslcommerz-failed', [SSLCommerzController::class, 'failed'])->name('sslcommerz-failed');
Route::post('/sslcommerz-cancel', [SSLCommerzController::class, 'cancel'])->name('sslcommerz-cancel');
