<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Trips extends Model
{
   use Searchable;
   public static $autoIndex = true;
   public static $autoDelete = true;

    /*This is used to specify the table which this model is associated with*/
    protected $table = 'trips';
    protected $fillable = [
        'id',
        's_id',
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
        'image_url',
        'image_url_thumb',
        'slug'
    ];

    public $timestamps = false;

    public function styles(){
        return $this->belongsTo(TravelStyles::class,'s_id');
    }
    public function wish(){
        return $this->hasOne(WishList::class,'trip_id','id');
    }

    public function reviews(){
        return $this->hasMany(Reviews::class,'reviews','trip_id');
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

    public function priceDate()
    {
        return $this->date()->getQuery()->where('start_date', '>',now())->get()->min('price');
    }

    public function date(){
        return $this->hasMany(TripDates::class,'trip_id');
    }
    public function faq(){
        return $this->hasMany(TripFaq::class,'trip_id');
    }

    public function themes(){
        return $this->belongsToMany('App\Themes','trips_themes','trip_id','theme_id');
    }
    public function cities(){
        return $this->belongsToMany('App\Cities','trips_cities','trip_id','city_id');
    }
    public function countries(){
        return $this->belongsToMany('App\Destinations','destination_trips','trip_id','destination_id');
    }
    public function booking(){
        return $this->hasOne(Bookings::class,'trip_id','id');
    }
    public function tbooking(){
        return $this->hasOne(TripBookings::class,'trip_id','id');
    }

    public function enquiries(){
            return $this->hasMany(Enquiry::class,'trip_id');
    }

    public function views(){
        return $this->hasOne(TripViews::class,'trip_id');
    }

    public function customtrip(){
        return $this->hasOne(CustomTrip::class,'trip_id','id');
    }
	
	public function seotrip(){
		return $this->hasOne(Seotrip::class, 'trip_id', 'id');
	}
	
	public function extraPackages(){
    	return $this->belongsToMany(ExtraPackage::class, 'trip_extra_packages', 'trip_id', 'extra_packages_id');
	}
	
	public function map($trip){
    	return $trip->gallery()->where('map', 1)->first();
	}
 
	public function toSearchableArray()
   {
       $array = $this->toArray();
       $array['regions'] = explode(',', $array['regions']);
       $array['country'] = explode(',', $array['country']);
       $array['ventures'] = explode(',', $array['ventures']);
       $array['dates'] = null;
       $array['altitude'] = (int)$array['altitude'];
       $array['price'] = (int)$array['price'];
       $array['special_discount'] = (int)$array['special_discount'];
       $array['days'] = (int)$array['days'];
       $array['physical_rating'] = (int)$array['physical_rating'];
       $array['poplularity'] = (int)$array['poplularity'];
       return $array;
   }

    public function packages(){
    	return $this->belongsToMany(TripPackages::class, 'trips_tripPackages','trip_id','tripPackages_id');
    }

}
