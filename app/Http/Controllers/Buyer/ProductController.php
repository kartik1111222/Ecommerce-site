<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function product_details($id){
        $item = Item::find($id);
        return view('buyer.product_detail', compact('item'));
    }

    public function add_to_wishlist(Request $request){

          $item_id = $request->id;

          $wishlist = new Wishlist();
          $wishlist->item_id = $item_id;
          $wishlist->user_id = Auth()->user()->id;
          $wishlist->save();
          return response()->json([
           'message' => 'product added in wishlist'
          ]);
    }
}
