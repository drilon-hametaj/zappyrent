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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contratti','Contratti@getListaContratti')->name('contratti');
Route::post('/nuovo-alloggio','AlloggiController@nuovoAlloggio')->name('nuovo-alloggio');
Route::get('/prenota/{id}','AlloggiController@prenotaAlloggio')->name('prenota');

Route::get('/pagamenti/{id}','PagamentiController@vediPagamenti')->name('pagamenti');
Route::get('/pagamenti-da-ricevere/{id}','PagamentiController@vediPagamentiDaRicevere')->name('pagamenti-da-ricevere');
Route::get('/effettua-pagamento/{id}','PagamentiController@effettuaPagamento')->name('effettua-pagamento');

/*Cron (giornaliero oppure ad ogni ora) per il controllo dei pagamenti e addebito mensile*/
Route::get('/cron','CronController@checkPayment');
