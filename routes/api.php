<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\PlanosController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//------------------Rotas para cliente------------------------------------

//Buscar todos os cliente 
Route::get('/clientes', [ClienteController::class, "index"]);
//Buscar cliente especifico 
Route::get('/clientes/{id}', [ClienteController::class, "show"]);

//Cadastrar Cliente
Route::post('/clientes', [ClienteController::class, "store"]);

//Deletar ciliente
Route::delete('/clientes/{id}',[ClienteController::class, "destroy"]);

//Atualziar cliente
Route::put('/clientes/{id}', [ClienteController::class, "update"]);

//----------------Rotas para equipe----------------------------------------

//Buscar todos os funcionarios
Route::get('/funcionario', [EquipeController::class, "index"]);

//Buscar funcionario especifico
Route::get('/funcionario/{id}', [EquipeController::class, "show"]);

//Cadastrar funcionarios
Route::post('/funcionario', [EquipeController::class, "store"]);

//Deletar funcionarios
Route::delete('/funcionario/{id}',[EquipeController::class, "destroy"]);

//Atualziar funcionarios
Route::put('/funcionario/{id}', [EquipeController::class, "update"]);

//----------------Rota para Planos--------------------------------------------

//Buscar todos os planos
Route::get('/plano', [PlanosController::class, "index"]);

//Cadastrar planos
Route::post('/plano', [PlanosController::class, "store"]);

//Deletar planos
Route::delete('/plano/{id}',[PlanosController::class, "destroy"]);

//Atualziar planos
Route::put('/plano/{id}', [PlanosController::class, "update"]);
