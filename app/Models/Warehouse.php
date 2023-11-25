<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function warehouseShelves()
    {
        return $this->hasMany(WarehouseShelf::class);
    }

    public function warehouseShelfGroups()
    {
        return $this->hasMany(WarehouseShelfGroup::class);
    }

    public function warehouseShelfGroup()
    {
        return $this->belongsTo(WarehouseShelfGroup::class);
    }

    public function userWarehouses()
    {
        return $this->hasMany(UserWarehouse::class);
    }
}
