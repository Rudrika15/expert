@extends('layouts.app')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
<style>
body {
  background-color: white;
 
  }
  
  #wrapper {
  border: 1px solid #F7F7F7;
  border-radius: 5px;
    line-height:1.5em;
    height:100%;
    background:#F7F7F7;
    margin:20px auto;
    padding:20px 50px; 
    
  }
 #wrapper {
  font-family: "Roboto Mono", monospace;
  font-optical-sizing: auto;
  font-weight: 500;
  font-style: normal;
 }
  ul {
    list-style-type: none;
}
table,
        th,
        td {
            padding: 5px;
            text-align: center;
        }
        td , ul , li  {
            padding: 5px;
            text-align: center;
        }
</style>

    <div class="container-fluid">
        <div class="container p-3">
            <div id="wrapper" class="text-secondary">
              <div class="d-flex justify-content-end">
                <img src="{{asset('templateCss/images/Expertlogo.png')}}" class="img-fluid" width="280px" height="250px" alt="Logo">
              </div>
                <div class="p-2"> 
                  <h4>Name: <span class="text-dark">  {{$studentData->name}}</span> </h4>
                </div>
                <div class="p-2">
                <h4>Email:  <span class="text-dark">  {{$studentData->email}}</span></h4>
                </div>
                <div class="p-2">
                <h4>Phone Number:  <span class="text-dark">  {{$studentData->phoneNumber}}</span></h4>
                </div>
                <div class="p-2">
                <table class="table table-striped  table-bordered table-hover w-25">
                    <thead>
                      <tr>
                        <th scope="col">Sr. No</th>
                        <th scope="col">Subjects</th>
                        <th scope="col">Total Score</th> 
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">
                          @foreach ($studentData->results as $resultData ) 
                          <ul>
                            <li>{{ $loop->iteration }}</li>
                          </ul>
                          @endforeach
                        </th>
                        <td>
                          @foreach ($studentData->results as $resultData )  
                        <ul>
                          <li>{{$resultData->Subject}}</li>
                        </ul> 
                          @endforeach
                        </td>
                        <td>
                          @foreach ($studentData->results as $resultData )  
                          <ul>
                            <li>{{$resultData->Score}}</li> 
                          </ul> 
                            @endforeach
                            <hr><ul>
                              <li class="fw-bold">
                            {{$totalScore}}</li> 
                        </td>
                        
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="p-2">
                 
                <h4>Comments:  <span class="text-dark">{{$studentData->Comments}} </span></h4>
                </div>
                <div class="p-2">
                <h4>Suggestions:  <span class="text-dark">{{$studentData->Suggestions}} </span></h4>
                </div>
                  </div>
        </div>
      </div>
      




@endsection