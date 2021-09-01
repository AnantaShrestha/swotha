<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    /*This is used to specify the table which this model is associated with*/
    protected $table = 'themes';
    protected $fillable = [
        'id',
        'theme_name',
        'description',
        'image',
        'created_at',
        'updated_at',
        'slug',
        'position',

    ];
    public $timestamps = true;

    public function trips(){
        return $this->belongsToMany(Trips::class,'trips_themes','theme_id','trip_id');
    }
    public function equipments(){
        return $this->belongsToMany(Equipment::class,'themes_equipments','theme_id','equipment_id');
    }


}
