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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [
	'uses' => 'Auth\LoginController@Login',
	'name' => 'api.post.login',
	'data.model' => 'CredentialsModel',
	'data.validator' => 'CredentialsValidator'
]);


Route::get('/listings', [
	'uses' => 'ListingsController@index',
	'name' => 'listings.index'
]);

Route::get('/listings/all', [
	'uses' => 'ListingsController@all',
	'name' => 'listings.index'
]);

Route::get('/listings/{id}', [
	'uses' => 'ListingsController@show',
	'name' => 'listings.show'
]);

Route::post('/listings', [
	'uses' => 'ListingsController@create',
	'name' => 'listings.create'
]);

Route::put('/update/{id}', [
	'uses' => 'ListingsController@update',
	'name' => 'listings.update'
]);

Route::delete('/delete/{id}', [
	'uses' => 'ListingsController@delete',
	'name' => 'listings.delete'
]);


Route::get('/listings{listingId}/images', [
	'uses' => 'ListingsImagesController@index',
	'name' => 'listings.images.index'
]);

Route::get('/listings/{listingId}/images/{id}', [
	'uses' => 'ListingsImagesController@show',
	'name' => 'listings.images.show'
]);

Route::post('/listings/{listingId}/images', [
	'uses' => 'ListingsImagesController@create',
	'name' => 'listings.images.create'
]);

Route::put('/update/{listingId}/images/{id}', [
	'uses' => 'ListingsImagesController@update',
	'name' => 'listings.images.update'
]);

Route::delete('/delete/{listingId}/images/{id}', [
	'uses' => 'ListingsImagesController@delete',
	'name' => 'listings.images.delete'
]);