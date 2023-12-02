<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product\Product;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no', 'product_id','qty','cost'
    ];


    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
