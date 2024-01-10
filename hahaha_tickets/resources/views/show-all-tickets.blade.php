@extends('templates\layout')
@section('content')
@if(!auth()->user())
<p>Creaza cont sau autentifica-te pentru a cumpara bilet</p>
@endif
<div>
    <div id="csrfTokenElement" data-csrf-token="{{ csrf_token() }}"></div>

    @php
        $events = App\Models\Event::all();
    @endphp

    <div style="width: 100%; display:flex; justify-content: center">
        <ul>
            @forelse(auth()->user()->tickets ?? [] as $ticket)
                <li>
                    <div style="width: 100%">
                        Titlu:{{ $ticket->event->title }} <br>
                        Pret:{{ $ticket->event->price }} RON <br>
                        Descriere:{{ $ticket->event->desc }} <br>
                        Data:{{ $ticket->event->data }} <br>
                        Locatia:{{ $ticket->event->location }}<br>
                        <form action="{{ route('deleteTicket', $ticket->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete ticket</button>
                        </form>
                        
                        <button id="payTicketBtn_{{$ticket->id}}" data-id="{{$ticket->id}}" type="button" class="pay-ticket-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Pay</button>
                        <button id="cancelPayTicketBtn_{{$ticket->id}}" data-id="{{$ticket->id}}" style="display:none" type="button" class="cancel-pay-ticket-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Cancel</button>
                        <div style="display: none" id="payment-form_{{$ticket->id}}" data-id="{{$ticket->id}}" class="payment-form overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full mt-3">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="p-4 md:p-5 space-y-4">
                                        <form>
                                            <div class="form-group">
                                                <label for="cardNumber_{{$ticket->id}}">Card number</label>
                                                <input type="text" class="form-control" id="cardNumber_{{$ticket->id}}" placeholder="Card number">
                                            </div>

                                            <div class="form-group mt-2">
                                                <label for="expirationDate_{{$ticket->id}}">Expiration date</label>
                                                <input type="text" class="form-control" id="expirationDate_{{$ticket->id}}" placeholder="Expiration date">
                                            </div>

                                            <div class="form-group mt-2">
                                                <label for="cvc_{{$ticket->id}}">CVC</label>
                                                <input type="text" class="form-control" id="cvc_{{$ticket->id}}" placeholder="CVC">
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
                </li>
            @empty
                <p>No tickets</p>
            @endforelse
        </ul>
    </div>

    <script>
        var csrfToken = document.getElementById('csrfTokenElement').getAttribute('data-csrf-token');

        document.addEventListener('DOMContentLoaded', function () {
            var payTicketBtns = document.querySelectorAll('.pay-ticket-btn');
            var cancelPayTicketBtns = document.querySelectorAll('.cancel-pay-ticket-btn');
            var paymentForms = document.querySelectorAll('.payment-form');

    

            payTicketBtns.forEach(function (payBtn) {
                payBtn.addEventListener('click', function () {
                    var ticketId = payBtn.getAttribute('data-id');
                    var paymentForm = document.querySelector('#payment-form_' + ticketId);
                    var cancelBtn = document.querySelector('#cancelPayTicketBtn_' + ticketId);

                    paymentForm.style.display = 'block';
                    payBtn.style.display = 'none';
                    cancelBtn.style.display = 'block';
                });
            });

            cancelPayTicketBtns.forEach(function (cancelBtn) {
                cancelBtn.addEventListener('click', function () {
                    var ticketId = cancelBtn.getAttribute('data-id');
                    var paymentForm = document.querySelector('#payment-form_' + ticketId);
                    var payBtn = document.querySelector('#payTicketBtn_' + ticketId);

                    if (paymentForm && payBtn) {
                        paymentForm.style.display = 'none';
                        payBtn.style.display = 'block';
                        cancelBtn.style.display = 'none';
                    }
                });
            });
        });
    </script>

</div>

@endsection
