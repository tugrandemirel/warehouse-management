<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmazonReport extends Model
{
    use HasFactory;

    protected $table = 'amazon_reports';

    protected $guarded = [];
}
