<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'GameController@welcome')->name('welcome');
Route::post('/', 'GameController@startGame')->name('startGame');
Route::match(['get', 'post'], '/play', 'GameController@loadGame')->name('loadGame');
Route::post('/guessNumber', 'GameController@guessNumber')->name('guessNumber');

Route::get('/statistics', 'StatisticsController@list')->name('statistics');
