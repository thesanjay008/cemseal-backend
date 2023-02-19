<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';
    
    protected $fillable = ['outlet_id', 'title', 'image', 'type','sorting', 'timimg', 'status', 'delete_at'];

    // GET Outlet DETAILS
    public function outlet(){
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
}