@extends('templates\layout')
@section('content')
    <div>
        <h2>Edit Artist</h2>
        <form method="POST" action="{{ route('artist.update', ['id' => $artist->id]) }}">
            @csrf <!-- Laravel CSRF protection token -->
            @method('PUT')

            <label for="name">Name:</label>
            <input type="text" id="name" name="name"  value="{{$artist->name}}" required><br><br>
            
            <label for="phone_number">Phone number:</label>
            <input type="text" id="phone_number" name="phone_number"  value="{{$artist->phone_number}}" required><br><br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="{{$artist->email}}" required><br><br>

            <label for="salary">Salary:</label>
            <input type="number" id="salary" name="salary" value="{{$artist->salary}}" required><br><br>
            
            <button type="submit" value="Update">Update</button>

        </form>
    </div>
@endsection
