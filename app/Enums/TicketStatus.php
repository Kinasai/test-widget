<?php

namespace App\Enums;

enum TicketStatus: string
{
    case New = 'NEW';
    case InProgress = 'IN_PROGRESS';
    case Processed = 'PROCESSED';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Новый',
            self::InProgress => 'В работе',
            self::Processed => 'Обработан',
        };
    }
}
