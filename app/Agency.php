<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = ['user_id', 'agency_name', 'agency_address', 'country', 'state', 'city', 'postal_code',
        'agency_email', 'agency_public_phone', 'fax', 'private_number', 'document', 'agency_number'];
}

