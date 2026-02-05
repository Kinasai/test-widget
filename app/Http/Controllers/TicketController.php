<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Http\Requests\TicketStatisticRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TicketResource::collection(Ticket::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('widget');
    }


    public function statistics(TicketStatisticRequest $request)
    {
        $validated = $request->validated();

        $ticketService = new TicketService;

        return TicketResource::collection($ticketService->statisticTickets($validated));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        $validated = $request->validated();

        $ticketService = new TicketService;

        return TicketResource::make($ticketService->createTicket($validated));

    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
