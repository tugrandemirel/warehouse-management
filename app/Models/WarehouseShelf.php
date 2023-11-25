<?php

namespace App\Models;

use App\Enum\Warehouse\Shelf\WarehouseShelfIsActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseShelf extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'warehouse_id',
        'name',
        'description',
        'code',
        'is_active',
        'shelf_group_id'
    ];

    protected $casts = [
        'is_active' => WarehouseShelfIsActiveEnum::class
    ];
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function warehouseShelfGroup()
    {

        return $this->belongsTo(WarehouseShelfGroup::class);
    }
}
