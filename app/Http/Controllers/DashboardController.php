<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Wishlist;

class DashboardController extends Controller
{
    public function seller_dashboard(){
        return view('seller.dashboard');
    }

    public function buyer_dashboard(){
       $items = Item::all();
       $count_wishlists = Wishlist::count();
       $wishlist = Wishlist::pluck('item_id')->toArray();
       
        return view('buyer.dashboard', compact('items', 'count_wishlists', 'wishlist'));
    }
}
