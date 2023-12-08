<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'country_id',
        'description'
    ];

    public function productMarketPlaces()
    {
        return $this->hasMany(ProductMarketPlace::class);
    }
}
