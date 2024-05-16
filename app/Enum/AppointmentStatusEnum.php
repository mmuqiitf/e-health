<?php

namespace App\Enum;

enum AppointmentStatusEnum: string
{
    // 'Waiting', 'Approved', 'Rejected', 'Cancel'
    case Waiting = 'Waiting';
    case Approved = 'Approved';
    case Rejected = 'Rejected';
    case Cancel = 'Cancel';
}
