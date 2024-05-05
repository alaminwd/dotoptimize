<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function search(Request $request){
        $data = $request->all();
    
        $search_category = Category::where(function($q) use ($data){
            if(!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined' ){
                $q->where(function($q) use ($data){
                    $q->where('category_name', 'like', '%'.$data['q'].'%');
                });
            }
        })->get();

    }
}
