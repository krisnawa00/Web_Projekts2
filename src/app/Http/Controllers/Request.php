<?php

namespace App\Http\Controllers;

use App\Models\Develepor;
use Illuminate\Http\Request;  // Import the Request class here

class DeveleporController extends Controller
{
    // Method to handle the store (create) functionality
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new Develepor
        Develepor::create($validated);

        // Redirect or return response
        return redirect()->route('develepors.index')->with('success', 'Develepor created successfully!');
    }
}
