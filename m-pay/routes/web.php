<?php

use App\Http\Controllers\AddPayeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PayeesController;
use App\Http\Controllers\PayrollController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])
        ->name('dashboard');
    Route::get('/add-payee', [PayeesController::class, 'show'])
        ->name('add-payee-form');
    Route::post('/add-payee', [PayeesController::class, 'store'])
        ->name('add-payee');
    Route::get('/update-payee', [PayeesController::class, 'showUpdateForm'])
        ->name('show-update-form');
    Route::post('/update-payee', [PayeesController::class, 'update'])
        ->name('update-payee');
    Route::post('/delete-payee', [PayeesController::class, 'delete'])
        ->name('delete-payee');
    Route::get('/create-payroll', [PayrollController::class, 'show'])
        ->name('create-payroll');
    Route::get('/payees', [PayeesController::class, 'listPayees'])
        ->name('payees');
    Route::get('/payroll', [PayrollController::class, 'showPayroll'])->name('payroll');
    Route::post('/add-to-payroll', [PayrollController::class, 'addToPayroll'])->name('add.to.payroll');
    Route::patch('/update-payroll', [PayrollController::class, 'update'])->name('update.payroll');
    Route::delete('/remove-from-payroll', [PayrollController::class, 'remove'])->name('remove.from.payroll');
    Route::get('/checkout', [PayrollController::class, 'checkout'])->name('checkout.payroll');
});

require __DIR__ . '/auth.php';
