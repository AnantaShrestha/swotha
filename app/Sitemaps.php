<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sitemaps extends Model
{
    public $table = "sitemaps";

    protected $fillable = [
        'sitemap_title',
        'sitemap_link',
        'sitemap_description',
        'sitemap_image'
    ];

    protected $timestamp = true;
}

