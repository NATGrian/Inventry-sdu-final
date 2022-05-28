<?php

Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('register', 'AuthController@register');


//! ----------------- API USERS ---------------
Route::resource('users', 'Admins\UsersController');
Route::get('getusers', 'Admins\UsersController@getusers');
Route::get('roles', 'Admins\UsersController@getrole');
Route::post('addroles', 'Admins\UsersController@addrole');
Route::delete('roles/{id}', 'Admins\UsersController@rolesdestroy');
//! ----------------------------------------------------


//! ----------------- API MEMBER ---------------
Route::resource('relevants', 'Admins\RelevantController');
Route::get('getrelevants', 'Admins\RelevantController@getrelevants');
Route::get('groups', 'Admins\RelevantController@getgroups');
Route::post('addgroups', 'Admins\RelevantController@addgroups');
Route::delete('groups/{id}', 'Admins\RelevantController@groupsdestroy');
//! ----------------------------------------------------


//! ----------------- API STORAGES ---------------
Route::resource('storages', 'Admins\StoragesController');
//! ----------------------------------------------------


//! ----------------- API ingredients ---------------
Route::resource('ingredients', 'Admins\IngredientsController');

Route::get('category', 'Admins\IngredientsController@getcategory');
Route::get('getingredients', 'Admins\IngredientsController@getingredients');
Route::get('recordingredients', 'Admins\IngredientsController@getrecord');
Route::get('getexport', 'Admins\IngredientsController@getexport');
Route::get('Labellingingredients', 'Admins\IngredientsController@getLabelling');
Route::get('import/{id}', 'Admins\IngredientsController@getimport');
Route::get('export/search/{id}', 'Admins\IngredientsController@getsearch');
Route::get('Labelling/search/{id}', 'Admins\IngredientsController@getsearchLabelling');
Route::get('reports/getingredients', 'Admins\IngredientsController@getreportsIngredients');

Route::post('category', 'Admins\IngredientsController@addcategory');
Route::post('ingredients/import', 'Admins\IngredientsController@import_Ingredients');
Route::post('ingredients/export', 'Admins\IngredientsController@export_Ingredients');
Route::post('reports/ingredients', 'Admins\IngredientsController@reportsIngredients');

Route::delete('category/{id}', 'Admins\IngredientsController@categorydestroy');
Route::delete('importdeleting', 'Admins\IngredientsController@importdestroy');
Route::delete('exportdeleting', 'Admins\IngredientsController@exportdestroy');
//! ----------------------------------------------------


//! ----------------- API packagings ---------------
Route::resource('packagings', 'Admins\PackagingsController');
Route::get('getpackagings', 'Admins\PackagingsController@getpackagings');
Route::get('category-pp', 'Admins\PackagingsController@getcategory');
Route::get('getexport-pp', 'Admins\PackagingsController@getexport');
Route::get('recordpackagings', 'Admins\PackagingsController@getrecord');
Route::get('Labellingpackagings', 'Admins\PackagingsController@getLabelling');
Route::get('import-pp/{id}', 'Admins\PackagingsController@getimport');
Route::get('export-pp/search/{id}', 'Admins\PackagingsController@getsearch');
Route::get('Labelling-pp/search/{id}', 'Admins\PackagingsController@getsearchLabelling');
Route::get('reports/getpackagings', 'Admins\PackagingsController@getreportsPackagings');

Route::post('category-pp', 'Admins\PackagingsController@addcategory');
Route::post('reports/packagings', 'Admins\PackagingsController@reportsPackagings');
Route::post('packagings/import', 'Admins\PackagingsController@import_Packagings');
Route::post('packagings/export', 'Admins\PackagingsController@export_Packagings');

Route::delete('category-pp/{id}', 'Admins\PackagingsController@categorydestroy');
Route::delete('importdeleting-pp', 'Admins\PackagingsController@importdestroy');
Route::delete('exportdeleting-pp', 'Admins\PackagingsController@exportdestroy');
//! ----------------------------------------------------


//! ----------------- API products ---------------
Route::resource('products', 'Admins\ProductsController');

Route::get('getproducts', 'Admins\ProductsController@getproducts');
Route::get('category-p', 'Admins\ProductsController@getcategory');
Route::get('recordproduct', 'Admins\ProductsController@getrecord');
Route::get('import-p/{id}', 'Admins\ProductsController@getimport');
Route::get('getexport-p', 'Admins\ProductsController@getexport');
Route::get('export-p/search/{id}', 'Admins\ProductsController@getsearch');
Route::get('reports/getproduct', 'Admins\ProductsController@getreportsProducts');

Route::post('category-p', 'Admins\ProductsController@addcategory');
Route::post('product/import', 'Admins\ProductsController@import_product');
Route::post('product/export', 'Admins\ProductsController@export_product');
Route::post('reports/product', 'Admins\ProductsController@reportsproduct');

Route::delete('exportdeleting-p', 'Admins\ProductsController@exportdestroy');
Route::delete('category-p/{id}', 'Admins\ProductsController@categorydestroy');
Route::delete('importdeleting-p/', 'Admins\ProductsController@importdestroy');
//! ----------------------------------------------------