<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const DONE = 1;
    public const ERROR = 2;
    public const NOTHING = 0;
    public const CONFIRM_STATUS = [
        self::DONE => 'done',
        self::ERROR => 'has an error',
        self::NOTHING => 'do nothing yet',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getOrderByStoreId($storeId)
    {
        return Order::where('store_id', '=', $storeId)->with('items')->get();
    }

    public function items()
    {
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }
}
