<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table  = 'enquiry';
    protected  $fillable = [
        'id','email','name','nationality','message','trip_id','reply_message'
    ];

    public function trip(){
        return $this->belongsTo(Trips::class,'trip_id');
    }
}
