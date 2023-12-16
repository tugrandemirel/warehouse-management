<?php

namespace App\Models;

use App\Enum\Product\Stock\StockStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_id',
        'company_id',
        'currency_id',
        'invoice_number',
        'invoice_date',
        'total',
        'exchange_rate',
        'status'
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'total' => 'decimal:2',
        'exchange_rate' => 'decimal:2',
        'status' => StockStatusEnum::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function productStocks(): HasMany
    {
        return $this->hasMany(ProductStock::class);
    }

}
