<?php

namespace App\Http\Controllers\Admin;

use App\TicketPriority;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\TicketPriorityTransformer;

class TicketPrioritiesController extends Controller
{
    public function index()
    {
        $priorities = TicketPriority::get();

        return fractal($priorities, new TicketPriorityTransformer)->toArray();
    }
}
