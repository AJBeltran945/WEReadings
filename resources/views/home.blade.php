@extends('layout.app')

@section('content')
    <h1>
        Add Your Records:
    </h1>

    <button>
        <a href="{{ route('electric.create') }}">Add Electric Reading</a>
    </button>

    <button>
        <a href="{{ route('water.create') }}">Add Water Reading</a>
    </button>
@endsection
