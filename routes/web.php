<?php

use App\Http\Controllers\ScoutingController;
use App\HTTP\Controllers\Search;
use Illuminate\Support\Facades\Route;

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
    return redirect("/home");
});


Route::get('/scouting', 'App\Http\Controllers\ScoutingController@index');

Route::post('/scouting', 'App\Http\Controllers\ScoutingController@store');

Route::get("/home", 'App\Http\Controllers\Home@index');

Route::get("/new_match", "App\Http\Controllers\NewMatch@index");

Route::get("/search", "App\Http\Controllers\Search@index");

Route::get("/search/{team_id}", "App\Http\Controllers\Search@show");

Route::get("/sync", 'App\Http\Controllers\Sync@index');

Route::post("/sync", "App\Http\Controllers\Sync@store");

Route::get("/game_info/{view_id}", "app\Http\Controllers\GameInfo@index");

/*

Route::get('/extra-param/{param}', function($param) {
    return view('extra-param', ['parap' => $param]);
});

*/