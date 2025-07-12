<div>
    <form action="{{ route('electric.update', $electric->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="date">Select a date:</label>
            <input
                type="date"
                name="date"
                id="date"
                value="{{ old('date', \Carbon\Carbon::parse($electric->date)->format('Y-m-d')) }}"
                required
            >
            @error('date')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>


        <div>
            <label for="reading">Enter electric reading:</label>
            <input type="number" name="reading" id="reading" value="{{ old('reading', $electric->number) }}" required>
            @error('reading')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="comment">Comment (optional):</label>
            <input type="text" name="comment" id="comment" value="{{ old('comment', $electric->comment) }}" placeholder="Add a note (optional)">
        </div>

        <button type="submit">Update</button>
    </form>
</div>
