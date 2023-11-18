<?php

namespace App\Models\user_allocation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\pump\Pump;
use App\Models\shift\ShiftItem;

class UserAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "shift_id", "pump_id", "status"
    ];

    /**
     * Dates
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Guarded fields of model
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function pump()
    {
        return $this->belongsTo(Pump::class, 'pump_id');
    }
    public function shift()
    {
        return $this->belongsTo(ShiftItem::class, 'shift_id');
    }
}
