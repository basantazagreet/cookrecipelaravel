<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\RecipesController;
use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\LikesController;
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

Route::post('login','Api\AuthController@login');
Route::post('register','Api\AuthController@register');
Route::get('logout','Api\AuthController@logout');
Route::post('save_user_info','Api\AuthController@saveUserInfo')->middleware('jwtAuth');
Route::get('profileinfo','Api\AuthController@profileInfo')->middleware('jwtAuth');

//Recipes
Route::post('recipes/create','Api\RecipesController@create')->middleware('jwtAuth');
Route::post('recipes/update','Api\RecipesController@update')->middleware('jwtAuth');
Route::post('recipes/delete','Api\RecipesController@delete')->middleware('jwtAuth');
Route::get('recipes','Api\RecipesController@recipes')->middleware('jwtAuth');
Route::get('getrecipe/{key}','Api\RecipesController@showRecipesInAPI');



//comments
Route::post('comments/create','Api\CommentsController@create')->middleware('jwtAuth');
Route::post('comments/delete','Api\CommentsController@delete')->middleware('jwtAuth');
Route::post('comments/update','Api\CommentsController@update')->middleware('jwtAuth');
Route::post('recipes/comments','Api\CommentsController@comments')->middleware('jwtAuth');

//Likes
Route::post('recipes/like','Api\LikesController@like')->middleware('jwtAuth');