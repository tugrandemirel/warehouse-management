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
        'slug'
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

    public function skuValues()
    {
        return $this->hasManyThrough(SkuValue::class, Variant::class);
    }

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'sku_values');
    }

    public function warehouseShelves()
    {
        return $this->belongsToMany(WarehouseShelf::class, 'sku_values');
    }

    public function warehouseShelfGroups()
    {
        return $this->belongsToMany(WarehouseShelfGroup::class, 'sku_values');
    }

    public function getVariantGroupsAttribute()
    {
        return $this->variantGroups()->get();
    }

    public function getSkusAttribute()
    {
        return $this->skus()->get();
    }


}
