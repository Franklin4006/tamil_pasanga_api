<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileOtp extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile_number',
        'otp_value',
        'expires_at'
    ];
}
