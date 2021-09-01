<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    /*This is used to specify the table which this model is associated with*/
    protected $table = 'wishlist';
    protected $fillable = [
        'id',
        'trip_id',
        'user_id',
    ];
    public $timestamps = true;

    public function trips(){
        return $this->belongsTo(Trips::class,'trip_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
