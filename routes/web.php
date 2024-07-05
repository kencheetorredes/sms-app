<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ContactGroupController;

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
    return view('layout');
});

Route::name('message.')->prefix('/message')->group(function(){
    Route::get('/inbox',[SmsController::class,'index'])->name('index');
    Route::get('/compose',[SmsController::class,'create'])->name('compose');
});

Route::name('sms_template.')->prefix('/sms-template')->group(function(){
    Route::get('/',[TemplateController::class,'index'])->name('index');
    Route::get('/form/{id?}',[TemplateController::class,'create'])->name('create');
});

Route::name('contacts.')->prefix('/contacts')->group(function(){
    Route::get('/',[ContactController::class,'index'])->name('index');
    Route::get('/form/{id?}',[ContactController::class,'create'])->name('create');
});

Route::name('contact_group.')->prefix('/contact-groups')->group(function(){
    Route::get('/',[ContactGroupController::class,'index'])->name('index');
    Route::get('/form/{id?}',[ContactGroupController::class,'create'])->name('create');
});