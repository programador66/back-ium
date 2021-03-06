<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('cliente')->group( function(){
    Route::post('/cadastro','UserController@newUser');
    Route::post('/login', 'UserController@login');
    Route::middleware('auth:api')->get('/usuario', 'UserController@getUser');
});

Route::prefix('candidato')->group( function(){
    Route::post('/cadastro','CandidatoController@newCandidato');
    Route::post('/formacao', 'FormacaoEscolarController@newFormacao');
    Route::post('/certificado', 'CertificadoController@newCertificado');
    Route::post('/getCurriculo', 'CandidatoController@getCurriculo');
    Route::post('/experiencia-profissional', 'ExperienciaProfissionalController@newExperienciaProfissional');
});
