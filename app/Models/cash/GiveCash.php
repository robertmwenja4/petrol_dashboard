<?php

namespace App\Models\cash;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\pump\Pump;
use App\Models\shift\Shift;

class GiveCash extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id','pump_id',
        'shift_id','amount','tid','approve_note','status'
    ];


    public function pump()
    {
        return $this->belongsTo(Pump::class, 'pump_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }
}
