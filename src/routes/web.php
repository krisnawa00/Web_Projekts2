<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\DeveleporController; 

Route::get('/', [HomeController::class, 'index']);

Route::get('/develepors', [DeveleporController::class,'list']);
Route::get('/develepors/create', [DeveleporController::class, 'create']);
Route::post('/develepors/put', [DeveleporController::class, 'put']);
Route::get('/develepors/update/{develepor}', [DeveleporController::class, 'update']);
Route::post('/develepors/patch/{develepor}', [DeveleporController::class, 'patch']);
Route::post('/develepors/delete/{develepor}', [DeveleporController::class, 'delete']);


