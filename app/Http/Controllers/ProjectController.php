<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Plan;
use App\Models\Project;
use App\Models\project_section_title;
use App\Models\ProjectPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class ProjectController extends Controller
{
    //project
    function add_project(){
        return view('admin.project.add_project');
    }


    // ===project section title store
    function project_section_title(){
        $section_title =  project_section_title::all();
        return view('admin.project.add_section_title',[
           'section_title'=> $section_title,
        ]);
    }
    function section_title_update(Request $request){
        $request->validate([
            'section_title'=>'required',
            'section_desp'=>'required',
        ]);

        project_section_title::where('id', $request->id)->update([
            'section_title'=>$request->section_title,
            'section_desp'=>$request->section_desp,
        ]);

        return back();
    }

    // project store
    function project_store(Request $request){
        $request->validate([
            'title'=>'required',
            'client'=>'required',
            'author'=>'required',
            'place'=>'required',
            'desp'=>'required',
            'long_desp'=>'required',
            'keyword'=>'required',
            'image'=>'required|mimes:png,jpg',
        ]);

        $project_img = $request->image;
        $extension = $project_img->getClientOriginalExtension();
        $size = $project_img->getSize();
        $file_name = str_replace(' ', '_', $request->client).'.'.$extension;
        
        if($size < 2000000){
            Image::make($project_img)->save(public_path('upload/project/'.$file_name));

            Project::insert([
                'title'=>$request->title,
                'client'=>$request->client,
                'author'=>$request->author,
                'place'=>$request->place,
                'desp'=>$request->desp,
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

    // Project List
    function project_list(){
        $projects = Project::all();
        return view('admin.project.project_list', [
            'projects'=>$projects,
        ]);
    }
    
    
    // project Edit

    function project_edit($project_id){
        $projects = Project::find($project_id);
        return view('admin.project.project_edit',[
            'projects'=>$projects,
        ]);
    }

    function project_update(Request $request){
        $request->validate([
            'title'=>'required',
            'client'=>'required',
            'author'=>'required',
            'place'=>'required',
            'desp'=>'required',
            'long_desp'=>'required',
            'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg',],

        ]);

        if($request->image == null){
            Project::where('id', $request->id)->update([
                'title'=>$request->title,
                'client'=>$request->client,
                'author'=>$request->author,
                'place'=>$request->place,
                'desp'=>$request->short_desp,
                'long_desp'=>$request->long_desp,
                'created_at'=>Carbon::now(),
            ]);

            return back();
        }
        else{

            $prevImage =  Project::find($request->id);
            if($prevImage->image != null){
                unlink(public_path('upload/project/'.$prevImage->image));
            }

            $project_img = $request->image;
            $extension = $project_img->getClientOriginalExtension();
            $size = $project_img->getSize();
            $file_name = str_replace(' ', '_', $request->client).'.'.$extension;
            
            Image::make($project_img)->save(public_path('upload/project/'.$file_name));
    
            Project::where('id', $request->id)->update([
                'title'=>$request->title,
                'client'=>$request->client,
                'author'=>$request->author,
                'place'=>$request->place,
                'desp'=>$request->short_desp,
                'long_desp'=>$request->long_desp,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
                
            ]);

            return back();
        }
    }

    // Project Delete
    function project_delete($project_id){
        $present_img = Project::find($project_id);
        unlink(public_path('upload/project/'.$present_img->image));

        Project::find($project_id)->delete();
        return back();
    }

    // project price
    function project_price($project_id){
        $projects_info = Project::find($project_id);
        $plans = Plan::all();
        $project_plans = ProjectPlan::where('project_id', $project_id)->get();
        return view('admin.project.project_price', [
            'projects_info'=>$projects_info,
            'plans'=>$plans,
            'project_plans'=>$project_plans,
        ]);
    }

    // Project plan store
    function project_plan_store(Request $request){
        $request->validate([
            'plan_id'=>'required',
        ]);

        ProjectPlan::insert([
            'project_id'=>$request->project_id,
            'plan_id'=>$request->plan_id,
            'created_at'=>Carbon::now(),
        ]);

        return back()->withPlan('Pricing Plan Added Successfully!');
    }

    // project plan delete
    function project_plan_delete($plan_id){
        ProjectPlan::find($plan_id)->delete();
        return back();
    }

    
}
