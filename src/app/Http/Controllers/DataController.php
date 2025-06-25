<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Develepor;
use Illuminate\Http\JsonResponse;

class DataController extends Controller
{
    public function getTopGames(): JsonResponse
    {
        $games = Game::with('develepor')
            ->where('is_active', true)
            ->inRandomOrder()
            ->take(3)
            ->get()
            ->map(function ($game) {
                return [
                    'id' => $game->id,
                    'title' => $game->title,
                    'name' => $game->title, // For compatibility with React code
                    'description' => $game->description,
                    'price' => $game->price,
                    'release_year' => $game->release_year,
                    'image' => $game->image,
                    'develepor' => $game->develepor ? $game->develepor->name : null,
                    'genre' => $game->genre_id ? $game->genre->name : null,
                ];
            });

        return response()->json($games);
    }

    public function getGame(Game $game): JsonResponse
    {
        $selectedGame = Game::with(['develepor', 'genre'])
            ->where([
                'id' => $game->id,
                'is_active' => true,
            ])
            ->firstOrFail();

        $gameData = [
            'id' => $selectedGame->id,
            'title' => $selectedGame->title,
            'name' => $selectedGame->title, // For compatibility with React code
            'description' => $selectedGame->description,
            'price' => $selectedGame->price,
            'release_year' => $selectedGame->release_year,
            'image' => $selectedGame->image,
            'develepor' => $selectedGame->develepor ? $selectedGame->develepor->name : null,
            'genre' => $selectedGame->genre ? $selectedGame->genre->name : null,
        ];

        return response()->json($gameData);
    }

    public function getRelatedGames(Game $game): JsonResponse
    {
        $relatedGames = Game::with('develepor')
            ->where('is_active', true)
            ->where('id', '<>', $game->id)
            ->inRandomOrder()
            ->take(3)
            ->get()
            ->map(function ($relatedGame) {
                return [
                    'id' => $relatedGame->id,
                    'title' => $relatedGame->title,
                    'name' => $relatedGame->title, // For compatibility with React code
                    'description' => $relatedGame->description,
                    'price' => $relatedGame->price,
                    'release_year' => $relatedGame->release_year,
                    'image' => $relatedGame->image,
                    'develepor' => $relatedGame->develepor ? $relatedGame->develepor->name : null,
                    'genre' => $relatedGame->genre_id ? $relatedGame->genre->name : null,
                ];
            });

        return response()->json($relatedGames);
    }
}