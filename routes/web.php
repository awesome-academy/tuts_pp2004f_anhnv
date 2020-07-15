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

    Route::match(['PUT', 'PATCH'], 'posts/{post}/unpublish', 'PostController@unpublish')->name('posts.unpublish');
    Route::resource('posts', 'PostController')->except(['edit', 'update', 'destroy']);

    Route::get('drafts/trashed', 'DraftController@trashedIndex')->name('drafts.trashed');
    Route::get('drafts/{draft}/trash', 'DraftController@trash')->name('drafts.trash');
    Route::match(['PUT', 'PATCH'], 'drafts/{draft}/trashed-update', 'DraftController@trashedUpdate')->name('drafts.trashed_update');
    Route::match(['PUT', 'PATCH'], 'drafts/{draft}/publish', 'DraftController@publish')->name('drafts.publish');
    Route::resource('drafts', 'DraftController')->except(['create', 'store', 'destroy']);
});