<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoicController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\InvoicePDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::middleware(['localization'])->group(function () {
    Route::post('login',[AuthController::class, 'login'])->name('login');
    Route::post('signup',[AuthController::class, 'signup'])->name('signup');
    
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout',[AuthController::class, 'logout']);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('providers', ProviderController::class);
        Route::apiResource('products', ProductController::class);
        Route::apiResource('shops', ShopController::class);
        Route::post('shops/info/{id}',[ShopController::class,'update']);
        Route::apiResource('invoices', InvoicController::class);
        Route::put("saveinvoice/{id}",[InvoicController::class,'save']);
         Route::apiResource('invoicesdetails', InvoiceDetailsController::class);
        Route::apiResource('users', UserController::class)->except(["store","destroy"]);
        //Route::get('/invoicepdf/{id}', [ReportController::class,"generate_invoice"]);

        //Route::get('/invoicepdf', [ReportController::class,"generate_invoice"]);
       
    }
    );
});
Route::get('/invoicepdf/{id}', [ReportController::class,"generate_invoice"]);
Route::get('/invoicepdf', [ReportController::class,"generate_pdf"]);
Route::apiResource('invoicesdetails', InvoiceDetailsController::class);
