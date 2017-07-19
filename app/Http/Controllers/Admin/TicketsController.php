<?php

namespace App\Http\Controllers\Admin;

use App\Ticket;
use App\Http\Controllers\Controller;
use App\Transformers\TicketTransformer;

class TicketsController extends Controller
{
    public function index()
    {
        return fractal(Ticket::orderBy('created_at', 'DESC')->get(), new TicketTransformer)->toArray();
    }
}
