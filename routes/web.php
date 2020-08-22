<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|
*/

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
     
    Route::get('/','Auth\LoginController@showLoginForm')->name('fromLogin');
    Route::post('auth.login', 'Auth\LoginController@login')->name('login');

});


Route::group(['middleware' => ['auth']], function () {

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('version', 'VersionController@index');

  
    Route::group(['middleware' => ['Compras']], function () {
         
        Route::resource('categoria', 'CategoriaController');
        Route::resource('producto', 'ProductoController');
        Route::get('/listarProductoPdf', 'ProductoController@listarPdf')->name('productos_pdf');
        Route::resource('proveedor', 'ProveedorController');
        Route::resource('compra', 'CompraController'); 
        Route::get('/pdfCompra/{id}', 'CompraController@pdf')->name('compra_pdf');
    
    });

    Route::group(['middleware' => ['Ventas']], function () {

         Route::resource('cliente', 'ClienteController');
         Route::resource('venta', 'VentaController');
         Route::get('/pdfVenta/{id}', 'VentaController@pdf')->name('venta_pdf');
         Route::post('ajax-consultas','AjaxController@index');
    });

    Route::group(['middleware' => ['Administrador']], function () {
      
      Route::get('/home', 'HomeController@index');   
      Route::resource('user', 'UserController');
      
      Route::resource('faltante','FaltanteController');
      Route::get('/listarFaltantesPdf', 'FaltanteController@listarPdf')->name('faltantes_pdf');
      
      // Route::resource('rol', 'RolController');
      Route::resource('receta','RecetaController');
      Route::resource('negocio','NegocioController');
      
    });


});

