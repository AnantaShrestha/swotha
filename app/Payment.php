<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $fillable = [
        'id','bid','status','date','chosen','paid_amount','due_amount','grandtotal','paid_amount_sum','left_amount_sum','online_paid'
    ];

    public function booking(){
        return $this->belongsTo(Bookings::class,'bid','bookid');
    }


}
