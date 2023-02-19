<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\Translations\OfferTranslation;

class Offer extends Model
{
    use Translatable;

    protected $table = 'offers';

    protected $fillable = ['start_date','image','end_date','discount_percentage','status','owner_id','owner_type','offer_price','avail_for_purchase'];

     /**
     * The localed attributes that are mass assignable.
     *
     * @var array
     */
    public $translatedAttributes = ['offer_name','description'];

    /**
     * @var string
     */
    public $translationForeignKey = 'offer_id';

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
    public $translationModel = OfferTranslation::class;

    // function for filter records
    public function translation(){
    	return $this->hasMany(OfferTranslation::class, 'offer_id','id');
    }

    public function hospital(){
        return $this->belongsTo(Hospital::class, 'hospital_id' );
    }
}
