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

// Route::get('/', function () {
//     return view('auth.login');
// });

//web links
//web links
Route::get('/index', [App\Http\Controllers\WebController::class, 'index'])->name('index');
Route::get('/productlist/{id}', [App\Http\Controllers\WebController::class, 'productlist'])->name('productlist');
Route::get('/productdetails/{id}', [App\Http\Controllers\WebController::class, 'productdetails'])->name('productdetails');
Route::get('/userLogin', [App\Http\Controllers\WebController::class, 'userLogin'])->name('userLogin');
Route::get('/userRegister', [App\Http\Controllers\WebController::class, 'userRegister'])->name('userRegister');
Route::post('/createUser', [App\Http\Controllers\WebController::class, 'createUser'])->name('createUser');
Route::get('/check-auth', [App\Http\Controllers\WebController::class, 'checkauth'])->name('check-auth');
Route::post('/add-to-bag', [App\Http\Controllers\CustomerController::class, 'addtobag'])->name('add-to-bag');
Route::post('/minusToBag', [App\Http\Controllers\CustomerController::class, 'minusToBag'])->name('minusToBag');

Route::post('/ulogin', [App\Http\Controllers\WebController::class, 'ulogin'])->name('ulogin');
Route::post('/add-to-wishlist', [App\Http\Controllers\CustomerController::class, 'addtowishlist'])->name('add-to-wishlist');
Route::get('/cartlist', [App\Http\Controllers\CustomerController::class, 'cartlist'])->name('cartlist');
Route::post('/remove-cart', [App\Http\Controllers\CustomerController::class, 'removecart'])->name('remove-cart');
Route::get('/checkout', [App\Http\Controllers\CustomerController::class, 'checkout'])->name('checkout');
Route::post('/order-now', [App\Http\Controllers\CustomerController::class, 'ordernow'])->name('order-now');
Route::post('/updateAd', [App\Http\Controllers\CustomerController::class, 'updateShippingAddress'])->name('updateAd');
Route::post('/removeAd', [App\Http\Controllers\CustomerController::class, 'removeShippingAddress'])->name('removeAd');
Route::get('/profile', [App\Http\Controllers\CustomerController::class, 'profile'])->name('profile');
Route::post('/addDelivery', [App\Http\Controllers\CustomerController::class, 'addDelivery'])->name('addDelivery');
Route::post('/removewishlist', [App\Http\Controllers\CustomerController::class, 'removewishlist'])->name('removewishlist');
Route::post('/move-to-bag', [App\Http\Controllers\CustomerController::class, 'movetobag'])->name('move-to-bag');
Route::get('/payment-success', [App\Http\Controllers\CustomerController::class, 'paymentsuccess'])->name('payment-success');





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

Route::get('/agent', [App\Http\Controllers\HomeController::class, 'agent'])->name('agent');
Route::get('/agentlist', [App\Http\Controllers\HomeController::class, 'agentlist'])->name('agentlist');
Route::post('/agentcreate', [App\Http\Controllers\HomeController::class, 'agentcreate'])->name('agentcreate');

Route::get('/customer', [App\Http\Controllers\HomeController::class, 'customer'])->name('customer');

Route::get('/size', [App\Http\Controllers\HomeController::class, 'size'])->name('size');

Route::post('/sizeinsert', [App\Http\Controllers\HomeController::class, 'sizeinsert'])->name('sizeinsert');

Route::post('/sizefetch', [App\Http\Controllers\HomeController::class, 'sizefetch'])->name('sizefetch');

Route::post('/sizeedit', [App\Http\Controllers\HomeController::class, 'sizeedit'])->name('sizeedit');
Route::get('/occasions', [App\Http\Controllers\HomeController::class, 'occasions'])->name('occasions');

Route::post('/occasiansinsert', [App\Http\Controllers\HomeController::class, 'occasiansinsert'])->name('occasiansinsert');

Route::post('/occasiansfetch', [App\Http\Controllers\HomeController::class, 'occasiansfetch'])->name('occasiansfetch');

Route::post('/occasiansedit', [App\Http\Controllers\HomeController::class, 'occasiansedit'])->name('occasiansedit');
Route::post('/orderstatusfetch', [App\Http\Controllers\HomeController::class, 'orderstatusfetch'])->name('orderstatusfetch');

