<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraServices extends Model
{
    protected $table = 'extraservices';
    protected $fillable = [
       'id ','equipment_price','equipment_name','equipment_quantity','bid'
    ];
    public $timestamps = false;
    public function trips(){
        return $this->belongsTo(Bookings::class,'trip_id');
    }

}
