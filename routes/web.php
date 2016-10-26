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

Auth::routes();

Route::get('/home', 'HomeController@index');
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
	// Route::get('cron', function(){
	// 	$event = new EventEmail();
	// 	return $event->emailReminder();
	// });
});


// Route::get('/make', function(){
// 	$user = App\User::create([
// 		'first_name' => 'Alfred',
// 		'last_name' => 'Moore',
// 		'email' => 'ak_moore@live.com',
// 		'slug' => 'alfred-moore',
// 		'work_phone' => '225-288-9870',
// 		'cell_phone' => '225-288-9870',
// 		'password' => bcrypt('password'),
// 		'type' => 'admin'
// 	]);

// 	return $user;
// });