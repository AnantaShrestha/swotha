<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $table = "departments";

    protected $fillable=[
        'id',
        'departmentname',
        'departmentdetails'
    ];

    public function members(){
        return $this->belongsToMany(TeamMembers::class,'teammember_department',
            'department_id','teammember_id');
    }
}
