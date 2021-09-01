<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutDetails extends Model
{
    protected $table = 'about_details';

    protected $fillable = ['about_id', 'description', 'cover_image', 'title'];

    public $timestamps = false;

    public function images()
    {
        return $this->hasMany('App\AboutImages', 'about_details_id', 'id');
    }
}
