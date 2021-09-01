<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table = 'articles';
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'author',
        'article',
        'cover_image',
        'profile',
        'created_at',
        'updated_at',
        'slug',
        'is_published',
        'image_url',
        'image_url_thumb',
        'view'
    ];


    public function tags()
    {
        return $this->belongsToMany('App\Tags', 'article_tag', 'article_id', 'tag_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'articles_categories', 'art_id', 'cat_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function images()
    {
        return $this->hasMany(ArtImages::class, 'section_id');
    }

    public function sections()
    {
        return $this->hasMany(ArticleSection::class, 'article_id');
    }

    public function seoblog()
    {
        return $this->hasOne(SeoBlog::class, 'blog_id', 'id');
    }

}
