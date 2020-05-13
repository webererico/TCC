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

Route::get('/', function () {
    return view('welcome');
});


//EXIBE
Route::get('/home/{ambiente?}/{size?}', 'HomeController@index')->name('home');
Route::get('/edit/ambiente/{id}', 'ControllerAmbientes@editAmbiente')->name('sala1');
Route::get('/edit/ambiente/{id}', 'ControllerAmbientes@editAmbiente')->name('sala2');
Route::get('/edit/ambiente/{id}', 'ControllerAmbientes@editAmbiente')->name('lab');
Route::get('/edit/ambiente/{id}', 'ControllerAmbientes@editAmbiente')->name('exterior');
Route::get('/nensaio','ControllerAmbientes@novoEnsaio')->name('novoEnsaio');
Route::get('/caensaio', 'ControllerAmbientes@listaensaios')->name('consultaensaio');
Route::get('/ensaio/download/{id}', 'ControllerAmbientes@downloadEnsaio')->name('downloadensaio');
Route::get('/ensaioPDF/download/{id}', 'ControllerAmbientes@downloadEnsaioPDF')->name('downloadensaioPDF');
Route::get('/perfil', 'HomeController@exibePerfil')->name('exibePerfil');
Route::get('/config/ambiente/{id}', 'ControllerAmbientes@configAmbiente')->name('configuracao.ambiente');
Route::get('/config/ambiente/{id}', 'ControllerAmbientes@configAmbiente')->name('configuracao.ambiente');
Route::get('/config/ambiente/{id}', 'ControllerAmbientes@configAmbiente')->name('configuracao.ambiente');
Route::get('/config/ambiente/{id}', 'ControllerAmbientes@configAmbiente')->name('configuracao.ambiente');


Route::get('/desligar/{$id}', 'ControllerAmbientes@desligaArManual')->name('desligaArManual');

//SALVA
Route::post('/salvar/{id}', 'ControllerAmbientes@save')->name('salvar');
Route::post('/criaensaio', 'ControllerAmbientes@createEnsaio')->name('criaensaio');
Route::post('/autoensaio', 'ControllerAmbientes@createEnsaioAuto')-> name('autoensaio');
Route::post('/perfil', 'HomeController@atualizaPerfil')->name('atulizaPerfil');
Route::post('/salvar/config/{id}', 'ControllerAmbientes@salvaConfig')->name('salvarConfig');
Route::post('/controle/{id}', 'ControllerAmbientes@controleManual')->name('ControleManual');

//APAGAR
Route::get('/ensaio/apagar/{id}', 'ControllerAmbientes@apagarEnsaio')->name('apagarEnsaio');
Route::get('/apagar/{id}', 'ControllerAmbientes@limpaBanco')->name('limpaBanco');
Route::get('/apagar/{id}', 'ControllerAmbientes@deleteUser')->name('deleteUser');

//DOWNLOAD
route::get('/resgatar/{id}', 'ControllerAmbientes@download')->name('download');


//EDITAR
route::get('/alterar/controle', 'ControllerAmbientes@alteraLab')->name('mudaControle');

Auth::routes();