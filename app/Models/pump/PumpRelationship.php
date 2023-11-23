<?php

namespace App\Models\pump;

use App\Models\product\Product;
use App\Models\pump\Nozzle;

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

    
}
