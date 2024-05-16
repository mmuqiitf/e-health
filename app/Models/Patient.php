<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'medical_record_id',
        'nik',
        'birth_place',
        'birthday',
        'gender',
        'address',
        'religion',
        'email',
        'phone',
    ];

    protected $casts = [
        'birthday' => 'date',
    ];
}
