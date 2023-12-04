<?php

namespace App\Models\pump;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pump\Pump;
use App\Models\product\Product;

class Nozzle extends Model
{
    use HasFactory;

    protected $fillable = [
        'pump_id', 'name','code', 'product_id','readings'
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

    public function pump()
    {
        return $this->belongsTo(Pump::class, 'pump_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
