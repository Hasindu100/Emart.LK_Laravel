<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\HomeController;
use App\HTTP\Controllers\LoginController;
use App\HTTP\Controllers\SignupController;
use App\HTTP\Controllers\AdminController;
use App\HTTP\Controllers\ProductController;
use App\HTTP\Controllers\CartController;

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
    return view('home');
});
Route::get("/", [HomeController::class,'index']);
Route::get("/login", [LoginController::class,'index'])->name('login');
Route::post("log", [LoginController::class,'login'])->name('log.update');
Route::get("/signup", [SignupController::class,'index'])->name('signup');
Route::post("register", [SignupController::class,'register'])->name('signup.register');
Route::get("logout", [LoginController::class,'logout'])->name('logout');
Route::get("/admin", [AdminController::class,'index'])->name('admin');
Route::post("order_user_item_count", [AdminController::class,'order_user_item_count'])->name('admin.order_user_item_count');
Route::post("show_users", [AdminController::class,'show_users'])->name('admin.show_users');
Route::post("show_orders", [AdminController::class,'show_orders'])->name('admin.show_orders');
Route::post("show_items", [AdminController::class,'show_items'])->name('admin.show_items');
Route::post("add_items", [AdminController::class,'add_items'])->name('admin.add_items');
Route::post("view_order", [AdminController::class,'view_order'])->name('admin.view_order');
Route::post("complete_order", [AdminController::class,'complete_order'])->name('admin.complete_order');
Route::post("view_item", [AdminController::class,'view_item'])->name('admin.view_item');
Route::post("update_item", [AdminController::class,'update_item'])->name('admin.update_item');
Route::post("delete_item", [AdminController::class,'delete_item'])->name('admin.delete_item');

Route::get("/product", [ProductController::class,'index'])->name('product');
Route::get('product-category/{category}',[ProductController::class,'product_category'])->name('product.category');
Route::get('single-page/{id}',[ProductController::class, 'single_page'])->name('product.single-page');
Route::post("get_related_products", [ProductController::class,'get_related_products'])->name('product.related_products');
Route::get('get_search_item/{id}',[ProductController::class, 'get_search_item']);

Route::get("/cart", [CartController::class,'index']);
Route::post("add_to_cart", [CartController::class,'add_to_cart'])->name('cart.add_to_cart');
Route::get("get_cart", [CartController::class,'get_cart'])->name('cart.get_cart');
Route::post("get_data", [CartController::class,'get_data'])->name('cart.get_data');
Route::post("remove_item", [CartController::class,'remove_item'])->name('cart.remove_item');
Route::post("update_cart", [CartController::class,'update_item'])->name('cart.update_item');
Route::post("order_items", [CartController::class,'order_items'])->name('cart.order_items');
Route::post("cart_count", [CartController::class,'cart_count'])->name('cart.cart_count');

