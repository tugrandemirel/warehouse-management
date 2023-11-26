<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'variant_group_id',
        'product_id',
    ];

    public function variantGroup()
    {
        return $this->belongsTo(VariantGroup::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function skuValues()
    {
        return $this->hasMany(SkuValue::class);
    }

    public function variantOptions()
    {
        return $this->belongsToMany(VariantOption::class, 'sku_values');
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

    public function getVariantOptionsAttribute()
    {
        return $this->variantOptions()->get();
    }
}
