<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\GameRequest;
use App\Models\Game;
use App\Models\Develepor;
use Illuminate\Routing\Controllers\HasMiddleware;

class GameController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth'];
    }

    public function list(): View
    {
        $items = Game::orderBy('title', 'asc')->get();

        return view('game.list', [
            'title' => 'Spēles',
            'items' => $items,
        ]);
    }

    public function create(): View
    {
        $develepors = Develepor::orderBy('name', 'asc')->get();

        return view('game.form', [
            'title' => 'Pievienot spēli',
            'game' => new Game(),
            'develepors' => $develepors,
        ]);
    }

    private function saveGameData(Game $game, GameRequest $request): void
    {
        $validatedData = $request->validated();

        // Assign validated data to model
        $game->fill($validatedData);

        // Handle boolean field - adjust if your field is 'is_active' or 'display'
        $game->is_active = (bool) ($validatedData['is_active'] ?? false);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($game->image && file_exists(public_path('images/' . $game->image))) {
                unlink(public_path('images/' . $game->image));
            }

            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $path = $uploadedFile->storePubliclyAs(
                '/',
                $name . '.' . $extension,
                'uploads'
            );

            // Save just the filename, or the full path if you prefer
            $game->image = basename($path);
        }

        $game->save();
    }

    public function update(Game $game): View
    {
        $develepors = Develepor::orderBy('name', 'asc')->get();

        return view('game.form', [
            'title' => 'Rediģēt spēli',
            'game' => $game,
            'develepors' => $develepors,
        ]);
    }

    public function put(GameRequest $request): RedirectResponse
    {
        $game = new Game();
        $this->saveGameData($game, $request);

        return redirect('/games')->with('success', 'Spēle veiksmīgi pievienota!');
    }

    public function patch(Game $game, GameRequest $request): RedirectResponse
    {
        $this->saveGameData($game, $request);

        return redirect('/games/update/' . $game->id)->with('success', 'Spēle veiksmīgi atjaunota!');
    }

    public function delete(Game $game): RedirectResponse
    {
        if ($game->image && file_exists(public_path('images/' . $game->image))) {
            unlink(public_path('images/' . $game->image));
        }
        $game->delete();

        return redirect('/games')->with('success', 'Spēle veiksmīgi dzēsta!');
    }
}
