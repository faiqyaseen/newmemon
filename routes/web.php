<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\CylinderController;
use App\Http\Controllers\CylinderEmptyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrdersProductsController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::resource('users', UsersController::class);
    Route::resource('customers', CustomersController::class);
    Route::macro('cylinders', function ($uri, $controller) {
        Route::get("{$uri}/modify", ["{$controller}", "modify"])->name("{$uri}.modify");
        Route::post("{$uri}/modify", ["{$controller}", "modification"])->name("{$uri}.modify");
        Route::get("{$uri}/sell", ["{$controller}", "sell"])->name("{$uri}.sell");
        Route::post("{$uri}/sell", ["{$controller}", "sold"])->name("{$uri}.sell");
        Route::get("{$uri}/sold", ["{$controller}", "showSold"])->name("{$uri}.sold");
        // Route::get("{$uri}/empties", ["{$controller}", "empties"])->name("{$uri}.empties");
        // Route::get("{$uri}/get_empties", ["{$controller}", "getEmpties"])->name("{$uri}.get_empties");
        // Route::put("{$uri}/update_empties", ["{$controller}", "updateGetEmpties"])->name("{$uri}.update_empties");
        Route::resource($uri, $controller);
    });
    Route::macro('orders', function ($uri, $controller) {
        Route::put("{$uri}/{order}/confirm", ["{$controller}", "confirm"])->name("{$uri}.confirm");
        Route::get("/order/remainings", ["{$controller}", "remainings"])->name("{$uri}.remainings");
        Route::get("{$uri}/customer_name", ["{$controller}", "getCustomerName"])->name("{$uri}.customer_name");
        Route::post("{$uri}/recieve", ["{$controller}", "recievePaymentsAndEmpties"])->name("{$uri}.recieve");
        Route::resource($uri, $controller);
    });
    Route::cylinders('cylinders', CylinderController::class);
    Route::orders('orders', OrderController::class);
    Route::resource('orders_products', OrdersProductsController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('purchases', PurchaseController::class);
    Route::resource('sales', SaleController::class);
    Route::macro('empties', function ($uri, $controller) {
        Route::get("{$uri}/recieve", ["{$controller}", "recieve"])->name("{$uri}.recieve");
        Route::post("{$uri}/recieved", ["{$controller}", "recieved"])->name("{$uri}.recieved");
        Route::resource($uri, $controller);
    });
    Route::empties('empties', CylinderEmptyController::class);
});
