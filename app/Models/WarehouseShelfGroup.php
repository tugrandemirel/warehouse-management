<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseShelfGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }


    public function skuValues()
    {
        return $this->hasMany(SkuValue::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sku_values');
    }

    public function skus()
    {
        return $this->belongsToMany(Sku::class, 'sku_values');
    }

    public function variantGroups()
    {
        return $this->belongsToMany(VariantGroup::class, 'sku_values');
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
