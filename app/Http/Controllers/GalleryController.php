<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class GalleryController extends Controller
{
    //gallery
    function add_gallery(){
        $galleries = Gallery::paginate(15);
        return view('admin.gallery.add_gallery', [
            'galleries'=>$galleries,
        ]);
    }

    // Gallery store
    function gallery_store(Request $request){
        $request->validate([
            'gallery_name'=>'required',
            'gallery_image'=>'required|mimes:png,jpg',
        ]);

        $gallery = $request->gallery_image;
        $extension = $gallery->getClientOriginalExtension();
        $size = $gallery->getSize();
        $file_name = str_replace(' ', '_', substr($request->gallery_name, 0, 10)).'.'.$extension;

        if($size < 2000000){
            Image::make($gallery)->save(public_path('upload/gallery/'.$file_name));

            Gallery::insert([
                'gallery_name'=>$request->gallery_name,
                'gallery_image'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{
            return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
        }
        return back()->with('gallery', 'Gallery Added Successfully');

    }

    // Gallery delete
    function gallery_delete($gal_id){
        $present_img = Gallery::find($gal_id);
        unlink(public_path('upload/gallery/'.$present_img->gallery_image));

        Gallery::find($gal_id)->delete();
        return back();
    }
}
