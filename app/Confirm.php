<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirm extends Model
{

    public $timestamps = false;
    
    protected $fillable = [
        'class_id', 'user_id'
    ];
}
