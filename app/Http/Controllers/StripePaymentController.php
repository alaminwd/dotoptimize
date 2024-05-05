<?php
    
namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Order;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use Stripe;
     
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    { 

        return view('stripe');
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
       $data_info = session('info');
       foreach($data_info as $data){
            $customer_id = $data['customer_id'];
            $name = $data['name'];
            $email = $data['email'];
            $phone_number = $data['phone_number'];
            $plan_name = $data['plan_name'];
            $amount = $data['price'];
            $payment_method = $data['payment_method'];
       }
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
            
                "amount" => $amount,
                "currency" => "BDT",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 

        ]);
        Order::insert([
            'customer_id'=>$customer_id,
            'name'=>$name,
            'email'=>$email,
            'phone'=>$phone_number,
            'plan_name'=>$plan_name,
            'price'=>$amount,
            'payment_method'=>$payment_method,
            'stripe_token'=>$request->stripeToken,
            'created_at'=>Carbon::now(),
        ]);

        // return redirect()->route('cart', $customer_id)->with('success', 'Order Completed !');
        return redirect()->route('order.success')->with('success', 'Order Completed !');

    }
}