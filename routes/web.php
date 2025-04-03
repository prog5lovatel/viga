<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\ObrasController;
use App\Http\Controllers\OuvidoriaController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\ServicosController;
use Illuminate\Support\Facades\Route;

/* Home */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/marcas', [HomeController::class, 'index'])->name('home.marcas');

/* Contato */
Route::get('/contato', [ContatoController::class, 'index'])->name('contato');
Route::post('/contato', [ContatoController::class, 'enviar'])->name('contato.enviar');
Route::get('/trabalhe', [ContatoController::class, 'trabalhe'])->name('contato.trabalhe');

/* Sobre */
Route::get('/sobre', [SobreController::class, 'index'])->name('sobre');

/* Clientes */
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes');

/* Servicos */
Route::get('/servicos', [ServicosController::class, 'index'])->name('servicos');
Route::get('/servicos/{slugServico}', [ServicosController::class, 'detalhes'])->name('servicos.detalhes');

/* Obras */
Route::get('/obras', [ObrasController::class, 'index'])->name('obras');
Route::get('/obras-detalhes', [ObrasController::class, 'detalhes'])->name('obras.detalhes');

/* Ouvidoria */
Route::get('/ouvidoria', [OuvidoriaController::class, 'index'])->name('ouvidoria');
Route::post('/ouvidoria', [OuvidoriaController::class, 'enviar'])->name('ouvidoria.enviar');

/* Documentos */
Route::get('/documentos', [DocumentosController::class, 'index'])->name('documentos');
