<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientReport;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesReport;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\InvoiceDetailsController;

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

Route::get('page/{id?}', function ($id) {
    return view("$id");
});
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// Auth::routes(["register"=>false]); #porhibit the regisrtation
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource("section", SectionController::class);
Route::get('/getproduct/{id}', [SectionController::class, 'getproduct']);
Route::resource("products", ProductController::class);
Route::get("invoiceDetails/{id}/{notif?}", [InvoiceDetailsController::class, "index"]);
// Route::get("View_file/{invoices}/{invoice_name}/{name}",[InvoiceDetailsController::class,"View_file"]);
Route::resource("archive", ArchiveController::class);

// permision route
Route::group(['middleware' => ['auth']], function () {

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);
});

Route::resource("invoices", InvoiceController::class);

Route::controller(InvoiceController::class)->group(function () {
    Route::put('/invoice_status/{invoice}', 'status_update');
    Route::post("add_attachment", "add_attachment");
    Route::get("PrintInvoice/{invoice}", "print");
    Route::get('export_invoices', "export");
    Route::get('MarkAllAsRead', "MarkAllAsRead");
});

Route::controller(InvoicesReport::class)->group(function () {
Route::get('invoices_report','index');
Route::post('Search_invoices','get_invoices');
});

Route::controller(ClientReport::class)->group(function () {
    Route::get('client_reports',  "index");
    Route::post('Search_customers', "Search_customers");
});
