<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Destinations extends Model
{
    /*This is used to specify the table which this model is associated with*/
    protected $table = 'destinations';
    protected $fillable = [
        'country_name',
        'about',
        'image',
        'slug',
        'position',
        'created_at',
        'image_url',
        'image_url_thumb',
        'updated_at'

    ];
    public $timestamps = true;

    public function cities(){
        return $this->hasMany(Cities::class,'d_id');
    }
    public function trips(){
        return $this->belongsToMany('App\Trips','destination_trips','destination_id','trip_id');
    }

}
