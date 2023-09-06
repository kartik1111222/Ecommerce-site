<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function wishlist(){
        $user_id = Auth()->user()->id;
        $items = Wishlist::where('user_id',$user_id)->with('item')->get();
        
        return view('buyer.wishlist', compact('items'));
    }

    public function add_to_wishlist(Request $request)
    {

            $item_id = $request->id;
           
            $wishlist = new Wishlist();
            $wishlist->item_id = $item_id;
            $wishlist->user_id = Auth()->user()->id;
            $wishlist->save();
            return response()->json([
                'message' => 'product added in wishlist'
            ]);
    }


    public function remove_wishlist($id){
        $delete_item = Wishlist::find($id);
       
        if($delete_item != null){
            $delete_item->delete();
            return response()->json([
              'message' => 'Item removed successfully!'
            ]);
        }else{
            return response()->json([
                'message' => 'Item not found'
              ]);
        }
    }

    public function product_remove_wishlist($id){
     
        $delete_product = Wishlist::where('item_id', $id)->first();
  
        if($delete_product != null){
          $delete_product->delete();
  
          return response()->json([
            'message' => 'Product removed!'
          ]);
        }else{
          return response()->json([
              'message' => 'Something went wrong'
            ]);
        }
    } 
  
}
