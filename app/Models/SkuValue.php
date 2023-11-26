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
    ];
}
