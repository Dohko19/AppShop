<?php

Route::post('messages', 'TestController@contact');

Route::get('categoriesList', 'TestController@categoriesShow');

Route::get('category/{category}', 'CategoryController@show');

Route::get('/products/{id}', 'ProductController@show');

