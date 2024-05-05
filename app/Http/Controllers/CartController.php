<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
   function cart($plan_id){
      $banks = Bank::where('status', 1)->get();
      $plan_info = Plan::find($plan_id);
      if(Auth::guard('customerlogin')->id()){
         return view('frontned.cart',[
            'plan_info'=>$plan_info,
            'banks'=>$banks,
         ] );
      }
      
     return redirect()->route('customer.login')->with('login', 'Login First');
   }

   function chekout(Request $request){
      $request->validate([
         'name'=>'required',
         'email'=>'required',
         'phone_number'=>'required',
         'payment_method'=>'required',
      ]);

      if($request->payment_method == 1){
         $data = $request->all();
         return redirect('payment')->with('data', [$data]);
      }

      elseif($request->payment_method == 2 ){
         $data = $request->all();
         return redirect()->route('bkash-create-payment')->with('data', [$data]);
      }

      else{
         $data = $request->all();
         return redirect('/stripe')->with('data', [$data]);
      }
   
   }
     
}
