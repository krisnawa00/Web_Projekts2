<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Develepor;
use App\Models\Game;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\GameRequest;

class GameController extends Controller implements HasMiddleware
{
    public static function middleware(): array
{
return [
'auth',
];
}

public function list(): View
{
$items = Game::orderBy('title', 'asc')->get();
return view(
'game.list',
[
'title' => 'Spēles',
'items' => $items
]
);
}

public function create(): View
{
$develepors = Develepor::orderBy('name', 'asc')->get();
return view(
'game.form',
[
'title' => 'Pievienot spēli',
'game' => new Game(),
'develepors' => $develepors,
]
);
}

private function saveGameData(Game $game, GameRequest $request): void
{
    $validatedData = $request->validate([
        'name' => 'required|min:3|max:256',
        'develepor_id' => 'required',
        'description' => 'nullable',
        'price' => 'nullable|numeric',
        'year' => 'numeric',
        'image' => 'nullable|image',
        'display' => 'nullable',
    ]);

    $game->name = $validatedData['name'];
    $game->develepor_id = $validatedData['develepor_id'];
    $game->description = $validatedData['description'];
    $game->price = $validatedData['price'];
    $game->year = $validatedData['year'];
    $validatedData = $request->validated();
    $game->fill($validatedData);
    $game->display = (bool) ($validatedData['display'] ?? false);

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
        $game->image = basename($path);
    }

    $game->save();
}


public function update(Game $game): View
{
    $develepors = Develepor::orderBy('name', 'asc')->get();

    return view(
        'game.form',
        [
            'title' => 'Rediģēt spēli',
            'game' => $game,
            'develepors' => $develepors,
        ]
    );
}

public function put(GameRequest $request): RedirectResponse
{
    $game = new Game();
    $this->saveGameData($game, $request);
    return redirect('/games');
}

public function patch(Game $game, GameRequest $request): RedirectResponse
{
    $this->saveGameData($game, $request);
    return redirect('/games/update/' . $game->id);
}









public function delete(Game $game): RedirectResponse
{
    if ($game->image && file_exists(public_path('images/' . $game->image))) {
        unlink(public_path('images/' . $game->image));
    }
    $game->delete();
    return redirect('/games');
}

public function messages(): array
{
 return [
 'required' => 'Lauks ":attribute" ir obligāts',
 'min' => 'Laukam ":attribute" jābūt vismaz :min simbolus garam',
 'max' => 'Lauks ":attribute" nedrīkst būt garāks par :max simboliem',
 'boolean' => 'Lauka ":attribute" vērtībai jābūt "true" vai "false"',
 'unique' => 'Šāda lauka ":attribute" vērtība jau ir reģistrēta',
 'numeric' => 'Lauka ":attribute" vērtībai jābūt skaitlim',
 'image' => 'Laukā ":attribute" jāpievieno korekts attēla fails',
 ];
}
public function attributes(): array
{
 return [
 'name' => 'nosaukums',
 'author_id' => 'autors',
 'description' => 'apraksts',
 'price' => 'cena',
 'year' => 'gads',
 'image' => 'attēls',
 'display' => 'publicēt',
 ];
}

}
