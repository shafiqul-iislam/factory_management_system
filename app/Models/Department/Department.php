<?php

namespace App\Models\Department;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    public function userData()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
