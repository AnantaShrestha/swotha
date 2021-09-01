<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripItenaries extends Model
{
    /*This is used to specify the table which this model is associated with*/
    protected $table = 'itenaries';
    protected $fillable = ['id', 'trip_id','day','description','accomodation','included_activities','meals_included'];
    public $timestamps = true;

    public function trips(){
        return $this->belongsTo(Trips::class,'trip_id');
    }
}
