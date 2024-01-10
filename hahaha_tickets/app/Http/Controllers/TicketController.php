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

    public function addTicket($eventId,Request $request)
    {
        $userId = auth()->user()?->id;
        $quantity = $request->input('quantity', 1);

    if ($eventId && $quantity > 0) {
        for ($i = 0; $i < $quantity; $i++) {
            Ticket::create([
                'user_id' => $userId,
                'event_id' => $eventId
            ]);
        }
    }
    return view('show-all-tickets');
}

public function deleteTicket($id)
{
    $ticket = Ticket::find($id);
    if ($ticket) {
        $ticket->delete();
    }
    return redirect()->route('show-tickets');
}
}
