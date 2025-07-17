<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PhotoGalleryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\VideoGalleryController;

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

    //Service Or Product url hare
    Route::get("/product/{id?}",[ProductController::class,"index"])->name("admin.product");
    Route::post("/product/{id?}",[ProductController::class,"store"])->name("admin.product");
    Route::post("/product/{id}/delete",[ProductController::class,"destory"])->name("admin.product.delete");


    //Photo Gallery url hare
    Route::get("/photogallery/{id?}",[PhotoGalleryController::class,"index"])->name("admin.photogallery");
    Route::post("/photogallery/{id?}",[PhotoGalleryController::class,"store"])->name("admin.photogallery");
    Route::post("/photogallery/{id}/delete",[ProductController::class,"destory"])->name("admin.photogallery.delete");

    //Video Gallery url hare
    Route::get("/videogallery/{id?}",[VideoGalleryController::class,"index"])->name("admin.videogallery");
    Route::post("/videogallery/{id?}",[VideoGalleryController::class,"store"])->name("admin.videogallery");
    Route::post("/videogallery/{id}/delete",[VideoGalleryController::class,"destory"])->name("admin.videogallery.delete");

    //team url hare
    Route::get('/teams/{id?}',[TeamController::class,'index'])->name('admin.team');
    Route::post('/teams/{id?}',[TeamController::class,'store'])->name('admin.team');
    Route::post('/teams/{id}/delete',[TeamController::class,'destroy'])->name('admin.team.delete');


    //client url hare
    Route::get('/clients/{id?}',[ClientController::class,'index'])->name('admin.client');
    Route::post('/clients/{id?}',[ClientController::class,'store'])->name('admin.client');
    Route::post('/client/{id}/delete',[ClientController::class,'destroy'])->name('admin.client.delete');

    //about url hare
    Route::get('/about',[AboutController::class,'index'])->name('admin.about');
    Route::post('/about',[AboutController::class,'store'])->name('admin.about');

    //Contact url hare
    Route::get('/contact',[ContactController::class,'index'])->name('admin.message');
    Route::post('/contact/{id}',[ContactController::class,'destroy'])->name('admin.message.delete');

});





// Route::group(['prefix'=> ''], function () {});


