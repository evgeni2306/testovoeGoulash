<?php

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\GenerateContentController;
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
    return redirect(\route('registration'));
});
Route::middleware('guest')->group(function () {
    Route::get('registration', [RegistrationController::class, 'index']);
    Route::post('registration', [RegistrationController::class, 'store'])->name('registration');
});


Route::middleware('auth')->group(function () {
    Route::get('tasks/list', [TasksController::class, 'userList'])->name('userList');
    Route::get('tasks/list/user={idd}', [TasksController::class, 'taskList'])->name('taskList');
});

Route::get('generate', [GenerateContentController::class, 'generate']);

Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::guard('web')->logout();
    return redirect(route('registration'));
})->name('logout');
