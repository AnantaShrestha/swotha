<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripBookedActivities extends Model
{
	protected $table = 'tripbookedactivities';
	protected $fillable = [
		'id ','title','price','pax','bid'
	];
	
	public $timestamps = false;
	public function trips(){
		return $this->belongsTo(TripBookingDetail::class,'bid');
	}
}
