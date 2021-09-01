<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class Cities extends Model
{
    /*This is used to specify the table which this model is associated with*/
    protected $table = 'cities';

    protected $fillable = [
        'id',
        'd_id',
        'name',
        'title',
        'description',
        'cover_image',
        'created_at',
        'updated_at',
        'image_url',
        'image_url_thumb',
        'slug'

    ];
    public $timestamps = true;

    public function destinations(){
        return $this->belongsTo(Destinations::class,'d_id');
    }

    public function trips(){
        return $this->belongsToMany('App\Trips','trips_cities','city_id','trip_id');
    }


}
