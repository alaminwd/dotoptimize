<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    function rel_to_plan(){
        return $this->belongsTo(Plan::class, 'plan_id');
    }

}
