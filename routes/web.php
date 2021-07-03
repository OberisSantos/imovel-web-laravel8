<?php

use App\Http\Controllers\DonoControlador;
use App\Http\Controllers\ImovelControlador;
use App\Http\Controllers\ImagemControlador;
use App\Http\Controllers\LocatarioControlador;
use App\Http\Controllers\ContratoControlador;
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



//Route::get('/', [EventController::class, 'index']);

//Route::get('/event/create', [EventController::class, 'create']);
Route::get('/', [DonoControlador::class, 'index']);

Route::get('/prop/create', [DonoControlador::class, 'create'])->middleware('auth');
Route::post('/proprietario', [DonoControlador::class, 'store']);

Route::get('/dashboard', [DonoControlador::class, 'dashboard'])->middleware('auth');

Route::get('/locatario/create', [LocatarioControlador::class, 'create']);
Route::post('/locatario', [LocatarioControlador::class, 'store']);
Route::get('/locatario/list/{id?}', [LocatarioControlador::class, 'list']);

Route::get('/imovel/create', [ImovelControlador::class, 'create']);
Route::post('/imovel', [ImovelControlador::class, 'store']);
Route::delete('/imovel/{id}', [ImovelControlador::class, 'destroy']);

Route::get('/imagem/add/{id}', [ImagemControlador::class, 'add']);
Route::post('/imagem', [ImagemControlador::class, 'store']);


Route::get('/contrato/add/{id}', [ContratoControlador::class, 'add']);
Route::get('/contrato/edit/{id}',[ContratoControlador::class, 'edit']);
Route::put('/contrato/update/{id}', [ContratoControlador::class, 'update']);
Route::get('/contrato/{id}', [ContratoControlador::class,'show']);
Route::post('/contrato', [ContratoControlador::class, 'store']);


/*
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
 */
