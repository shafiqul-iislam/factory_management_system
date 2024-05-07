<?php

namespace App\Models\Stock;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockAdjustment extends Model
{
    use HasFactory;


    public function productData()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
