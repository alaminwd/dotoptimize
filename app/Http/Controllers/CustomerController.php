<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Customer;
use App\Models\CustomerPasswordReset;
use App\Models\CustomerSupport;
use App\Models\CustomerVerify;
use App\Models\Order;
use App\Notifications\CustomerEmailVerifyNotification;
use App\Notifications\CustomerPasswordResetNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Stripe\Customer as StripeCustomer;
use Illuminate\Support\Facades\Notification;

use Image;


class CustomerController extends Controller
{
    function customer_login(){
        return view('frontned.login');
    }
    function customer_register(){
        return view('frontned.register');
    }


    function register_store(Request $request){
      
        $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:customers',
            'phone'=>'required',
            'password'=>'required',
        ]);

        $customer_id = Customer::insertGetId([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'created_at'=>Carbon::now(),
        ]);

        $info = CustomerVerify::create([
            'customer_id'=>$customer_id,
            'token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);

        $customer = Customer::find($customer_id);

        Notification::send($customer, new CustomerEmailVerifyNotification($info));

        return back()->with('verify', 'we have sent you a email verification mail to your email please veryfiy');

        
    }

    // customer email verify process

    function customer_email_verify($customer_id, $token){
    
        $customerVerify = CustomerVerify::where('customer_id', $customer_id)->where('token', $token)->firstOrFail();
        $customer = Customer::find($customerVerify->customer_id);
        $customer->update([
            'email_verified_at'=>Carbon::now(),
        ]);
        
        if($customer){
            Auth::guard('customerlogin')->login($customer);
            return redirect()->route('index');
        }
       
        return false;
       
    }



    function again_verify_request(){
        return view('frontned.email_verify_req');
    }


    function email_verify_requ_send(Request $request){
        $request->validate([
            'email'=>'required|email',
        ]);
        if(Customer::where('email', $request->email)->exists()){
           $customer = Customer::where('email', $request->email)->firstOrFail();
           CustomerVerify::where('customer_id', $customer->id)->delete();
        
           $info = CustomerVerify::create([
                'customer_id'=>$customer->id,
                'token'=>uniqid(),
                'created_at'=>Carbon::now(),
           ]);

           Notification::send($customer, new CustomerEmailVerifyNotification($info));

           return back()->with('verify', "we have send you a email . please verify your mail !"); 
        }
        else{
           return back()->with('email_requst', 'You Did Not Register Yet !' );
        }
    }


    function customer_login_info(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        
        if(Auth::guard('customerlogin')->attempt(['email'=> $request->email, 'password'=> $request->password])){
            if(Auth::guard('customerlogin')->user()->email_verified_at == null){
                Auth::guard('customerlogin')->logout();
                return back()->with('no_verify', 'Please Verify Your Email');
            }
            else{
                  return redirect()->route('index');
            }
        
        }
        else{
            return back()->with('wrong', 'Wrong Credential');
        }
    }


    // Customer Logout

    function customer_logout(){
        Auth::guard('customerlogin')->logout();

        return redirect('/');
    }


    //Customer Profile info ///

    function customer_profile(){
        if(Auth::guard('customerlogin')->id()){ 
        return view('frontned.customer_profile');
        }
        return redirect()->route('customer.login')->with('login', 'Login First');
    }

    // Customer Profile Update Option  //

    function customer_profile_update(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
        ]);

        if($request->photo == ''){
            if($request->password == ''){
                Customer::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                ]);
                return back();
            }
            else{
                Customer::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                ]);
            }

            return back();

        }

        else{
            if($request->password == ''){
                
                if(Customer::find(Auth::guard('customerlogin')->user()->photo != '')){
                    $delete_from = public_path('upload/customer/'.Auth::guard('customerlogin')->user()->photo);
                    unlink($delete_from);
                }

                $photo = $request->photo;
                $extension = $photo->getClientOriginalExtension();
                $file_name = Auth::guard('customerlogin')->id().'.'.$extension;
                Image::make($photo)->save(public_path('upload/customer/'.$file_name));

                Customer::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'photo'=>$file_name,
                ]);
                return back();
            }

            else{

                if(Customer::find(Auth::guard('customerlogin')->user()->photo != '')){
                    $delete_from = public_path('upload/customer/'.Auth::guard('customerlogin')->user()->photo);
                    unlink($delete_from);
                }

                $photo = $request->photo;
                $extension = $photo->getClientOriginalExtension();
                $file_name = Auth::guard('customerlogin')->id().'.'.$extension;
                Image::make($photo)->save(public_path('upload/customer/'.$file_name));

                Customer::find(Auth::guard('customerlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'photo'=>$file_name,
                ]);
                return back();
            }
        }
    }


    // Customer Order History //

    function order_history(){

       $orders = Order::where('customer_id', Auth::guard('customerlogin')->id())->orderBy('created_at', 'DESC')->get();
        if(Auth::guard('customerlogin')->id()){
            return view('frontned.order_history',[
                'orders'=>$orders,
            ]);
         }
        return redirect()->route('customer.login')->with('login', 'Login First');

    }


    // Customer List //

    function customer(){
        $customers = Customer::all();
        $total_customer =  $customers->count();
        return view('admin.user.customer',[
            'customers'=>$customers,
            'total_customer'=>$total_customer,
        ]);
    }


    // Customer Delete //

    function customer_delete($customer_id){
        $present_img = Customer::find($customer_id);
        if($present_img->photo != null){
            unlink(public_path('upload/customer/'.$present_img->photo));
        }
        Customer::find($customer_id)->delete();
        return back()->with('user_del', 'User Deleted Succesfully');
    }


    // Customer Support //

    function support(){
        if(Auth::guard('customerlogin')->id()){
            return view('frontned.support');
         }
        return redirect()->route('customer.login')->with('login', 'Login First');

    }

    // support form submit //
    function support_request(Request $request){
        
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'file'=>['required','mimes:jpg,jpeg,png,bmp,tiff,pdf,txt,doc,docx,rtf,xls,xlsx'],
            
        ]);

        $file = $request->file(key:"file");
        $extension2 = $file->getClientOriginalExtension();
        $file_name2 = Auth::guard('customerlogin')->name.'.'.$extension2;
        $destinationPath = "upload/support";
        $file->move($destinationPath, $file_name2);


        CustomerSupport::insert([
            'customer_id'=>$request->customer_id,
            'title'=>$request->title,
            'desp'=>$request->desp,
            'file'=>$file_name2,
            'created_at'=>Carbon::now(),
        ]);

        return back();
    }



    // return redirect()->route('plan')->with('success', 'Order Completed !');

    function  customer_support(){
        $supports = CustomerSupport::all();
        return view('admin.user.customer_support',[
            'supports'=> $supports,
        ]);
    }



    // download //
    function document_file_download($support_id){
        $info = CustomerSupport::find($support_id);
        $path_file = public_path('upload/support/'.$info->file);
        return response()->download($path_file, $info->original_name);
    }



    function support_info_delete($support_id){

        $present_file = CustomerSupport::find( $support_id);
        unlink(public_path('upload/support/'. $present_file->file));

        CustomerSupport::find($support_id)->delete();

        return back();
    }


    function support_details($support_id){
        $support_details = CustomerSupport::find($support_id);
        return view('admin.user.support_details',[
            'support_details'=>$support_details,
        ]);
    }



    function pay(){
        $banks = Bank::where('status', 1)->get();
        if(Auth::guard('customerlogin')->id()){
            return view('frontned.pay',[
                'banks'=>$banks,
            ] );
         }
         return redirect()->route('customer.login')->with('login', 'Login First');
    }


    function payment_store(Request $request){
        $request->validate([
           'plan_name'=>'required',
           'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
           'price'=>['required','integer'],
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


      // Customer password Reset 
        function check_email(){
            return view('frontned.password_reset') ;
        }

        function password_request_send(Request $request){
            $request->validate([
                'email'=>'required|email',
            ]);

            if(Customer::where('email', $request->email)->exists()){

              $customer =  Customer::where('email', $request->email)->firstOrFail();
              CustomerPasswordReset::where('customer_id', $customer->id)->delete();

              $info = CustomerPasswordReset::create([
                'customer_id'=>$customer->id,
                'token'=>uniqid(),
                'created_at'=>Carbon::now(),
              ]);

              Notification::send($customer, new CustomerPasswordResetNotification($info));

              return back()->with('check_email', 'we have sent you a email. please veryfiy email');

            }
            else{
              return back()->with('invalid', "Email Dose Not Exist! ");
            }
        }

    function pass_reset_form($token){
       return view('frontned.password_update_form',[
        'token'=>$token,
       ]);
       
    }

    function password_reset_confirm(Request $request){

        $request->validate([
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
        ]);

        $reset_info = CustomerPasswordReset::where('token', $request->token)->firstOrFail();
        Customer::find($reset_info->customer_id)->update([
            'password'=>bcrypt($request->password),
        ]);
        CustomerPasswordReset::where('customer_id',$reset_info->customer_id )->delete();

        return back()->with('reset_success', "Password Reset Successfully ");
    }

}