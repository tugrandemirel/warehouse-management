<?php

namespace App\Models;

use App\Enum\Settings\Product\Currency\CurrencyIsDefaultEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'symbol',
        'is_default',
    ];

    protected $casts = [
        'is_default' => CurrencyIsDefaultEnum::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productOption(): HasOne
    {
        return $this->hasOne(ProductOption::class);
    }

    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }
}
