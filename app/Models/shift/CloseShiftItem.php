<?php

namespace App\Models\shift;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pump\Pump;
use App\Models\User;
use App\Models\product\Product;
use App\Models\pump\Nozzle;
use App\Models\shift\CloseShift;

class CloseShiftItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','pump_id','product_id','nozzle_id','product_price','balance','amount',
            'open_stock','category',
            'current_stock',
    ];


    public function close_shift()
    {
        return $this->belongsTo(CloseShift::class, 'close_shift_id');
    }
    public function pump()
    {
        return $this->belongsTo(Pump::class, 'pump_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function nozzle()
    {
        return $this->belongsTo(Nozzle::class, 'nozzle_id');
    }
}
