<?php

namespace App\Http\Controllers;

use App\Models\Electric;
use App\Models\Water;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index(Request $request)
    {
        $electricMonths = Electric::selectRaw("DATE_FORMAT(date, '%Y-%m') as month")->distinct()->pluck('month')->toArray();
        $waterMonths = Water::selectRaw("DATE_FORMAT(date, '%Y-%m') as month")->distinct()->pluck('month')->toArray();
        $availableMonths = array_unique(array_merge($electricMonths, $waterMonths));
        sort($availableMonths);

        $electricDates = Electric::select('date')->distinct()->pluck('date')->toArray();
        $waterDates = Water::select('date')->distinct()->pluck('date')->toArray();
        $availableDates = array_unique(array_merge($electricDates, $waterDates));
        sort($availableDates);

        $electricsQuery = Electric::query();
        $watersQuery = Water::query();

        if ($request->filled('month')) {
            $month = $request->month;
            $electricsQuery->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$month]);
            $watersQuery->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$month]);
        }

        if ($request->filled('start_date')) {
            $electricsQuery->where('date', '>=', $request->start_date);
            $watersQuery->where('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $electricsQuery->where('date', '<=', $request->end_date);
            $watersQuery->where('date', '<=', $request->end_date);
        }

        if ($request->filled('specific_date')) {
            $electricsQuery->whereDate('date', $request->specific_date);
            $watersQuery->whereDate('date', $request->specific_date);
        }

        $electrics = $electricsQuery->orderByDesc('date')->get();
        $waters = $watersQuery->orderByDesc('date')->get();

        return view('index', compact('electrics', 'waters', 'availableMonths', 'availableDates'));
    }

}
