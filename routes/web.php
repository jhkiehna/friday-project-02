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

Route::prefix('journal-entries/{userId}')->group(function() {
    Route::get('/', 'JournalEntryController@index')->name('journal.index');
    
    Route::get('/{journalId}', 'JournalEntryController@show')->name('journal.show');
    Route::patch('/{journalId}', 'JournalEntryController@updateWebhook')->name('journal.update');
});
