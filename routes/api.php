<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todos',[TodoController::class,'index'])->name('todos');
Route::post('/todo/create',[TodoController::class,'create'])->name('create');
Route::get('/todos/{id}',[TodoController::class,'index_id'])->name('index_id');