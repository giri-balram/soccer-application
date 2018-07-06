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

/*Frontend Routes*/

//home page route
Route::get('/', 'FrontendController@index')->name('home');

//login page route
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

//display all players for a particular team
Route::get('/team/{id}/players', 'FrontendController@showTeamPlayers')->name('showTeamPlayers');


/*AJAX Route*/
//Fronteend ajax controller
Route::post('/load/partial/teamview', 'AjaxController@loadTeamView');
Route::post('/load/partial/teamplayerview', 'AjaxController@loadTeamPlayerView');

//Backend ajax controller
Route::post('/admin/partial/teamview', 'AjaxController@loadAdminTeamView');
Route::post('/admin/partial/playerview', 'AjaxController@loadAdminPlayerView');



/*Backend Routes*/
Route::group(['prefix' => 'admin', 'middleware' => ['auth:web']], function () {
    Route::get('/', 'AdminController@index');
    Route::get('allplayers', 'AdminController@players')->name('allPlayers');
    Route::get('allteams', 'AdminController@teams')->name('allTeams');
    Route::get('/single/team/{id}/player', 'AdminController@teamPlayer')->name('singleTeamPlayers');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
});
