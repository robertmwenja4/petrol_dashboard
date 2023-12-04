<?php

namespace App\Models\pump;

use App\Models\product\Product;
use App\Models\pump\Nozzle;
use App\Models\shift\ShiftItem;
use App\Models\shift\CloseShiftItem;
use App\Models\sale\Sale;
use App\Models\cash\GiveCash;

trait PumpRelationship
{
    public function products()
    {
        return $this->hasMany(Product::class, "pump_id");
    }
    public function nozzles()
    {
        return $this->hasMany(Nozzle::class, "pump_id");
    }
    public function shift_items()
    {
        return $this->hasMany(ShiftItem::class, "pump_id");
    }

    public function sale(){
        return $this->hasMany(Sale::class, 'pump_id');
    }
    public function close_shift_items(){
        return $this->hasMany(CloseShiftItem::class, 'pump_id');
    }
    public function give_cash(){
        return $this->hasMany(GiveCash::class, 'pump_id');
    }
}
