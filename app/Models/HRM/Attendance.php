<?php

namespace App\Models\HRM;

use App\Models\HRM\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;


    public function employeeData()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function userData()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
