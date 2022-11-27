<?php

use Illuminate\Support\Facades\Route;

Route::get('categories/hierarchy', 'CategoriesController@categoriesHierarchy');
Route::post('categories/update-tree', 'CategoriesController@updateCategoriesHierarchy');
Route::post('categories/bulk-action', 'CategoriesController@bulkAction');
Route::post('attributes/bulk-action', 'AttributesController@bulkAction');
Route::resource('categories', 'CategoriesController', ['except' => ['show']]);
Route::resource('attributes', 'AttributesController', ['except' => ['show']]);

Route::get('categories/attributes/{product_id?}', 'AttributesController@getCategoryAttributes');
