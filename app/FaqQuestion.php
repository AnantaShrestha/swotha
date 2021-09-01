<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqQuestion extends Model
{
    protected $table = 'faq_questions';
    protected $fillable = ['faq_id', 'question', 'description'];
    
    public $timestamps = false;
    
    public function topic(){
    	return $this->belongsTo(Faq::class, 'faq_id', 'id');
    }
    
}
