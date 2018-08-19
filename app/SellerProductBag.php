<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerProductBag extends Model
{
    //
    protected $table = 'seller_product_bag';

    protected $fillable = [
        'seller_id',
        'product_id',
        'amount',
        'price'
    ];

    public function seller() {
        return $this->belongsTo('App\Seller');
    }
}
