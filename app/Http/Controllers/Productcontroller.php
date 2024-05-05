<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Product;
use App\Models\ProductPlan;
use App\Models\ProductSectionTitle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class Productcontroller extends Controller
{
    //
    function add_product(){
        return view('admin.product.add_product');
    }

    function product_store(Request $request){
        $request->validate([
            'title'=>'required',
            'short_desp'=>'required',
            'long_desp'=>'required',
            'keyword'=>'required',
            'image'=>'mimes:png,jpg',
        ]);
        
        $project_img = $request->image;
        $extension = $project_img->getClientOriginalExtension();
        $size = $project_img->getSize();
        $file_name = Substr($request->title, 0, 7).'.'.$extension;
        
        if($size < 2000000){
            Image::make($project_img)->save(public_path('upload/product/'.$file_name));

            Product::insert([
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

        return back()->withProject('Project Added Successfully!');
    }


    function product_list(){
        $products = Product::paginate(20);
        return view('admin.product.product_list', [
          'products'=>$products,
        ]);
    }


        function product_edit($product_id){
        $product = Product::find($product_id);
        return view('admin.product.product_edit',[
            'product'=>$product,
        ]);
    }


    function product_update(Request $request){
        $request->validate([
            'title'=>'required', 
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg',],

        ]);

        if($request->image == null){
            Product::where('id', $request->id)->update([
                'title'=>$request->title,
                'created_at'=>Carbon::now(),
            ]);

            return back();
        }
        else{

            $prevImage =  Product::find($request->id);
            if($prevImage->image != null){
                unlink(public_path('upload/product/'.$prevImage->image));
            }

            $project_img = $request->image;
            $extension = $project_img->getClientOriginalExtension();
            $size = $project_img->getSize();
            $file_name = str_replace(' ', '_', $request->title).'.'.$extension;
            
            Image::make($project_img)->save(public_path('upload/product/'.$file_name));
    

            Product::where('id', $request->id)->update([
                'title'=>$request->title,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
                
            ]);

            return back();
        }
    }
    

    function product_delete($product_id){
        $present_img = Product::find($product_id);
        unlink(public_path('upload/product/'.$present_img->image));

        Product::find($product_id)->delete();
        return back();
    }

    function product_price($product_id){
    
        $projects_info = Product::find($product_id);
        $plans = Plan::all();
        $project_plans = ProductPlan::where('product_id', $product_id)->get();
        return view('admin.product.product_price', [
            'projects_info'=>$projects_info,
            'plans'=>$plans,
            'project_plans'=>$project_plans,
        ]);
    }

    function product_plan_store(Request $request){
        $request->validate([
            'plan_id'=>'required',
        ]);

        ProductPlan::insert([
            'product_id'=>$request->product_id,
            'plan_id'=>$request->plan_id,
            'created_at'=>Carbon::now(),
        ]);

        return back()->withPlan('Pricing Plan Added Successfully!');
    }

    function product_plan_delete($plan_id){
        ProductPlan::find($plan_id)->delete();
        return back();
    }

    function product_section_title(){
        $products = ProductSectionTitle::all();
        foreach ($products as $product_sections){
            $product_sections = $product_sections;
        }
        return view('admin.product.product_section_title', [
            'product_sections'=>$product_sections,
        ]);
    }

    function product_section_info_update(Request $request){
       ProductSectionTitle::find($request->section_id)->update([
        'title'=>$request->title,
        'desp'=>$request->desp,
       ]);
       return back();
    }

}
