<?php

namespace App\Traits;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait FetchesTicketsByType
{
    /**
     * Fetch Tickets by Type
     *
     * @param $type
     * @return null
     */
    public function getTickets($type)
    {
        $tickets = null;

        switch ($type) {
            case 'user':
                $user = Auth::User();
                $tickets = $user->tickets()->get();
                break;
            case 'unassigned':
                $tickets = $this->whereNull('assigned_to')->get();
                break;
            case 'overdue':
                $tickets = $this->where('is_overdue', 1)->get();
                break;

            case 'due_today':
                $startDate = Carbon::now()->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                $tickets = $this->whereBetween('created_at', [$startDate, $endDate]);
                break;
            default:
                $tickets = $this->whereNull('assigned_to')->get();
                break;
        }

        return $tickets;
    }

    /**
     * Get Ticket Statistics
     *
     * @return array
     */
    public function getStats()
    {
        $startDate = Carbon::now()->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $user = Auth::User();

        return [
            'user_tickets' => $user->tickets()->count(),
            'unassigned' => $this->whereNull('assigned_to')->count(),
            'overdue' => $this->where('is_overdue', 1)->count(),
            'due_today' => $this->whereBetween('created_at', [$startDate, $endDate])->count(),
        ];
    }
}