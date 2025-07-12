@extends('layout.app')

@section('content')
    <div class="max-w-md mx-auto p-4 bg-white rounded-lg shadow mt-6">
        <form action="{{ route('water.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Select a date:</label>
                <input type="date" name="date" id="date" value="{{ \Carbon\Carbon::now()->toDateString() }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-green-300">
                @error('date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="reading" class="block text-sm font-medium text-gray-700 mb-1">Enter water readings for today:</label>
                <input type="number" name="reading" id="reading" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-green-300">
                @error('reading')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Comment (optional):</label>
                <input type="text" name="comment" id="comment" placeholder="Add a note (optional)"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-green-300">
            </div>

            <div>
                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md transition">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection
