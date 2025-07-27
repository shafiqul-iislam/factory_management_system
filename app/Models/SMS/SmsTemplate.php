<?php

namespace App\Models\SMS;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmsTemplate extends Model
{
    use HasFactory;

    public function createdByData()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
