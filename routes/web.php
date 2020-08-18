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
Route::get('/FinalizarCompra', 'GalleryController@FinalizarCompra')->name('FinalizarCompra');

Route::post('/camisas/insertar', 'GalleryController@InsertarProducto')->name('InsertarProducto');
Route::post('/camisas/eliminar', 'GalleryController@EliminarProducto')->name('EliminarProducto');
Route::post('/camisas/actualizar', 'GalleryController@UpdateProducto')->name('UpdateProducto');

Route::post('/Registro/Update', 'GalleryController@UpdateRegistro')->name('UpdateRegistro');
Route::post('/Registro/Terminar', 'GalleryController@TerminarRegistro')->name('TerminarRegistro');
