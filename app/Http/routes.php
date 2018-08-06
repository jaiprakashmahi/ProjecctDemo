<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/add-organization', 'OrganizationController@create')->name('add-organization');
Route::POST('/organization-save', 'OrganizationController@store')->name('organization-save');
Route::POST('/edit-organization-save', 'OrganizationController@update')->name('edit-organization-save');
Route::match(['post','get'],'edit-organization/{id}', 'OrganizationController@edit')->name('edit-organization');
Route::DELETE('/delete-organization/{id}', 'OrganizationController@delete')->name('delete-organization');