<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = ['logical_thinking', 'skills', 'attitudes', 'period', 'user_id'];

}
