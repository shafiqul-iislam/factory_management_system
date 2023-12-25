<?php

use App\Models\Designation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPortal\UserController;
use App\Http\Controllers\AdminPortal\HRM\EmployeeController;
use App\Http\Controllers\AdminPortal\HRM\AttendanceController;
use App\Http\Controllers\AdminPortal\HRM\DesignationController;
use App\Http\Controllers\AdminPortal\Department\DepartmentController;
use App\Http\Controllers\AdminPortal\HRM\HolidayController;
use App\Http\Controllers\AdminPortal\HRM\LeaveRequestController;
use App\Http\Controllers\AdminPortal\HRM\PayrollController;
use App\Http\Controllers\AdminPortal\Product\ProductsController;

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
    return view('welcome');
});

// after login
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/home', function () {
        return view('theme.admin_portal.index');
    })->name('home');
});


// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::get('/dashboard', function () {
//         return redirect('/home');
//     })->name('dashboard');
// });

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware(['auth:sanctum'])
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

Route::middleware(['auth:sanctum'])
    ->prefix('departments')
    ->name('departments.')
    ->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('all');
        Route::post('/add', [DepartmentController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit');
        Route::post('/update', [DepartmentController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [DepartmentController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [DepartmentController::class, 'serverSideAllDepartments'])->name('server-side-data');
    });


Route::middleware(['auth:sanctum'])
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


Route::middleware(['auth:sanctum'])
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


Route::middleware(['auth:sanctum'])
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


Route::middleware(['auth:sanctum'])
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

Route::middleware(['auth:sanctum'])
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


Route::middleware(['auth:sanctum'])
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

Route::middleware(['auth:sanctum'])
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




    // ############# need to add balance module ##############
