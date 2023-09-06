<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function product_details($id)
    {
        $item = Item::find($id);
        $count_wishlists = Wishlist::count();
        $wishlist = Wishlist::pluck('item_id')->toArray();
        return view('buyer.product_detail', compact('item', 'count_wishlists', 'wishlist'));
    }


    
   
}
