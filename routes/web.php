<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SaleController;

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

Route::get('/', [AuthController::class, 'index']);

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(
    [
        'middleware' => ['ceklogin'],
        'prefix' => 'admins'
    ],
    function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        //Car
        Route::get('/car', [CarController::class, 'index'])->name('car.index');

        Route::post('/car-edit', [CarController::class, 'edit'])->name('car.edit');

        Route::post('/car', [CarController::class, 'store'])->name('car.store');

        Route::post('/car-destroy', [CarController::class, 'destroy'])->name('car.destroy');

        //Sale
        Route::get('/sale', [SaleController::class, 'index'])->name('sale.index');

        Route::post('/sale-edit', [SaleController::class, 'edit'])->name('sale.edit');

        Route::post('/sale', [SaleController::class, 'store'])->name('sale.store');

        Route::post('/sale-destroy', [SaleController::class, 'destroy'])->name('sale.destroy');
    }
);
