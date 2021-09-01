<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TExtraServices extends Model
{
    protected $table = 'tripextraservices';
    protected $fillable = [
        'id ','equipment_price','equipment_name','equipment_quantity','bid'
    ];
    public $timestamps = false;
    public function tbookings(){
        return $this->belongsTo(TripBookings::class,'trip_id');
    }

}
