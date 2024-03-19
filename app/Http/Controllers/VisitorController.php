<?php

namespace App\Http\Controllers;

use App\Imports\TestQuestionnaireImport;
use App\Models\Result;
use App\Models\StudentLogin;
use App\Models\TestMaster;
use App\Models\TestQuestionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Log;


class VisitorController extends Controller
{
    // public function home()
    // {
    //     return view('home');
    // }
    public function uploadTest()
    {
        return view('uploadTest');
    }

    public function saveTest(Request $request)
    {
        $existingTest = TestMaster::where('testName', $request->testName)->get();
        if ($existingTest) {
            foreach ($existingTest as $test) {
                TestQuestionnaire::where('testId',  $test->id)->delete();
                Testmaster::find($test->id)->delete();
            }
        }
        $testData = new TestMaster();
        $testData->testName = $request->testName;
        $testData->status = "stop";
        $testData->save();
        $testId = $testData->id;
        Excel::import(new TestQuestionnaireImport($testId), request()->file('file'), $testId);
        $request->session()->put('test_id', $testId);
        if ($request->session()->has('test_id')) {
            return redirect()->route('viewTest');
        } else {
            return  "error";
        }
    }

    public function viewTest()
    {
        $testId = session()->get('test_id');
        $testMaster= Testmaster::all();
        $testData = TestQuestionnaire::where('testId', $testId)->with('testMaster')->get();
        return view('viewTest', compact('testData', 'testMaster'));
    }
    public function viewExamQuestionnaire(Request $request){
        $testMaster= Testmaster::all();
       $testName =  $request->testName;
        $test = TestMaster::where('testName', $testName)->first();
        $testData = TestQuestionnaire::where('testId', $test->id)->with('testMaster')->get();
         return view('viewTest', compact('testData', 'testMaster'));
    }


    public function selectTest()
    {
        $test = TestMaster::all();
        return view('selectTest', compact('test'));
    }

    // store  selected test data
    public function storeSelectedData(Request $request)
    {
        $request->validate(
            [
                'testName' => 'required',
            ],
            [
                'testName.required'  => 'Please fill the field',
            ]
        );
        $testName = $request->testName;
        $action = $request->action;
        $testData = TestMaster::where('testName',  $testName)->first();
        if ($testData) {
            if ($action == 'start') {
                $testData->status = 'start';
            } else if ($action == 'stop') {
                $testData->status = 'stop';
            }
            $testData->save();
            if ($testData->save()) {
                return redirect()->back();
            } else {
                return redirect()->back()->with('error', 'Error');
            }
        } else {
            return redirect()->back()->with('error', 'Error not Found');
        }
    }
    public function results()
    {
        // $viewResult  = Result::orderBy('studentPhoneNumber', 'asc')->get();
        $viewResult  = StudentLogin::whereHas('results')->orderBy('phoneNumber', 'desc')->get();
        return view('admin.results', compact('viewResult'));
    }
    public function resultsUpdate(Request $request, $id)
    {
        $resultData = StudentLogin::findOrFail($id);
        $resultData->Comments = $request->Comments;
        $resultData->Suggestions = $request->Suggestions;
        $resultData->save();
        return redirect()->route('admin.printData', ['id' => $id]);
    }

    public function  printData($id)
    {
        $studentData = StudentLogin::with('results')->findorFail($id);
        $totalScore = 0;
        foreach ($studentData->results as $resultData) {
            $totalScore += $resultData->Score;
        }

        return view('admin.printData', compact('studentData', 'totalScore'));
    }

    // STUDENT LOGIN FORM ---------------------------------------------------------------------

