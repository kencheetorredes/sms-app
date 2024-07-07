<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\CSVTemplateController;
use App\Http\Controllers\Setting\CountryCodeController;

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
    Route::get('/lists',[TemplateController::class,'lists'])->name('lists');
    Route::get('/form/{id?}',[TemplateController::class,'create'])->name('create');
    Route::post('/store',[TemplateController::class, 'store'])->name('store');
    Route::post('/update',[TemplateController::class, 'update'])->name('update');
});

Route::name('contacts.')->prefix('/contacts')->group(function(){
    Route::get('/',[ContactController::class,'index'])->name('index');
    Route::get('/lists',[ContactController::class,'lists'])->name('lists');
    Route::get('/form/{id?}',[ContactController::class,'create'])->name('create');
    Route::post('/store',[ContactController::class, 'store'])->name('store');
    Route::post('/update',[ContactController::class, 'update'])->name('update');
});

Route::name('group.')->prefix('/groups')->group(function(){
    Route::get('/',[GroupController::class,'index'])->name('index');
    Route::get('/lists',[GroupController::class,'lists'])->name('lists');
    Route::get('/form/{id?}',[GroupController::class,'create'])->name('create');
    Route::get('/view/{id?}',[GroupController::class,'show'])->name('view');
    Route::post('/store',[GroupController::class, 'store'])->name('store');
    Route::post('/update',[GroupController::class, 'update'])->name('update');
    Route::get('/add-member/{id}',[GroupController::class,'addMember'])->name('addMember');
    Route::get('/import/{id}',[GroupController::class,'import'])->name('import');
    Route::post('/member-process',[GroupController::class, 'memberProcess'])->name('memberProcess');
});

Route::name('setting.')->prefix('/setting')->group(function(){
    
    Route::get('/',function(){
        return view('setting.landing.index');
    })->name('index');
    Route::get('/csv-template/{module}',[CSVTemplateController::class,'index'])->name('csv-template');
    

    Route::name('country_code.')->prefix('/country_code')->group(function(){
        Route::get('/',[CountryCodeController::class,'index'])->name('index');
        Route::get('/lists',[CountryCodeController::class,'lists'])->name('lists');
        Route::get('/form/{id?}',[CountryCodeController::class,'create'])->name('create');
        Route::post('/store',[CountryCodeController::class, 'store'])->name('store');
        Route::post('/update',[CountryCodeController::class, 'update'])->name('update');
    });



});