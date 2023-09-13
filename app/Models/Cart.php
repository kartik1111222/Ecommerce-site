<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 'user_id', 'product_qty', 'total_price'
    ];

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function image(): HasOne
    {
        return $this->hasOne(image::class, 'item_id', 'item_id');

    }

}
