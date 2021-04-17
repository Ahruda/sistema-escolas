<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\TurmasController;
use App\Http\Controllers\EscolasController;
use Illuminate\Http\Request;

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

Route::view('/', 'index');
Route::resource('alunos', AlunosController::class);
Route::resource('turmas', TurmasController::class);
Route::resource('escolas', EscolasController::class);

Route::post('/relation', function (Request $request) {
});