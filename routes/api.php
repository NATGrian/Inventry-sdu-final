<?php

Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('register', 'AuthController@register');

Route::resource('recipes', 'RecipeController');

Route::resource('users', 'Admins\UsersController');

Route::get('roles', 'Admins\UsersController@getrole');
Route::post('addroles', 'Admins\UsersController@addrole');

Route::resource('peoples', 'Admins\PeopleController');

Route::get('groups', 'Admins\PeopleController@getgroups');
Route::post('addgroups', 'Admins\PeopleController@addgroups');

Route::resource('storages', 'Admins\StoragesController');

Route::get('category', 'Admins\IngredientsController@getcategory');
Route::post('category', 'Admins\IngredientsController@addcategory');

Route::get('category-p', 'Admins\ProductsController@getcategory');
Route::post('category-p', 'Admins\ProductsController@addcategory');

Route::resource('ingredients', 'Admins\IngredientsController');
Route::get('recordingredients', 'Admins\IngredientsController@getrecord');
Route::get('import/{id}', 'Admins\IngredientsController@getimport');
Route::post('ingredients/import', 'Admins\IngredientsController@import_Ingredients');
Route::post('ingredients/export', 'Admins\IngredientsController@export_Ingredients');

Route::resource('products', 'Admins\ProductsController');
Route::get('recordproduct', 'Admins\ProductsController@getrecord');
Route::get('import-p/{id}', 'Admins\ProductsController@getimport');
Route::post('product/import', 'Admins\ProductsController@import_product');

Route::get('export/search/{id}', 'Admins\IngredientsController@getsearch');
Route::get('export-p/search/{id}', 'Admins\ProductsController@getsearch');
Route::post('product/export', 'Admins\ProductsController@export_product');