<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    protected $table = 'comment_replies';
    
    protected $fillable = [
        'comment_id',
	    'user_id',
	    'reply',
    ];
    
    public $timestamps = true;
    
    public function user(){
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
