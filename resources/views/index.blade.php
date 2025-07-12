@extends('layout.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Filter Readings</h1>

    <form action="{{ route('index') }}" method="GET" class="mb-8 space-y-4">

        <!-- Filter by month -->
        <div>
            <label for="month">Filter by Month:</label>
            <select name="month" id="month" class="border rounded px-2 py-1">
                <option value="">-- All Months --</option>
                @foreach($availableMonths as $month)
                    <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::parse($month . '-01')->format('F Y') }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filter by date interval -->
        <div>
            <label for="start_date">From (Date Interval):</label>
            <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="border rounded px-2 py-1">
        </div>
        <div>
            <label for="end_date">To (Date Interval):</label>
            <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="border rounded px-2 py-1">
        </div>

        <!-- Filter by specific date -->
        <div>
            <label for="specific_date">Specific Date:</label>
            <select name="specific_date" id="specific_date" class="border rounded px-2 py-1">
                <option value="">-- All Dates --</option>
                @foreach($availableDates as $date)
                    <option value="{{ $date }}" {{ request('specific_date') == $date ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::parse($date)->format('m.d.Y') }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Apply Filters</button>
    </form>

    <h1 class="text-2xl font-bold mb-4">Electric Readings</h1>
    <table class="w-full table-auto border-collapse border border-gray-400 mb-10">
        <thead>
        <tr class="bg-gray-200">
            <th class="border border-gray-300 px-4 py-2">Date</th>
            <th class="border border-gray-300 px-4 py-2">Reading</th>
            <th class="border border-gray-300 px-4 py-2">Actions</th> <!-- Nueva columna -->
        </tr>
        </thead>
        <tbody>
        @foreach($electrics as $electric)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($electric->date)->format('m.d.Y') }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ number_format($electric->number) }}</td>
                <td class="border border-gray-300 px-4 py-2 flex gap-2">
                    <!-- Botón Editar -->
                    <a href="{{ route('electric.edit', $electric->id) }}" class="text-blue-600 hover:underline">Edit</a>

                    <!-- Botón Eliminar -->
                    <form action="{{ route('electric.destroy', $electric->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        <!-- Total row -->
        <tr class="bg-gray-100 font-bold">
            <td class="border border-gray-300 px-4 py-2 text-right">Total Difference:</td>
            <td class="border border-gray-300 px-4 py-2">
                {{ number_format($electrics->last()->number - $electrics->first()->number) }}
            </td>
            <td class="border border-gray-300 px-4 py-2"></td>
        </tr>
        </tbody>
    </table>


    <h1 class="text-2xl font-bold mb-4">Water Readings</h1>
    <table class="w-full table-auto border-collapse border border-blue-400">
        <thead>
        <tr class="bg-blue-200">
            <th class="border border-blue-300 px-4 py-2">Date</th>
            <th class="border border-blue-300 px-4 py-2">Reading</th>
            <th class="border border-blue-300 px-4 py-2">Actions</th> <!-- Nueva columna -->
        </tr>
        </thead>
        <tbody>
        @foreach($waters as $water)
            <tr>
                <td class="border border-blue-300 px-4 py-2">{{ \Carbon\Carbon::parse($water->date)->format('m.d.Y') }}</td>
                <td class="border border-blue-300 px-4 py-2">{{ number_format($water->number) }}</td>
                <td class="border border-blue-300 px-4 py-2 flex gap-2">
                    <!-- Botón Editar -->
                    <a href="{{ route('water.edit', $water->id) }}" class="text-blue-600 hover:underline">Edit</a>

                    <!-- Botón Eliminar -->
                    <form action="{{ route('water.destroy', $water->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        <tr class="bg-gray-100 font-bold">
            <td class="border border-gray-300 px-4 py-2 text-right">Total Difference:</td>
            <td class="border border-gray-300 px-4 py-2">
                {{ number_format($waters->last()->number - $electrics->first()->number) }}
            </td>
            <td class="border border-gray-300 px-4 py-2"></td>
        </tr>
        </tbody>
    </table>


@endsection
