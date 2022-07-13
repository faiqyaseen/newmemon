<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'user_id',
        'email',
        'phone_number',
        'phone_number2',
        'phone_number3',
        'cnic',
        'cnic_pic',
        'address',
        'address2',
        'location_pic',
        'location',
        'location2',
        'reference',
        'dealer',
        'dealer_cnic',
        'proprietor',
        'proprietor_cnic',
        'is_owner',
        'remarks',
        'agreement',
    ];
}
