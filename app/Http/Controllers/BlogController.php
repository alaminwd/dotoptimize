<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Blog_Comment;
use App\Models\BlogTag;
use App\Models\Category;
use App\Models\customer;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class BlogController extends Controller
{
    //category
    function add_category(){
        $categories = Category::all();
        return view('admin.blog.add_category', [
            'categories'=>$categories,
        ]);
    }

    // Category store
    function category_store(Request $request){
        $request->validate([
            'category_name'=>'required|unique:categories',
        ]);

        Category::insert([
            'category_name'=>$request->category_name,
            'created_at'=>Carbon::now(),
        ]);

        return back()->withCategory('Category Added Successfully');
    }

    // category delete
    function category_delete($category_id){
        Category::find($category_id)->delete();
        return back();
    }

    // category edit
    function category_edit($category_id){
        $category_info = Category::find($category_id);
        return view('admin.blog.edit_category', [
            'category_info'=>$category_info,
        ]);
    }

    // Category update
    function category_update(Request $request){
        Category::find($request->category_id)->update([
            'category_name'=>$request->category_name,
        ]);

        return back()->withCategory('Category Updated Successfully');
    }


    // ================== tag ===========

    // tags
    function add_tag(){
        $tags = Tag::paginate(20);
        return view('admin.blog.add_tag', [
            'tags'=>$tags,
        ]);
    }

    // tag store
    function tag_store(Request $request){
        $request->validate([
            'tag_name'=>'required',
        ]);

        Tag::insert([
            'tag_name'=>$request->tag_name,
            'created_at'=>Carbon::now(),
        ]);

        return back()->withTag('Tag added Successfully');
       
    }

    // Tag Delete
    function tag_delete($tag_id){
        Tag::find($tag_id)->delete();

        return back();
    }

    // ============== blog =============

    // Blog
    function add_blog(){
        $categories = Category::all();
        return view('admin.blog.add_blog', [
            'categories'=>$categories,
        ]);
    }

    // blog store
    function blog_store(Request $request){
       $request->validate([
        'category_id'=>'required',
        'title'=>'required',
        'desp'=>'required',
        'long_desp'=>'required',
        'image'=>'required|mimes:png,jpg',
       ]);
       $blog_img = $request->image;
       $extension = $blog_img->getClientOriginalExtension();
       $size = $blog_img->getSize();
       $file_name = substr($request->title, 0,6).'.'.$extension;
       
       if($size < 2000000){
            Image::make($blog_img)->save(public_path('upload/blog/'.$file_name));
            Blog::insert([
            'category_id'=>$request->category_id,
            'title'=>$request->title,
            'desp'=>$request->desp,
            'long_desp'=>$request->long_desp,
            'image'=>$file_name,
            'created_at'=>Carbon::now(),
            ]);
       }

       else{
        return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
       }

       return back()->withBlog('Blog added successfully!');
    }

    // blog list
    function blog_list(){
        $blogs = Blog::paginate(20);
        return view('admin.blog.blog_list', [
            'blogs'=>$blogs,
        ]);
    }

    // Blog Delete
    function blog_delete($blog_id){
        $present_img = Blog::find($blog_id);
        unlink(public_path('upload/blog/'.$present_img->image));

        Blog::find($blog_id)->delete();
        return back();
    }

    // blog tag
    function blog_tag($blog_id){
        $blog_info = Blog::find($blog_id);
        $tags = Tag::all();
        $tag_info = BlogTag::where('blog_id', $blog_id)->get();
        return view('admin.blog.blog_tag', [
            'blog_info'=>$blog_info,
            'tags'=>$tags,
            'tag_info'=>$tag_info,
        ]);
    }

    // blog tag store
    function blog_tag_store(Request $request){
        $request->validate([
            'tag_id'=>'required',
        ]);

        BlogTag::insert([
            'blog_id'=>$request->blog_id,
            'tag_id'=>$request->tag_id,
            'created_at'=>Carbon::now(),
        ]);

        return back();
    }

    // Blog tag delete
    function blog_tag_delete($tag_id){
        BlogTag::find($tag_id)->delete();
        return back();
    }

    function search(Request $request){
        $data = $request->all();
        $categories = Category::all();
        $blogs = Blog::where(function ($q) use ($data){
            if (!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined') {
                $q->where(function ($q) use ($data) {
                    $q->where('title', 'like', '%' . $data['q'] . '%');
                    $q->OrWhere('desp', 'like', '%' . $data['q'] . '%');
                });
            }
        })->latest()->paginate(6);
        $tags = Tag::all();
        return view('frontned.blog', [
            'categories'=>$categories,
            'blogs'=>$blogs,
            'tags'=>$tags,
        ]);
    }

    function comment(){
        $comments = Blog_Comment::latest()->paginate(20);
        return view('admin.blog.comment', [
          'comments'=>$comments,
        ]);
    }

    function comment_store(Request $request){

        if( Auth::guard('customerlogin')->id()){
           


           Blog_Comment::insert([
            'blog_id'=>$request->blog_id,
            'name'=>$request->name,
            'comment'=>$request->comment,
            'created_at'=>Carbon::now(),
           ]);
           return back();
        }
        else{
            return redirect()->route('customer.login')->withError('Login to comment !');
        }
       
    }


    function comment_delete($comment_id){
        Blog_Comment::find($comment_id)->delete();
        return back();
    }

    function comment_reply($comment_id){
       $comment_info = Blog_Comment::find($comment_id);
       return view('admin.blog.comment_reply', [
        'comment_info'=>$comment_info,
       ]);

    }

    function comment_reply_store(Request $request){
        Blog_Comment::find($request->comment_id)->update([
            'reply'=>$request->reply,
        ]);
        return back();
    }
}
