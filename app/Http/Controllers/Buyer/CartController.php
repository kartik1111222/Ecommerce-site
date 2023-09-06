<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
   public function cart(){
    return view('buyer.cart');
   }

   public function add_to_cart(Request $request, $id){

      $data = $request->all();
   
      $cart = new Cart();
      $cart->item_id = $data['id'];
      $cart->product_qty = $data['product-qty'];
      $cart->user_id  = Auth()->user()->id;
      $cart->save();

      return response()->json([
          'message' => 'product added in cart successfully!'
      ]);
   }
}
