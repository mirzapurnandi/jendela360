<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;

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
    return view('login');
});

Route::group(
    [
        'middleware' => ['ceklogin'],
        'prefix' => 'admins'
    ],
    function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    }
);

Route::get('/logout', function () {
    Session::flush();
    return redirect('/')->with('message', '<div class="alert alert-success">Anda berhasil logout.</div>');
})->name('logout');
