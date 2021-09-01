<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraPackage extends Model
{
    protected $table = 'extra_packages';
   
    protected $fillable = [
    	'title',
	    'description',
	    'price',
	    'image',
    ];
    
    public $timestamps = false;
    
}
