<?php
// Route::get('/', 'AuthController@index');
// Route::get('{any}', 'AuthController@index')->where('any', '([A-z\d-\/_.]+)?');

Route::get('/{any}', function () {
    return view('welcome');
})->where(['any' => '.*']);
