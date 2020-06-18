<?php
Auth::routes();

Route::get('/', 'TestController@welcome')->name('inicio');
// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/search', 'SearchController@show');
Route::get('/products/json', 'SearchController@data');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show');
Route::get('/categories/{category}', 'CategoryController@show');

Route::post('/cart', 'CartDetailController@store');
Route::delete('/cart', 'CartDetailController@destroy');

Route::post('/order', 'CartController@update');


Route::group([
	'prefix' => 'admin',
	'namespace' => 'Admin',
	'middleware' => 'auth'],
function (){
Route::get('/products', 'ProductController@index'); //listado
Route::get('/products/create', 'ProductController@create'); //crear
Route::post('/products', 'ProductController@store'); //registrar
Route::get('/products/{id}/edit', 'ProductController@edit'); //EDITAR
Route::post('/products/{id}/edit', 'ProductController@update'); //actualizar
Route::delete('/products/{id}', 'ProductController@destroy');

Route::get('/products/{id}/images', 'ImageController@index');
Route::post('/products/{id}/images', 'ImageController@store');
Route::delete('/products/{id}/images', 'ImageController@destroy');
Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); //destacar imagen

Route::get('/categories', 'CategoryController@index'); //listado
Route::get('/categories/create', 'CategoryController@create'); //crear
Route::post('/categories', 'CategoryController@store'); //registrar
Route::get('/categories/{category}/edit', 'CategoryController@edit'); //EDITAR
Route::post('/categories/{category}/edit', 'CategoryController@update'); //actualizar
Route::delete('/categories/{category}', 'CategoryController@destroy');
});
