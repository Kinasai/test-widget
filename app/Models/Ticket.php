<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory, Notifiable, InteractsWithMedia;

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
    #[Scope]
    public function filter(Builder $query, array $filters)
    {

        $date = Carbon::now();

        match ($filters['period']){
            'day' => $query->whereDate('created_at', $date),
            'week' => $query->whereBetween('created_at', [$date->copy()->startOfWeek(), $date->copy()->endOfWeek()]),
            'month' => $query->whereBetween('created_at', [$date->copy()->startOfMonth(), $date->copy()->endOfMonth()])
        };
    }
}
