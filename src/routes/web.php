<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\DeveleporController; 
use App\Http\Controllers\GameController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\DataController;
Route::get('/', [HomeController::class, 'index']);

Route::get('/develepors', [DeveleporController::class,'list']);
Route::get('/develepors/create', [DeveleporController::class, 'create']);
Route::post('/develepors/put', [DeveleporController::class, 'put']);
Route::get('/develepors/update/{develepor}', [DeveleporController::class, 'update']);
Route::post('/develepors/patch/{develepor}', [DeveleporController::class, 'patch']);
Route::post('/develepors/delete/{develepor}', [DeveleporController::class, 'delete']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/games', [GameController::class, 'list']);
Route::get('/games/create', [GameController::class, 'create']);
Route::post('/games/put', [GameController::class, 'put']);
Route::get('/games/update/{game}', [GameController::class, 'update']);
Route::post('/games/patch/{game}', [GameController::class, 'patch']);
Route::post('/games/delete/{game}', [GameController::class, 'delete']);
Route::get('/genres', [GenreController::class, 'list']);
Route::get('/genres/create', [GenreController::class, 'create']);
Route::post('/genres/put', [GenreController::class, 'put']);
Route::get('/genres/update/{genre}', [GenreController::class, 'update']);
Route::post('/genres/patch/{genre}', [GenreController::class, 'patch']);
Route::post('/genres/delete/{genre}', [GenreController::class, 'delete']);
Route::get('/data/get-top-games', [DataController::class, 'getTopGames']);
Route::get('/data/get-game/{game}', [DataController::class, 'getGame']);
Route::get('/data/get-related-games/{game}', [DataController::class, 'getRelatedGames']);