<?php

namespace App\Transformers;


use App\Ticket;
use League\Fractal\TransformerAbstract;

class TicketTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Ticket $ticket)
    {
        return [
            'id' => $ticket->id,
            'email' => $ticket->ticket_number,
            'subject' => $ticket->subject,
            'content' => $ticket->content,
            'priority_id' => $ticket->priority_id,
            'status_id' => $ticket->status_id,
            'created_at' => $ticket->created_at->format('Y-m-d H:i:s'),
        ];
    }
}