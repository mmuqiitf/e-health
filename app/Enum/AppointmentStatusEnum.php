<?php

namespace App\Enum;

enum AppointmentStatusEnum: string
{
    case Waiting = 'Waiting';
    case Approved = 'Approved';
    case Rejected = 'Rejected';
    case Cancel = 'Cancel';
}
