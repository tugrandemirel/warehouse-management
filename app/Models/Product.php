<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function variantGroups()
    {
        return $this->belongsToMany(VariantGroup::class, 'variants');
    }

    public function skus()
    {
        return $this->hasManyThrough(Sku::class, Variant::class);
    }



}
