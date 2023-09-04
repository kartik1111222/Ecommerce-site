<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function registration(){
        return view('register');
    }

    public function add_registration(Request $request){
      
        $data = $request->all();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->address = $data['address'];
        $user->phone_no = $data['phone_no'];
        $user->role = $data['role'];
        if($request->has('profile')){
            $profile = $request->profile;
            $name = time().'.'. $profile->extension();    
            $path = public_path(). 'assets/images/users';
            $profile->move($path, $name);
            $user->profile = $name;
        }
        
        $user->save();
        // return redirect()->route('login');
        return response()->json([
           'message' => 'Registered successfully!'
        ]);
    }

    public function login(){
        return view('login');
    }

    public function login_check(Request $request){
        if(Auth::attempt($request->only('email','password'))){
           $user = Auth::user();
           if($user->role == '1'){
              return redirect()->route('seller.dashboard');
           }else{
             return redirect()->route('buyer.dashboard');
           }
        }else{
         return redirect()->route('login');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
