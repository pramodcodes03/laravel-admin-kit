<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingRequest extends Model
{
    protected $fillable = [
        'institute_name', 'owner_name', 'mobile', 'email', 'city',
        'pincode', 'category', 'message', 'status', 'admin_notes',
    ];
}
