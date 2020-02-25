<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainee_info extends Model
{
    protected $fillable = [
        'contract_start', 'contract_end', 'internship_status', 'position', 'address', 'marital_status',
        'height', 'nationality', 'dob', 'hobbies', 'place_of_birth', 'reference_name', 'reference_position',
        'reference_phone', 'reference_email', 'user_id'];
}
