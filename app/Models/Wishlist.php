<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'product_id'
    ];

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class, 'item_id', 'item_id');

    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class, 'item_id', 'item_id');

    }
}
