<div>
    <form action="{{ route('water.update', $water) }}" method="POST">
        @csrf

        <div>
            <label for="date">Select a date:</label>
            <input type="date" name="date" id="date" value="{{ \Carbon\Carbon::now()->toDateString() }}" required>
            @error('date')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="reading">Enter water readings for today:</label>
            <input type="number" name="reading" id="reading" required>
            @error('reading')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="comment">Comment (optional):</label>
            <input type="text" name="comment" id="comment" placeholder="Add a note (optional)">
        </div>

        <button type="submit">Submit</button>
    </form>
</div>
