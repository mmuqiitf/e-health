<?php

namespace App\Enum;

enum PaymentMethodEnum: string
{
    // 'Cash', 'Debit', 'Credit'
    case Cash = 'Cash';
    case Debit = 'Debit';
    case Credit = 'Credit';
}
