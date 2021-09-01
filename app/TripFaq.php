<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripFaq extends Model
{
    public $table = "tripfaq";
    protected  $fillable = [
        'id','trip_id','trip_faq'
    ];
    public $timestamps = false;

    public function trips(){
        return $this->belongsTo('App\Trips','trip_id');
    }
}
