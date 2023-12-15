<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'invoice_number' => 'unique',
        'total' => 'decimal:2',
        'exchange_rate' => 'decimal:2',
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



}
