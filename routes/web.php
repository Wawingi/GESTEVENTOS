<?php

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function(){
	Route::get('listarUtilizadores', 'UtilizadorController@listarutilizador');
	Route::post('registarutilizador', 'UtilizadorController@registarutilizador');
	Route::post('editarutilizador', 'UtilizadorController@editarutilizador');
	Route::post('alterarSenhaUtilizador', 'UtilizadorController@alterarSenhaUtilizador');
	Route::get('eliminarUtilizador/{id}', 'UtilizadorController@eliminarUtilizador');
});

Route::get('/inserir',function(){
    return view('inserirevento');  
});

Route::get('/pdf',function(){
    return view('pdfevento');
});

Route::middleware(['auth'])->group(function(){
	Route::get('/listar','EventoController@listar');
	Route::post('/inserir','EventoController@inserir');
	Route::get('/editar/{id}','EventoController@editar');
	Route::post('/actualizar/{id}','EventoController@actualizar');
	Route::get('/eliminar/{id}','EventoController@eliminar');
	Route::get('/ver/{id}','EventoController@ver');
	Route::get('/eventoPDF/{id}','EventoController@verPDF');
	Route::get('convitePDF','EventoController@verDigitalConvite');
	Route::get('eventosdecorrer','EventoController@eventosdecorrer');
	Route::get('vereventodecorrer/{id}','EventoController@vereventodecorrer');
});

//Route::resource('evento','EventoController');
Route::get('inserir',function(){
    return view('inserirevento');
})->middleware('auth');

//Rotas para AJAX
Route::get('/listarEvento',function(){
    return view('listarevento');
});
Route::get('pegaEventos','EventoController@pegaEventos');
Route::post('registarEvento','EventoController@registarEvento');
Route::resource('evento','EventoController');
Route::get('pegaEvento/{id}','EventoController@pegaEvento');
Route::post('editarEvento','EventoController@editarEvento');
Route::get('eliminarEvento/{id}','EventoController@eliminar');
Route::get('/ver/{id}','EventoController@ver');

Route::Post('editarEvento','EventoController@editarEvento');
Route::Post('apagarEvento','EventoController@apagarEvento');

//ROTAS ASSENTO
Route::post('inserirAssento','AssentoController@inserirAssento');
Route::post('editarAssento','AssentoController@editarAssento');
Route::get('/eliminarAssento/{id}/{id1}','AssentoController@eliminar');
Route::get('/verAssento/{id}/{idEvento}/{entidade}','AssentoController@ver');

//ROTAS CONVIDADO
Route::post('inserirConvidado','ConvidadoController@inserirConvidado');
Route::post('gerarConvite','ConvidadoController@gerarConvite');
Route::get('verqrcode/{nome}/{id}/{pasta}','ConvidadoController@verQRCODE');
Route::get('apagarConvidado/{nome}/{id}/{pasta}','ConvidadoController@eliminar');
Route::get('convitesGerados/{id}','ConvidadoController@convitesGeradosPage');
Route::get('pegaConvitesGerados/{id}/{entidade}','ConvidadoController@pegaConvitesGerados');

//ROTAS CONSUMO
Route::get('verConsumo/{id}','EventoController@verConsumo');
Route::post('inserirProduto','ConsumoController@inserirProduto');
Route::get('pegaConsumos/{id}','ConsumoController@pegaConsumos');
Route::get('eliminarConsumo/{id}','ConsumoController@eliminarConsumo');

//ROTAS API
Route::get('gerarapi','EventoController@getEvento');
Route::get('vereventoAPI/{id}','EventoController@verEventoAPI');
Route::post('registarAPI','EventoController@registarAPI');
Route::get('apagarEventoAPI/{id}','EventoController@apagarEventoAPI');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/back',function(){
    return back();
});



