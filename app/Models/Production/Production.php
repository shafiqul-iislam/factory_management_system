<?php

namespace App\Models\Production;

use App\Models\User;
use App\Models\Department\Department;
use App\Models\HRM\Employee;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Production extends Model
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

    public function supervisorData()
    {
        return $this->belongsTo(Employee::class, 'supervisor_id');
    }

    public function productData()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
