<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teamskill extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function rel_to_team(){
        return $this->belongsTo(Team::class, 'member_id');
    }
}
