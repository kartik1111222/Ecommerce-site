<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Item extends Model
{
    use HasFactory;

    public function image(): HasOne
    {
        return $this->hasOne(Image::class, 'item_id', 'id');
       
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class, 'item_id', 'id');

    }

    public function wishlist(): HasOne
    {
        return $this->hasOne(Wishlist::class, 'item_id', 'id');
    }

    
}
