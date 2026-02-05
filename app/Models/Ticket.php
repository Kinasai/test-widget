<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'customer_id',
        'title',
        'text',
        'status',
        'response_date'
    ];

    protected function casts(): array
    {
        return [
            'status' => TicketStatus::class
        ];
    }
}
