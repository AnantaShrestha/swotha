<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';
    protected $fillable = ['topic'];
    
    public $timestamps = false;
    
    public function questions(){
    	return $this->hasMany(FaqQuestion::class, 'faq_id', 'id');
    }
}
