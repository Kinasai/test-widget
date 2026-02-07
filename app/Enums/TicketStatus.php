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

    public static function forSelect(): array
    {
        $result = [];
        foreach (self::cases() as $status) {
            $result[$status->value] = $status->label();
        }
        return $result;
    }
}
