<?php

namespace App\Models;

use App\Models\customer as ModelsCustomer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stripe\Customer;

class Blog_Comment extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

   

    
}
