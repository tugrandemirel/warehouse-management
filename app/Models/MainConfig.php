<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MainConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_prefix'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
