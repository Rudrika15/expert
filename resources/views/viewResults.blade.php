@extends('layouts.app')
@section('content')
<style>
body {
  background-color:#f3f3f3;
}

#wrapper {
border: 1px solid #fff;
border-radius: 5px;
  font-family:Sans-serif;
  line-height:1.5em;
  height:100%;
  background:#fff;
  margin:20px auto;
  padding:20px 50px; 
}
nav{
  background-color: #F7F7F7;
}

</style>
<div class="container-fluid">
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="{{asset('templateCss/images/Expertlogo.png')}}" class="img-fluid" width="220px" alt="Logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      {{-- <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
          </li>
        </ul>
      </div> --}}
    </div>
  </nav>
</div>
<div class="container p-3">
  @if ($message = Session::get('error'))
  <div class="alert alert-danger text-dark" role="alert">
  {{$message}}      
  </div>
  @endif
  <div id="wrapper">
    @if ($studentData->isNotEmpty())
      @foreach ($studentData as $student)
        <h3 class="text-secondary">Hi {{ ucfirst($student->name) }}, here is your result:</h3>
        @if ($student->results->isNotEmpty())
          @foreach ($student->results as $result)
            <!-- showing results here -->
            <h4>Test Name: {{ ucfirst($result->Subject) }}</h4>
            <h6>Score: <span class="text-primary">{{ $result->Score }}</span></h6>
            <h6>Right Answer: <span class="text-success">{{ $result->totalRightAns }}</span></h6>
            <h6>Wrong Answer: <span class="text-danger">{{ $result->totalWrongAns }}</span></h6>  
          @endforeach
        @endif 
      @endforeach
      <h6>Total Unattempts: <span class="text-danger">{{ $unattemptedQues }}</span></h6>
      <h5>Percentage: {{ round($percent) }}<span>%</span></h5>
      <div class="d-flex justify-content-end">
        <a href="{{ route('studentLogin') }}" class="btn btn-secondary" style="border-radius: 0">Give Another Exam</a>
      </div>
    @else
      <p>No student data found.</p>
    @endif
  </div>
</div>
@endsection