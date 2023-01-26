<?php

use App\Http\Controllers\BackOffice\AbsensiController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BackOffice\DashboardController;
use App\Http\Controllers\BackOffice\UserController;
use App\Http\Controllers\BackOffice\EmployeController;
use App\Http\Controllers\BackOffice\CustomerController;
use App\Http\Controllers\BackOffice\SupplierController;
use App\Http\Controllers\BackOffice\ProductController;
use App\Http\Controllers\BackOffice\ProfileCompanyController;
use App\Http\Controllers\BackOffice\ServiceController;
use App\Http\Controllers\BackOffice\UnitController;
use App\Http\Controllers\BackOffice\TypeController;
use App\Http\Controllers\BackOffice\SaleController;
use App\Http\Controllers\BackOffice\PurchaseController;
use App\Http\Controllers\BackOffice\SosmedController;
use App\Http\Controllers\BackOffice\VoucherController;
use App\Http\Controllers\BackOffice\StokController;
use App\Http\Controllers\BackOffice\FinanceController;
use App\Http\Controllers\BackOffice\AttendanceController;
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
Route::middleware(['auth',  'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil', [UserController::class, 'profile'])->name('profile');
    Route::post('/profil', [UserController::class, 'updateProfile']);
    Route::resource('user', UserController::class);
    /**
     * sale block
     */
    Route::resource('sale', SaleController::class);
    Route::get('destroyDetail/{id}', [SaleController::class, 'destroyDetail'])->name('destroyDetail');
    Route::post('submitOrder', [SaleController::class, 'submitOrder'])->name('submitOrder');
    /**
     * end sale block
     */

     /**
     * purchase block
     */
    Route::resource('purchase', PurchaseController::class);
    Route::get('destroyDetailPurchase/{id}', [PurchaseController::class, 'destroyDetail'])->name('destroyDetailPurchase');
    Route::post('submitPurchase', [PurchaseController::class, 'submitPurchase'])->name('submitPurchase');
    /**
     * end purchase block
     */
    Route::resource('employe', EmployeController::class);
    Route::resource('product', ProductController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('type', TypeController::class);
    Route::resource('profile', ProfileCompanyController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('voucher', VoucherController::class);
    Route::resource('kehadiran', AbsensiController::class);
    Route::resource('sosmed', SosmedController::class);


    Route::prefix('report')->group(function () {
        Route::resource('stok', StokController::class);
        Route::resource('finance', FinanceController::class);
        Route::resource('attendance', AttendanceController::class);
        Route::get('export-finance', [FinanceController::class, 'cetak_pdf']);
        Route::get('export-stock', [StokController::class, 'cetak_pdf']);
        // Route::get('finance', [FinanceController::class, 'filter']);
    });
});
