<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayementDetails extends Model
{
	protected $table = 'paymentdetails';
	
	protected $fillable=[
		'paymentGatewayID',
		'respCode',
		'fraudCode',
		'Pan',
		'Amount',
		'invoiceNo',
		'tranRef',
		'approvalCode',
		'Eci',
		'dateTime',
		'Status',
		'hashValue'
	];
	
}
