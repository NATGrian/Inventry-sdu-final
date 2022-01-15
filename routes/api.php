<?php

Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('register', 'AuthController@register');

Route::resource('recipes', 'RecipeController');




Route::resource('users', 'Admins\UsersController');
Route::get('roles', 'Admins\UsersController@getrole');
Route::post('addroles', 'Admins\UsersController@addrole');
Route::delete('roles/{id}', 'Admins\UsersController@rolesdestroy');




Route::resource('peoples', 'Admins\PeopleController');
Route::get('groups', 'Admins\PeopleController@getgroups');
Route::post('addgroups', 'Admins\PeopleController@addgroups');
Route::delete('groups/{id}', 'Admins\PeopleController@groupsdestroy');



Route::resource('storages', 'Admins\StoragesController');


Route::resource('ingredients', 'Admins\IngredientsController');

Route::get('category', 'Admins\IngredientsController@getcategory');
Route::post('category', 'Admins\IngredientsController@addcategory');
Route::delete('category/{id}', 'Admins\IngredientsController@categorydestroy');

Route::get('recordingredients', 'Admins\IngredientsController@getrecord');
Route::get('import/{id}', 'Admins\IngredientsController@getimport');
Route::delete('import/{id}', 'Admins\IngredientsController@importdestroy');
Route::post('ingredients/import', 'Admins\IngredientsController@import_Ingredients');

Route::post('ingredients/export', 'Admins\IngredientsController@export_Ingredients');
Route::get('export/search/{id}', 'Admins\IngredientsController@getsearch');
Route::delete('export/{id}', 'Admins\IngredientsController@exportdestroy');

Route::get('Labelling/search/{id}', 'Admins\IngredientsController@getsearchLabelling');
Route::post('reports/ingredients', 'Admins\IngredientsController@reportsIngredients');



Route::resource('products', 'Admins\ProductsController');

Route::get('category-p', 'Admins\ProductsController@getcategory');
Route::post('category-p', 'Admins\ProductsController@addcategory');
Route::delete('category-p/{id}', 'Admins\ProductsController@categorydestroy');

Route::get('recordproduct', 'Admins\ProductsController@getrecord');
Route::get('import-p/{id}', 'Admins\ProductsController@getimport');
Route::delete('import-p/{id}', 'Admins\ProductsController@importdestroy');
Route::post('product/import', 'Admins\ProductsController@import_product');
Route::get('export-p/search/{id}', 'Admins\ProductsController@getsearch');
Route::post('product/export', 'Admins\ProductsController@export_product');
Route::delete('export/{id}', 'Admins\ProductsController@exportdestroy');
Route::post('reports/product', 'Admins\ProductsController@reportsproduct');