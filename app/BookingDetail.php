<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected  $table = 'bookingdetail';

    protected $fillable = [
        'id', 'bid', 'name', 'email', 'dob', 'contactno', 'paddress', 'taddress',
        'country','state','town','zip','passportno','doi','insurance','ic','icn','ipn','feedback'
    ];
    public $timestamps = false;

    public function bookings(){
        return $this->belongsTo(Bookings::class,'bid','bookid');
    }
}
