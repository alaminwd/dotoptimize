<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Client;
use App\Models\Overview;
use App\Models\Request_form;
use App\Models\Skill;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use Str;

class AboutController extends Controller
{
    //About Info
    function about_info(){
        $abouts = About::all();
        foreach ($abouts as $about){
            $about_info = $about;
        }
        return view('admin.about.about_info', [
            'about_info'=>$about_info,
        ]);
    }

    // About Update
    function about_update(Request $request){
       $request->validate([
        'image'=>'mimes:png,jpg',
       ]);

      if($request->image==''){
        About::find($request->about_id)->update([
            'title'=>$request->title,
            'desp'=>$request->desp,
            'experience'=>$request->experience,
            'award'=>$request->award,
            'client'=>$request->client,
       ]);

      }

      else{
 
        $about_img = $request->image;
        $extension = $about_img->getClientOriginalExtension();
        $size = $request->image->getSize();
        $file_name = Str::lower(substr($request->title, 0, 3)).'.'.$extension;
        
        
        if($size < 2000000){
            $present_img = About::find($request->about_id);
            unlink(public_path('upload/about/'.$present_img->image));

            Image::make($about_img)->save(public_path('upload/about/'.$file_name));

            About::find($request->about_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'experience'=>$request->experience,
                'award'=>$request->award,
                'client'=>$request->client,
                'image'=>$file_name,
           ]);
        }
        else{
            return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
        }
      }
      
