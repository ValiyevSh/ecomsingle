<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\HomeController;
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


Route::controller(HomeController::class)->group(function (){
    Route::get('/','index')->name('Home');
});


//user controler finished

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth',])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admindashboard');
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/all-category', 'index')->name('all-category');
        Route::get('/admin/add-category', 'AddCategory')->name('addcategory');
        Route::post('/admin/store-category','storecategory')->name('storecategorys');
        Route::get('/admin/edit-category/{id}','EditCategory')->name('edicategory');
        Route::post('/admin/update-category','UpdateCategory')->name('updatecategory');
        Route::get('/admin/delete-category/{id}','DeleteCategory')->name('deletecategory');

    });

    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/admin/all-subcategory', 'index')->name('allsubcategory');
        Route::get('/admin/add-subcategory', 'AddSubCategory')->name('addsubcategory');
        Route::post('/admin/store-subcategory','StoreSubcategory')->name('storesubcategory');
        Route::get('/admin/edit-subcategory/{id}','EditSubCat')->name('editsubcat');
        Route::get('/admin/delete-subcategory/{id}','DeleteSubCat')->name('deletesubcat');
        Route::post('/admin/update-subcategory','UpdateSubCat')->name('updatesubcat');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/all-products', 'index')->name('allproducts');
        Route::get('/admin/add-product', 'Addproduct')->name('addproduct');
        Route::post('/admin/store-product','StoreProduct')->name('storeproduct');
        Route::get('/admin/edit-product-img/{id}','EditProductImg')->name('editproductimg');
        Route::post('/admin/update-product-img','UpdateProductImg')->name('updateproductimg');
        Route::get('/admin/edit-product/{id}','EditProduct')->name('editproduct');
        Route::post('/admin/update-product','UpdateProduct')->name('updateproduct');
        Route::get('/admin/delete-product/{id}','DeleteProduct')->name('deleteproduct');


    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/pending-order', 'index')->name('pendingorder');
    });
});



require __DIR__ . '/auth.php';
