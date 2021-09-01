<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookedActivities extends Model
{
	protected $table = 'bookedactivities';
	protected $fillable = [
		'id ','title','price','pax','bid'
	];
	public $timestamps = false;
	public function trips(){
		return $this->belongsTo(Bookings::class,'bid');
	}
}
