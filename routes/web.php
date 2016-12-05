<?php

use App\Mail\EventWasCreatedMail;
use App\SalesConnect\Helpers\Commands\EventEmailReminderCommandHelper as EventEmail;
use App\Calendar;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');


Route::group(['middleware' => 'auth'], function(){
	Route::resource('aes', 'AeController');
	Route::resource('managers', 'ManagerController');
	Route::resource('agencies', 'AgencyController');
	Route::resource('clients', 'ClientController');
	Route::resource('projects', 'ProjectController');
	Route::post('projects/{project}/youtube', ['as' => 'projects.youtube', 'uses' => 'ProjectController@youtube']);
	Route::resource('projects.notes', 'NoteController');
	Route::resource('projects.progress', 'ProgressController', ['only' => ['update']]);
	Route::resource('projects.events', 'CalendarController');
	Route::resource('projects.orders', 'OrderController');
	Route::get('projects/{project}/orders/{order}/pdf', ['as' => 'projects.orders.pdf', 'uses' => 'OrderController@pdf']);
	Route::resource('projects.videos', 'YoutubeController');

	// Route::get('/message', ['as' => 'send.message', 'uses' => 'Messages@sendMessage']);
	Route::get('/calendar', ['as' => 'calendar', 'uses' => 'CalendarController@index']);
	Route::get('/calendar/events', ['as' => 'calendar.events', 'uses' => 'CalendarController@composeEventsArray']);

	Route::resource('campaigns', 'CampaignController');
});


