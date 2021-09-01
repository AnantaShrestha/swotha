<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bookings extends Model
{
    protected $table = 'booking';
    protected $fillable = [
            'id','user_id','trip_id','people','bookid','document'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function trips(){
        return $this->belongsTo(TripDates::class,'trip_id');
    }
//    public function trip(){
//        return $this->belongsTo(Trips::class,'trip_id');
//    }
    public function bdetail(){
        return $this->hasMany(BookingDetail::class,'bid','bookid');
    }
    public function services(){
        return $this->hasMany(ExtraServices::class,'bid','bookid');
    }
	
	public function activities(){
		return $this->hasMany(BookedActivities::class,'bid','bookid');
	}
	
    public function payment(){
        return $this->hasOne(Payment::class,'bid','bookid');
    }
	
	public function is_posted($tripdate_id){
		$post = TrekkingPartners::where([
			['user_id', Auth::user()->id],
			['tripdate_id', $tripdate_id]
		])->first();
		
		if(is_null($post)){
			return false;
		}
		
		return true;
	}
}