Route::post('/orderstatusedit', [App\Http\Controllers\HomeController::class, 'orderstatusedit'])->name('orderstatusedit');

Route::get('/orders', [App\Http\Controllers\HomeController::class, 'orders'])->name('orders');
Route::get('/vieworderitems/{orderId}', [App\Http\Controllers\HomeController::class, 'vieworderitems'])->name('vieworderitems');

Route::get('/subcategory/{catId}/{categoryname}', [App\Http\Controllers\HomeController::class, 'subcategory'])->name('subcategory');

Route::post('/subcategoryinsert', [App\Http\Controllers\HomeController::class, 'subcategoryinsert'])->name('subcategoryinsert');

Route::post('/subcategoryfetch', [App\Http\Controllers\HomeController::class, 'subcategoryfetch'])->name('subcategoryfetch');

Route::post('/subcategoryedit', [App\Http\Controllers\HomeController::class, 'subcategoryedit'])->name('subcategoryedit');
Route::get('/category', [App\Http\Controllers\HomeController::class, 'category'])->name('category');

Route::post('/categoryinsert', [App\Http\Controllers\HomeController::class, 'categoryinsert'])->name('categoryinsert');
Route::post('/categoryfetch', [App\Http\Controllers\HomeController::class, 'categoryfetch'])->name('categoryfetch');

Route::post('/categoryedit', [App\Http\Controllers\HomeController::class, 'categoryedit'])->name('categoryedit');
Route::get('/productcategory', [App\Http\Controllers\HomeController::class, 'productcategory'])->name('productcategory');

Route::get('/product', [App\Http\Controllers\HomeController::class, 'product'])->name('product');

Route::post('/productinsert', [App\Http\Controllers\HomeController::class, 'productinsert'])->name('productinsert');
Route::post('/productfetch', [App\Http\Controllers\HomeController::class, 'productfetch'])->name('productfetch');
Route::post('/fetchproductcategory', [App\Http\Controllers\HomeController::class, 'fetchProductCategory'])->name('fetchproductcategory');

Route::post('/productedit', [App\Http\Controllers\HomeController::class, 'productedit'])->name('productedit');
Route::get('/productlist', [App\Http\Controllers\HomeController::class, 'productlist'])->name('productlist');

Route::post('/fetchsubcategory', [App\Http\Controllers\HomeController::class, 'fetchsubcategory'])->name('fetchsubcategory');
Route::post('/getmarketsubcatlist', [App\Http\Controllers\HomeController::class, 'getmarketsubcatlist'])->name('getmarketsubcatlist');
Route::post('/productcategoryinsert', [App\Http\Controllers\HomeController::class, 'productcategoryinsert'])->name('productcategoryinsert');
Route::post('/productcategoryfetch', [App\Http\Controllers\HomeController::class, 'productcategoryfetch'])->name('productcategoryfetch');

Route::post('/productcategoryupdate', [App\Http\Controllers\HomeController::class, 'productcategoryupdate'])->name('productcategoryupdate');

Route::get('/banner', [App\Http\Controllers\HomeController::class, 'banner'])->name('banner');
Route::post('/bannerinsert', [App\Http\Controllers\HomeController::class, 'bannerinsert'])->name('bannerinsert');

Route::post('/bannerfetch', [App\Http\Controllers\HomeController::class, 'bannerfetch'])->name('bannerfetch');

Route::post('/banneredit', [App\Http\Controllers\HomeController::class, 'banneredit'])->name('banneredit');

Route::get('/subbanner', [App\Http\Controllers\HomeController::class, 'subbanner'])->name('subbanner');
Route::post('/subbannerinsert', [App\Http\Controllers\HomeController::class, 'subbannerinsert'])->name('subbannerinsert');

Route::post('/subbannerfetch', [App\Http\Controllers\HomeController::class, 'subbannerfetch'])->name('subbannerfetch');

Route::post('/subbanneredit', [App\Http\Controllers\HomeController::class, 'subbanneredit'])->name('subbanneredit');

Route::get('/varients/{productId}/{productname}', [App\Http\Controllers\HomeController::class, 'varients'])->name('varients');
Route::post('/variantsfetch', [App\Http\Controllers\HomeController::class, 'variantsrfetch'])->name('variantsfetch');

Route::post('/variantsedit', [App\Http\Controllers\HomeController::class, 'variantsedit'])->name('variantsedit');
