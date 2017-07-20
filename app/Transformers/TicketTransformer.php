<?php

namespace App\Transformers;


use App\Ticket;
use App\Transformers\TicketPriorityTransformer;
use App\Transformers\TicketStatusTransformer;
use App\User;
use League\Fractal\TransformerAbstract;

class TicketTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'status',
        'priority',
        'user',
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
            'ticket_number' => $ticket->ticket_number,
            'agent' => $ticket->user_id,
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
     * @param Ticket $ticket
     * @return \League\Fractal\Resource\Item
     */
    public function includeStatus(Ticket $ticket)
    {
        $status = $ticket->status;

        return $this->item($status, new TicketStatusTransformer);
    }


    /**
     * Include Priority
     *
     * @param Ticket $ticket
     * @return \League\Fractal\Resource\Item
     */
    public function includePriority(Ticket $ticket)
    {
        $priority = $ticket->priority;

        return $this->item($priority, new TicketPriorityTransformer);
    }

    /**
     * Include User
     *
     * @param Ticket $ticket
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Ticket $ticket)
    {
        $user = $ticket->user;

        if (! is_null($user)) {
            return $this->item($user, new UserTransformer);
        }

        return null;
    }
}