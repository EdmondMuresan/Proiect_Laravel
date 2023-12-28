@extends('templates\layout')
@section('content')
    <div>
        <h2>Edit Event</h2>
        <form method="POST" action="{{ route('events.update', ['id' => $event->id]) }}">
            @csrf
            @method('PUT') <!-- Use PUT method for update -->
            
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ $event->title }}" required><br><br>
            
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="{{ $event->price }}" required><br><br>
            
            <label for="desc">Description:</label>
            <input type="text" id="desc" name="desc" value="{{ $event->desc }}" required><br><br>
            
            <label for="data">Date:</label>
            <input type="date" id="data" name="data" value="{{ $event->data }}" required><br><br>
            
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" value="{{ $event->location }}" required><br><br>

            <label for="location">Artist:</label>
            <select id="artist_id" name="artist_id">
                @foreach ($artists as $artist)
                    <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                @endforeach
            </select><br><br>

            <button type="submit" value="Update">Update</button>
        </form>
    </div>
@endsection