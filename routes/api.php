<?php

use Illuminate\Http\Request;
use App\Http\Resources\Convidado as ConvidadoResource;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('verEventoDecorrerAPI/{id}','EventoController@verEventoDecorrerAPI');
Route::get('verAssentoDecorrerAPI/{id}','EventoController@verAssentoDecorrerAPI');
Route::get('convidados/{id}','EventoController@convidadosAPI');
Route::get('convidadoMudarEstadoAPI/{id}/{chegada}','EventoController@convidadoMudarEstadoAPI');
Route::get('estatisticaConvidadosAPI/{id}','EventoController@estatisticaConvidadosAPI');