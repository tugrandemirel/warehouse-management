<?php

namespace App\Models;

use App\Enum\Settings\Product\MeasurementUnit\MeasurementUnitIsDefaultEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeasurementUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'symbol',
        'is_default',
    ];

    protected $casts = [
        'is_default' => MeasurementUnitIsDefaultEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
