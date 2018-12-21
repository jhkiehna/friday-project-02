<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('journal-entries')->group(function() {
    Route::get('/for-user/{userId}', 'JournalEntryController@index')->name('journal.index');
    
    Route::get('/{journalId}', 'JournalEntryController@show')->name('journal.show');
    Route::post('/', 'JournalEntryController@updateWebhook')->name('journal.update');
});
