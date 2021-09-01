<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelStyles extends Model
{
    /*This is used to specify the table which this model is associated with*/
    protected $table = 'styles';
    protected $fillable = [
        'id',
        'name',
        'description',
        'accomodation',
        'inclusions',
        'transports',
        'created_at',
        'updated_at'
        ];
    public $timestamps = true;

    public function trips(){
        return $this->hasMany(Trips::class);
    }
}
