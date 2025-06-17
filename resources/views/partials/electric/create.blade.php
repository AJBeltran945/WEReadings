<div>
    <form action="{{ route('electric.store') }}" method="POST">
        @csrf

        <div>
            <label for="date">Select a date:</label>
            <input type="date" name="date" id="date" required>
        </div>

        <div>
            <label for="reading">Enter a number:</label>
            <input type="number" name="reading" id="reading" required>
        </div>

        <button type="submit">Submit</button>
    </form>
</div>
