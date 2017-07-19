<?php

namespace App\Transformers;


use App\TicketStatus;
use League\Fractal\TransformerAbstract;

class TicketStatusTransformer extends TransformerAbstract
{
    public function transform(TicketStatus $status)
    {
        return [
            'name' => $status->name,
            'color' => $status->color
        ];
    }
}