<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLogin extends Model
{
    use HasFactory;
    public function results() {
        return $this->hasMany(Result::class,'student_id' ,'id');
    }
}
