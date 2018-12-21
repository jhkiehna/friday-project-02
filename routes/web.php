<?php

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

Route::prefix('{userId}')->group(function() {
    Route::get('/', 'JournalController@index')->name('journal.index');
    
    Route::get('/{journalId}', 'JournalController@show')->name('journal.show');
    Route::update('/{journalId}', 'JournalController@updateWebhook')->name('journal.update');
});
