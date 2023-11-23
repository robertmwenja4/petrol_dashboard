<?php

namespace App\Models\cash;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiveCash extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id','pump_id',
        'shift_id','amount','tid'
    ];
}
