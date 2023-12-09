<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'name',
        'slug'
    ];
    protected $appends = [
        'main_image'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productOptions(): HasMany
    {
        return $this->hasMany(ProductOption::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product')
            ->singleFile();
    }

    public function getMainImageAttribute()
    {
        return !empty($this->getFirstMediaUrl('product')) ?  $this->getFirstMediaUrl('product') : asset('images/no-image.png');
    }
}
