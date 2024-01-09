@extends('templates\layout')
@section('content')
<div>
    <div id="csrfTokenElement" data-csrf-token="{{ csrf_token() }}"></div>


    @php
        $events = App\Models\Event::all();
    @endphp

    <button id="addTicketBtn" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add ticket</button>

    <select id="tickets" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option selected>Choose an event</option>
    @foreach($events ?? [] as $event)
    <option value="{{$event->id}}">{{$event->title}}</option>
    @endforeach  
    </select>

    <div style="width: 100%; display:flex; justify-content: center">
        
    <ul>
    @forelse(auth()->user()->tickets ?? [] as $ticket)
        <li>    
        
        <div style="width: 50%">
            {{ $ticket->event->title }}
            {{ $ticket->event->price }}
            {{ $ticket->event->desc }}
            {{ $ticket->event->data }}
            {{ $ticket->event->location }}
            <button id="deleteTicketBtn" data-id="{{$ticket->id}}" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
            </button>

            <button id="payTicketBtn" data-id="{{$ticket->id}}" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Pay</button>
            </button>

            <button id="cancelPayTicketBtn" data-id="{{$ticket->id}}"  style="display:none" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Cancel</button>
            </button>

            <div style="display: none" id="payment-form" data-id="{{$ticket->id}}" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full mt-3">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="p-4 md:p-5 space-y-4">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Card number</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Card number">
                            </div>

                            <div class="form-group mt-2">
                                <label for="exampleInputEmail1">Expiration date</label>
                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Expiration date">
                            </div>

                            <div class="form-group mt-2">
                                <label for="exampleInputEmail1">CVC</label>
                                <input type="email" class="form-control" id="exampleInputEmail3" placeholder="CVC">
                            </div>

                            <div class="d-flex justify-center w-100 mt-4"> 
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <p>No tickets</p>
</li>
        @endforelse
</ul>
    </div>

<script>
   
    var addTicketRoute = '{{ route("add-ticket") }}';
    var deleteTicketRoute = '{{ route("delete-ticket") }}';

    document.addEventListener('DOMContentLoaded', function () {
    var payTicketBtns = document.querySelectorAll('[id^="payTicketBtn"]');
    var cancelPayTicketBtns = document.querySelectorAll('[id^="cancelPayTicketBtn"]');
    
    payTicketBtns.forEach(function(payBtn) {
        payBtn.addEventListener('click', function () {
                var ticketId = payBtn.getAttribute('data-id');
                var paymentForm = document.querySelector('#payment-form[data-id="' + ticketId + '"]');
                var cancelBtn = document.querySelector('#cancelPayTicketBtn[data-id="' + ticketId + '"]');
                
                paymentForm.style.display = 'block';
                payBtn.style.display = 'none';
                cancelBtn.style.display = 'block';                
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
    var cancelPayTicketBtns = document.querySelectorAll('[id^="cancelPayTicketBtn"]');
    
        cancelPayTicketBtns.forEach(function(cancelBtn) {
            cancelBtn.addEventListener('click', function () {
                var ticketId = cancelBtn.getAttribute('data-id');
                var paymentForm = document.querySelector('#payment-form[data-id="' + ticketId + '"]');
                var payBtn = document.querySelector('#payTicketBtn[data-id="' + ticketId + '"]');
                
                if (paymentForm && payBtn) {
                    paymentForm.style.display = 'none';
                    payBtn.style.display = 'block';
                    cancelBtn.style.display = 'none';
                }
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
        var addTicketBtn = document.getElementById('addTicketBtn');
        var csrfTokenElement = document.getElementById('csrfTokenElement');
        var csrfToken = csrfTokenElement ? csrfTokenElement.getAttribute('data-csrf-token') : null;
    
        addTicketBtn.addEventListener('click', function () {
        var eventId = document.getElementById('tickets').value;

        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    window.location.reload();
                    console.log(xhr.responseText);
                } else {
                    console.error('Error:', xhr.status);
                }
            }
        };

        xhr.open('POST', addTicketRoute);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-Token', csrfToken);
        var data = JSON.stringify({ eventId: eventId });
        xhr.send(data);
        });
    
        var deleteTicketBtns = document.querySelectorAll('[id^="deleteTicketBtn"]');
    
        deleteTicketBtns.forEach(function(deleteBtn) {
            deleteBtn.addEventListener('click', function () {
                var ticketId = deleteBtn.getAttribute('data-id');

                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            window.location.reload();
                            console.log('Ticket deleted successfully');
                        } else {
                            console.error('Error:', xhr.status);
                        }
                    }
                };

                xhr.open('POST', deleteTicketRoute);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-Token', csrfToken);
                var data = JSON.stringify({ ticketId: ticketId });
                xhr.send(data);
            });
        });
    });

</script>

</div>

@endsection