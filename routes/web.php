<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\GroupChatController;
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

Route::get('/chat', [ChatController::class, 'index'])->name('chat');
Route::post('/chat', [ChatController::class, 'store']);
Route::get('/chat/{id}', [ChatController::class, 'getUserMessage']);
Route::get('/user', [ChatController::class, 'user']);
Route::get('/search', [ChatController::class, 'search']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile-user', [ProfileController::class, 'user']);
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile-image', [ProfileController::class, 'imageProfile'])->name('profile.image');

Route::get('/group', [GroupChatController::class, 'index'])->name('group');
Route::post('/group', [GroupChatController::class, 'store'])->name('group.store');
Route::get('/group/create', [GroupChatController::class, 'create'])->name('group.create');
Route::get('/group-list', [GroupChatController::class, 'group'])->name('group.list');
Route::post('/group-send', [GroupChatController::class, 'send'])->name('group.send');
Route::get('/group/{id}', [GroupChatController::class, 'getGroupMessage'])->name('group.chat');
});






Auth::routes();

