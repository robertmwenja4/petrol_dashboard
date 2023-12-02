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
        'user_id','pump_id','cash_given_by',
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
    public function given_by()
    {
        return $this->belongsTo(User::class, 'cash_given_by');
    }
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }
}
