<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BackOffice\DashboardController;
use App\Http\Controllers\BackOffice\UserController;
use App\Http\Controllers\BackOffice\CategoryController;
use App\Http\Controllers\BackOffice\FormController;
use App\Http\Controllers\BackOffice\SubCategoryController;
use App\Http\Controllers\BackOffice\ImportController;
use App\Http\Controllers\SiteController;
use App\Models\Voucher;

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


Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/postSkp', [SiteController::class, 'postSkp'])->name('postSkp');
Route::get('/getData', [SiteController::class, 'getData'])->name('authLogin');
Route::get('/checkToken', [SiteController::class, 'checkToken'])->name('checkToken');
Route::post('/form/submit', [SiteController::class, 'store'])->name('form.submit');
Route::get('/form/success', [SiteController::class, 'success'])->name('form.success');
Route::middleware(['auth',  'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil', [UserController::class, 'profile'])->name('profile');
    Route::post('/profil', [UserController::class, 'updateProfile']);
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('sub_category', SubCategoryController::class);
    Route::resource('form', FormController::class);
    Route::resource('import', ImportController::class);
    Route::get('/calculation', [FormController::class, 'calculation'])->name('calculation');

});
