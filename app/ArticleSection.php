<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleSection extends Model
{
    protected $fillable = [
        'description',
    ];
    
    public function images(){
    	return $this->hasMany(ArtImages::class, 'section_id');
    }
}
