<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Number extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productOptions(): HasMany
    {
        return $this->hasMany(ProductOption::class);
    }


}
