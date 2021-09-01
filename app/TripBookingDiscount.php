<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripBookingDiscount extends Model
{
    protected  $table = "tripbookings_discounts";

    protected $fillable = [
        'early_booking_discount',
        'group_discount',
        'special_discount',
        'coupon_discount',
        'book_id',
    ];
}
