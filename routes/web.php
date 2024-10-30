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

Route::get('/','GoutteController@doWebScraping');
Route::get('/new','GoutteController@newdoWebScraping');
Route::get('/getfirst','GoutteController@getfirst');

Route::get('/data','GoutteController@data');
Route::post('/web-scraping','GoutteController@call_me_crawler');
Route::post('/new-web-scraping','GoutteController@new_call_me_crawler');

Route::get('/share','GoutteController@share');

Route::get('/graph','GoutteController@graph');

Route::get('/uk','GoutteController@uk');
Route::post('/astro','GoutteController@astro');


Route::post('/ast','GoutteController@ast');
Route::get('/ast-input','GoutteController@ast_input');




Route::post('/jay-shree-ram','GoutteController@india');
Route::get('/jayshreeram','GoutteController@india_input');

Route::get('/australia-input','GoutteController@australia_input');
Route::get('/australia-output','GoutteController@australia_output');


