<?php

use App\Http\Controllers\GeneralController;
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

Route::resource('invoice', 'InvoiceController');
Route::redirect('/', \route('invoice.index'));
Route::get('lang/{locale}', [GeneralController::class, 'changeLang'])->name('change_lang');
//Auth::routes();

//Route::get('/home', [HomeController::class,'index'])->name('home');
