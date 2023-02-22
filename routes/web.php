<?php

use App\Models\User;
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
    return redirect('home');
});
Route::get('index', function () {
    return redirect('home');
});

Auth::routes();

Route::group([ 'middleware'=>'auth'], function(){

    Route::get('/home', 'App\Http\Controllers\HomeController@index');

    Route::resource('invoices','App\Http\Controllers\InvoicesController');
    Route::get('section/{id}','App\Http\Controllers\InvoicesController@getproducts');
    Route::resource('sections','App\Http\Controllers\SectionsController');
    Route::resource('products','App\Http\Controllers\ProductsController');

});


Route::get('/{page}', 'App\Http\Controllers\AdminController@index');