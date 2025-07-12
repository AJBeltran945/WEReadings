<?php

namespace App\Http\Controllers;

use App\Models\Electric;
use App\Models\Water;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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

        $electricBaseline = 199790;
        $waterBaseline = 7899874;

        if ($request->filled('month')) {
            $month = $request->month;
            $startOfMonth = $month . '-01';

            $electricBaseline = Electric::where('date', '<', $startOfMonth)->orderBy('date', 'desc')->first();
            $waterBaseline = Water::where('date', '<', $startOfMonth)->orderBy('date', 'desc')->first();

            $electricsQuery->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$month]);
            $watersQuery->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$month]);
        }

        if ($request->filled('start_date')) {
            $startDate = $request->start_date;

            if (!$electricBaseline) {
                $electricBaseline = Electric::where('date', '<', $startDate)->orderBy('date', 'desc')->first();
            }
            if (!$waterBaseline) {
                $waterBaseline = Water::where('date', '<', $startDate)->orderBy('date', 'desc')->first();
            }

            $electricsQuery->where('date', '>=', $startDate);
            $watersQuery->where('date', '>=', $startDate);
        }

        if ($request->filled('end_date')) {
            $electricsQuery->where('date', '<=', $request->end_date);
            $watersQuery->where('date', '<=', $request->end_date);
        }

        if ($request->filled('specific_date')) {
            $specific = $request->specific_date;

            $electricBaseline = Electric::where('date', '<', $specific)->orderBy('date', 'desc')->first();
            $waterBaseline = Water::where('date', '<', $specific)->orderBy('date', 'desc')->first();

            $electricsQuery->whereDate('date', $specific);
            $watersQuery->whereDate('date', $specific);
        }

        $electrics = $electricsQuery->orderBy('date')->get();
        $waters = $watersQuery->orderBy('date')->get();

        $januaryElectricBaseline = 199790;
        $januaryWaterBaseline = 7899874;

        $electricReadings = $this->calculateReadings(
            $electrics,
            $electricBaseline instanceof Electric ? $electricBaseline->number : $electricBaseline,
            $januaryElectricBaseline
        );

        $waterReadings = $this->calculateReadings(
            $waters,
            $waterBaseline instanceof Water ? $waterBaseline->number : $waterBaseline,
            $januaryWaterBaseline
        );

        return view('index', [
            'electricReadings' => $electricReadings,
            'waterReadings' => $waterReadings,
            'totalElectricDiff' => $electricReadings->sum('diff'),
            'totalWaterDiff' => $waterReadings->sum('diff'),
            'availableMonths' => $availableMonths,
            'availableDates' => $availableDates,
        ]);
    }

    private function calculateReadings(Collection $readings, $baseline, $januaryBaseline = null): Collection
    {
        $previous = $baseline;
        $first = true;

        return $readings->map(function ($reading) use (&$previous, &$first, $januaryBaseline) {
            if ($first && $januaryBaseline !== null && date('m', strtotime($reading->date)) === '01') {
                $previous = $januaryBaseline;
            }

            $diff = $reading->number - $previous;
            $item = (object)[
                'id' => $reading->id,
                'date' => $reading->date,
                'number' => $reading->number,
                'previous' => $previous,
                'diff' => $diff,
            ];
            $previous = $reading->number;
            $first = false;

            return $item;
        });
    }
}
