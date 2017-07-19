<?php

namespace App\Transformers;


use App\TicketPriority;
use League\Fractal\TransformerAbstract;

class TicketPriorityTransformer extends TransformerAbstract
{
    public function transform(TicketPriority $priority)
    {
        return [
            'name' => $priority->name,
            'color' => $priority->color
        ];
    }
}