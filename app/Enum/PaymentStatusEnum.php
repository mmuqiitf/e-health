<?php

namespace App\Enum;

enum PaymentStatusEnum: string
{
    // 'Pending', 'Success', 'Failed'
    case Pending = 'Pending';
    case Success = 'Success';
    case Failed = 'Failed';
}
