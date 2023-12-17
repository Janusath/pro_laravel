<?php

use App\Http\Controllers\AdminAddEntrepreneurUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\EntrepreneurController;
use App\Http\Controllers\EntrepreneurUserController;




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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::fallback(function()
{
    return view('error_page.error404');

});

Route::get('/',[AdminUserController::class,'login'])->name('admin_login');

// admin routing
Route::get('/admin_dashboard',[AdminController::class,'index'])->name('admin_dashboard');
Route::get('/admin_login',[AdminUserController::class,'login'])->name('admin_login');
Route::get('/admin_login_user',[AdminUserController::class,'login_user'])->name('admin_login_user');
Route::get('/admin_register',[AdminUserController::class,'register'])->name('admin_register');
Route::post('/admin_register_user',[AdminUserController::class,'register_user'])->name('admin_register_user');
Route::get('/admin_profile',[AdminUserController::class,'admin_profile'])->name('admin_profile');
Route::get('/admin_logout',[AdminUserController::class,'logout'])->name('admin_logout');
Route::post('/admin_profile_update', [AdminUserController::class, 'admin_profile_update'])->name('admin_profile_update');

Route::get('/entrepreneur_logout',[EntrepreneurUserController::class,'logout'])->name('entrepreneur_logout');

// admin add entrepreneur user routing
Route::get('/admin_add_enterpreneur_user', [AdminAddEntrepreneurUserController::class, 'index'])->name('admin_add_enterpreneur_user');
Route::post('/admin_add_enterpreneur_user_store',[AdminAddEntrepreneurUserController::class,'store'])->name('admin_add_enterpreneur_user_store');
Route::get('/admin_add_enterpreneur_user_show', [AdminAddEntrepreneurUserController::class, 'show'])->name('admin_add_enterpreneur_user_show');

// entrepreneur routing
Route::get('/entrepreneur_dashboard',[EntrepreneurController::class,'index'])->name('entrepreneur_dashboard');
Route::get('/entrepreneur_login',[EntrepreneurUserController::class,'login'])->name('entrepreneur_login');
Route::get('/entrepreneur_login_user',[EntrepreneurUserController::class,'login_user'])->name('entrepreneur_login_user');
Route::get('/entrepreneur_register',[EntrepreneurUserController::class,'register'])->name('entrepreneur_register');
Route::post('/entrepreneur_register_user',[EntrepreneurUserController::class,'register_user'])->name('entrepreneur_register_user');
Route::get('/entrepreneur_profile',[EntrepreneurUserController::class,'entrepreneur_profile'])->name('entrepreneur_profile');
Route::post('/entrepreneur_profile_update', [EntrepreneurUserController::class, 'entrepreneur_profile_update'])->name('entrepreneur_profile_update');

