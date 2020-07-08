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

Route::prefix('admin')->as('admin.')->middleware('admin_auth')->group(function(){
    Auth::routes();
    Route::fallback(function(){ 
        if(Auth::check()){
            return response()->view('admin_default.errors.404', [], 404); 
        }
    });
    
    Route::get('/', 'AdminController@dashboard');

    Route::get('tickets/trash', 'TicketController@trash')->name('tickets.trash');
    Route::get('tickets/{ticket}/showTrashed', 'TicketController@showTrashed')->name('tickets.showTrashed');
    Route::get('tickets/{ticket}/editTrashed', 'TicketController@editTrashed')->name('tickets.editTrashed');
    Route::match(['put', 'patch'], 'ticket/{ticket}/updateTrashed', 'TicketController@updateTrashed')->name('tickets.updateTrashed');
    Route::match(['put', 'patch'], 'ticket/{ticket}/restore', 'TicketController@restore')->name('tickets.restore');
    Route::get('tickets/{ticket}/delete', 'TicketController@delete')->name('tickets.delete');
    Route::resource('tickets', 'TicketController');

    Route::resource('comments', 'CommentController')->only(['store']);
});
