<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    //

    protected $fillable =[
        'first_name',
        'last_name',
        'dni',
        'phone_number',
        'address',
        'status',
        'money'
    ];
}
