<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\Translations\CouponTranslation;
use Spatie\Permission\Models\Role;

class Coupon extends Model
{
    use Translatable;

    protected $table = 'coupons';

    protected $fillable = ['user_id','owner_id','user_id','code','discount_type','discount','start_date','end_date','status'];

     /**
     * The localed attributes that are mass assignable.
     *
     * @var array
     */
    public $translatedAttributes = ['title'];

    /**
     * @var string
     */
    public $translationForeignKey = 'coupon_id';

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The class name for the localed model.
     *
     * @var string
     */
    public $translationModel = CouponTranslation::class;

    // function for filter records
    public function translation(){
    	return $this->hasMany(CouponTranslation::class, 'coupon_id','id');
    }
}

