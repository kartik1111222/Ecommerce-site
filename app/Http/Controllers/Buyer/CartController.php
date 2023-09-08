<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
   public function cart()
   {
      $user_id = Auth()->user()->id;
      $items = Cart::where('user_id',$user_id)->with('item')->get();
        
      return view('buyer.cart', compact('items'));
   }

   public function add_to_cart(Request $request, $id)
   {
         $data = $request->all();
         $unique_cart = Cart::where('item_id', $id)->first();

         if($unique_cart != null){

           $cart = Cart::where('item_id', $id)->first();
           $cart->item_id = $data['id'];
         //   $newQuantity =  $cart->product_qty +  $data['pro_qty'];
           $newQuantity =  isset($data['pro_qty']) ? $cart->product_qty +  $data['pro_qty']: $cart->product_qty + '1' ;
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
            $cart->user_id  = Auth()->user()->id;
            $cart->save();
   
            return response()->json([
               'message' => 'product quantity updated in cart successfully!'
            ]);

         }

         

   


        
   }
}
