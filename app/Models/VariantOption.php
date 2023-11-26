<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariantOption extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'variant_id',
        'product_id',
    ];

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function skuValues()
    {
        return $this->hasMany(SkuValue::class);
    }

    public function variantGroups()
    {
        return $this->belongsToMany(VariantGroup::class, 'sku_values');
    }

    public function skus()
    {
        return $this->belongsToMany(Sku::class, 'sku_values');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sku_values');
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
}
