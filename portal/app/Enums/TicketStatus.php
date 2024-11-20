<?php
namespace App\Enums;

enum TicketStatus: string {
    case EQUIPMENT_RELATED = 'equipment_related';
    case OTHERS = 'others';
}