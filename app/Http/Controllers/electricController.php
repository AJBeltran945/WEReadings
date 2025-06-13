<?php

namespace App\Http\Controllers;

use App\Models\Electric;
use Illuminate\Http\Request;

class electricController extends Controller
{
    public function index()
    {
        $electrics = Electric::orderByDesc('date')->get();
        return view('electric.index', compact('electrics'));
    }

    public function create()
    {
        return view('electric.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|numeric',
            'date' => 'required|date',
            'comment' => 'nullable|string',
        ]);

        Electric::create($request->all());

        return redirect()->route('electric.index')->with('success', 'Electric reading added successfully.');
    }

    public function edit(Electric $electric)
    {
        return view('electric.edit', compact('electric'));
    }

    public function update(Request $request, Electric $electric)
    {
        $request->validate([
            'number' => 'required|numeric',
            'date' => 'required|date',
            'comment' => 'nullable|string',
        ]);

        $electric->update($request->all());

        return redirect()->route('electric.index')->with('success', 'Electric reading updated successfully.');
    }

    public function destroy(Electric $electric)
    {
        $electric->delete();

        return redirect()->route('electric.index')->with('success', 'Electric reading deleted.');
    }
}
