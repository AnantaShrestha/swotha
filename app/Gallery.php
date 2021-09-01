<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected  $fillable = [
        'trip_id',
        'image',
        'map'
    ];
    public function trip(){
        return $this->belongsTo(Trips::class,'trip_id');
    }
}
