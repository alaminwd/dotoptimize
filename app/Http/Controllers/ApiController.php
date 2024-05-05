<?php

namespace App\Http\Controllers;

use App\Models\Aamarpay_api;
use App\Models\Bank;
use App\Models\BkashApi;
use App\Models\StripApi;
use App\Models\StripeApi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Image;
use Str;

class ApiController extends Controller
{
   function api(){
    $banks = Bank::all();
    $aamarpay_api = Aamarpay_api::all();
    $bkash_api = BkashApi::all();
    $stripe_api = StripeApi::all();
    return view('admin.api_setup.api',[
        'bkash_api'=> $bkash_api,
        'aamarpay_api'=>$aamarpay_api,
        'banks'=>$banks,
        'stripe_api'=>$stripe_api,
    ]);
   }

   function update_bkash_api(Request $request){
        $request->validate([
            'user_name'=>'required',
            'bkash_password'=>'required',
            'bkash_app_key'=>'required',
            'bkash_app_secret'=>'required',
        ]);

        BkashApi::where('id', $request->id)->update([
            'bkash_username'=>$request->user_name,
            'bkash_password'=>$request->bkash_password,
            'bkash_app_key'=>$request->bkash_app_key,
            'bkash_app_secret'=>$request->bkash_app_secret,
            
        ]);

        Artisan::call(' app:update-env-variables-for-bkash-api');
        return back();
   }

   function update_aamarpay_api(Request $request){
      $request->validate([
        'store_id'=>'required',
        'signature_key'=>'required',
        ]);

        Aamarpay_api::where('id', $request->id)->update([
            'store_id'=>$request->store_id,
            'signature_key'=>$request->signature_key,
        ]);
        
       return back();
   }

   // ===================== bank

   function bank_store(Request $request){
      $request->validate([
        'bank_name'=>'required',
        'bank_logo'=>'required|mimes:png',
      ]);
      $upload_logo = $request->bank_logo;
      $extension = $upload_logo->getClientOriginalExtension();
      $size = $request->bank_logo->getSize();
      $file_name = Str::lower(str_replace(' ','-', $request->bank_name)).'.'.$extension;
      
      
      if($size < 2000000){
         Image::make($upload_logo)->save(public_path('upload/bank/'.$file_name));
         
      Bank::insert([
          'bank_name'=>$request->bank_name,
          'bank_logo'=>$file_name,
          'created_at'=>Carbon::now(),
      ]);
     }
     else{
          return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
     }
     
      return back()->withLogoadd('Logo Added Successfully');
   }

  
    function bank_delete($bank_id){
        $present_logo = Bank::find($bank_id);
        unlink(public_path('upload/bank/'.$present_logo->bank_logo));

        Bank::find($bank_id)->delete();

        return back()->withLogodel('Logo Successfully Deleted');
    }


    function bank_status($bank_id){
    
        $get_status = Bank::find($bank_id);
        
        if($get_status->status == 1){
            Bank::where('id', $bank_id)->update([
                'status'=>0,
            ]);
        }
        else{
            Bank::where('id', $bank_id)->update([
                'status'=>1,
            ]);
        }
        
         return back();
    }

    function update_stripe(Request $request){
        $request->validate([
            'stripe_key'=>'required',
            'stripe_secret'=>'required',
            ]);

            StripeApi::where('id', $request->id)->update([
                'stripe_key'=>$request->stripe_key,
                'stripe_secret'=>$request->stripe_secret,
            ]);

        

            Artisan::call(' app:update-env-variables-for-stripe-api');
            return back();
    }
}
