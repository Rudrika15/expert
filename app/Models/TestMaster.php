<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestMaster extends Model
{
    use HasFactory;
    public function testQuestions(){
        return $this->hasMany(TestQuestionnaire::class, 'testId', 'id');
    }
}
