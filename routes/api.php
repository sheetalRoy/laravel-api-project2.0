<?php

use Illuminate\Http\Request;
use App\Http\Middleware\ApiTokenIsValid;
use App\Http\Middleware\VeevaUserVerify;

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
Route::post('save', 'Api\ResultController@store');
Route::get('show', 'Api\ResultController@getResult');
Route::get('showData/{id}', 'Api\ResultController@result');
Route::put('update/{key}', 'Api\ResultController@updateResult');
Route::delete('delete/{id}', 'Api\ResultController@deleteResult');
/* Informationsmaterial route */
Route::get('getInfos', 'Api\InfoController@getInfos');
Route::get('getInfo/{id}', 'Api\InfoController@getInfo');
Route::post('saveInfo', 'Api\InfoController@saveInfo');
Route::post('updateInfo/{id}', 'Api\InfoController@updateInfo');
Route::get('searchInfo', 'Api\InfoController@searchInfo');
Route::delete('deleteInfo/{id}', 'Api\InfoController@deleteInfo');


Route::group(['middleware' => 'ApiTokenIsValid'], function(){
    /* Strike or Stroke Score route */
    Route::post('saveResult', 'Api\ScoreController@store');
    // Veeva login authentication
    Route::group(['middleware' => 'VeevaUserVerify'], function(){
        Route::get('getResult', 'Api\ScoreController@getResult');
        Route::get('result/{key}', 'Api\ScoreController@result');
        Route::put('updateResult/{key}', 'Api\ScoreController@updateResult');
        Route::delete('deleteResult/{key}', 'Api\ScoreController@deleteResult');
        Route::delete('truncateRecord', 'Api\ScoreController@truncateData');
    });  
    
    Route::post('veevaLogin', 'Api\ScoreController@veevaLogin');
    /* User route */
    Route::post('register', 'Api\UserController@register');
});

//  Route::group(['middleware' => 'checkcustomauth'], function(){
//     Route::post('favinsert', 'FavcontentController@favinsert');
//     Route::post('hcpsa/fav_veevaid', 'FavcontentController@favinsert');
//     Route::get('favget/{key}', 'Api\FavcontentController@favget');
//     Route::post('likeinsert', 'LikecontentController@likeInsert');
//     Route::get('likeget/{key}', 'LikecontentController@likeGet');
//  });

