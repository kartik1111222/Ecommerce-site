<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function seller_dashboard(){
        return view('seller.dashboard');
    }

    public function buyer_dashboard(){
       $items = Item::all();
        return view('buyer.dashboard', compact('items'));
    }
}