    public function studentLogin()
    {
        session()->forget('exam_submitted');

        return view('studentLogin');
    }
    public function studentLoginStored(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i',
                'phoneNumber' => 'required|min:10|max:12'
            ],
            [
                'name.required'  => 'Name field is required',
                'email.required' => 'Email field is required',
                'phoneNumber.required' => 'Phone Number field is required'
            ]
        );
        $existingStudent = StudentLogin::where('phoneNumber', $request->phoneNumber)->first();
        if (!$existingStudent) {
            $studentData = new StudentLogin();
            $studentData->name = $request->name;
            $studentData->email = $request->email;
            $studentData->phoneNumber = $request->phoneNumber;
            $studentData->save();
            $student_id = $studentData->id;
            $request->session()->put('Student_id', $student_id);
            if ($request->session()->has('Student_id')) {
                return redirect()->route('selectSubject');
            } else {
                return "error";
            }
        } else {
            $student_id = $existingStudent->id;
            $request->session()->put('Student_id', $student_id);
            if ($request->session()->has('Student_id')) {
                return redirect()->route('selectSubject');
            } else {
                return "error";
            }
        }
    }
    public function selectSubject()
    {
        $testName = TestMaster::all();
        return view('selectSubject', compact('testName'));
    }
    public function examPaper(Request $request)
    {
        if (session()->has('exam_submitted')) {
            // Redirect the user to the result page
            return redirect()->route('viewResults')->with('error', 'You have already submitted the exam.');
        } else {
            $request->validate(
                [
                    'Subject' => 'required',
                ],
                [
                    'Subject.required' => 'Please Select a Subject !',
                ]
            );
            $subjectData  = TestMaster::where('testName', $request->Subject)->first();
            if ($subjectData) {
                $examData = TestQuestionnaire::with('testMaster')->where('testId', $subjectData->id)->get();
            }

            // $examData = TestQuestionnaire::with('testMaster')->get();
            foreach ($examData as $testData) {
                $testMaster = $testData->testMaster;
            }
            if ($request->session()->has('Student_id')) {
                return view('examPaper', compact('examData', 'testMaster'));
            } else {
                return redirect()->route('studentLogin')->with('error', 'You have not Registered please Register First!');
            }
           
        }
    }
    public function resultStore(Request $request)
    {
        $studentId = session()->get('Student_id');
        $studentData = StudentLogin::find($studentId);
        $answers = [];
        $correctCount = 0; // Count for correct answers
        $IncorrectCount = 0;  //Count for incorrect answers

        // Mapping from letters to option columns in the database
        $optionsMapping = [
            'a' => 'Opt1',
            'b' => 'Opt2',
            'c' => 'Opt3',
            'd' => 'Opt4',
        ];

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'studentAns') === 0) {
                $questionId = str_replace('studentAns', '', $key);
                $answers[$questionId] = $value;
            }
        }

        if ($answers) {
            $attemptedAns = count($answers);
            $questionIds = array_keys($answers); // Get all the question IDs

            // Retrieve questions from the database based on question IDs
            $questions = TestQuestionnaire::whereIn('id', $questionIds)->get();

            foreach ($questions as $question) {
                $correctAnswer = $question->Right_Ans;
                $selectedOption = $answers[$question->id]; // Student's selected option

                // Map letter to option column in the database
                $correctOption = $optionsMapping[$correctAnswer];

                // Check if  student's answer matches the correct answer
                if ($selectedOption == $question->$correctOption) {
                    $correctCount++;
                }
                if ($selectedOption !== $question->$correctOption) {
                    $IncorrectCount++;
                }
            }
        }

        $result  = new Result();
        $result->student_id = $studentData->id;
        $result->studentName = $studentData->name;
        $result->studentEmail = $studentData->email;
        $result->studentPhoneNumber = $studentData->phoneNumber;
        $result->totalAttempted = $attemptedAns;
        $result->Subject = $request->examName;
        $result->totalRightAns = $correctCount; // Store the count of correct answers
        $result->totalWrongAns = $IncorrectCount; // Store the count of Incorrect answers
        $result->Score = $correctCount;
        $result->save();
        session()->put('exam_submitted', true);
        return redirect()->route('viewResults');
    }

    public function viewResults()
    {
        $studentId = session()->get('Student_id');
        $studentData = StudentLogin::where('id', $studentId)
            ->with(['results' => function ($query) {
                $query->latest()->take(1); // Retrieve only the latest result
            }])
            ->get();

        if ($studentData->isNotEmpty()) {
            $latestResult = $studentData->first()->results->first();
            $correctAns = $latestResult->totalRightAns;
            $attemptedAns  = $latestResult->totalAttempted;
            $subject = $latestResult->Subject;
            $SelectedSubject = TestMaster::where('testName', $subject)->first();
            $totalQues = TestQuestionnaire::where('testId', $SelectedSubject->id)->get(['Questions']);

            $countedQues = count($totalQues);
            $percent = $correctAns / $countedQues * 100;
            $unattemptedQues = $countedQues - $attemptedAns;

            return view('viewResults', compact('studentData', 'percent', 'unattemptedQues'));
        } else {
            // Handle case where no student data is found
            return "error";
        }
    }

    // public function viewResults()
    // {
    //     $studentId = session()->get('Student_id');
    //     $studentData = StudentLogin::where('id', $studentId)
    //     ->with(['results' => function ($query) {
    //         $query->latest()->take(1); // Retrieve only the latest result
    //     }])
    //     ->get();
    //     // return $studentData = StudentLogin::whereHas('results', function($q) use($studentId){
    //     //     $q->where( 'student_id' ,$studentId)
    //     //     ->latest();
    //     // })->with('results')->get();
    //     foreach ($studentData->results as $result) {
    //         $correctAns =  $result->totalRightAns;
    //         $attemptedAns  = $result->totalAttempted;
    //         $subject =  $result->Subject;
    //         $SelectedSubject = TestMaster::where('testName', $subject)->first();
    //         $totalQues = TestQuestionnaire::where('testId', $SelectedSubject->id)->get([
    //             'Questions'
    //         ]);
    //     }

    //     $countedQues = count($totalQues);
    //     $percent = $correctAns / $countedQues * 100;
    //     $unattemptedQues = $countedQues - $attemptedAns;
    //     return view('viewResults', compact('studentData', 'percent', 'unattemptedQues'));
    // }
}
