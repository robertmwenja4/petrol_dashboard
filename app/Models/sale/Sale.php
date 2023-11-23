<?php

namespace App\Models\sale;

use App\Models\User;
use App\Models\customer\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\shift\Shift;
use App\Models\product\Product;
use App\Models\pump\Pump;

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
        'vrn_no',
        'tin_no',
        'customer_id',
        'driver',
        'vehicle_no',
        'tid',
        'mileage'
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
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function pump()
    {
        return $this->belongsTo(Pump::class, 'pump_id');
    }
}
