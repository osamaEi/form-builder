<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;

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



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){

Route::get('/admin',[AdminController::class ,'index'])->name('admin.index');

Route::get('/admin/roles',[RoleController::class,'index'])->name('role.index');

Route::post('/admin/roles/create',[RoleController::class,'store'])->name('roles.store');


Route::get('/roles/{role}/edit',[RoleController::class, 'edit'])->name('roles.edit');


});

// routes/web.php
Route::post('/save-form-data', [FormController::class,'saveFormData'])->name('save-selected-inputs');

Route::get('/form-data', [FormController::class,'getFormData'])->name('get-selected-inputs');

Route::post('/storeDynamicFormData', [FormController::class,'storeDynamicFormData'])->name('storeDynamicFormData');


