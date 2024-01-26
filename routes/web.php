<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
});

Route::group(['middleware' => 'auth'], function () {

Route::get('/chat', [ChatController::class, 'index']);
Route::post('/chat', [ChatController::class, 'store']);
Route::get('/chat/{id}', [ChatController::class, 'getUserMessage']);
Route::get('/user', [ChatController::class, 'user']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile-user', [ProfileController::class, 'user']);
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

});






Auth::routes();

