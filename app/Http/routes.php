<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Route;

Route::put('api/clientes/{id}/updatePreventiva', 'ClientesController@updatePreventiva');

Route::resource('api/clientes', 'ClientesController');

Route::resource('api/chamados', 'ChamadosController');

Route::get('api/abertos', 'ChamadosController@abertos');

Route::get('api/downloadExcel', 'ChamadosController@downloadExcel');
Route::get('api/downloadExcelClientes', 'ImportController@downloadExcelClientes');
Route::get('api/downloadExcelNotas', 'ImportController@downloadExcelNotas');

Route::post('api/importExcelChamados', 'ImportController@importExcelChamados');
Route::post('api/importExcelPreventivas', 'ImportController@importExcelPreventivas');

Route::get('api/fechados', 'ChamadosController@fechados');

Route::resource('api/notas', 'NotasController');

Route::get('api/qtdechamados', 'ChamadosController@qtdeChamados');

Route::get('api/itinerario', 'ChamadosController@itinerario');

Route::get('api/busca', 'BuscaController@search');

Route::get('api/enviar-email', 'EmailController@sendMail');

Route::get('api/statuscliente', 'ChamadosController@statusCliente');

Route::get('/listar-cobrancas', 'CobrancaController@listarCobrancas');
Route::get('/simular-envio', 'CobrancaController@simularEnvio')->name('simular-envio');
Route::get('/enviar-emails', 'CobrancaController@enviarCobrancas')->name('enviar-emails');

Route::get('/{any}', 'VueController@index')->where('any', '.*');
