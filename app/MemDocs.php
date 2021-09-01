<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemDocs extends Model
{
    protected $table = "memdocs";
    protected $fillable =[
        'id','member_id','image','shortdescription'
    ];
}
