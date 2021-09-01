<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoldDates extends Model
{
    protected $table = 'holddates';
    protected $fillable = [
        'id','user_id','trip_id','confirmation','is_confirmed','date', 'seats','booked'
    ];
    public  $timestamps = false;

    public function trips(){
        return $this->belongsTo(TripDates::class,'trip_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
