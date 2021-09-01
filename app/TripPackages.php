<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripPackages extends Model
{
	public $timestamps = false;

	protected $table = 'trippackages';

    protected $fillable = [
    	'id',
    	'title',
	    'description',
	    'image',
	    'rank',
        'image_url',
        'image_url_thumb',
        'slug',
    ];

    public function trips(){
    	return $this->belongsToMany(Trips::class, 'trips_tripPackages', 'tripPackages_id', 'trip_id');
    }
}
