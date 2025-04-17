<?php

namespace App\Models\Product;

use App\Models\User;
use App\Models\Department\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
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
