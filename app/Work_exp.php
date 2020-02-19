<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work_exp extends Model
{
    protected $fillable = ['date', 'description', 'user_id'];
}
