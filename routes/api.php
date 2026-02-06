<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Buscar todos os cliente 
Route::get('/clientes', [ClienteController::class, "index"]);

//Cadastrar Cliente
Route::post('/clientes', [ClienteController::class, "store"]);

//Deletar ciliente
Route::delete('/clientes/{id}',[ClienteController::class, "destroy"]);

//Atualziar cliente
Route::put('/clientes/{id}', [ClienteController::class, "update"]);
