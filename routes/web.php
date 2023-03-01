<?php

use App\Http\Controllers\InvoiceAttachmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
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
    return view('auth.login');
});


Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('invoices/{id}',[InvoiceController::class,'update_status'])->name('update_status');
Route::resource('invoices',InvoiceController::class);
Route::resource('section',SectionController::class);
Route::resource('product',ProductController::class);
Route::get('products/{id}',[InvoiceController::class,'get_product']);
Route::resource('detail',\App\Http\Controllers\InvoiceDetailController::class);
Route::resource('attach',InvoiceAttachmentController::class);
Route::get('download/{invoice_number}/{file_name}', [InvoiceDetailController::class,'get_file']);

Route::get('View_file/{invoice_number}/{file_name}', [InvoiceDetailController::class,'open_file']);

Route::get('Invoices/export/', [InvoiceController::class, 'export'])->name('export');
Route::get('/{page}', [\App\Http\Controllers\AdminController::class,'index']);
