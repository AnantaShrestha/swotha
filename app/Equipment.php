<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table  = 'equipments';
    protected  $fillable = [
        'name',
        'price',
	    'image'

    ];
    public function themes(){
        return $this->belongsToMany(Themes::class,'themes_equipments','equipment_id','theme_id');
    }

}
