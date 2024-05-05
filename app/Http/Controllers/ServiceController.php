<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Service;
use App\Models\ServicePrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class ServiceController extends Controller
{
    //service
    function add_service(){
        return view('admin.service.add_service');
    }

    // Service store
    function service_store(Request $request){
        $request->validate([
            'icon'=>'required',
            'title'=>'required|unique:services',
            'short_desp'=>'required',
            'long_desp'=>'required',
            'keyword'=>'required',
            'image'=>'required|mimes:png,jpg',
        ]);

        $service_img = $request->image;
        $extension = $service_img->getClientOriginalExtension();
        $size = $service_img->getSize();
        $file_name = substr(str_replace(' ', '_', $request->title), 0, 10).'.'.$extension;

        if($size < 2000000){
            Image::make($service_img)->save(public_path('upload/service/'.$file_name));
            Service::insert([
                'icon'=>$request->icon,
                'title'=>$request->title,
                'short_desp'=>$request->short_desp,
                'long_desp'=>$request->long_desp,
                'keyword'=>$request->keyword,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);

        }
        else{
            return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
        }
        return back()->with('service', 'Service Added Successfully');
    }

    // Service list
    function service_list(){
        $services = Service::paginate(20);
        return view('admin.service.service_list', [
            'services'=>$services,
        ]);
    }

    // Service delete
    function service_delete($ser_id){
        $presen_img = Service::find($ser_id);
        unlink(public_path('upload/service/'.$presen_img->image));

        Service::find($ser_id)->delete();
        return back();
    }


    // service edit
    function service_edit($ser_id){
        $ser_info = Service::find($ser_id);
        return view('admin.service.edit_service', [
            'ser_info'=>$ser_info,
        ]);
    }

    // service update
    function service_update(Request $request){
        $request->validate([
            'image'=>'mimes:png,jpg',
        ]);

        if($request->image==''){
            Service::find($request->ser_id)->update([
                'icon'=>$request->icon,
                'title'=>$request->title,
                'short_desp'=>$request->short_desp,
                'long_desp'=>$request->long_desp,
                'keyword'=>$request->keyword,
            ]);
        }
        else{
            $service_img = $request->image;
            $extension = $service_img->getClientOriginalExtension();
            $size = $service_img->getSize();
            $file_name = substr(str_replace(' ', '_', $request->title), 0, 10).'.'.$extension;
    
            if($size < 2000000){

                $presen_img = Service::find($request->ser_id);
                unlink(public_path('upload/service/'.$presen_img->image));

                Image::make($service_img)->save(public_path('upload/service/'.$file_name));

                Service::find($request->ser_id)->update([
                    'icon'=>$request->icon,
                    'title'=>$request->title,
                    'short_desp'=>$request->short_desp,
                    'long_desp'=>$request->long_desp,
                    'keyword'=>$request->keyword,
                    'image'=>$file_name,
                ]);
    
            }
            else{
                return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
            }
        }

        return back()->with('service', 'Service Updated Successfully');
    }

    function service_plan($ser_id){
        $sevice_plans = ServicePrice::where('service_id', $ser_id)->get();
        $plans = Plan::all();
        $ser_info  = Service::find($ser_id);
        return view('admin.service.service_plan',[
            'ser_info'=>$ser_info,
            'plans'=>$plans,
            'sevice_plans'=>$sevice_plans,
        ]);
    }

    function add_service_plan(Request $request){
        $request->validate([
            'plan_id'=>'required',
        ]);

        ServicePrice::insert([
            'service_id'=>$request->service_id,
            'plan_id'=>$request->plan_id,
            'created_at'=>Carbon::now(),
        ]);

        return back();
    }

    function service_price_delete($ser_id){
        ServicePrice::find($ser_id)->delete();

        return back();
    }
}
