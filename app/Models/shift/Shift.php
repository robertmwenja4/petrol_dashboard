<?php

namespace App\Models\shift;

use App\Models\User;
use App\Models\shift\ShiftItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_name', 'created_by', 'status', 'end_date'
    ];

    public function items()
    {
        return $this->hasMany(ShiftItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
