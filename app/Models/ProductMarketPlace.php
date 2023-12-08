<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMarketPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_option_id',
        'market_place_id',
        'stock_code',
    ];

    public function productOption()
    {
        return $this->belongsTo(ProductOption::class);
    }

    public function marketPlace()
    {
        return $this->belongsTo(MarketPlace::class);
    }


}
