<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPaymentDetails extends Model
{
    public $table = "userpayment_details";
    public $timestamps = false;
    protected  $fillable = [
        'user_id','card_type','card_number','card_holder_name','card_expiry_date'
    ];

}
