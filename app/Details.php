<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    protected $table = 'user_details';
    
    protected $fillable = [
    	'user_id',
	    'birthday',
	    'address',
	    'phone',
	    'nationality',
	    'last_logged_from',
	    'languages',
	    'bio',
	    'interests'
    ];
    
    public $timestamps = false;
}
