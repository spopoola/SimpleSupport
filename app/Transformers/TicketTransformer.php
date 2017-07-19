<?php

namespace App\Transformers;


use App\Ticket;
use App\Transformers\TicketPriorityTransformer;
use App\Transformers\TicketStatusTransformer;
use League\Fractal\TransformerAbstract;

class TicketTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'status',
        'priority',
    ];

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

    /**
     * Include Status
     *
     * @return League\Fractal\ItemResource
     */
    public function includeStatus(Ticket $ticket)
    {
        $status = $ticket->status;

        return $this->item($status, new TicketStatusTransformer);
    }


    /**
     * Include Priority
     *
     * @return League\Fractal\ItemResource
     */
    public function includePriority(Ticket $ticket)
    {
        $priority = $ticket->priority;

        return $this->item($priority, new TicketPriorityTransformer);
    }
}