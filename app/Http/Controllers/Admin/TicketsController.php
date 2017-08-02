<?php

namespace App\Http\Controllers\Admin;

use App\Ticket;
use App\Http\Controllers\Controller;
use App\Transformers\TicketTransformer;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    /**
     * Return all tickets
     *
     * @return array
     */
    public function index()
    {
        return fractal(Ticket::orderBy('created_at', 'DESC')->get(), new TicketTransformer)->toArray();
    }

    /**
     * Get Tickets linked to a user
     *
     * @param User $user
     * @return array
     */
    public function getByUser(User $user)
    {
        return fractal($user->tickets()->get(), new TicketTransformer)->toArray();
    }

    /**
     * Get Ticket stats
     *
     * @param User $user
     * @return array
     */
    public function getTicketStats()
    {
        $startDate = Carbon::now()->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $user = Auth::User();

        return [
            'user_tickets' => $user->tickets()->count(),
            'unassigned' => Ticket::whereNull('assigned_to')->count(),
            'overdue' => Ticket::where('is_overdue', 1)->count(),
            'due_today' => Ticket::whereBetween('created_at', [$startDate, $endDate])->count(),
        ];
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

        $ticket = Ticket::create(request()->only('subject', 'content'));

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
