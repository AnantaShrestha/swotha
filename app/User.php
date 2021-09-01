<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
	    'email',
	    'password',
	    'role',
	    'is_active',
	    'code',
	    'photo',
	    'secondary_email',
	    'secondary_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
//    protected $dates = ['deleted_at'];
    
    public function wish(){
        return $this->hasMany(WishList::class,'user_id');
    }
    public function hold(){
        return $this->hasMany(HoldDates::class,'user_id');
    }
    public function booking(){
        return $this->hasMany(Bookings::class,'user_id');
    }
    public function article(){
        return $this->hasMany(Articles::class,'user_id');
    }
       public function tbooking(){
        return $this->hasMany(TripBookings::class,'user_id');
    }
    
    public function details(){
       	return $this->hasOne('App\Details', 'user_id', 'id');
    }
    
    public function coupons(){
    	return $this->hasMany('App\Coupons', 'user_id', 'id');
    }
    public function hascards(){
        return $this->hasMany('App\UserPayment','user_id');
    }

    public function trekpartners(){
        return $this->hasMany(TrekkingPartners::class, 'user_id');
    }
}
