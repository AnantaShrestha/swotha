<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Duplicate extends Model
{
    protected $table = 'duplicate';
	protected $fillable = [
		'id',
		's_id',
		'trip_id',
		'name',
		'description',
		'trip_information',
		'days',
		'trekdays',
		'cover_image',
		'code',
		'start_location',
		'why_this_trip',
		'transportation',
		'is_this_trip_right',
		'finish_location',
		'physical_rating',
		'ages',
		'trip_notes',
		'traveldeal',
		'featured',
		'special_discount',
		'min_group_size',
		'max_group_size',
		'created_at',
		'updated_at',
		'price',
		'poplularity',
		'hidden_gem',
		'altitude',
		'regions',
		'country',
		'style',
		'ventures',
		'ratings',
		'dates',
		'seasons',
		'exclusions',
		'complimentary',
		'slug'
	];
	
	public $timestamps = false;
	
	public function styles(){
		return $this->belongsTo(TravelStyles::class,'s_id');
	}
	
	
	public function gallery(){
		return $this->hasMany(Gallery::class,'trip_id');
	}
	
	public function itenary(){
		return $this->hasMany(TripItenaries::class,'trip_id')->orderBy('day','asc');
	}
	
	public function getItenariesAttribute()
	{
		$itenaries = $this->itenary()->getQuery()->orderBy('day', 'asc')->get();
		return $itenaries;
	}
	public function date(){
		return $this->hasMany(TripDates::class,'trip_id');
	}
	public function faq(){
		return $this->hasMany(TripFaq::class,'trip_id');
	}
	
	public function themes(){
		return $this->belongsToMany(Themes::class,'trips_themes','trip_id','theme_id');
	}
	public function cities(){
		return $this->belongsToMany('App\Cities','trips_cities','trip_id','city_id');
	}
	public function countries(){
		return $this->belongsToMany('App\Destinations','destination_trips','trip_id','destination_id');
	}
	
	public function customtrip(){
		return $this->hasOne(CustomTrip::class,'trip_id','trip_id');
	}
	
}
