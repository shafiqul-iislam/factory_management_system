<?php

namespace App\Models\HRM;

use App\Models\User;
use App\Models\HRM\Employee;
use App\Models\Department\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveRequest extends Model
{
    use HasFactory;

    public function departmentData()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }


    public function employeeData()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }


    public function userData()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
