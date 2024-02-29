<?php

namespace App\Models\shift;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\shift\Shift;

class ShiftType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','start_time', 'end_time'
    ];

    public function shift(){
        return $this->hasMany(Shift::class);
    }
}
