<?php

namespace App\Enums;

enum TicketStatus: string
{
    case New = 'NEW';
    case InProgress = 'IN_PROGRESS';
    case Processed = 'PROCESSED';
}
