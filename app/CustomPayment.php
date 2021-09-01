<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomPayment extends Model
{
    protected $table = "custompayment";

    protected $fillable =[
      'fullname',
      'address',
      'email',
      'phone',
      'tripdate',
      'amount',
      'purpose',
      'success',
      'invoice_number',
    ];
}
