<?php

namespace App\Models\HRM;

use App\Models\Department\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    public function departmentData()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function userData()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
