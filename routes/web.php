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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::name('role.')->group(function(){
   Route::get('roles', 'App\Http\Controllers\RoleController@index')->name('index');
   Route::post('role/store', 'App\Http\Controllers\RoleController@store')->name('store');
   Route::get('role/edit/{id}', 'App\Http\Controllers\RoleController@edit')->name('edit');
	   Route::get('role/show/{id}', 'App\Http\Controllers\RoleController@show')->name('show');
   Route::put('role/update/{id}', 'App\Http\Controllers\RoleController@update')->name('update');
   Route::post('role/destroy/{id}', 'App\Http\Controllers\RoleController@destroy')->name('destroy');
   Route::post('role/update/status', 'App\Http\Controllers\RoleController@status')->name('status');
 });