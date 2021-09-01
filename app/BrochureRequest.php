<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrochureRequest extends Model
{
    protected $table  = 'brochurerequest';
    protected  $fillable = [
        'id','name','email','country','interest'
    ];

}
