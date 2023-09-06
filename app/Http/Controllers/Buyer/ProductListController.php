<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Wishlist;

class ProductListController extends Controller
{
    public function all_products(){
        $items = Item::all();
        $wishlist = Wishlist::pluck('item_id')->toArray();
        return view('buyer.all_products', compact('items', 'wishlist')); 
    }

    public function women_product(){
        $items = Item::where('item_type','1')->get();
        return view('buyer.women_product', compact('items'));
    }

    public function men_products(){
        $items = Item::where('item_type','0')->get();
        return view('buyer.men_product', compact('items'));
    }

    public function watch_products(){
        $items = Item::where('item_type','3')->get();
        return view('buyer.watch_product', compact('items'));
       
    }

    public function shoes_products(){
        $items = Item::where('item_type','2')->get();
        return view('buyer.shoes_product', compact('items'));
    }

    public Function bag_product(){
        $items = Item::where('item_type','4')->get();
        return view('buyer.bag_product', compact('items'));
    }
}
