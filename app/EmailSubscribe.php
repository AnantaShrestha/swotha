<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailSubscribe extends Model
{
	protected $table = 'emailsubscribe';
	
	protected $fillable = [
		'id',
		'email',
		'ipaddress',
		'country',
		'subscribed'
	];
	
	public $timestamps = true;
}
