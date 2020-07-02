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

Route::prefix('admin')->as('admin.')->group(function(){
    Route::get('/', 'AdminController@dashboard');

    Route::get('tickets/trash', 'TicketController@trash')->name('tickets.trash');
    Route::get('tickets/{ticket}/delete', 'TicketController@delete')->name('tickets.delete');
    Route::resource('tickets', 'TicketController');
});
