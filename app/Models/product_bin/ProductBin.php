<?php

namespace App\Models\product_bin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product\Product;

class ProductBin extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'shift_id','opening_stock',
        'closing_stock','stock_in', 'stock_out','type','transaction_id'
    ];


    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
