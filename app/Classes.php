<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
   protected $fillable = [
       'title', 'date', 'time', 'class_length', 'going'
   ];
}

