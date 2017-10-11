<?php

namespace App\Http\Controllers\Admin;

use App\Generators\UniqueIDGeneration;
use App\Ticket;
use App\Http\Controllers\Controller;
use App\Transformers\TicketTransformer;

class TicketsController extends Controller
{
    /**
     * @var Ticket Instance of Ticket
     */
    private $ticket;

    public function __construct(Ticket $ticket)
    {

        $this->ticket = $ticket;
    }
    /**
     * Return all tickets
     *
     * @return array
     */
    public function index()
    {
        return fractal($this->ticket->orderBy('created_at', 'DESC')->get(), new TicketTransformer)->toArray();
    }

    /**
     * Return Tickets by Type
     *
     * @param $type
     * @return array
     */
    public function getByType($type)
    {
        return fractal($this->ticket->getTickets($type), new TicketTransformer)->toArray();
    }

    /**
     * Get Ticket stats
     *
     * @return array
     */
    public function getTicketStats()
    {
        return $this->ticket->getStats();
    }

    /**
     * Return Ticket by ID
     *
     * @param Ticket $ticket
     * @return array
     */
    public function show(Ticket $ticket)
    {
        return fractal($ticket, new TicketTransformer)->toArray();
    }

    /**
     * Store a new Ticket instance
     *
     * @return array
     */
    public function store()
    {
        $this->validate(request(), [
            'subject' => 'required',
            'content' => 'required',
            'priority_id' => 'required',
        ]);

        $newTicketRequest = request()->only('subject', 'content', 'priority_id');

        $newTicket = array_merge(
            $newTicketRequest,
            ['ticket_number' => app(UniqueIDGeneration::class)->generate()]
        );

        $ticket = $this->ticket->create($newTicket);

        $ticketData = fractal($ticket, new TicketTransformer)->toArray();
        $ticketData['success'] = "You have created a new Ticket!";

        return $ticketData;
    }

    /**
     * Update an exiting Ticket
     *
     * @param Ticket $ticket
     * @return array
     */
    public function update(Ticket $ticket)
    {
        $this->validate(request(), [
            'subject' => 'required',
            'content' => 'required',
            'priority_id' => 'required',
        ]);

        $ticket->update(request()->only('subject', 'content', 'priority_id'));
        
        $ticketData = fractal($ticket, new TicketTransformer)->toArray();
        $ticketData['success'] = "You have updated ticket {$ticket->ticket_number}";

        return $ticketData;
    }

    /**
     * Delete a Ticket
     *
     * @param Ticket $ticket
     * @return array
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return ["success" => "Ticket ID " . str_plural($ticket->ticket_number) . " deleted!"];
    }
}
