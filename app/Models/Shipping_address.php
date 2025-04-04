<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping_address extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'district_id',
        'landmark',
        'area',
        'zipcode',
        'phone_number',
    ];
}
