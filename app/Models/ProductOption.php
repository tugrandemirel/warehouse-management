<?php

namespace App\Models;

use App\Enum\Product\ProductOption\ProductOptionIsActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOption extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'user_id',
        'number_id',
        'currency_id',
        'image',
        'manufacturer_name',
        'manufacturer_brand',
        'description',
        'short_description',
        'price',
        'color',
        'weight',
        'width',
        'height',
        'length',
        'code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => ProductOptionIsActiveEnum::class
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function number(): BelongsTo
    {
        return $this->belongsTo(Number::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

}
