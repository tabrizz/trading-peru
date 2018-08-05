<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TruckLoad extends Model
{
    //
    protected $fillable = [
        'seller_id',
        'description',
        'load_date',
    ];
}
