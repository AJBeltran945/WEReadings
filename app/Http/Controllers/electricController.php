<?php

namespace App\Http\Controllers;

use App\Models\Electric;
use Illuminate\Http\Request;

class electricController extends Controller
{
    public function create()
    {
        return view('electric.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|before_or_equal:today',
            'reading' => 'required|numeric',
            'comment' => 'nullable|string',
        ]);

        Electric::create([
            'date' => $request->date,
            'number' => $request->reading,
            'comment' => $request->comment,
        ]);

        return redirect()->route('home')->with('success', 'Electric reading added successfully.');
    }

    public function edit(Electric $electric)
    {
        return view('partials.electric.edit', compact('electric'));
    }

    public function update(Request $request, Electric $electric)
    {
        $request->validate([
            'date' => 'required|date',
            'reading' => 'required|numeric',
            'comment' => 'nullable|string',
        ]);

        $electric->update([
            'date' => $request->date,
            'number' => $request->reading,
            'comment' => $request->comment,
        ]);

        return redirect()->route('index')->with('success', 'Electric reading updated successfully.');
    }

    public function destroy(Electric $electric)
    {
        $electric->delete();

        return redirect()->route('index')->with('success', 'Electric reading deleted.');
    }
}
