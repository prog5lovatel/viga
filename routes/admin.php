<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CkEditor;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\InicioController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ObraController;
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Admin\ServicoController;
use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\SobreController;
use App\Http\Controllers\Admin\UnidadeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', InicioController::class)->name('inicio')->middleware('auth');

/* Login */
Route::get('/entrar', [LoginController::class, 'index'])->name('login');
Route::post('/entrar', [LoginController::class, 'auth'])->name('auth');
Route::post('/esqueceu-senha', [LoginController::class, 'forgot'])->name('forgot');
Route::get('/sair', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/* CKEDITOR */
Route::post('/ckeditor-upload', CkEditor::class);

/* Popup */
Route::get('/popup', [PopupController::class, 'index'])->name('popup')->middleware('auth');
Route::get('/popup/foto', [PopupController::class, 'foto'])->name('popup.foto')->middleware('auth');
Route::post('/popup', [PopupController::class, 'update'])->name('popup.update')->middleware('auth');
Route::post('/popup/foto', [PopupController::class, 'updateFoto'])->name('popup.updateFoto')->middleware('auth');

/* Site */
Route::get('/site', [SiteController::class, 'index'])->name('site')->middleware('auth');
Route::get('/site/head', [SiteController::class, 'head'])->name('site.head')->middleware('auth');
Route::get('/site/body', [SiteController::class, 'body'])->name('site.body')->middleware('auth');
Route::get('/site/footer', [SiteController::class, 'footer'])->name('site.footer')->middleware('auth');
Route::post('/site', [SiteController::class, 'update'])->name('site.update')->middleware('auth');
Route::post('/site/codigos', [SiteController::class, 'updateCodigos'])->name('site.updateCodigos')->middleware('auth');

/* Users */
Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('auth');
Route::get('/users/criar', [UserController::class, 'create'])->name('users.create')->middleware('auth')->can('create', App\Models\User::class);
Route::get('/users/{user}', [UserController::class, 'edit'])->name('users.edit')->middleware('auth')->can('update', 'user');
Route::get('/users/trocar-senha/{user}', [UserController::class, 'changePassword'])->name('users.change')->middleware('auth')->can('delete', 'user');

Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('auth')->can('create', App\Models\User::class);
Route::post('/users/alterar/{user}', [UserController::class, 'update'])->name('users.update')->middleware('auth')->can('update', 'user');
Route::post('/users/alterar-senha/{user}', [UserController::class, 'updatePassword'])->name('users.updatePassword')->middleware('auth')->can('update', 'user');
Route::post('/users/destruir/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth')->can('delete', 'user');

/* Banner */
Route::get('/banner', [BannerController::class, 'index'])->name('banner')->middleware('auth');
Route::get('/banner/criar', [BannerController::class, 'create'])->name('banner.create')->middleware('auth');
Route::get('/banner/{banner}', [BannerController::class, 'edit'])->name('banner.edit')->middleware('auth');
Route::get('/banner/fotos/{banner}', [BannerController::class, 'fotos'])->name('banner.fotos')->middleware('auth');

Route::post('/banner', [BannerController::class, 'store'])->name('banner.store')->middleware('auth');
Route::post('/banner/alterar/{banner}', [BannerController::class, 'update'])->name('banner.update')->middleware('auth');
Route::post('/banner/alterar-fotos/{banner}', [BannerController::class, 'updateFotos'])->name('banner.updateFotos')->middleware('auth');
Route::post('/banner/ordenar', [BannerController::class, 'order'])->name('banner.order')->middleware('auth');
Route::post('/banner/destruir/{banner}', [BannerController::class, 'destroy'])->name('banner.destroy')->middleware('auth');

/* Banner */
Route::get('/banner', [BannerController::class, 'index'])->name('banner')->middleware('auth');
Route::get('/banner/criar', [BannerController::class, 'create'])->name('banner.create')->middleware('auth');
Route::get('/banner/{banner}', [BannerController::class, 'edit'])->name('banner.edit')->middleware('auth');
Route::get('/banner/fotos/{banner}', [BannerController::class, 'fotos'])->name('banner.fotos')->middleware('auth');

Route::post('/banner', [BannerController::class, 'store'])->name('banner.store')->middleware('auth');
Route::post('/banner/alterar/{banner}', [BannerController::class, 'update'])->name('banner.update')->middleware('auth');
Route::post('/banner/alterar-fotos/{banner}', [BannerController::class, 'updateFotos'])->name('banner.updateFotos')->middleware('auth');
Route::post('/banner/ordenar', [BannerController::class, 'order'])->name('banner.order')->middleware('auth');
Route::post('/banner/destruir/{banner}', [BannerController::class, 'destroy'])->name('banner.destroy')->middleware('auth');
/* Servico */
Route::get('/servico', [ServicoController::class, 'index'])->name('servico')->middleware('auth');
Route::get('/servico/criar', [ServicoController::class, 'create'])->name('servico.create')->middleware('auth');
Route::get('/servico/{servico}', [ServicoController::class, 'edit'])->name('servico.edit')->middleware('auth');
Route::get('/servico/fotos/{servico}', [ServicoController::class, 'fotos'])->name('servico.fotos')->middleware('auth');

Route::post('/servico', [ServicoController::class, 'store'])->name('servico.store')->middleware('auth');
Route::post('/servico/alterar/{servico}', [ServicoController::class, 'update'])->name('servico.update')->middleware('auth');
Route::post('/servico/alterar-fotos/{servico}', [ServicoController::class, 'updateFotos'])->name('servico.updateFotos')->middleware('auth');
Route::post('/servico/ordenar', [ServicoController::class, 'order'])->name('servico.order')->middleware('auth');
Route::post('/servico/ordenar-fotos', [ServicoController::class, 'orderServicoFoto'])->name('servico.orderServicoFoto')->middleware('auth');
Route::post('/servico/destruir-fotos/{servico}', [ServicoController::class, 'destroyAllServicoFoto'])->name('servico.destroyAllServicoFoto')->middleware('auth');
Route::post('/servico/destruir-foto/{servicoFoto}', [ServicoController::class, 'destroyServicoFoto'])->name('servico.destroyServicoFoto')->middleware('auth');
Route::post('/servico/destruir/{servico}', [ServicoController::class, 'destroy'])->name('servico.destroy')->middleware('auth');

/* Banner */
Route::get('/banner', [BannerController::class, 'index'])->name('banner')->middleware('auth');
Route::get('/banner/criar', [BannerController::class, 'create'])->name('banner.create')->middleware('auth');
Route::get('/banner/{banner}', [BannerController::class, 'edit'])->name('banner.edit')->middleware('auth');
Route::get('/banner/fotos/{banner}', [BannerController::class, 'fotos'])->name('banner.fotos')->middleware('auth');

Route::post('/banner', [BannerController::class, 'store'])->name('banner.store')->middleware('auth');
Route::post('/banner/alterar/{banner}', [BannerController::class, 'update'])->name('banner.update')->middleware('auth');
Route::post('/banner/alterar-fotos/{banner}', [BannerController::class, 'updateFotos'])->name('banner.updateFotos')->middleware('auth');
Route::post('/banner/ordenar', [BannerController::class, 'order'])->name('banner.order')->middleware('auth');
Route::post('/banner/destruir/{banner}', [BannerController::class, 'destroy'])->name('banner.destroy')->middleware('auth');
/* Obra */
Route::get('/obra', [ObraController::class, 'index'])->name('obra')->middleware('auth');
Route::get('/obra/criar', [ObraController::class, 'create'])->name('obra.create')->middleware('auth');
Route::get('/obra/{obra}', [ObraController::class, 'edit'])->name('obra.edit')->middleware('auth');
Route::get('/obra/fotos/{obra}', [ObraController::class, 'fotos'])->name('obra.fotos')->middleware('auth');

Route::post('/obra', [ObraController::class, 'store'])->name('obra.store')->middleware('auth');
Route::post('/obra/alterar/{obra}', [ObraController::class, 'update'])->name('obra.update')->middleware('auth');
Route::post('/obra/alterar-fotos/{obra}', [ObraController::class, 'updateFotos'])->name('obra.updateFotos')->middleware('auth');
Route::post('/obra/ordenar', [ObraController::class, 'order'])->name('obra.order')->middleware('auth');
Route::post('/obra/ordenar-fotos', [ObraController::class, 'orderObraFoto'])->name('obra.orderObraFoto')->middleware('auth');
Route::post('/obra/destruir-fotos/{obra}', [ObraController::class, 'destroyAllObraFoto'])->name('obra.destroyAllObraFoto')->middleware('auth');
Route::post('/obra/destruir-foto/{obraFoto}', [ObraController::class, 'destroyObraFoto'])->name('obra.destroyObraFoto')->middleware('auth');
Route::post('/obra/destruir/{obra}', [ObraController::class, 'destroy'])->name('obra.destroy')->middleware('auth');

/* Cliente */
Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente')->middleware('auth');
Route::get('/cliente/criar', [ClienteController::class, 'create'])->name('cliente.create')->middleware('auth');
Route::get('/cliente/{cliente}', [ClienteController::class, 'edit'])->name('cliente.edit')->middleware('auth');
Route::get('/cliente/fotos/{cliente}', [ClienteController::class, 'fotos'])->name('cliente.fotos')->middleware('auth');

Route::post('/cliente', [ClienteController::class, 'store'])->name('cliente.store')->middleware('auth');
Route::post('/cliente/alterar/{cliente}', [ClienteController::class, 'update'])->name('cliente.update')->middleware('auth');
Route::post('/cliente/alterar-fotos/{cliente}', [ClienteController::class, 'updateFotos'])->name('cliente.updateFotos')->middleware('auth');
Route::post('/cliente/ordenar', [ClienteController::class, 'order'])->name('cliente.order')->middleware('auth');
Route::post('/cliente/destruir/{cliente}', [ClienteController::class, 'destroy'])->name('cliente.destroy')->middleware('auth');
/* Unidade */
Route::get('/unidade', [UnidadeController::class, 'index'])->name('unidade')->middleware('auth');
Route::get('/unidade/criar', [UnidadeController::class, 'create'])->name('unidade.create')->middleware('auth');
Route::get('/unidade/{unidade}', [UnidadeController::class, 'edit'])->name('unidade.edit')->middleware('auth');

Route::post('/unidade', [UnidadeController::class, 'store'])->name('unidade.store')->middleware('auth');
Route::post('/unidade/alterar/{unidade}', [UnidadeController::class, 'update'])->name('unidade.update')->middleware('auth');
Route::post('/unidade/ordenar', [UnidadeController::class, 'order'])->name('unidade.order')->middleware('auth');
Route::post('/unidade/destruir/{unidade}', [UnidadeController::class, 'destroy'])->name('unidade.destroy')->middleware('auth');

/* Sobre */
Route::get('/sobre/{sobre}', [SobreController::class, 'edit'])->name('sobre.edit')->middleware('auth');
Route::get('/sobre/fotos/{sobre}', [SobreController::class, 'fotos'])->name('sobre.fotos')->middleware('auth');

Route::post('/sobre/alterar/{sobre}', [SobreController::class, 'update'])->name('sobre.update')->middleware('auth');
Route::post('/sobre/alterar-fotos/{sobre}', [SobreController::class, 'updateFotos'])->name('sobre.updateFotos')->middleware('auth');
Route::post('/sobre/ordenar-fotos', [SobreController::class, 'orderSobreFoto'])->name('sobre.orderSobreFoto')->middleware('auth');
Route::post('/sobre/destruir-fotos/{sobre}', [SobreController::class, 'destroyAllSobreFoto'])->name('sobre.destroyAllSobreFoto')->middleware('auth');
Route::post('/sobre/destruir-foto/{sobreFoto}', [SobreController::class, 'destroySobreFoto'])->name('sobre.destroySobreFoto')->middleware('auth');
