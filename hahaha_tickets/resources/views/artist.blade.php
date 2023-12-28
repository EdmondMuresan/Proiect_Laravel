@extends('templates\layout')
@section('content')
<div>
@foreach ($artists as $artist)
    <p>{{ $artist->id }} {{ $artist->name }}</p>
    <p><span class="artist-desc" style="display: none;">Phone: {{ $artist->phone_number }} <br> Email: {{ $artist->email }} <br> Salary: {{$artist->salary }}</span></p>
    <p><button class="more-button" onclick="toggleDescription(this)">More<span class="arrow">&#9660;</span></button></p>
    <form class="option" action="{{ route('artist.delete', ['id' => $artist->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Artist</button>
    </form>
    <form class="option" action="{{ route('artist.edit', ['id' => $artist->id]) }}" method="GET">
        @csrf
        <button type="submit">Edit Artist</button>
    </form>
@endforeach
</div>
<div>
    <div>
        <form action="{{ route('add_artist') }}" method="GET">
            <button type="submit">Add a new Artist</button>
        </form>
    </div>
    <script>
        function toggleDescription(button) {
            const description = button.parentElement.previousElementSibling.querySelector('.artist-desc');
            if (description.style.display === 'none') {
                description.style.display = 'inline';
                button.querySelector('.arrow').innerHTML = '&#9650;'; // Upward arrow
            } else {
                description.style.display = 'none';
                button.querySelector('.arrow').innerHTML = '&#9660;'; // Downward arrow
            }
        }
    </script>
</div>
@endsection