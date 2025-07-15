<?php

use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SliderController;


use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){
    Route::get('/',[DashboardController::class,'index'])->name('admin')->middleware('checkAuth');
    Route::get('/login',[DashboardController::class,'login'])->name('admin.login');
    Route::post('/login',[DashboardController::class,'authenticate'])->name('admin.login');
    Route::get('/logout',[DashboardController::class,'logout'])->name('admin.logout')->middleware('checkAuth');

    //registring admin/users
    Route::get('/register',[DashboardController::class,'register'])->name('admin.register');
    Route::post('/register',[DashboardController::class,'store'])->name('admin.register');


    //handling users from admin pannel
    Route::get("/users/{id?}",[UsersController::class,"index"])->name("admin.users");
    Route::post("/users/{id?}",[UsersController::class,"storeUser"])->name("admin.users");
    Route::post("/users/{id}/delete",[UsersController::class,"deleteUser"])->name("admin.user.delete");

    //edit user from user side
    Route::get("/users/{id}/edit",[UsersController::class,"editUser"])->name("admin.user.edit");
    Route::post("/users/{id}/edit",[UsersController::class,"editUserStore"])->name("admin.user.edit");


    //company maintain url
    Route::get("/company",[CompanyController::class,"index"])->name("admin.company");
    Route::post("/company",[CompanyController::class,"create"])->name("admin.company");

    //slider maintaining url
    Route::get("/sliders/{id?}",[SliderController::class,"index"])->name("admin.slider");
    Route::post("/sliders/{id?}",[SliderController::class,"store"])->name("admin.slider");
    Route::post("/sliders/{id}/delete",[SliderController::class,"destroy"])->name("admin.slider.delete");


    //category url hare
    Route::get("/category/{id?}",[CategoryController::class,"index"])->name("admin.category");
    Route::post("/category/{id?}",[CategoryController::class,"store"])->name("admin.category");

    Route::post("/category/{id}/delete",[CategoryController::class,"destroy"])->name("admin.category.delete");



});