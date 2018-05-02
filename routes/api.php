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
Route::group(['prefix'  => 'beers'], function() {
    Route::get('/random','BeerAPIController@randomBeers');
});
Route::group(['prefix'  => 'brewery'], function() {
    Route::get('/beers/{beerId}','BreweryAPIController@getBreweryBeers');
});
