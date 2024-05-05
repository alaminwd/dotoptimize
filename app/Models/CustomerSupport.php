<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSupport extends Model
{
    use HasFactory;

    function rel_to_customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
