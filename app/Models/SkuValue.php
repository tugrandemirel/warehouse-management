<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkuValue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sku_id',
        'variant_id',
        'variant_group_id',
        'product_id',
        'warehouse_id',
        'warehouse_shelf_id',
        'warehouse_shelf_group_id',
        'variant_option_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function variantGroup()
    {
        return $this->belongsTo(VariantGroup::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function warehouseShelf()
    {
        return $this->belongsTo(WarehouseShelf::class);
    }

    public function warehouseShelfGroup()
    {
        return $this->belongsTo(WarehouseShelfGroup::class);
    }

    public function variantOption()
    {
        return $this->belongsTo(VariantOption::class);
    }

    public function getVariantOptionAttribute()
    {
        return $this->variantOption()->get();
    }
}
