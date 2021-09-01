<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TPayment extends Model
{
    protected $table = 'trippayment';
    protected $fillable = [
        'id','bid','status','date','chosen','paid_amount','due_amount','grandtotal','paid_amount_sum','left_amount_sum','online_paid','is_custom',
    ];

    public function tbooking(){
        return $this->belongsTo(TripBookings::class,'bid','bookid');
    }
}
