<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
   public function cart()
   {
      $user_id = Auth()->user()->id;
      $items = Cart::where('user_id',$user_id)->with('item')->get();

     
      $count_cart = Cart::count();
      $count_wishlist = Wishlist::count();
      $wishlist = Wishlist::pluck('item_id')->toArray();
      $cart_items = Cart::all();
        
      return view('buyer.cart', compact('items', 'count_cart','count_wishlist','wishlist','cart_items'));
   }

   public function add_to_cart(Request $request, $id)
   {
         $data = $request->all();
         // dd($data);
         $unique_cart = Cart::where('item_id', $id)->first();

         if($unique_cart != null){

           $cart = Cart::where('item_id', $id)->first();
           $cart->item_id = $data['id'];
           //   $newQuantity =  $cart->product_qty +  $data['pro_qty'];
           $newQuantity =  isset($data['pro_qty']) ? $cart->product_qty +  $data['pro_qty']: $cart->product_qty + '1' ;
           $newTotalprice = isset($data['pro_qty']) ? $cart->total_price +  $data['pro_qty'] * $data['total_price']: $cart->total_price +  '1' * $data['total_price']; 
           $cart->total_price = $newTotalprice;
           $cart->product_qty = $newQuantity;
           $cart->user_id  = Auth()->user()->id;
           $cart->save();
  
           return response()->json([
              'message' => 'product quantity updated in cart successfully!'
           ]);


         }else{
             
            $cart = new Cart();
  
            $cart->item_id = $data['id'];
            $cart->product_qty = isset($data['pro_qty']) ? $data['pro_qty']: '1' ;
            $cart->total_price = isset($data['pro_qty']) ? $data['pro_qty']  *  $data['total_price']: '1'  *  $data['total_price'];
            $cart->user_id  = Auth()->user()->id;
            $cart->save();
   
            return response()->json([
               'message' => 'product quantity updated in cart successfully!'
            ]);

         }
   }

   public function cart_item_delete($id){
      
      $item_delete = Cart::find($id);
      
      
      if($item_delete != null){
         
         $item_delete->delete();
         
         return response()->json([
           'message' => 'Item removed from cart successfully!'
         ]);
      } 
   }

   public function update_cart(Request $request){
    $data = $request->all();   
      dd($data);
     $id = $data['id'];

     $update_cart = Cart::where('item_id',$id)->first();
     $update_cart->product_qty = $data['quantity'];
     $update_cart->total_price = $data['quantity'] * $data['price']; 
     $update_cart->save();
     return response()->json([
      'message' => 'Quantity updated successfully!'
     ]);
   }

}
