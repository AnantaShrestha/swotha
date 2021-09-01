<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingDiscount extends Model
{
    protected  $table = "bookings_discounts";
    protected $fillable = [
        'last_minute_deals',
        'early_booking_discount',
        'group_discount',
        'special_discount',
        'coupon_discount',
        'book_id',
    ];
}
