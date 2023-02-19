<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    
    protected $fillable = ['custom_order_id','user_id', 'outlet_id', 'table_id', 'address','order_date','status'];

    // Get User detail
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    // Get address detail
    public function outlet(){
        return $this->belongsTo(Outlet::class,'outlet_id');
    }
}