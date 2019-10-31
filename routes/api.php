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
	'uses' => 'Api\ListingsController@get',
	'name' => 'api.listings.get'
]);

Route::get('/listings/all', [
	'uses' => 'Api\ListingsController@all',
	'name' => 'api.listings.all'
]);

Route::get('/listings/{id}', [
	'uses' => 'Api\ListingsController@getSingle',
	'name' => 'api.listings.show'
]);

Route::post('/listings', [
	'uses' => 'Api\ListingsController@create',
	'name' => 'api.listings.create',
	'data.model' => 'ListingModel',
	'data.validator' => 'ListingValidator'
]);

Route::put('/listings/{id}', [
	'uses' => 'Api\ListingsController@update',
	'name' => 'api.listings.update',
	'data.model' => 'ListingModel',
	'data.validator' => 'ListingValidator'
]);

Route::delete('/delete/{id}', [
	'uses' => 'Api\ListingsController@delete',
	'name' => 'api.listings.delete'
]);


Route::get('/listings{listingId}/images', [
	'uses' => 'Api\ListingsImagesController@index',
	'name' => 'api.listings.images.get'
]);

Route::get('/listings/{listingId}/images/{id}', [
	'uses' => 'Api\ListingsImagesController@show',
	'name' => 'api.listings.images.show'
]);

Route::post('/listings/{listingId}/images', [
	'uses' => 'Api\ListingsImagesController@create',
	'name' => 'api.listings.images.create'
]);

Route::put('/update/{listingId}/images/{id}', [
	'uses' => 'Api\ListingsImagesController@update',
	'name' => 'api.listings.images.update'
]);

Route::delete('/delete/{listingId}/images/{id}', [
	'uses' => 'Api\ListingsImagesController@delete',
	'name' => 'api.listings.images.delete'
]);