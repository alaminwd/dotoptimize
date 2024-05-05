<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Career;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Image;


class CareersController extends Controller
{
    function job_post(){
        $careers = Career::all();
        return view('admin.career.career',[
            'careers'=>$careers,
        ]);
    }

    function post_store(Request $request){
        $request->validate([
            'job_title'=>'required',
            'job_desp'=>'required',
            'job_img'=>'required',
            'job_img'=>'mimes:jpg,png',
        ]);

        $random_number = random_int(0, 999);
        $photo = $request->job_img;
        $extension = $photo->getClientOriginalExtension();
        // $size = $request->photo->getSize();
        $file_name = $random_number.'.'.$extension;
        Image::make($photo)->save(public_path('upload/career/'.$file_name));

        
    

        Career::insert([
            'title'=>$request->job_title,
            'desp'=>$request->job_desp,
            'image'=> $file_name,
            'created_at'=>Carbon::now(),
        ]);

        return back();
    }


    function post_delete($post_id){

        $present_img = Career::find($post_id);
        unlink(public_path('upload/career/'.$present_img->image));

        Career::where('id', $post_id)->delete();
        
        return back();
    }

    function post_details($post_id){
        $careers_info = Career::find($post_id);
        
        return view('frontned.single_career',[
            'careers_info'=>$careers_info,
        ]);
    }


    function upload_cv(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:applicants,email',
            'phone'=>'required',
            'cv'=>['required','mimes:pdf'],
        ]);

       
        $file = $request->file(key:"cv");
        $extension2 = $file->getClientOriginalExtension();
        $file_name2 = $request->name.'.'.$extension2;
        
        $destinationPath = "upload/ApplicantCv";
        $file->move($destinationPath, $file_name2);

        Applicant::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'image'=> $file_name2,
        ]);

        return back();
    }

    function applicant(){
        $applicants = Applicant::all();
        return view('admin.user.applicant_list',[
            'applicants'=>$applicants,
        ]);
    }


    function applicant_delete($applicant_id){
        $present_cv = Applicant::find($applicant_id);
        unlink(public_path('upload/ApplicantCv/'.$present_cv->image));
        Applicant::where('id', $applicant_id)->delete();

        return back();
    }



    // Download Applicant CV //

    function download_cv($applicant_id){
        $info = Applicant::find($applicant_id);
        $path_file = public_path('upload/ApplicantCv/'.$info->image);
        return response()->download($path_file, $info->original_name);
        
    }
}
