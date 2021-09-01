<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoverImage extends Model
{
    protected $table = 'coverimage';
    protected $fillable = [
    	'title',
        'image',
	    'description',
	    'rank',
        'image_url',
        'image_url_thumb',
	    'is_parallax',
	    'is_video',
        'created_at',
        'updated_at'

    ];
    public $timestamps = true;
}
