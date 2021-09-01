<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositCancel extends Model
{
    public $table = "depositcancel";

    protected $fillable = [
        'deposit_details',
        'selected'
    ];
}
