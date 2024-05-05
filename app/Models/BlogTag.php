<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    use HasFactory;
    function rel_to_tag(){
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    function rel_to_blog(){
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    
}
