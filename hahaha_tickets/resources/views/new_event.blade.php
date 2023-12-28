@extends('templates\layout')
@section('content')
    <div>
        <h2>Create a New Event</h2>
        <form method="POST" action="{{route("save_event") }}">
            @csrf <!-- Laravel CSRF protection token -->
            
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br><br>
            
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required><br><br>
            
            <label for="desc">Description:</label>
            <input type="text" id="desc" name="desc" required><br><br>
            
            <label for="data">Date:</label>
            <input type="date" id="data" name="data" required><br><br>
            
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required><br><br>

            <label for="artist_id">Select Artist:</label>
            <select id="artist_id" name="artist_id">
                @foreach ($artists as $artist)
                    <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                @endforeach
            </select><br><br>
            <button type="submit" value="Submit">Add</button>
        </form>
    </div>
@endsection
