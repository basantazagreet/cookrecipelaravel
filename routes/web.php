<?php
use App\Http\Controllers\Api\RecipesController;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//need to login to add recipe bcz userid is required
Route::view("recipeform","recipeform");
Route::post("addrecipe",[RecipesController::class,'addRecipe']);
