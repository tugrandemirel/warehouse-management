<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'key',
        'secret',
        'shipping_account',
        'cargo_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
