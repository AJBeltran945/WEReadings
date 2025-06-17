<?php

namespace App\Http\Controllers;

use App\Models\Water;
use Illuminate\Http\Request;

class waterController extends Controller
{
    public function create()
    {
        return view('water.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|before_or_equal:today',
            'reading' => 'required|numeric',
            'comment' => 'nullable|string',
        ]);

        Water::create([
            'date' => $request->date,
            'number' => $request->reading,
            'comment' => $request->comment,
        ]);

        return redirect()->route('home')->with('success', 'Water reading added successfully.');
    }

    public function edit(Water $water)
    {
        return view('partials.water.edit', compact('water'));
    }

    public function update(Request $request, Water $water)
    {
        $request->validate([
            'date' => 'required|date|before_or_equal:today',
            'reading' => 'required|numeric',
            'comment' => 'nullable|string',
        ]);

        $water->update([
            'date' => $request->date,
            'number' => $request->reading,
            'comment' => $request->comment,
        ]);

        return redirect()->route('index')->with('success', 'Water reading updated successfully.');
    }

    public function destroy(Water $water)
    {
        $water->delete();

        return redirect()->route('index')->with('success', 'Water reading deleted.');
    }
}
