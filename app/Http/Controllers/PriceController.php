<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    //Pricing 
    function add_plan(){
        $plans = Plan::all();
        return view('admin.price.add_plan', [
            'plans'=>$plans,
        ]);
    }

    // Plan store
    function plan_store(Request $request){
        $request->validate([
            'plan_name'=>'required',
            'price'=>'required',
        ]);

        Plan::insert([
            'plan_name'=>$request->plan_name,
            'price'=>$request->price,
            'created_at'=>Carbon::now(),
        ]);

        return back()->withPlan('Plan Added Successfully!');
    }

    // plan status
    function plan_status($plan_id){
        $get_status = Plan::find($plan_id);
        if($get_status->status == 1){
            Plan::where('id', $plan_id)->update([
                'status'=>0,
            ]);
        }
        else{
            Plan::where('id', $plan_id)->update([
                'status'=>1,
            ]);
            Plan::where('id','!=', $plan_id)->update([
                'status'=>0,
            ]);
        }
        return back();
    }

    // Plan Delete
    function plan_delete($plan_id){
        Plan::find($plan_id)->delete();

        return back();
    }

    // Plan edit
    function plan_edit($plan_id){
        $plan_info = Plan::find($plan_id);
        return view('admin.price.edit_plan', [
            'plan_info'=>$plan_info,
        ]);
    }

    // plan Update
    function plan_update(Request $request){
        Plan::find($request->plan_id)->update([
            'plan_name'=>$request->plan_name,
            'price'=>$request->price,
        ]);
        return back()->withPlan('Plan Updated Successfully!');
    }

    // plan features
    function plan_features($plan_id){
        $features = Feature::where('plan_id', $plan_id)->get();
        $plan_info = Plan::find($plan_id);
        return view('admin.price.plan_features', [
            'plan_info'=>$plan_info,
            'features'=>$features,
        ]);
    }

    // Features store
    function feature_store(Request $request){
        $request->validate([
            'features'=>'required',
        ]);

        Feature::insert([
            'plan_id'=>$request->plan_id,
            'features'=>$request->features,
            'created_at'=>Carbon::now(),
        ]);

        return back()->withPlan('Features Added Successfully!');
    }

    // Features delete
    function feature_delete($feature_id){
        Feature::find($feature_id)->delete();
        return back();
    }

    // features edit
    function feature_edit($feature_id){
        $featrue_info = Feature::find($feature_id);
        return view('admin.price.edit_feature', [
            'featrue_info'=>$featrue_info,
        ]);
    }

    // Features Update
    function feature_update(Request $request){
        Feature::find($request->feature_id)->update([
            'features'=>$request->features,
        ]);

        return back()->withPlan('Features Updated Successfully!');
    }
}
