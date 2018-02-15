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



Route::bind('producto',function ($lug){
return App\Producto::where('slug',$lug)->first();

});
Route::get('/', function () {
    return view('welcome');
});

//Route::resource('/productos','ProductoController');
Route::get('/index','ProductoController@index');
Route::get('producto/{slug}',['as'=>'producto_detalle','uses'=>'ProductoController@show']);

Route::get('cart/show',['as'=>'cart-show','uses'=>'CartController@show']);

Route::get('cart/add/{producto}',['as'=>'cart-add','uses'=>'CartController@add']);

Route::get('cart/delete/{producto}',['as'=>'cart-delete','uses'=>'CartController@delete']);
Route::get('cart/borrar',['as'=>'borrar','uses'=>'CartController@borrar']);

Route::get('cart/up/{producto}',['as'=>'cart-mas','uses'=>'CartController@mas']);
Route::get('cart/down/{producto}',['as'=>'cart-menos','uses'=>'CartController@menos']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
