<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = "cart";
    public $timestamps = false;

    protected $fillable = ["user_id","item_name","quantity","price","total_price", "order_id", "status"];
}
