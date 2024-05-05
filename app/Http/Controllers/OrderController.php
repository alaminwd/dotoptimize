<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function order(){
        $orders = Order::latest()->get();
        return view('admin.order.order',[
            'orders'=>$orders,
        ]);

    }

    function order_delete($order_id){
        Order::find($order_id)->delete();
        return back();
    }

    function status_update(Request $request){
        Order::where('id', $request->order_id)->update([
            'status'=>$request->status,
        ]);

        return back();
    }


    function order_success(){
        return view('frontned.order_success');
    }
}
