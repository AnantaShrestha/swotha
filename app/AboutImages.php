<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutImages extends Model
{
    protected $table = 'about_images';

    protected $fillable = ['about_details_id', 'image'];

    public $timestamps = false;

    public function detail()
    {
        return $this->belongsTo('App\AboutDetails', 'about_details_id', 'id');
    }
}
