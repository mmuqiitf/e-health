<?php

namespace App\Models;

use App\Enum\PaymentMethodEnum;
use App\Enum\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'amount',
        'status',
        'method',
        'card_number',
        'note',
    ];

    protected $casts = [
        'status' => PaymentStatusEnum::class,
        'method' => PaymentMethodEnum::class,
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
