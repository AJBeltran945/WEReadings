@extends('layout.app')

@section('content')
    <h1 class="text-xl sm:text-2xl font-bold mb-4 text-gray-800 text-center">
        Add Your Records:
    </h1>

    <div class="flex flex-col sm:flex-row sm:flex-wrap sm:justify-center gap-4 items-center">
        <a href="{{ route('electric.create') }}"
           class="w-64 text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded shadow">
            Add Electric Reading
        </a>

        <a href="{{ route('water.create') }}"
           class="w-64 text-center bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded shadow">
            Add Water Reading
        </a>
    </div>

    <div class="flex justify-center py-4">
        <a href="{{ route('index') }}"
           class="w-64 text-center bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded shadow">
            Show Readings
        </a>
    </div>


@endsection
