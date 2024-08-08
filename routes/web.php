<?php

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

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('/loginadmin', [App\Http\Controllers\WelcomeController::class, 'loginadmin'])->name('loginadmin');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/p/{code}', [App\Http\Controllers\WelcomeController::class, 'productdetail'])->name('productdetail');
Route::get('/c/{code}', [App\Http\Controllers\WelcomeController::class, 'categorydetail'])->name('categorydetail');
Route::post('/p', [App\Http\Controllers\WelcomeController::class, 'searchproduct'])->name('searchproduct');
Route::post('/payments/notif', [App\Http\Controllers\WelcomeController::class, 'receive']);

Route::group(['middleware' => ['auth']], function (){
    Route::get('/profile', [App\Http\Controllers\Customer\ProfileController::class, 'profile'])->name('profile.customer');
    Route::post('/profile-update', [App\Http\Controllers\Customer\ProfileController::class, 'updateprofile'])->name('profile.update');

    Route::post('/addtocart', [App\Http\Controllers\Customer\OrderController::class, 'addtocart'])->name('addtocart');
    Route::post('/deletefromcart', [App\Http\Controllers\Customer\OrderController::class, 'deletefromcart'])->name('deletefromcart');
    Route::post('/makeorder', [App\Http\Controllers\Customer\OrderController::class, 'makeorder'])->name('makeorder');
    Route::post('/payorder', [App\Http\Controllers\Customer\OrderController::class, 'payorder'])->name('payorder');

    
    Route::get('/get-province', [App\Http\Controllers\RajaOngkirController::class, 'get_province']);
    Route::get('/get-city-by-province/{id}', [App\Http\Controllers\RajaOngkirController::class, 'get_city_by_province']);
    Route::post('/get-cost', [App\Http\Controllers\RajaOngkirController::class, 'get_cost']);
});
Route::group(['middleware' => ['role:admin|store']], function (){
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/storeinfo', [App\Http\Controllers\Admin\DashboardController::class, 'storeinfo'])->name('storeinfo');
    Route::post('/storeinfo-update', [App\Http\Controllers\Admin\DashboardController::class, 'storeinfoupdate'])->name('storeinfoupdate');

    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/add-category', [App\Http\Controllers\Admin\CategoryController::class, 'add'])->name('admin.category.add');
    Route::post('/create-category', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.category.create');
    Route::get('/edit-category/{code}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/update-category', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/delete-category/{code}', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('admin.category.delete');

    Route::get('/product', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/add-product', [App\Http\Controllers\Admin\ProductController::class, 'add'])->name('admin.product.add');
    Route::post('/create-product', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.product.create');
    Route::get('/edit-product/{code}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.product.edit');
    Route::post('/update-product', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/delete-product/{code}', [App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('admin.product.delete');

    Route::get('/customer', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('admin.customer.index');
    Route::get('/add-customer', [App\Http\Controllers\Admin\CustomerController::class, 'add'])->name('admin.customer.add');
    Route::post('/create-customer', [App\Http\Controllers\Admin\CustomerController::class, 'create'])->name('admin.customer.create');
    Route::get('/edit-customer/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'edit'])->name('admin.customer.edit');
    Route::post('/update-customer', [App\Http\Controllers\Admin\CustomerController::class, 'update'])->name('admin.customer.update');
    Route::get('/delete-customer/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'delete'])->name('admin.customer.delete');

    Route::get('/store', [App\Http\Controllers\Admin\StoreController::class, 'index'])->name('admin.store.index');
    Route::get('/add-store', [App\Http\Controllers\Admin\StoreController::class, 'add'])->name('admin.store.add');
    Route::post('/create-store', [App\Http\Controllers\Admin\StoreController::class, 'create'])->name('admin.store.create');
    Route::get('/edit-store/{id}', [App\Http\Controllers\Admin\StoreController::class, 'edit'])->name('admin.store.edit');
    Route::post('/update-store', [App\Http\Controllers\Admin\StoreController::class, 'update'])->name('admin.store.update');
    Route::get('/delete-store/{id}', [App\Http\Controllers\Admin\StoreController::class, 'delete'])->name('admin.store.delete');

    Route::get('/cart', [App\Http\Controllers\Admin\CartController::class, 'index'])->name('admin.cart.index');
    Route::get('/cart-reset/{id}', [App\Http\Controllers\Admin\CartController::class, 'reset'])->name('admin.cart.reset');

    Route::get('/order', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.order.index');
    Route::get('/order-detail/{id}', [App\Http\Controllers\Admin\OrderController::class, 'detail'])->name('admin.order.detail');
    Route::get('/order-delete/{id}', [App\Http\Controllers\Admin\OrderController::class, 'delete'])->name('admin.order.delete');
    Route::post('/order-verif', [App\Http\Controllers\Admin\OrderController::class, 'verif'])->name('admin.order.verif');

    Route::get('/payment', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('admin.payment.index');

    Route::get('/shipment', [App\Http\Controllers\Admin\ShipmentController::class, 'index'])->name('admin.shipment.index');
});