<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product\Product;

class StockAdjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id','previous_qty','current_qty'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
