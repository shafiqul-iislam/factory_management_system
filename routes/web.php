<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPortal\UserController;
use App\Http\Controllers\AdminPortal\Department\DepartmentController;

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
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.all');
        Route::post('/add', [UserController::class, 'add'])->name('users.add');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::get('/view/{id}', [UserController::class, 'view'])->name('users.view');
        Route::post('/update', [UserController::class, 'update'])->name('users.update');
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
        Route::post('/server-side-users', [UserController::class, 'serverSideAllUsers'])->name('users.server-side-users');
    });

Route::middleware(['auth:sanctum'])
    ->prefix('departments')
    ->name('departments.')
    ->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('all');
        Route::post('/add', [DepartmentController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit');
        Route::get('/view/{id}', [DepartmentController::class, 'view'])->name('view');
        Route::post('/update', [DepartmentController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [DepartmentController::class, 'delete'])->name('delete');
        Route::post('/server-side-data', [DepartmentController::class, 'serverSideAllDepartments'])->name('server-side-data');
    });
