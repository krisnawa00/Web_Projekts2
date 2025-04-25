<?php

namespace App\Http\Controllers;

use App\Models\Develepor;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeveleporController extends Controller
{
    public function list(): View
    {
        
        $items = Develepor::orderBy('name','asc')->get();

        
        return view('develepor.list', [
            'title' => 'Develepor',
            'items' => $items,
        ]);
    }

    public function create(): View
    {
    return view(
    'develepor.form',
    [
    'title' => 'Pievienot develepor',
    'develepor' => new Develepor()
    ]
    );
    }

    public function put(Request $request): RedirectResponse
    {
    $validatedData = $request->validate([
    'name' => 'required|string|max:255',
    ]);
    $develepor = new Develepor();
    $develepor->name = $validatedData['name'];
    $develepor->save();
    return redirect('/develepors');
    }

    public function update(Develepor $develepor): View
{
 return view(
 'develepor.form',
 [
 'title' => 'Rediģēt autoru',
 'develepor' => $develepor
 ]
 );
}


public function patch(Develepor $develepor, Request $request): RedirectResponse
{
 $validatedData = $request->validate([
 'name' => 'required|string|max:255',
 ]);
 $develepor->name = $validatedData['name'];
 $develepor->save();
 return redirect('/develepors');
}

public function delete(Develepor $develepor)
{
    $develepor->forceDelete(); // Use forceDelete() for a hard delete
    return redirect('/develepors');
}


}
