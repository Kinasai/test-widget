<?php

namespace App\Services;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class TicketService
{
    public function createTicket($request): Ticket
    {
        return DB::transaction(function () use ($request) {

            $customer = (new CustomerService())->findOrCreateCustomer($request);

            $ticket = Ticket::query()->create(
                [
                    'customer_id' => $customer->id,
                    'title' => $request['title'],
                    'text' => $request['text'],
                    'status' => TicketStatus::New,
                ]
            );
            if(isset($request['file'])) {
                $ticket->addMediaFromRequest('file')->toMediaCollection('documents');
            }

            return $ticket;
        });
    }

    public function statisticTickets($request)
    {
        return Ticket::query()->period($request)->get();
    }

    public function updateStatus(Ticket $ticket, mixed $validated)
    {
        return $ticket->update($validated);
    }
}
