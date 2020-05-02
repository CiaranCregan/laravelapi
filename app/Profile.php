<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'user_id', 'dob', 'mobile_number', 'height', 'weight', 'goal_weight', 'action_plan'
    ];
}
