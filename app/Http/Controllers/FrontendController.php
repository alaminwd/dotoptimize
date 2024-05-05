<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AddWorkWay;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Blog_Comment;
use App\Models\BlogTag;
use App\Models\CallInformation;
use App\Models\Career;
use App\Models\Category;
use App\Models\Client;
use App\Models\ContactContent;
use App\Models\Footer;
use App\Models\Gallery;
use App\Models\OfficeAddress;
use App\Models\Overview;
use App\Models\Plan;
use App\Models\Policy;
use App\Models\Product;
use App\Models\ProductPlan;
use App\Models\ProductSectionTitle;
use App\Models\Project;
use App\Models\project_section_title;
use App\Models\ProjectPlan;
use App\Models\Request_form;
use App\Models\Review;
use App\Models\Service;
use App\Models\ServicePrice;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\Team;
use App\Models\TeamTitle;
use App\Models\TestimonialsContent;
use App\Models\Work;
use App\Models\WorkWay;
use GuzzleHttp\Psr7\Request;

class FrontendController extends Controller
{
    //index
    function index(){
        $team_title = TeamTitle::all();
        $project_title = project_section_title::all();
        $banners = Banner::all();
        foreach($banners as $banner){
            $banner_info = $banner;
        }

        $abouts = About::all();
        foreach($abouts as $about){
            $about_info = $about;
        }

        $over_views = Overview::all();
        foreach($over_views as $over_view){
            $over_view = $over_view;
        }

        $works = Work::all();
        foreach($works as $work){
            $work_info = $work;
        }

        $footers = Footer::all();
        foreach($footers as $footer){
            $footer_info = $footer;
        }
        $call_info = CallInformation::all();
        foreach($call_info as $call){
            $info = $call;
        }


        $services = Service::paginate(6);
        $clients = Client::all();
        $skills = Skill::all();
        $projects = Project::latest()->paginate(3);
        $teams = Team::all();
        $reviews = Review::all();
        $blogs = Blog::latest()->paginate(3);
       

        return view('frontned.index', [
            'banner_info'=>$banner_info,
            'services'=>$services,
            'about_info'=>$about_info,
            'clients'=>$clients,
            'over_view'=>$over_view,
            'work_info'=>$work_info,
            'skills'=>$skills,
            'projects'=>$projects,
            'footer_info'=>$footer_info,
            'teams'=>$teams,
            'reviews'=>$reviews,
            'blogs'=>$blogs,
            'project_title'=>$project_title,
            'team_title'=>$team_title,
            'info'=>$info,
            

        ]);
    }

    // About
    function about(){
      
        $team_title = TeamTitle::all();
        
        $abouts = About::all();
        foreach($abouts as $about){
            $about_info = $about;
        }
        $works = Work::all();
        foreach($works as $work){
            $work_info = $work;
        }
        $skills = Skill::all();
        $teams = Team::all();
        return view('frontned.about', [
            'about_info'=>$about_info,
            'work_info'=>$work_info,
            'skills'=>$skills,
            'teams'=>$teams,
            'team_title'=>$team_title,
          
        ]);
    }

    // Service
    function service(){
        $services = Service::all();
        return view('frontned.service', [
            'services'=>$services,
        ]);
    }

    // project 
    function project(){
        $project_title = project_section_title::all();
        $projects = Project::latest()->paginate(18);
        return view('frontned.project', [
            'projects'=>$projects,
            'project_title'=>$project_title,
        ]);
    }

    // product
    function product(){

        $project_title = ProductSectionTitle::all();
        $projects = Product::latest()->paginate(18);
        return view('frontned.product', [
            'projects'=>$projects,
            'project_title'=>$project_title,
        ]);
    }

    // Contact
    function contact(){
        $contetns = ContactContent::all();
        foreach($contetns as $contetn){
            $content_info =$contetn;
        }
        $footers = Footer::all();
        foreach($footers as $footer){
            $footer_info = $footer;
        }
        $address_info = OfficeAddress::all();

        return view('frontned.contact', [

            'footer_info'=>$footer_info,
            'content_info'=>$content_info,
            'address_info'=>$address_info,
        ]);
    }

    // Gallery
    function gallery(){
        $galleries = Gallery::paginate(30);
        return view('frontned.gallery', [
            'galleries'=>$galleries,
        ]);
    }

    // single Service
    function single_service($service_id){
        $project_plans = ServicePrice::where('service_id', $service_id)->get();
        $single_service = Service::find($service_id);
        $footers = Footer::all();
        foreach($footers as $footer){
            $footer_info = $footer;
        }

        $clients = Client::all();
        return view('frontned.single_service', [
            'single_service'=>$single_service,
            'footer_info'=>$footer_info,
            'clients'=>$clients,
            'project_plans'=>$project_plans,
        ]);
    }

