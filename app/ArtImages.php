<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtImages extends Model
{
    protected $table = "artimages";
    protected $fillable =[
        'id','section_id','image','caption',
    ];

}
