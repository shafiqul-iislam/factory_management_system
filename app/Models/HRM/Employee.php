<?php

namespace App\Models\HRM;

use App\Models\User;
use App\Models\HRM\Designation;
use App\Models\Department\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    public function designationData()
    {
        return $this->belongsTo(Designation::class, 'designation');
    }

    public function departmentData()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function userData()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
