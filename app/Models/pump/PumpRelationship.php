<?php

namespace App\Models\pump;

use App\Models\product\Product;

trait PumpRelationship
{
    public function products()
    {
        return $this->hasMany(Product::class, "pump_id");
    }
}
