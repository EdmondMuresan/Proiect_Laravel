<?php

namespace App\Services\TicketService;

class TicketService
{
    public function delete($ticketId)
    {
        Ticket::destroy($ticketId);
    }
}