<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Wishlist;
use App\Models\Cart;

class ProductListController extends Controller
{
    public function all_products(){
        $items = Item::all();
        $wishlist = Wishlist::pluck('item_id')->toArray();
        $count_cart = Cart::count();
        $count_wishlist = Wishlist::count();
        $cart_items = Cart::all();
        return view('buyer.all_products', compact('items', 'wishlist', 'count_cart', 'count_wishlist', 'cart_items')); 
    }

    public function women_product(){
        $items = Item::with('image')->where('item_type','1')->get();
        $count_cart = Cart::count();
        $count_wishlist = Wishlist::count();
        $cart_items = Cart::all();
        $wishlist = Wishlist::pluck('item_id')->toArray();
        return view('buyer.women_product', compact('items', 'count_cart', 'count_wishlist', 'cart_items', 'wishlist'));
    }

    public function men_products(){
        $items = Item::with('image')->where('item_type','0')->get();
        $count_cart = Cart::count();
        $count_wishlist = Wishlist::count();
        $cart_items = Cart::all();
        $wishlist = Wishlist::pluck('item_id')->toArray();

        return view('buyer.men_product', compact('items', 'count_cart', 'count_wishlist', 'cart_items', 'wishlist'));
    }

    public function watch_products(){
        $items = Item::with('image')->where('item_type','3')->get();
        $count_cart = Cart::count();
        $count_wishlist = Wishlist::count();
        $cart_items = Cart::all();
        $wishlist = Wishlist::pluck('item_id')->toArray();
        
        return view('buyer.watch_product', compact('items', 'count_cart', 'count_wishlist', 'cart_items', 'wishlist'));
       
    }

    public function shoes_products(){
        $items = Item::with('image')->where('item_type','2')->get();
        $count_cart = Cart::count();
        $count_wishlist = Wishlist::count();
        $wishlist = Wishlist::pluck('item_id')->toArray();
        $cart_items = Cart::all();

        return view('buyer.shoes_product', compact('items', 'count_cart', 'count_wishlist', 'cart_items', 'wishlist'));
    }

}
