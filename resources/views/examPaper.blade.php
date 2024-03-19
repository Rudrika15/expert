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
.submit-btn{
  color: white;
  font-weight: medium;
  text-transform: uppercase;
  border: none; 
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 5px; 
}
.submit-btn:hover{
background-color: rgb(2, 38, 104);
 color: white;
 font-weight: medium;
 text-transform: uppercase;
 box-shadow: 0 8px 10px 0 rgba(3, 196, 3, 0.2), 0 6px 20px 0 rgba(0, 128, 0, 0.19), 5px 5px 15px rgba(0, 0, 255, 0.5);
} 

nav{
  background-color: #F7F7F7;
}
</style>

<div class="container-fluid">
  {{-- navbar --}}
  
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="{{asset('templateCss/images/Expertlogo.png')}}" class="img-fluid" width="220px" alt="Logo" >
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

  <div class="container">
  {{-- end navbar --}}
  @if ($testMaster->status != "start") 
  <div id="wrapper">
    <h5 class="text-danger">Sorry!  the Test is not started yet!!</h5> 
  </div>
  @else
<div id="wrapper">
    <h3 class="text-primary">
      @if(!$examData->isEmpty())
        {{ucfirst($examData->first()->testMaster->testName)}} Exam
      @endif
    </h3>
    <hr>
<p class="text-secondary">All the questions below given are required</p>
</div>
<div id="wrapper">
    <form action="{{route('resultStore')}}" method="post" id="examForm" enctype="multipart/form-data">
        @csrf
        @if(!$examData->isEmpty())
        <input type="hidden" name="examName" value="{{$examData->first()->testMaster->testName}}">
      @endif  

    @foreach ($examData as $data)
  <div class="question-block" id="questionBlock{{ $data->id }}">
        <h6 class="fw-semibold">Q.{{$loop->iteration}} {{ $data->Questions }}</h6>
        <p>a. <input type="radio" name="studentAns{{$data->id}}" id="" value="{{ $data->Opt1 }}"> {{ $data->Opt1 }}</p>
        <p>b. <input type="radio" name="studentAns{{$data->id}}"id="" value="{{ $data->Opt2 }}"> {{ $data->Opt2 }}</p>
        <p>c. <input type="radio" name="studentAns{{$data->id}}" id="" value="{{ $data->Opt3 }}"> {{ $data->Opt3 }}</p>
        <p>d. <input type="radio" name="studentAns{{$data->id}}" id="" value="{{ $data->Opt4 }}"> {{ $data->Opt4 }}</p>
        <div class="d-flex justify-content-end">
          <button type="button" class="btn btn-secondary text-white" style="border-radius: 0;" onclick="document.querySelectorAll('input[name=studentAns{{ $data->id }}]').forEach(radio => radio.checked = false)">Reset</button>
      </div>
        <hr>
  </div>
    @endforeach
    <center><button class="btn btn-primary submit-btn"  type="submit" value="submit" style="border-radius: 0;" onclick="return confirm('Are you sure you want to submit the exam?')">Submit</button></center>
  </form>
</div>
@endif
</div>
</div>
@endsection
