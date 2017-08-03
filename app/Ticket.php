<?php

namespace App;

use App\Traits\FetchesTicketsByType;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use FetchesTicketsByType;

    protected $fillable = ['ticket_number', 'user_id', 'priority_id',
        'status_id', 'assigned_to', 'subject', 'content', 'is_overdue',
        'is_replied', 'is_closed', 'is_deleted'
    ];

    public function status()
    {
        return $this->belongsTo(TicketStatus::class);
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
