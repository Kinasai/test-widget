<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone_number'
    ];

    protected function casts(): array
    {
        return [
            'phone_number' => E164PhoneNumberCast::class
        ];
    }

    protected function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
