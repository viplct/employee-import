<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_id',
        'user_name',
        'name_prefix',
        'first_name',
        'middle_initial',
        'last_name',
        'gender',
        'email',
        'date_of_birth',
        'time_of_birth',
        'age',
        'date_of_joining',
        'age_in_company',
        'phone',
        'place',
        'county',
        'city',
        'zip',
        'region',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'date_of_joining' => 'date',
        'time_of_birth' => 'datetime:H:i:s',
        'age' => 'integer',
        'age_in_company' => 'float',
    ];
}
