<?php

use App\Http\Controllers\ClienteControlador;
use App\Http\Controllers\ContasReceberControlador;
use App\Http\Controllers\DonoControlador;
use App\Http\Controllers\ImovelControlador;
use App\Http\Controllers\ImagemControlador;
use App\Http\Controllers\LocatarioControlador;
use App\Http\Controllers\ContratoControlador;
use App\Models\Imovel;
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
//externo
Route::get('/', [ImovelControlador::class, 'index']);
Route::get('/imovel/detalhe/{id}', [ImovelControlador::class, 'detalhe']);
Route::get('/search/imovel', [ImovelControlador::class, 'search']);

Route::post('/mensagem', [ClienteControlador::class, 'store']);


//interno
Route::get('/prop/create', [DonoControlador::class, 'create'])->middleware('auth');
Route::post('/proprietario', [DonoControlador::class, 'store'])->middleware('auth');
Route::get('/proprietario/{id}', [DonoControlador::class,'show'])->middleware('auth');

Route::get('/dashboard', [DonoControlador::class, 'index'])->middleware('auth');

Route::get('/locatario/create', [LocatarioControlador::class, 'create'])->middleware('auth');
Route::post('/locatario', [LocatarioControlador::class, 'store'])->middleware('auth');
Route::get('/locatario/list/{id?}', [LocatarioControlador::class, 'list'])->middleware('auth');

Route::get('/imovel/create', [ImovelControlador::class, 'create'])->middleware('auth');
Route::post('/imovel', [ImovelControlador::class, 'store'])->middleware('auth');
Route::delete('/imovel/destroy/{id}', [ImovelControlador::class, 'destroy'])->middleware('auth');
Route::get('/imovel/{id}', [ImovelControlador::class, 'show'])->middleware('auth');
Route::get('/imovel/list/{id?}', [ImovelControlador::class, 'list'])->middleware('auth');
Route::get('/imovel/edit/{id}',[ImovelControlador::class, 'edit'])->middleware('auth');
Route::put('/imovel/update/{id}', [ImovelControlador::class, 'update'])->middleware('auth');
Route::get('/imovel/up/{id}', [ImovelControlador::class, 'up'])->middleware('auth');


Route::get('/imagem/add/{id}', [ImagemControlador::class, 'add'])->middleware('auth');
Route::post('/imagem', [ImagemControlador::class, 'store'])->middleware('auth');


Route::get('/contrato/add/{id}', [ContratoControlador::class, 'add'])->middleware('auth');
Route::get('/contrato/edit/{id}',[ContratoControlador::class, 'edit'])->middleware('auth');
Route::put('/contrato/update/{id}', [ContratoControlador::class, 'update'])->middleware('auth');
Route::get('/contrato/{id?}', [ContratoControlador::class,'show'])->middleware('auth');
Route::post('/contrato', [ContratoControlador::class, 'store'])->middleware('auth');


Route::get('/conta/receber/{id}', [ContasReceberControlador::class, 'create'])->middleware('auth');
Route::post('/conta-receber', [ContasReceberControlador::class, 'store'])->middleware('auth');
Route::get('/conta/receber/list/{id?}', [ContasReceberControlador::class, 'show'])->middleware('auth');
Route::put('/conta/update/{id?}', [ContasReceberControlador::class, 'update'])->middleware('auth');

/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
 */
