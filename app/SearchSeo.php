<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchSeo extends Model
{
	protected $table = 'searchseo';
	
	protected $fillable = [
		'id',
		'content',
		'what',
	];
	
	public $timestamps = true;
}
