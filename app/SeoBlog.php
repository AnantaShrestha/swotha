<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeoBlog extends Model
{
	public $timestamps = false;
	
	protected $table = 'seoblogs';
	protected $fillable = ['blog_id', 'keywords', 'meta_title', 'meta_description'];
}
