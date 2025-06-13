<?php

namespace App\Http\Controllers;

use App\Models\Water;
use Illuminate\Http\Request;

class waterController extends Controller
{
    public function index()
    {
        $waters = Water::orderByDesc('date')->get();
        return view('water.index', compact('waters'));
    }

    public function create()
    {
        return view('water.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|numeric',
            'date' => 'required|date',
            'comment' => 'nullable|string',
        ]);

        Water::create($request->all());

        return redirect()->route('water.index')->with('success', 'Water reading added successfully.');
    }

    public function edit(Water $water)
    {
        return view('water.edit', compact('water'));
    }

    public function update(Request $request, Water $water)
    {
        $request->validate([
            'number' => 'required|numeric',
            'date' => 'required|date',
            'comment' => 'nullable|string',
        ]);

        $water->update($request->all());

        return redirect()->route('water.index')->with('success', 'Water reading updated successfully.');
    }

    public function destroy(Water $water)
    {
        $water->delete();

        return redirect()->route('water.index')->with('success', 'Water reading deleted.');
    }
}
