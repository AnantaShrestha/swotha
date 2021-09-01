<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = "about";
    protected $fillable = [
        'id',
        'aboutname',
        'cover_image',
        'content',
        'slug',
        'position',
        'meta_keywords',
        'meta_title',
        'meta_description',
        'image_url',
        'image_url_thumb',
    ];
    public $timestamps = true;


    public function details()
    {
        return $this->hasMany('App\AboutDetails', 'about_id', 'id');
    }

}
