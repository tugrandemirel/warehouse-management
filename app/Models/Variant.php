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


}