       return back()->withAbout('About Info Successfully Updated');
    }

    // Client
    function client(){
        $clients = Client::all();
        return view('admin.about.client', [
            'clients'=>$clients,
        ]);
    }

    // Client store
    function client_store(Request $request){
        $request->validate([
            'company_name'=>'required',
            'company_link'=>'required',
            'company_logo'=>'mimes:png|required',
        ]);
 
        $company_logo = $request->company_logo;
        $extension = $company_logo->getClientOriginalExtension();
        $size = $request->company_logo->getSize();
        $file_name = Str::lower(str_replace(' ', '_',$request->company_name)).'.'.$extension;
        
        
        if($size < 2000000){
            Image::make($company_logo)->save(public_path('upload/client/'.$file_name));
            
            Client::insert([
                'company_name'=>$request->company_name,
                'company_link'=>$request->company_link,
                'company_logo'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{
            return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
       }

        return back()->with('client_logo', 'Succesfully Added');

    }

    // Client delete
    function client_delete($client_id){
        $present_img = Client::find($client_id);
        unlink(public_path('upload/client/'.$present_img->company_logo));

        Client::find($client_id)->delete();
        return back();
    }

    // Skill
    function skill(){
        $skills = Skill::all();
        return view('admin.about.skill', [
            'skills'=>$skills,
        ]);
    }

    // Skill store
    function skill_store(Request $request){
        $request->validate([
            'skill'=>'required',
            'percent'=>'required',
        ]);

        Skill::insert([
            'skill'=>$request->skill,
            'percent'=>$request->percent,
            'created_at'=>Carbon::now(),
        ]);

        return back()->withSkill('Successfully Skill Added!');
    }

    // Skill Delete
    function skill_delete($skill_id){
        Skill::find($skill_id)->delete();
        return back();
    }

    // Skill Edit
    function skill_edit($skill_id){
        $skill_info = Skill::find($skill_id);
        return view('admin.about.edit_skill', [
            'skill_info'=>$skill_info,
        ]);
    }

    // Skill Update
    function skill_update(Request $request){
        Skill::find($request->skill_id)->update([
            'skill'=>$request->skill,
            'percent'=>$request->percent,
        ]);
        return back()->withSkill('Successfully Skill Updated!');
    }

    // Work Info
    function work(){
        $works = Work::all();
        foreach ($works as $work){
            $work_info = $work;
        }
        return view('admin.about.work_info', [
            'work_info'=>$work_info,
        ]);
    }

    // Work Info
    function work_update(Request $request){
        $request->validate([
            'image'=>'mimes:png,jpg',
        ]);

        Work::find($request->work_id)->update([
            'title'=>$request->title,
            'desp'=>$request->desp,
            'video_link'=>$request->video_link,


        ]);


        if($request->image != ''){
            $work_img = $request->image;
            $extension = $work_img->getClientOriginalExtension();
            $size = $request->image->getSize();
            $file_name = Str::lower(str_replace(' ', '_',$request->title)).'.'.$extension;
            

            
            if($size < 2000000){

                $present_img = work::find($request->work_id);
                unlink(public_path('upload/work/'.$present_img->image));

                Image::make($work_img)->save(public_path('upload/work/'.$file_name));
                
                Work::find($request->work_id)->update([
                    'title'=>$request->title,
                    'desp'=>$request->desp,
                    'video_link'=>$request->video_link,
                    'image'=>$file_name,
        
                ]);


            }
            else{
                return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
           }
        }


        return back()->withWork('Work Info Successfully Updated!');
    }

    // company overview
    function overview(){
        $overviwes = Overview::all();
        foreach($overviwes as $overviwe){
            $overviwe_info = $overviwe;
        }
        return view('admin.about.comany_overview', [
            'overviwe_info'=>$overviwe_info,
        ]);
    }

    // Company overview Update
    function overview_update(Request $request){
        $request->validate([

            'main_img'=>'mimes:png,jpg',
            'site_img'=>'mimes:png,jpg',
        ]);

      

        if($request->main_img == ''){
            if($request->site_img == ''){
                if($request->icon == ''){
                    Overview::find($request->overview_id)->update([
                        'title'=>$request->title,
                        'desp'=>$request->desp,
                       ]);   
                }
                else{
                    Overview::find($request->overview_id)->update([
                        'title'=>$request->title,
                        'desp'=>$request->desp,
                        'icon'=>$request->icon,
                       ]);   
                }
            }

            else{
                $ran_number2 = rand(0, 9999999);
                $site_photo = $request->site_img;
                $extension = $site_photo->getClientOriginalExtension();
                $file_name2 = $ran_number2.'.'.$extension;
                Image::make($site_photo)->save(public_path('upload/overview/'.$file_name2));

                Overview::find($request->overview_id)->update([
                    'title'=>$request->title,
                    'desp'=>$request->desp,
                    'site_img'=>$file_name2,
                    'icon'=>$request->icon,
                   ]);   
            }
        }



        else{

            if($request->site_img == '' ){
                if($request->icon == ''){

                    $ran_number = rand(0, 99999);
                    $photo = $request->main_img;
                    $extension = $photo->getClientOriginalExtension();
                    $file_name =$ran_number.'.'.$extension;
                    Image::make($photo)->save(public_path('upload/overview/'.$file_name));

                    Overview::find($request->overview_id)->update([
                        'title'=>$request->title,
                        'desp'=>$request->desp,
                        'main_img'=>$file_name,
                    ]); 

                }

                else{
                    $ran_number = rand(0, 99999);
                    $photo = $request->main_img;
                    $extension = $photo->getClientOriginalExtension();
                    $file_name =$ran_number.'.'.$extension;
                    Image::make($photo)->save(public_path('upload/overview/'.$file_name));

                    Overview::find($request->overview_id)->update([
                        'title'=>$request->title,
                        'desp'=>$request->desp,
                        'main_img'=>$file_name,
                        'icon'=>$request->icon,
                    ]); 

                }
            }

            else{
                
            $ran_number = rand(0, 99999);
            $ran_number2 = rand(0, 9999999);
        
            $photo = $request->main_img;
            $extension = $photo->getClientOriginalExtension();
            $file_name =$ran_number.'.'.$extension;
            Image::make($photo)->save(public_path('upload/overview/'.$file_name));

            $site_photo = $request->site_img;
            $extension = $site_photo->getClientOriginalExtension();
            $file_name2 = $ran_number2.'.'.$extension;
            Image::make($site_photo)->save(public_path('upload/overview/'.$file_name2));
        

            Overview::find($request->overview_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'main_img'=>$file_name,
                'site_img'=>$file_name2,
                'icon'=>$request->icon,
               ]); 

            }

        }
       return back();
    }

}
