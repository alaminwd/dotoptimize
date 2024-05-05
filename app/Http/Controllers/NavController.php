<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Logo;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use Str;

class NavController extends Controller
{
     // Logo list
     function nav_logo(){
        $logos = Logo::all();
        return view('admin.navbar&banner.logo', [
            'logos'=>$logos,
        ]);
    }

    // Add Logo
    function logo_store(Request $request){
        $request->validate([
            'logo_name'=>'required|unique:logos',
            'logo'=>'required|mimes:png',
         ]);
         
            $upload_logo = $request->logo;
            $extension = $upload_logo->getClientOriginalExtension();
            $size = $request->logo->getSize();
            $file_name = Str::lower(str_replace(' ','-', $request->logo_name)).'.'.$extension;
            
            
            if($size < 200000000){
               Image::make($upload_logo)->save(public_path('upload/logo/'.$file_name));
               
            Logo::insert([
                'logo_name'=>$request->logo_name,
                'logo'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
           }
           else{
                return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
           }
           
            return back()->withLogoadd('Logo Added Successfully');
        }

         // Logo Delete
         function logo_delete($logo_id){
            $present_logo = Logo::find($logo_id);
            unlink(public_path('upload/logo/'.$present_logo->logo));
    
            Logo::find($logo_id)->delete();
    
            return back()->withLogodel('Logo Successfully Deleted');
        }

        // Logo Status
        function logo_status($logo_id){
        
            $get_status = Logo::find($logo_id);
            
            if($get_status->status == 1){
                Logo::where('id', $logo_id)->update([
                    'status'=>0,
                ]);
            }
            else{
                Logo::where('id', $logo_id)->update([
                    'status'=>1,
                ]);
                Logo::where('id', '!=', $logo_id)->update([
                    'status'=>0,
                ]);
            }
            
             return back();
        }

        // ====================== logo end =====================

 // ================= menu start =====================

        // Menu list
        function nav_menu(){
            $menus = Menu::all();
            return view('admin.navbar&banner.menu', [
                'menus'=>$menus,
            ]);
        }

        // Add Menu 
        function menu_store(Request $request){
            $request->validate([
                'menu_name'=>'required',
                'menu_link'=>'required',
            ]);
    
            Menu::insert([
                'menu_name'=>$request->menu_name,
                'menu_link'=>$request->menu_link,
                'created_at'=>Carbon::now(),
            ]);
    
            return back()->withmenu('Successfully Updated');
        }
    
        // Delete Menu
        function menu_delete($menu_id){
            Menu::find($menu_id)->delete();
            return back()->withMenu_del('Successfully Deleted');
        }
    
        // edit Menu
        function menu_edit($menu_id){
            $menus_info = Menu::find($menu_id);
            return view('admin.navbar&banner.edit_menu', [
                'menus_info'=>$menus_info,
            ]);
        }
    
        // update Menu
        function menu_update(Request $request){
            Menu::find($request->menu_id)->update([
                'menu_name'=>$request->menu_name,
                'menu_link'=>$request->menu_link,
            ]);
            return back()->withMenu_up('Successfully Updated');
        }

        // ================== Menu end ================
        

        // ================== Banner Start ================
        // banner info
        function banner(){
            $banners = Banner::all();
            foreach($banners as $banner){
                $banner_info = $banner;
            }
            return view('admin.navbar&banner.banner', [
                'banner_info'=>$banner_info,
            ]);
        }

        // banner update
        function banner_update(Request $request){

           if($request->image==''){
            Banner::find($request->banner_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
            ]);
           }
           else{
            $present_img = Banner::find($request->banner_id);
            unlink(public_path('upload/banner/'.$present_img->image));

            $banner_img = $request->image;
            $banner_img->move('upload/banner', $banner_img->getClientOriginalName());
            $file_name = $banner_img->getClientOriginalName();

            Banner::find($request->banner_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'image'=>$file_name,
            ]);
           }
            return back()->withBanner('Banner updated Successfully');
        }

        // ================== Banner end ================


}
