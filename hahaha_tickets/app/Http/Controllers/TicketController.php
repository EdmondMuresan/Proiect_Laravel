<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function showTickets()
    {
        return view('show-all-tickets');
    }

    public function addTicket(Request $request)
    {
        $eventId = $request->input('eventId');

        $userId = auth()->user()?->id;

        if($eventId){
            Ticket::create([
                'user_id' => $userId,
                'event_id' => $eventId
            ]);
        }
    
    }

    public function deleteTicket(Request $request)
    {
        $ticketId = $request->input('ticketId');

        Ticket::destroy($ticketId);
    
    }
}
