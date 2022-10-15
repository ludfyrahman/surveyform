<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BackOffice\DashboardController;
use App\Http\Controllers\BackOffice\UserController;
use App\Http\Controllers\BackOffice\EmployeController;
use App\Http\Controllers\BackOffice\CustomerController;
use App\Http\Controllers\BackOffice\SupplierController;
use App\Http\Controllers\BackOffice\ProductController;
use App\Http\Controllers\BackOffice\ServiceController;
use App\Http\Controllers\BackOffice\UnitController;
use App\Http\Controllers\BackOffice\TypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dasboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('user', UserController::class);
Route::resource('employe', EmployeController::class);
Route::resource('product', ProductController::class);
Route::resource('service', ServiceController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('unit', UnitController::class);
Route::resource('customer', CustomerController::class);
Route::resource('type', TypeController::class);
Route::resource('profile', TypeController::class);
Route::resource('unint', UnitController::class);
