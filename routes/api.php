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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['namespace'  => 'API'], function() {
    Route::group(['prefix'  => 'beers'], function() {
        Route::get('/random','BeerAPIController@getRandomBeer')->name('api.beers.random');
        // Route::get('/random','BeerAPIController@randomBeer');
    });
    Route::group(['prefix'  => 'brewery'], function() {
        Route::get('/{ids}/beers','BreweryAPIController@getBreweriesBeers')->name('api.breweries.beers');
    });
    Route::group(['prefix'  => 'brewerydbSearch'], function() {
        Route::get('/{q}/{type}','SearchApiController@search')->name('api.brewerydb.search');
    });
});
