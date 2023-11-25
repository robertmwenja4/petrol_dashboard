<?php

namespace App\Models\shift;

use App\Models\User;
use App\Models\shift\ShiftItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\pump\Pump;
use App\Models\shift\CloseShift;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_name', 'created_by', 'status', 'end_date', 'allocated_by', 'closed_by'
    ];

    public function items()
    {
        return $this->hasMany(ShiftItem::class);
    }
    public function close_shift()
    {
        return $this->hasOne(CloseShift::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function pump()
    {
        return $this->belongsTo(Pump::class, 'pump_id');
    }
}
