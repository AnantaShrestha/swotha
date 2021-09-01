<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TripBookings extends Model
{
    protected $table = 'tripbookings';
    protected $fillable = [
        'id','user_id','trip_id','people','start_date','bookid','document'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function tbdetail(){
        return $this->hasMany(TripBookingDetail::class,'bid','bookid');
    }
    public function trips(){
        return $this->belongsTo(Trips::class,'trip_id');
    }
    public function services(){
        return $this->hasMany(TExtraServices::class,'bid','bookid');
    }

    public function tpayment()
    {
        return $this->hasOne(TPayment::class,'bid','bookid');
    }
	
	public function is_posted($book_id){
		$post = TrekkingPartners::where([
			['user_id', Auth::user()->id],
			['book_id', $book_id]
		])->first();
		
		if(is_null($post)){
			return false;
		}
		
		return true;
	}
}
