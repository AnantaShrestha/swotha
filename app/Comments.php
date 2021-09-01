<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'post_comments';
    
    protected $fillable = [
    	'post_id',
	    'user_id',
	    'comment'
    ];
    
    public $timestamps = true;
    
    public function replies(){
    	return $this->hasMany(Replies::class, 'comment_id', 'id');
    }
    
    public function user(){
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