    // single project
    function single_project($project_id){
        $project_info = Project::find($project_id);
        $project_plans = ProjectPlan::where('project_id', $project_id)->get();
        $clients = Client::all();
        return view('frontned.single_project', [
            'project_info'=>$project_info,
            'project_plans'=>$project_plans,
            'clients'=>$clients,
        ]);
    }

    // single product
    function single_product($product_id){
        $project_info = Product::find($product_id);
        $project_plans = ProductPlan::where('product_id', $product_id)->get();
        $single_service = Service::all();
        $clients = Client::all();
        $footers = Footer::all();
        foreach($footers as $footer){
            $footer_info = $footer;
        }
        return view('frontned.single_product', [
            'project_info'=>$project_info,
            'project_plans'=>$project_plans,
            'clients'=>$clients,
            'footer_info'=>$footer_info,
            'single_service'=>$single_service,
        ]);
    }

    // single Member
    function single_member($team_id){
        $team_info = Team::find($team_id);
        $clients = Client::all();
        return view('frontned.single_member', [
            'team_info'=>$team_info,
            'clients'=>$clients,
        ]);
    }


    // Blog
    function blog(){
        $categories = Category::all();
        $blogs = Blog::latest()->paginate(6);
        $tags = Tag::all();
        return view('frontned.blog', [
            'categories'=>$categories,
            'blogs'=>$blogs,
            'tags'=>$tags,
        ]);
    }

    // single Blog
    function single_blog($blog_id){
        $blog_info = Blog::find($blog_id);
        $categories = Category::all();
        $blogs = Blog::all();
        $tags = Tag::all();
        $comments = Blog_Comment::where('blog_id', $blog_id)->latest()->paginate(10);
        return view('frontned.single_blog', [
            'blog_info'=>$blog_info,
            'categories'=>$categories,
            'blogs'=>$blogs,
            'tags'=>$tags,
            'comments'=>$comments,
        ]);
    }

    // category blog 
    function category_blog($category_id){
        $category_info = Category::find($category_id);
        $categories = Category::all();
        $blogs = Blog::all();
        $tags = Tag::all();
        return view('frontned.category_blog', [
            'category_info'=>$category_info,
            'categories'=>$categories,
            'blogs'=>$blogs,
            'tags'=>$tags,
        ]);
    }

    // Pricing Plan
    function plan(){
        $plans = Plan::all();
        return view('frontned.pricing_plan', [
            'plans'=>$plans,
        ]);
    }

    // function 
    function case_studiy(){
        $services = Service::paginate(4);
        return view('frontned.case_study', [
            'services'=>$services,
        ]);
    }

    // testimonail
    function testimonial(){
        $testimonials = TestimonialsContent::all();
        foreach($testimonials as $testimonial){
            $content_test = $testimonial;
        }
        $reviews = Review::all();
        return view('frontned.testimonial', [
            'reviews'=>$reviews,
            'content_test'=>$content_test,
        ]);
    }

    // how it work
    function how_work(){
        $ways = WorkWay::all();
        $work_way = AddWorkWay::all();
        return view('frontned.how_work', [
            'work_way'=>$work_way,
            'ways'=>$ways,
        ]);
    }

    // policy
    function policy(){
        $policies = Policy::all();
        foreach($policies as $policy){
            $policy_info = $policy;
        }
        return view('frontned.policy', [
            'policy_info'=>$policy_info,
        ]);
    }

    // career 
    function career(){
        $careers = Career::all();
        return view('frontned.career',[
            'careers'=>$careers,
        ]);
    }

    // company
    function company(){
        $abouts = About::all();
        foreach($abouts as $about){
            $about_info = $about;
        }
        $works = Work::all();
        foreach($works as $work){
            $work_info = $work;
        }
        $skills = Skill::all();
        return view('frontned.company', [
            'about_info'=>$about_info,
            'work_info'=>$work_info,
            'skills'=>$skills,
        ]);
    }

    function tag_single_blog($tag_id){
        $tags_info = Tag::find($tag_id);
        $single_tags = BlogTag::where('tag_id',$tag_id)->get(); 
        $categories = Category::all();
        $tags = Tag::all();
        $blogs = Blog::all();
  
        return view('frontned.tag_single_blog',[
            'single_tags'=>$single_tags,
            'tags_info'=>$tags_info,          
            'tags'=> $tags,
            'categories'=>$categories,
            'blogs'=>$blogs,
        ]);


    }
   
}
