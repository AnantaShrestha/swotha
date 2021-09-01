<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = 'review';

    protected $fillable = [
        'trip_id',
	    'user_id',
        'name',
        'email',
        'review',
	    'country',
        'exp',
        'staff',
        'value',
        'meal',
        'accomodation',
        'transportation',
        'guide',
        'whynot',
	    'is_accepted',
	    'overall',
	    'average_total',
        'photo',
        'recomendation_scale',
        'suggestion',
        'improve_area'
    ];

    public function trip(){
        return $this->belongsTo(Trips::class,'trip_id');
    }
    
    public function user(){
    	return $this->belongsTo(User::class, 'user_id');
    }
}
