<?php

namespace App\Models\user_allocation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAllocationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_allocation_id", "product_id"
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
}
