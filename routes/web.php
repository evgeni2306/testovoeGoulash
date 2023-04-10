<?php

use App\Http\Controllers\Auth\RegistrationController;
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

Route::get('/', function () {
    return redirect(\route('login'));
});
Route::middleware('guest')->group(function () {

    Route::get('registration', [RegistrationController::class, 'index']);
    Route::post('registration', [RegistrationController::class, 'store'])->name('registration');


});
Route::get('/logout', function () {

    \Illuminate\Support\Facades\Auth::guard('web')->logout();
    return redirect(route('registration'));
})->name('logout');
