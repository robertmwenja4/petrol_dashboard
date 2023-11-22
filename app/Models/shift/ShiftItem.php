<?php

namespace App\Models\shift;

use App\Models\pump\Pump;
use App\Models\shift\Shift;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShiftItem extends Model
{
    use HasFactory;

    protected $fillable = ['shift_id', 'pump_id', 'user_id', 'status'];


    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    public function pump()
    {
        return $this->belongsTo(Pump::class, 'pump_id');
    }
}
