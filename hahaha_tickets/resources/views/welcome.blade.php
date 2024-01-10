@extends('templates\layout')
@section('content')
    <div>
        @foreach ($events as $event)
        @php
            $artist=$artists->where('id', $event->artist_id)->first();
        @endphp
            <p class="event-title">{{ $event->id }} {{ $event->title }} -Artist: {{ $artist->name}}<br>  {{$event->data  }}</p>
            <p><span class="event-desc" style="display: none;">Description: {{ $event->desc }} <br> Location: {{ $event->location }} </span></p>
            <p><button class="more-button" onclick="toggleDescription(this)">More<span class="arrow">&#9660;</span></button></p>
            @if(auth()->check() && auth()->user()->isAdmin())
  
            <form class="option" action="{{ route('events.delete', ['id' => $event->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete Event</button>
            </form>
            <form class="option" action="{{ route('events.edit', ['id' => $event->id]) }}" method="GET">
                @csrf
                <button type="submit">Edit Event</button>
            </form>
            @endif
            <form class="option" action="{{ route('add-ticket',$event->id) }}" method="POST">
                @csrf
                 <input type="number" name="quantity" value="1" min="1">
                <button type="submit">Cumpara</button>

            </form>
              <!-- Admin-specific UI elements -->
            
        @endforeach
    </div>
    <div>
        @if(auth()->check() && auth()->user()->isAdmin())
        <form action="{{ route('new_event') }}" method="GET">
            <button type="submit">Add a new event</button>
        </form>
        @endif
    </div>
    <script>
        function toggleDescription(button) {
            const description = button.parentElement.previousElementSibling.querySelector('.event-desc');
            if (description.style.display === 'none') {
                description.style.display = 'inline';
                button.querySelector('.arrow').innerHTML = '&#9650;'; // Upward arrow
            } else {
                description.style.display = 'none';
                button.querySelector('.arrow').innerHTML = '&#9660;'; // Downward arrow
            }
        }
    </script>
    
@endsection
