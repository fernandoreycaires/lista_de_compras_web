<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Lista\ListaAbertaController;
use App\Http\Controllers\Lista\ListaFechadaController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect()->route('home');
})->name('dashboard');

Route::get('home', [HomeController::class, 'home'])->name('home');
Route::get('listaAberta',[ListaAbertaController::class, 'listaAberta' ])->name('listaAberta');
Route::get('listasFechadas',[ListaFechadaController::class, 'listaFechada'])->name('listaFechada');

//Listas
Route::get('nova_lista', [ListaAbertaController::class, 'novaLista'])->name('novaLista');
Route::post('cancel_lista/{lista}', [ListaAbertaController::class, 'cancelLista'])->name('cancelLista');
Route::post('finaliza_lista/{lista}', [ListaAbertaController::class, 'finalizaLista'])->name('finalizaLista');
//Itens da lista
Route::get('add_item', [ListaAbertaController::class, 'addItensLista'])->name('addItensLista');
Route::post('item_disponivel/{item}', [ListaAbertaController::class, 'itemDisponivel'])->name('itemDisponivel');
Route::post('item_indisponivel/{item}', [ListaAbertaController::class, 'itemIndisponivel'])->name('itemIndisponivel');
Route::delete('item_delete/{item}', [ListaAbertaController::class, 'itemDelete'])->name('itemDelete');
Route::post('item_edit/{item}', [ListaAbertaController::class, 'itemEdit'])->name('itemEdit');
