<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermsnCondition extends Model
{
    public $table = "termsncondition";

    protected $fillable = [
        'terms_details',
        'selected'
    ];


}
