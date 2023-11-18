<?php

namespace App\Models\shift;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\shift\ShiftItem;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_name'
    ];

    public function items(){
        return $this->hasMany(ShiftItem::class);
    }
}
