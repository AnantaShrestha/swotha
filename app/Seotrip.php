<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seotrip extends Model
{
	public $timestamps = false;
	
	protected $table = 'seotrip';
	protected $fillable = ['trip_id', 'keywords', 'meta_title', 'meta_description'];
}
