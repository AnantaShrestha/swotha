<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripBookingDetail extends Model
{
    protected  $table = 'tbdetail';

    protected $fillable = [
        'id','bid','name','email','dob','contactno',
        'paddress','tdaaress','country','state','town','zip','passportno','doi','insurance','ic','icn','ipn','feedback'
    ];
    public $timestamps = false;

    public function tripbookings(){
        return $this->belongsTo(TripBookings::class,'bid','bookid');
    }

}
