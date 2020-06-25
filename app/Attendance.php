<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public function employee(){
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
