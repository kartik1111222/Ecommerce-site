<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'product_id'
    ];

    public function item(){
        return $this->belongsTo(Item::class);
    }
}
