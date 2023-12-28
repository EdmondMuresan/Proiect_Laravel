@extends('templates\layout')
@section('content')
    <div>
        <h2>Add a New Artist</h2>
        <form method="POST" action="{{route("new_artist") }}">
            @csrf <!-- Laravel CSRF protection token -->
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            
            <label for="phone_number">Phone number:</label>
            <input type="text" id="phone_number" name="phone_number" required><br><br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required><br><br>

            <label for="salary">Salary:</label>
            <input type="number" id="salary" name="salary" required><br><br>
            
            <button type="submit" value="Submit">Add</button>
        </form>
    </div>
@endsection
