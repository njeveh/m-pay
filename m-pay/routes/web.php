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
    Route::get('/add-payee', [AddPayeeController::class, 'show'])
        ->name('add-payee-form');
    Route::post('/add-payee', [AddPayeeController::class, 'store'])
        ->name('add-payee');
    Route::get('/payroll', [PayrollController::class, 'show'])
        ->name('payroll');
    Route::get('/payees', [PayeesController::class, 'show'])
        ->name('payees');
});

require __DIR__ . '/auth.php';
