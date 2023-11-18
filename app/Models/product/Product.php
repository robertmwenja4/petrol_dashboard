<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pump\Pump;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'pump_id', 'price', 'category'
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

    public function pump(){
        return $this->belongsTo(Pump::class, 'pump_id');
    }
}
