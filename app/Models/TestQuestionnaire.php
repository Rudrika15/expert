<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestionnaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'testId', 'Questions', 'Opt1', 'Opt2', 'Opt3', 'Opt4', 'Right_Ans'
    ];  
    public function testMaster(){
        return $this->belongsTo(TestMaster::class, 'testId', 'id');
      
    }
}
