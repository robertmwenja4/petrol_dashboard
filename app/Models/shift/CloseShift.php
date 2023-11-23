<?php

namespace App\Models\shift;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\shift\CloseShiftItem;
use App\Models\shift\Shift;

class CloseShift extends Model
{
    use HasFactory;

    protected $fillable = ['shift_id'];


    public function close_shift_items(){
        return $this->hasMany(CloseShiftItem::class);
    }
    public function shift(){
        return $this->belongsTo(Shift::class, 'shift_id');
    }
}
