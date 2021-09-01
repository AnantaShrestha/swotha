<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable=[
        'id',
        'title',
        'description',
        'slug'
    ];

    public function recentArticles()
    {
        return $this->belongsToMany(Articles::class, 'articles_categories', 'cat_id', 'art_id')->latest();
    }

    public function moreviewedArticles()
    {
        return $this->belongsToMany(Articles::class, 'articles_categories', 'cat_id', 'art_id')->orderBy("view", "desc");
    }

}
