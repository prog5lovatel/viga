<?php

use App\Http\Controllers\Admin\CkEditor;
use App\Http\Controllers\Admin\InicioController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Admin\SiteController;
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
