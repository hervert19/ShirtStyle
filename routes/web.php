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

Route::get('/', 'GalleryController@index')->name('catalogoCamisas');
Route::get('/camisas/detalles/{id?}', 'GalleryController@detalles')->name('detalleProducto');
Route::get('/MisArticulos', 'GalleryController@MisArticulos')->name('MisArticulos');
Route::get('/Registro', 'GalleryController@Registro')->name('Registro');

Route::post('/camisas/insertar', 'GalleryController@InsertarProducto')->name('InsertarProducto');
Route::post('/camisas/eliminar', 'GalleryController@EliminarProducto')->name('EliminarProducto');
Route::post('/camisas/actualizar', 'GalleryController@UpdateProducto')->name('UpdateProducto');


