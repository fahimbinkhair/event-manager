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
use Illuminate\Support\Facades\Route;
use App\Http\Constants;

//home page
Route::get('/', 'IndexController@sayWelcome')->name('home-page');

//event
Route::get('/event/add', 'EventController@displayAddEventForm')->name('display-form-to-add-event');
Route::post('/event/add-save', 'EventController@addNewEvent')->name('save-new-event');

Route::get('/event/edit/{id}', 'EventController@displayEditEventForm')
    ->where(['id' => '[0-9]+'])
    ->name('display-form-to-edit-event');

Route::post('/event/edit-save', 'EventController@updateEvent')->name('update-an-event');

Route::get('/event/view/{status}', 'EventController@viewEvents')
    ->where(['status' => '('.Constants::STATUS_ACTIVE.'|'.Constants::STATUS_ARCHIVED.')'])
    ->name('view-events');

Route::get('/event/status/{id}/{status}', 'EventController@changeEventStatus')
    ->where([
        'id' => '[0-9]+',
        'status' => '('.Constants::STATUS_DELETED.'|'.Constants::STATUS_ARCHIVED.')',
    ])
    ->name('change-event-status');