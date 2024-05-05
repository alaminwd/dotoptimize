<?php

namespace App\Http\Controllers;


use App\Models\Review;
use App\Models\TestimonialsContent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use PhpParser\Node\Expr\AssignOp\Pow;

class ReviewController extends Controller
{
    //Review
    function add_review(){
        $reivews = Review::all();
        return view('admin.review.add_review', [
            'reivews'=>$reivews,
        ]);
    }
    // Review store
    function review_store(Request $request){
        $request->validate([
            'name'=>'required',
            'profession'=>'required',
            'comment'=>'required',
            'logo'=>'mimes:png',
        ]);

        if($request->logo==''){
            Review::insert([
                'name'=>$request->name,
                'profession'=>$request->profession,
                'comment'=>$request->comment,
                'created_at'=>Carbon::now(),
            ]);
            
        }
        else{
            $random = random_int(1, 99);
            $logo = $request->logo;
            $extension = $logo->getClientOriginalExtension();
            $size = $logo->getSize();
            $file_name = $request->name.$random.'.'.$extension;

            if($size < 2000000){
                Image::make($logo)->save(public_path('upload/review/'.$file_name));

                Review::insert([
                    'name'=>$request->name,
                    'profession'=>$request->profession,
                    'comment'=>$request->comment,
                    'logo'=>$file_name,
                    'created_at'=>Carbon::now(),
                ]);
            }
            else{
                return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
            }
        }
        return back()->withReview('Review added Successfully!');
    }

    // review Delete
    function review_delete($reivew_id){
        $present_img = Review::find($reivew_id);
        if($present_img->logo != null){
            unlink(public_path('upload/review/'.$present_img->logo));
        }

        Review::find($reivew_id)->delete();
        return back();
    }

    // review edit
    function review_edit($reivew_id){
        $review_info = Review::find($reivew_id);
        return view('admin.review.edit_review', [
            'review_info'=>$review_info,
        ]);
    }

    // Review update
    function review_update(Request $request){
        $request->validate([
            'logo'=>'mimes:png',
        ]);

        if($request->logo==''){
            Review::find($request->review_id)->update([
                'name'=>$request->name,
                'profession'=>$request->profession,
                'comment'=>$request->comment,
            ]);
            
        }
        else{
            $random = random_int(1, 99);
            $logo = $request->logo;
            $extension = $logo->getClientOriginalExtension();
            $size = $logo->getSize();
            $file_name = $request->name.$random.'.'.$extension;

            if($size < 2000000){
                $present_img = Review::find($request->review_id);
                if($present_img->logo != null){
                    unlink(public_path('upload/review/'.$present_img->logo));
                }


                Image::make($logo)->save(public_path('upload/review/'.$file_name));

                Review::find($request->review_id)->update([
                    'name'=>$request->name,
                    'profession'=>$request->profession,
                    'comment'=>$request->comment,
                    'logo'=>$file_name,
                ]);
            }
            else{
                return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
            }
        }
        return back()->withReview('Review Updated Successfully!');
    }



    // =====Testimonial Content Update =========//

    function testimonial_content(){
        $contents = TestimonialsContent::all();
        foreach($contents as $content){
            $testimolial = $content;
        }
        return view('admin.review.testimonial_content',[
            'content'=>$content,
        ]);
    }



    function testimonial_content_update(Request $request){
    
       $request->validate([
        'sub_title'=>'required',
        'title'=>'required',
        'image'=>['image', 'mimes:jpeg,png,jpg,gif,svg'],
       ]);

       if($request->image == null){
            TestimonialsContent::where('id', $request->id)->update([
                'sub_title'=>$request->sub_title,
                'title'=>$request->title,
                'created_at'=>Carbon::now(),
            ]);
       }

       else{

            $prev_img = TestimonialsContent::find($request->id);
            unlink(public_path('upload/testimonial/'.$prev_img ->image));

            $file = $request->image;
            $extension = $file->getClientOriginalExtension();
            $file_name = str_replace(' ', '_', substr($request->sub_title, 0, 10)).'.'.$extension;
            Image::make($file)->save(public_path('upload/testimonial/'.$file_name));
            // Image::make($logo)->save(public_path('upload/review/'.$file_name));

            TestimonialsContent::where('id', $request->id)->update([
                'sub_title'=>$request->sub_title,
                'title'=>$request->title,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
       }

       return back();
    }

}
