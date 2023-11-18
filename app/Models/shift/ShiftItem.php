<?php

namespace App\Models\shift;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\shift\Shift;

class ShiftItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_time','end_time','shift_id'];


    public function shift(){
        return $this->belongsTo(Shift::class, 'shift_id');
    }
}
