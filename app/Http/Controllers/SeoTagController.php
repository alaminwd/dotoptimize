<?php

namespace App\Http\Controllers;

use App\Models\AboutSeo;
use App\Models\BlogSeo;
use App\Models\CareerJobField;
use App\Models\CareerSeo;
use App\Models\CaseStudiesSeo;
use App\Models\CompanySeo;
use App\Models\HomeSeo;
use App\Models\HowItWorkSeo;
use App\Models\PressMediaSeo;
use App\Models\PrivacyPolicySeo;
use App\Models\ProductSeo;
use App\Models\ProjectSeo;
use App\Models\ServiceSeo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class SeoTagController extends Controller
{
    function home_seo(){
        $seo_info = HomeSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }

        return view('admin.seo.home_seo', [
            'seos'=>$seos,
        ]);
    }

    function home_seo_store(Request $request){
    
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'tag'=>'required',
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        if($request->image == ''){
            HomeSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'created_at'=>Carbon::now(),
                
            ]);
        }
        else{

            $prev_img = HomeSeo::find($request->seo_id);
            if( $prev_img->image != null ){
                unlink(public_path('upload/home_seo_img/'.$prev_img->image));
            }
            
            

            $photo = $request->image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = substr($request->title,0, 10).'.'.$extension;
            Image::make($photo)->save(public_path('upload/home_seo_img/'.$file_name));


            HomeSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
                
            ]);
        }

       

        return back();
    }

    function about_seo(){
        $seo_info = AboutSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }

        return view('admin.seo.about_seo', [
            'seos'=>$seos,
        ]);
    }

    function about_seo_store(Request $request){

        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'tag'=>'required',
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        if($request->image == ''){
            AboutSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{
            $prev_img = AboutSeo::find($request->seo_id);
            if( $prev_img->image != null ){
                unlink(public_path('upload/about_seo_img/'.$prev_img->image));
            }
            
            

            $photo = $request->image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = substr($request->title,0, 10).'.'.$extension;
            Image::make($photo)->save(public_path('upload/about_seo_img/'.$file_name));


            AboutSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
        }

      

        return back();
    }

    function service_seo(){
        $seo_info = ServiceSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }

        return view('admin.seo.service_seo', [
            'seos'=>$seos,
        ]);
        
    }

    function service_seo_store(Request $request){

        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'tag'=>'required',
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

    
        if($request->image == ''){
            ServiceSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{

            $prev_img = ServiceSeo::find($request->seo_id);
            if( $prev_img->image != null ){
                unlink(public_path('upload/service_seo_img/'.$prev_img->image));
            }
            
            

            $photo = $request->image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = substr($request->title,0, 10).'.'.$extension;
            Image::make($photo)->save(public_path('upload/service_seo_img/'.$file_name));


            ServiceSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
                
            ]);
        }

        return back();
    }

    function project_seo(){
        $seo_info = ProjectSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }

        return view('admin.seo.proejct_seo', [
            'seos'=>$seos,
        ]);
        
    }

    function project_seo_store(Request $request){
        
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'tag'=>'required',
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

    
        if($request->image == ''){
                ProjectSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{

            $prev_img = ProjectSeo::find($request->seo_id);
            if( $prev_img->image != null ){
                unlink(public_path('upload/project_seo_img/'.$prev_img->image));
            }
            
            

            $photo = $request->image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = substr($request->title,0, 10).'.'.$extension;
            Image::make($photo)->save(public_path('upload/project_seo_img/'.$file_name));


            ProjectSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
                
            ]);
        }

        return back();
    }


    function product_seo(){
        $seo_info = ProductSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }

        return view('admin.seo.product_seo', [
            'seos'=>$seos,
        ]);
        
    }

    function product_seo_store(Request $request){

        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'tag'=>'required',
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

    
        if($request->image == ''){
            ProductSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{

            $prev_img = ProductSeo::find($request->seo_id);
            if( $prev_img->image !=null){
                unlink(public_path('upload/product_seo_img/'.$prev_img->image));
            }
            

            $photo = $request->image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = substr($request->title,0, 10).'.'.$extension;
            Image::make($photo)->save(public_path('upload/product_seo_img/'.$file_name));


            ProductSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
                
            ]);
        }


        return back();
    }

    
    function blog_seo(){
        $seo_info = BlogSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }

        return view('admin.seo.blog_seo', [
            'seos'=>$seos,
        ]);
        
    }

    function blog_seo_store(Request $request){
      
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'tag'=>'required',
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

    
        if($request->image == ''){
            BlogSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{

            $prev_img = BlogSeo::find($request->seo_id);
            if($prev_img->image != null){
                unlink(public_path('upload/blog_seo_img/'.$prev_img->image));
            }
            

            $photo = $request->image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = substr($request->title,0, 10).'.'.$extension;
            Image::make($photo)->save(public_path('upload/blog_seo_img/'.$file_name));


            BlogSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
                
            ]);
        }

        return back();
    }


    // career Seo process

    function career_seo(){
        $seo_info = CareerSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }
        return view('admin.seo.career_seo', [
            'seos'=>$seos,
        ]);   
    }


    function career_seo_store(Request $request){
        
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'tag'=>'required',
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

    
        if($request->image == ''){
            CareerSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{

            $prev_img = CareerSeo::find($request->seo_id);
            if($prev_img->image != null){
                unlink(public_path('upload/career_seo_img/'.$prev_img->image));
            }
           

            
            

            $photo = $request->image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = substr($request->title,0, 10).'.'.$extension;
            Image::make($photo)->save(public_path('upload/career_seo_img/'.$file_name));


            CareerSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
                
            ]);
        }

        return back();
    }


    function press_media_seo(){
        $seo_info = PressMediaSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }
        return view('admin.seo.press_media_seo',[
            'seos'=>$seos,
        ]);
    }


    function press_media_seo_store(Request $request){
        
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'tag'=>'required',
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

    
        if($request->image == ''){
            PressMediaSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{

            $prev_img = PressMediaSeo::find($request->seo_id);
            
            if( $prev_img->image != null){
                unlink(public_path('upload/press_media_seo/'.$prev_img->image));
            }
            

            $photo = $request->image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = substr($request->title,0, 10).'.'.$extension;
            Image::make($photo)->save(public_path('upload/press_media_seo/'.$file_name));


            PressMediaSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
                
            ]);
        }

        return back();
    }

    function company_seo(){
        $seo_info =CompanySeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }
        return view('admin.seo.company_seo',[
            'seos'=>$seos,
        ]);
    }


    function company_seo_store(Request $request){
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'tag'=>'required',
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

    
        if($request->image == ''){
            CompanySeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{

            $prev_img = CompanySeo::find($request->seo_id);
            
            if( $prev_img->image != null){
                unlink(public_path('upload/company_seo_img/'.$prev_img->image));
            }
            

            $photo = $request->image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = substr($request->title,0, 10).'.'.$extension;
            Image::make($photo)->save(public_path('upload/company_seo_img/'.$file_name));


            CompanySeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
                
            ]);
        }

        return back();
    }


    function privacy_policy_seo(){
        $seo_info =PrivacyPolicySeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }
        return view('admin.seo.privacy_policy_seo',[
            'seos'=>$seos,
        ]);
    }


    function privacy_seo_update(Request $request){
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'tag'=>'required',
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

    
        if($request->image == ''){
            PrivacyPolicySeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{

            $prev_img = PrivacyPolicySeo::find($request->seo_id);
            if( $prev_img->image != null){
                unlink(public_path('upload/privacy_policy_seo/'.$prev_img->image));
            }
            
            
            

            $photo = $request->image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = substr($request->title,0, 10).'.'.$extension;
            Image::make($photo)->save(public_path('upload/privacy_policy_seo/'.$file_name));


            PrivacyPolicySeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
                
            ]);
        }

        return back();
    }

    function career_job_sub(){

        $seo_info =CareerJobField::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }
        return view('admin.seo.job_field',[
            'seos'=>$seos,
        ]);
    }

    function job_seo_store(Request $request){
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'tag'=>'required',
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

    
        if($request->image == ''){
            CareerJobField::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{

            $prev_img = CareerJobField::find($request->seo_id);
            if($prev_img->image != null){
                unlink(public_path('upload/job_field_seo/'.$prev_img->image));
            }
           
            

            $photo = $request->image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = substr($request->title,0, 10).'.'.$extension;
            Image::make($photo)->save(public_path('upload/job_field_seo/'.$file_name));


            CareerJobField::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
                
            ]);
        }

        return back();
    }


    function case_studies_seo(){
        $seo_info =CaseStudiesSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }
        return view('admin.seo.case_studies',[
            'seos'=>$seos,
        ]);
    }


    function case_studies_seo_store(Request $request){
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'tag'=>'required',
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

    
        if($request->image == ''){
            CaseStudiesSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{

          
            $prev_img = CaseStudiesSeo::find($request->seo_id);
            if($prev_img->image != null){
                unlink(public_path('upload/CaseStudiesSeo/'.$prev_img->image));
            }
            
           
            

            $photo = $request->image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = substr($request->title,0, 10).'.'.$extension;
            Image::make($photo)->save(public_path('upload/CaseStudiesSeo/'.$file_name));


            CaseStudiesSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
                
            ]);
        }

        return back();
    }


    function how_it_work_seo(){
        $seo_info =HowItWorkSeo::all();
        foreach($seo_info as $seos){
            $seos = $seos;
        }
        return view('admin.seo.how_it_work_seo',[
            'seos'=>$seos,
        ]);
    }


    function how_it_work_seo_store(Request $request){
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'tag'=>'required',
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

    
        if($request->image == ''){
            HowItWorkSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{

            $prev_img = HowItWorkSeo::find($request->seo_id);
            if($prev_img->image != null){
                unlink(public_path('upload/howI_it_work_seo/'.$prev_img->image));
            }
            

            $photo = $request->image;
            $extension = $request->file('image')->getClientOriginalExtension();
            $file_name = substr($request->title,0, 10).'.'.$extension;
            Image::make($photo)->save(public_path('upload/howI_it_work_seo/'.$file_name));


            HowItWorkSeo::find($request->seo_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'tag'=>$request->tag,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
                
            ]);
        }

        return back();
    }

    
}
