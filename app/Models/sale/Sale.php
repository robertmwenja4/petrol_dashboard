<?php

namespace App\Models\sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'product_id',
        'rate',
        'qty',
        'total_price',
        'customer_id',
        'user_id',
        'pump_id',
        'shift_id',
        'lpo_no',
        'other_vrn_no',
        'other_tin_no',
        'customer_id',
        'driver',
        'vehicle_no',
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

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
