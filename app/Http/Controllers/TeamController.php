<?php

namespace App\Http\Controllers;

use App\Models\MemberIcon;
use App\Models\Team;
use App\Models\Teamskill;
use App\Models\TeamTitle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class TeamController extends Controller
{
    //Member List
    function member(){
        return view('admin.team.add_member',[
           
        ]);
    }

    // =====title store=========
    function member_section_title(){
        $section_title = TeamTitle::all();
        return view('admin.team.add_title',[
            'section_title'=>$section_title,
        ]);

        
    }
    function team_title_update(Request $request){
        $request->validate([
            'section_title'=>'required',
            'section_desp'=>'required',
        ]);
        TeamTitle::where('id', $request->id)->update([
            'section_title'=>$request->section_title,
            'section_desp'=>$request->section_desp,
        ]);

        return back();
    }

    // Member store
    function member_store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'role'=>'required',
            'image'=>'mimes:png,jpg',
        ]);

           if($request->image == ''){
             Team::insert([
                'name'=>$request->name,
                'email'=>$request->email,
                'role'=>$request->role,
                'phone'=>$request->phone,
                'short_desp'=>$request->short_desp,
                'about'=>$request->about,
                'address'=>$request->address,
                'created_at'=>Carbon::now(),
            ]);
           }

            else{
            $random = random_int(10, 99);
            $member_img = $request->image;
            $extension = $member_img->getClientOriginalExtension();
            $size = $request->image->getSize();
            $file_name = str_replace(' ','_',$request->name).$random.'.'.$extension;
            
            if($size < 2000000){
                Image::make($member_img)->save(public_path('upload/team/'.$file_name));
                   
                Team::insert([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'role'=>$request->role,
                    'phone'=>$request->phone,
                    'short_desp'=>$request->short_desp,
                    'about'=>$request->about,
                    'address'=>$request->address,
                    'image'=>$file_name,
                    'created_at'=>Carbon::now(),
                ]);
                    
                }
            else{
                return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
                }
            }

        return back()->withTeam('Member Successfully Added!');

    }

    // Member List
    function member_list(){
        $members = Team::all();
        return view('admin.team.member_list', [
            'members'=>$members,
        ]);
    }

    // Member Delete
    function member_delete($member_id){
        
        $present_img = Team::find($member_id);
        if($present_img->image!=null){
            unlink(public_path('upload/team/'.$present_img->image));
        }
        Team::find($member_id)->delete();
        return back();
    }

    // Member Edit
    function member_edit($member_id){
        $member_info = Team::find($member_id);
        return view('admin.team.edit_member', [
            'member_info'=>$member_info,
        ]);
    }

    // Member update
    function member_update(Request $request){
        $request->validate([
            'image'=>'mimes:png,jpg',
        ]);

        if($request->image==''){
            Team::find($request->member_id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'role'=>$request->role,
                'phone'=>$request->phone,
                'short_desp'=>$request->short_desp,
                'about'=>$request->about,
                'address'=>$request->address,
            ]);
        }
        else{

            $member_img = $request->image;
            $extension = $member_img->getClientOriginalExtension();
            $size = $request->image->getSize();
            $file_name = $request->member_id.'.'.$extension;
            
            if($size< 2000000 ){
                $present_img = Team::find($request->member_id);
                if($present_img->image){
                    unlink(public_path('upload/team/'.$present_img->image));
                }
                Image::make($member_img)->save(public_path('upload/team/'.$file_name));

                Team::find($request->member_id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'role'=>$request->role,
                    'phone'=>$request->phone,
                    'short_desp'=>$request->short_desp,
                    'about'=>$request->about,
                    'address'=>$request->address,
                    'image'=>$file_name,
                ]);
            }
            else{
                return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
           }
        }

        return back()->withTeam('Member info Successfully Updated!');
    }


    // Member Skill
    function member_skill(){
        $members = Team::all();
        foreach ($members as $member){
            $member = $member;
        }
        
        return view('admin.team.add_member_skill', [
            'members'=>$members,
        ]);
    }

    // Member Skill store
    function member_skill_store(Request $request){
        $request->validate([
            'member_id'=>'required',
            'skill'=>'required',
            'percent'=>'required',
        ]);

        Teamskill::insert([
            'member_id'=>$request->member_id,
            'skill'=>$request->skill,
            'percent'=>$request->percent,
            'created_at'=>Carbon::now(),
        ]);

        return back()->withSkill('Skill Added Successfully!');
    }

    // Member Skill Delete
    function member_skill_delete($skill_id){
        Teamskill::find($skill_id)->delete();
        return back();
    }

    // Member Skill Edit
    function member_skill_edit($skill_id){
        $skills_info = Teamskill::find($skill_id);
        return view('admin.team.edit_member_skill', [
            'skills_info'=>$skills_info,
        ]);
    }

    // Member Skill Update
    function member_skill_update(Request $request){
        Teamskill::find($request->skill_id)->update([
            'skill'=>$request->skill,
            'percent'=>$request->percent,
        ]);
        return back()->withSkill('Skill updated Successfully!');
    }

    // Member Icon
    function member_icon(){
        $members = Team::all();
        return view('admin.team.member_icon', [
            'members'=>$members,
        ]);
    }

    // Member Icon store
    function member_icon_store(Request $request){
        $request->validate([
            'icon'=>'required',
            'member_id'=>'required',
        ]);

        MemberIcon::insert([
            'icon'=>$request->icon,
            'icon_link'=>$request->icon_link,
            'member_id'=>$request->member_id,
            'created_at'=>Carbon::now(),
        ]);

        return back()->withIcon('Icon Added Successfully!');

    }

    // Member Icon delete
    function member_icon_delete($icon_id){
        MemberIcon::find($icon_id)->delete();
        return back();
    }

    // Member Icon Edit
    function member_icon_edit($icon_id){
        $icon_info = MemberIcon::find($icon_id);
        return view('admin.team.edit_member_icon', [
            'icon_info'=>$icon_info,
        ]);
    }

    // Member Icon update
    function member_icon_update(Request $request){
        MemberIcon::find($request->icon_id)->update([
            'icon'=>$request->icon,
            'icon_link'=>$request->icon_link,
        ]);

        return back()->withIcon('Icon updated Successfully!');
    }
}
