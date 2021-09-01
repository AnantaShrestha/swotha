<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerRequirements extends Model
{
    protected $table = 'partner_requirements';
    
    protected $fillable = ['description', 'age', 'nationalities', 'gender'];
    
    public $timestamps = false;
}
