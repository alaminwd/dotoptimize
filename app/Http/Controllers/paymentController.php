<?php

namespace App\Http\Controllers;

use App\Models\AamarPay;
use App\Models\Aamarpay_api;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class paymentController extends Controller
{
    public function payment(Request $request){

        $data_info = session('data');

        foreach($data_info as $data){
            $customer_id = $data['customer_id'];
            $name = $data['name'];
            $email = $data['email'];
            $phone_number = $data['phone_number'];
            $plan_name = $data['plan_name'];
            $price = $data['price'];
            $payment_method = $data['payment_method'];
        }
      

        $tran_id = rand(1111111,9999999);//unique transection id for every transection 

        $currency= "BDT"; //aamarPay support Two type of currency USD & BDT  

           //10 taka is the minimum amount for show card option in aamarPay payment gateway
        
        //For live Store Id & Signature Key please mail to support@aamarpay.com
       $aamar_apis = Aamarpay_api::all();

       foreach( $aamar_apis as $api){
            $store_id =$api->store_id;
            $signature_key =$api->signature_key; 
       }
        // $store_id = "aamarpaytest"; 
        
        //  $url = "https://​sandbox​.aamarpay.com/jsonpost.php";
        $url = "https://secure.aamarpay.com/jsonpost.php"; // for Live Transection use 
   
    
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
         
            "store_id": "'.$store_id.'",
            "tran_id": "'.$tran_id.'",
            "success_url": "'.route('success').'",
            "fail_url": "'.route('fail').'",
            "cancel_url": "'.route('plan').'",
            "amount": "'.$price.'",
            "currency": "'.$currency.'",
            "signature_key": "'.$signature_key.'",
            "desc": "Merchant Registration Payment",
            "cus_name": "'.$name.'",
            "cus_email": "payer@merchantcusomter.com",
            "cus_add1": "House B-158 Road 22",
            "cus_add2": "Mohakhali DOHS",
            "cus_city": "Dhaka",
            "cus_state": "Dhaka",
            "cus_postcode": "1206",
            "cus_country": "Bangladesh",
            "cus_phone": "+8801704",
            "type": "json"
        }',

        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
 
        $response_data = json_decode($response);
        // $url = $response_data->payment_url;
        // $queryString = parse_url($url, PHP_URL_QUERY);
       
        // parse_str($queryString, $params);

        // $tran_id = isset($params['track']) ? $params['track'] : null;

        // dd($response_data);

        AamarPay::insert([
            'customer_id'=>$customer_id,
            'name'=>$name,
            'email'=>$email,
            'phone_number'=>$phone_number,
            'plan_name'=>$plan_name,
            'price'=>$price,
            'payment_method'=>$payment_method,
            'track'=>$tran_id,
            'created_at'=>Carbon::now(),
        ]);

        if(isset($response_data->payment_url) && !empty($response_data->payment_url)) {

            $paymentUrl = $response_data->payment_url;
            // dd($paymentUrl);
            return redirect()->away($paymentUrl);

        }
        else{
            echo $response;
        }

    }
    public function success(Request $request){
        
    
        //verify the transection using Search Transection API 

        // $url = "http://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$request_id&store_id=aamarpaytest&signature_key=dbb74894e82415a2f7ff0ec3a97e4183&type=json";
        
        //For Live Transection Use 
        $url = "http://secure.aamarpay.com/api/v1/trxcheck/request.php";
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $data = session('data');
       

        $response = curl_exec($curl);
        // dd($response);

        curl_close($curl);
        // echo $response;

        $tran_id = $request->mer_txnid;

        $data_info = AamarPay::where('track', $tran_id)->get();

        foreach( $data_info as $data){
            Order::insert([
                'customer_id'=>$data->customer_id,
                'name'=>$data->name,
                'email'=>$data->email,
                'phone'=>$data->phone_number,
                'plan_name'=>$data->plan_name,
                'price'=>$data->price,
                'payment_method'=>$data->payment_method,
                'paymentID'=> $tran_id,
                'created_at'=>Carbon::now(),
            ]);
        }

        return redirect()->route('order.success')->with('success', 'Order Completed !');
    }

    public function fail(Request $request){
        return redirect('/plan');
    }

    // public function cancel(){
    //     return 'Canceled';
    // }
}
