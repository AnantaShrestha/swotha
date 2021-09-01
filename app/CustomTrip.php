<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomTrip extends Model
{
    protected $table = "customtrip";
    protected $fillable = [
        'id',
        'trip_id',
        'group_discount',
        'porter_cost',
        'guide_cost',
        'sherpa_cost',
        'assistant_cost',
        'public_cost',
        'private_cost',
        'flight_cost',
        'accomodation_cost',
        'citytour_cost',
	    'meals_cost',
        'recommended',
	    'ratios',
	    'guidecom',
	    'keywords',
	    'portercom',
	    'assistantcom',
	    'entrancefee',
	    'sherpacom',
	    'showcustom',
	    'coupon_discount',
	    'beyond_border',
    ];
    public $timestamps = true;
	
	public function onetrip()
	{
		return $this->hasOne(Trips::class);
	}
}

