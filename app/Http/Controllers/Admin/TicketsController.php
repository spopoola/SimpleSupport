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
            'subject' => 'required|',
            'content' => 'required',
        ]);

        $newTicketRequest = request()->only('subject', 'content');

        $newTicket = array_merge(
            $newTicketRequest,
            ['ticket_number' => app(UniqueIDGeneration::class)->generate()]
        );

        $ticket = $this->ticket->create($newTicket);

        return [
            "success" => "You have created a new Ticket!",
            "data" => [
                "ticket" => $ticket,
            ]
        ];
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
            'subject' => 'required|',
            'content' => 'required',
        ]);

        $ticket->update(request()->only('subject', 'content'));

        return [
            "success" => "You have updated ticket {$ticket->ticket_number}",
            "data" => [
                "ticket" => $ticket,
            ]
        ];
    }
}
