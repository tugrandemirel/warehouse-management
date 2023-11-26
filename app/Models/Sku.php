<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sku extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sku',
        'price',
        'stock',
        'description',
        'image',
        'user_id',
        'product_id',
        'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function variantGroups()
    {
        return $this->belongsToMany(VariantGroup::class, 'sku_values');
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
