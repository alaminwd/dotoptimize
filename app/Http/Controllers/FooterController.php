<?php

namespace App\Http\Controllers;

use App\Models\AddWorkWay;
use App\Models\Footer;
use App\Models\FooterCopyright;
use App\Models\FooterIcon;
use App\Models\Policy;
use App\Models\ProvideInfo;
use App\Models\Request_form;
use App\Models\WorkWay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Image;

class FooterController extends Controller
{

    function add_title(){
        $titles = Request_form::all();
        return view('admin.footer.request_title',[
            'titles'=>$titles ,
        ]);
    }
    function update_title(Request $request){
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
        ]);

       Request_form::where('id', $request->id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
            ]);
            return back();
    }
    //footer Info
    function footer_info(){
        $footer_info = Footer::all();
        foreach($footer_info as $footer){
            $footers = $footer;
        }
        $icons = FooterIcon::all();
        return view('admin.footer.footer_info', [
            'footers'=>$footers,
            'icons'=>$icons,
        ]);
    }

    // footer Update
    function footer_update(Request $request){
        $request->validate([
            'footer_logo'=>'mimes:png,jpg',
        ]);

        if($request->footer_logo==''){
            Footer::find($request->footer_id)->update([
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'top_address'=>$request->top_address,
                'start_day'=>$request->start_day,
                'end_day'=>$request->end_day,
                'close_day'=>$request->close_day,
                'start_time'=>$request->start_time,
                'close_time'=>$request->close_time,
              ]);
        }
        else{
            $foot_img = $request->footer_logo;
            $extension = $foot_img->getClientOriginalExtension();
            $size = $foot_img->getSize();
            $file_name = $request->footer_id.'.'.$extension;
    
            
            if($size < 2000000){
                Image::make($foot_img)->save(public_path('upload/footer/'.$file_name));
                Footer::find($request->footer_id)->update([
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'top_address'=>$request->top_address,
                'start_day'=>$request->start_day,
                'end_day'=>$request->end_day,
                'close_day'=>$request->close_day,
                'start_time'=>$request->start_time,
                'close_time'=>$request->close_time,
                'footer_logo'=>$file_name,
              ]);
            }
            else{
                return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
            }
        }

        
        return back()->withFooter('Footer Info Updated successfully!');

    }

    // footer icon
    function footer_icon_store(Request $request){
        $request->validate([
            'icon'=>'required',
        ]);

        FooterIcon::insert([
            'icon'=>$request->icon,
            'icon_link'=>$request->icon_link,
            'created_at'=>Carbon::now(),
        ]);

        return back()->withIcon('Icon Added Successly!');
    }

    // Footer icon delete
    function footer_icon_delete($icon_id){
        FooterIcon::find($icon_id)->delete();
        return back();
    }

    // footer Icon edit
    function footer_icon_edit($icon_id){
        $icons = FooterIcon::find($icon_id);
        return view('admin.footer.footer_icon_edit', [
            'icons'=>$icons,
        ]);
    }

    // footer icon update
    function footer_icon_update(Request $request){
        FooterIcon::find($request->icon_id)->update([
            'icon'=>$request->icon,
            'icon_link'=>$request->icon_link,
        ]);

        return back()->withIcon('Icon Updated Successly!');
    }

    // add work way
    function work_way(){
       $work_way = WorkWay::all();
        $works = AddWorkWay::all();
        return view('admin.footer.add_work_way', [
            'works'=>$works, 
            'work_way'=>$work_way,
        ]);
    }


    // add work way store
    function work_way_store(Request $request){

        $request->validate([
            'add_way'=>'required',
        ]);
        AddWorkWay::insert([
            'add_way'=>$request->add_way,
            'created_at'=>Carbon::now(),
        ]);


        return back()->with('work', 'Work way Added Successfully!');
    }


    function update_work_way(Request $request){

       $request->validate([
            'sub_title'=>'required',
            'title'=>'required',
            'desp'=>'required',
            // 'image'=>'required',
       ]);

      if($request->image == ''){
        WorkWay::find($request->id)->update([
            'sub_title'=>$request->sub_title,
            'title'=>$request->title,
            'desp'=>$request->desp,
           ]);
      }

      else{

        $present_img = WorkWay::find($request->id);
        unlink(public_path('upload/work_way/'.$present_img->image));

        $work_img = $request->image;
        $extension = $work_img->getClientOriginalExtension();
        $size = $work_img->getSize();
        $file_name = $request->sub_title.'.'.$extension;
        Image::make( $work_img)->save(public_path('upload/work_way/'.$file_name));
       

        WorkWay::find($request->id)->update([
            'sub_title'=>$request->sub_title,
            'title'=>$request->title,
            'desp'=>$request->desp,
            'image'=>$file_name,
           ]);

        
      }

       return back();
    }

    // Work way delete
    function work_way_delete($work_id){
        AddWorkWay::find($work_id)->delete();
        return back();
    }

    // privacy policy
    function edit_policy(){
        $policies = Policy::all();
        foreach($policies as $policy){
            $policy_info = $policy;
        }
        return view('admin.footer.edit_policy', [
            'policy_info'=>$policy_info,
        ]);
    }

    // Update privacy policy
    function policy_update(Request $request){

        Policy::find($request->policy_id)->update([
            'desp'=>$request->desp,
        ]);
        return back()->with('policy', 'Privacy Policy Updated Successfully!');
    }



    function copyright(){
        $copyright = FooterCopyright::all();
        return view('admin.footer.copyright',[
            'copyright'=>$copyright,
        ]);
    }

    function copyright_content_update(Request $request){
       
        $request->validate([
            'title'=>'required',
        ]);

        FooterCopyright::where('id', $request->id)->update([
            'title'=>$request->title,
        ]);
    
        return back();
    }


    function provide_info(){
        return view('frontned.provide_info');
    }

    function store_info(Request $request){
        $request->validate([
            'name'=>'required',
            'phone'=>'required|min:11|numeric',
            'address'=>'required',
            'fblink'=>'required',
        ]);

        ProvideInfo::insert([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'link'=>$request->fblink,
        ]);

        return back();
    }


    function customer_provide_info(){
        $provide_info = ProvideInfo::all();
        return view('admin.user.customer_provider_info',[
            'provide_info'=>$provide_info,
        ]);
    }

    function update_provide_info($id){
        $value = ProvideInfo::find($id);
        return view('admin.user.provide_info_edit',[
            'value'=>$value,
        ]);
    }
    
    function provide_edit(Request $request){
    
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'link' => ['required', Rule::unique('provide_infos')->ignore($request->id)],
        ]);
    
        ProvideInfo::find($request->id)->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'link'=>$request->link,
        ]);

        return back();
    }


    function provide_info_delete($id){
        ProvideInfo::find($id)->delete();

        return back();
    }
}
