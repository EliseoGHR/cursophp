<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::get('categoria/index',[CategoriaController::class, 'index']);
Route::get('categoria/calculadora',[CategoriaController::class, 'sumar'])->name('calcular');
