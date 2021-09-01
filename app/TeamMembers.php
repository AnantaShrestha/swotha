<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMembers extends Model
{
    protected $table = "teammembers";
    protected $fillable=[
        'id',
        'fullname',
        'dob',
        'position',
        'photo',
        'memberdetails',
	    'show_in_homepage',
    ];

    public function departments(){
        return $this->belongsToMany(Departments::class,'teammember_department','teammember_id',
            'department_id');
    }
    public function docs(){
        return $this->hasMany(MemDocs::class,'member_id');
    }

}
