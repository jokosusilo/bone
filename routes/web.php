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

Auth::routes([
	'register' => false,
	'reset' => false,
	'verify' => false
]);

Route::group([
	'prefix' => 'cp',
	'namespace' => 'Cp',
	'middleware' => 'auth',
	'as' => 'cp.'
], function () {
	Route::get('/', 'DashboardController@index')->name('dashboard');
	Route::resource('posts', 'PostController');
	Route::resource('contacts', 'ContactController')->only([
		'index', 'show', 'destroy'
	]);
	Route::resource('sliders', 'SliderController');
	Route::post('/move-slider', 'MoveSliderController@update')->name('move-slider');
	Route::resource('social-media', 'SocialMediaController');
	Route::group(['prefix' => 'backups'], function(){
		Route::get('/', 'BackupController@index')->name('backups.index');
		Route::get('/create', 'BackupController@create')->name('backups.create');
		Route::get('/download', 'BackupController@download')->name('backups.download');
		Route::post('/delete', 'BackupController@destroy')->name('backups.destroy');
	});
	Route::group(['prefix' => 'settings'], function(){
		Route::get('', 'SettingController@edit')->name('settings.edit');
		Route::put('', 'SettingController@update')->name('settings.update');
	});
	Route::group(['prefix' => 'profile'], function(){
		Route::get('', 'ProfileController@edit')->name('profile.edit');
		Route::put('', 'ProfileController@update')->name('profile.update');
	});

	Route::post('/upload', 'UploadController@store')->name('upload');
});

Route::model('social_sedium', 'App\SocialMedia');