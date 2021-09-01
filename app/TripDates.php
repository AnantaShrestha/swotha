<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property  attributes
 */
class TripDates extends Model
{
    /*This is used to specify the table which this model is associated with*/
    protected $table = 'tripdates';
    protected $fillable = [
        'id',
        'start_date',
        'finish_date',
        'trip_id',
        'price',
        'discount',
        'remainingseats'
    ];

    public function trips(){
        return $this->belongsTo(Trips::class,'trip_id','id');
    }
    public function hold(){
        return $this->hasOne(HoldDates::class,'trip_id','id');
    }
//    public function booking(){
//        return $this->hasOne(Bookings::class,'trip_id','id');
//    }

    public function tbooking(){
        return $this->hasOne(TripBookings::class,'trip_id','id');
    }

    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDateString();

    }
    public function getFinishDateAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDateString();

    }
}
