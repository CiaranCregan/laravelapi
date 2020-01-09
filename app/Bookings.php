<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'date', 'booking_type', 'time'
    ];
}
