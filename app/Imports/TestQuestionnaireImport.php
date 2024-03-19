<?php

namespace App\Imports;

use App\Models\TestQuestionnaire;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TestQuestionnaireImport implements ToModel, WithHeadingRow
{
   

    private $testId;

    public function __construct($testId)
    {
        $this->testId = $testId;
    }

    public function model(array $row)
    {
        return new TestQuestionnaire([
            'testId' => $this->testId,
            'Questions'=> $row['questions'],
            'Opt1'=> $row['a'], 
            'Opt2' => $row['b'], 
            'Opt3'=> $row['c'], 
            'Opt4'=> $row['d'], 
            'Right_Ans' => $row['right_ans'], 
        ]);
    }

    
}