<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripViews extends Model
{
    protected $table = 'tripviews';

    protected $fillable=['ip','count','trip_id'];

    public function trips(){
        return $this->belongsTo(Trips::class,'trip_id');
    }
}
