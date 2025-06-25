<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Game;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\GenreRequest;

class GenreController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return ['auth'];
    }

    public function list(): View
    {
        $items = Genre::orderBy('name', 'asc')->get();
        return view('genre.list', [
            'title' => 'Žanri',
            'items' => $items
        ]);
    }

    public function create(): View
    {
        $games = Game::orderBy('title', 'asc')->get();
        return view('genre.form', [
            'title' => 'Pievienot žanru',
            'genre' => new Genre(),
            'games' => $games,
        ]);
    }

    private function saveGenreData(Genre $genre, GenreRequest $request): void
    {
        $validatedData = $request->validated();

        $genre->fill([
            'name' => $validatedData['name'],
            'game_id' => $validatedData['game_id'],
            'description' => $validatedData['description'] ?? null,
            'is_active' => (bool) ($validatedData['is_active'] ?? false),
        ]);

        $genre->save();
    }

    public function update(Genre $genre): View
    {
        $games = Game::orderBy('title', 'asc')->get();
        return view('genre.form', [
            'title' => 'Rediģēt žanru',
            'genre' => $genre,
            'games' => $games,
        ]);
    }

    public function put(GenreRequest $request): RedirectResponse
    {
        $genre = new Genre();
        $this->saveGenreData($genre, $request);
        return redirect('/genres');
    }

    public function patch(Genre $genre, GenreRequest $request): RedirectResponse
    {
        $this->saveGenreData($genre, $request);
        return redirect('/genres/update/' . $genre->id);
    }

    public function delete(Genre $genre): RedirectResponse
    {
        $genre->delete();
        return redirect('/genres');
    }

    public function messages(): array
    {
        return [
            'required' => 'Lauks ":attribute" ir obligāts',
            'min' => 'Laukam ":attribute" jābūt vismaz :min simbolus garam',
            'max' => 'Lauks ":attribute" nedrīkst būt garāks par :max simboliem',
            'boolean' => 'Lauka ":attribute" vērtībai jābūt "true" vai "false"',
            'unique' => 'Šāda lauka ":attribute" vērtība jau ir reģistrēta',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nosaukums',
            'game_id' => 'spēle',
            'description' => 'apraksts',
            'is_active' => 'aktīvs',
        ];
    }
}
