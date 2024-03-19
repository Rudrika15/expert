@extends('layouts.master')
@section('content')
    <div class="container">
       
            <form action="{{route('viewExamQuestionnaire')}}" class="d-flex justify-content-end" enctype="multipart/form-data" method="get">
                <select name="testName" id="" class="form-select text-primary w-25">
                    <option value="" disabled>Select Test QuestionPaper</option>
                     @foreach ($testMaster as $data)
                    <option value="{{$data->testName}}">{{$data->testName}}</option>
                  @endforeach
                </select>
                <button class="btn btn-info ms-3">Search</button>
            </form>

        <table class="table table-primary text-dark">
        <h1 class="text-center p-2"> 
           {{ $testData->first()->testMaster->testName}} Question Paper</h1>
            <thead>
                <tr>
                    <th scope="col">Sr. No</th>
                    <th scope="col">Questions</th>
                    <th scope="col">Option1</th>
                    <th scope="col">Option2</th>
                    <th scope="col">Option3</th>
                    <th scope="col">Option4</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($testData as $testData)
                    <tr class="table-secondary">
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $testData->Questions }}</td>
                        <td>{{ $testData->Opt1 }}</td>
                        <td>{{ $testData->Opt2 }}</td>
                        <td>{{ $testData->Opt3 }}</td>
                        <td>{{ $testData->Opt4 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
