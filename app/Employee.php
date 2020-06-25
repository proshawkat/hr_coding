<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'number_1', 'number_2', 'district', 'thana', 'address','date_of_birth', 'gender', 'marital_status', 'nid', 'photo'
    ];
}
