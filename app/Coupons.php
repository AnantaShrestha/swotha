<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
	protected $table = 'user_coupon';
	public $timestamps = true;
	protected $fillable = ['user_id', 'code', 'trip_price', 'discount', 'redeemed','discountamount','partial_used','created_at','email'];
	
}
