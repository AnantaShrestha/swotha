<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';
    protected $fillable = [
      'id',
      'name'
    ];

    public function articles(){
        return $this->belongsToMany('App\Articles','article_tag','tag_id','article_id');
    }
}