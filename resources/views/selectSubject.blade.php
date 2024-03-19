@extends('layouts.app')
@section('content')
<style>
body {
  background-color:#f3f3f3;
}

/* #wrapper {
border: 1px solid #fff;
border-radius: 5px;
  font-family:Sans-serif;
  line-height:1.5em;
  height:100%;
  background:#fff;
  margin:20px auto;
  padding:20px 50px; 
} */
h2{
  font-family: "Rubik";
}
nav{
  background-color: #F7F7F7;
}
.instruct-ul{
  line-height: 1.9rem;
}
/* card css start */
:root {
  --card-line-height: 1.2em;
  --card-padding: 2em;
  --card-radius: 0.5em;
  --color-green: #558309;
  --color-gray: #e2ebf6;
  --color-dark-gray: #c4d1e1;
  --radio-border-width: 2px;
  --radio-size: 1.5em;
}

.card {
  background-color: #fff;
  /* width: 300px; */
  border-radius: var(--card-radius);
  position: relative;
  
  &:hover {
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);
  }
}

.radio {
  font-size: inherit;
  margin: 0;
  position: absolute;
  right: calc(var(--card-padding) + var(--radio-border-width));
  top: calc(var(--card-padding) + var(--radio-border-width));
}

@supports(-webkit-appearance: none) or (-moz-appearance: none) { 
  .radio {
    -webkit-appearance: none;
    -moz-appearance: none;
    background: #fff;
    border: var(--radio-border-width) solid var(--color-gray);
    border-radius: 0; /* Set border-radius to 0 for square shape */
    cursor: pointer;
    height: var(--radio-size);
    outline: none;
    transition: 
      background 0.2s ease-out,
      border-color 0.2s ease-out;
    width: var(--radio-size); 

    &::after {
      border: var(--radio-border-width) solid #fff;
      border-top: 0;
      border-left: 0;
      content: '';
      display: block;
      height: 0.75rem;
      left: 25%;
      position: absolute;
      top: 50%;
      transform: 
        rotate(45deg)
        translate(-50%, -50%);
      width: 0.375rem;
    }

    &:checked {
      background: var(--color-green);
      border-color: var(--color-green);
    }
  }
  
  .card:hover .radio {
    border-color: var(--color-dark-gray);
    
    &:checked {
      border-color: var(--color-green);
    }
  }
}

.plan-details {
  border: var(--radio-border-width) solid var(--color-gray);
  border-radius: var(--card-radius);
  cursor: pointer;
  display: flex;
  flex-direction: column;
  padding: var(--card-padding);
  transition: border-color 0.2s ease-out;
}

.card:hover .plan-details {
  border-color: var(--color-dark-gray);
}

.radio:checked ~ .plan-details {
  border-color: var(--color-green);
}

.radio:focus ~ .plan-details {
  box-shadow: 0 0 0 2px var(--color-dark-gray);
}

.radio:disabled ~ .plan-details {
  color: var(--color-dark-gray);
  cursor: default;
}

.radio:disabled ~ .plan-details .plan-type {
  color: var(--color-dark-gray);
}

.card:hover .radio:disabled ~ .plan-details {
  border-color: var(--color-gray);
  box-shadow: none;
}

.card:hover .radio:disabled {
    border-color: var(--color-gray);
  }

.plan-type {
  color: var(--color-green);
  font-size: 1.5rem;
  font-weight:480;
  line-height: 1em;
  font-family: "Rubik";
}



.slash {
  font-weight: normal;
}
.submit-btn {
  background-color: var(--color-green);
  color: white;
  font-weight: medium;
  text-transform: uppercase;
  border: none; 
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 5px; 
}
.submit-btn:hover{
  background-color: var( --color-green);
 color: white;
 font-weight: medium;
 text-transform: uppercase;
 box-shadow: 0 8px 10px 0 rgba(3, 196, 3, 0.2), 0 6px 20px 0 rgba(0, 128, 0, 0.19);
}

/* card css end */

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
    </div>
  </nav>
</div>
<div class="container p-5">
   <center><h2 style="color: #322F5D;">Select Subject</h2></center> 
   
   <form action="{{route('examPaper')}}" method="get" enctype="multipart/form-data">
    @csrf
    
    @if ($errors->has('Subject'))
    <div class="alert alert-warning">
       {{ $errors->first('Subject') }}
    </div>
    @endif  
    <div class="row">
      @php
      // Import the Result model
      use App\Models\Result;
      
      $studentId = session('Student_id');
      
      // Fetch submitted subjects for the current user
      $submittedSubjects = [];
      if ($studentId) {
          $submittedSubjects = Result::where('student_id', $studentId)->pluck('Subject')->toArray();
      }
  @endphp

  @foreach ($testName as $testName)
      @php
          // Check if the current subject has been submitted
          $isSubmitted = in_array($testName->testName, $submittedSubjects);
      @endphp

    <div class="col-md-4">
     
  
      <label class="card mt-5">
        <input name="Subject" class="radio" type="radio" value="{{$testName->testName}}" {{$isSubmitted ? 'disabled' : ''}}>
        <span class="plan-details">
          <span class="plan-type">{{$testName->testName}}</span>
        </span>
      </label>    
    </div>
@endforeach
    </div>
    <ul class="instruct-ul mt-4">
  <p class="h5">Instructions:-</p>
 <li>Please think properly before selecting the option. Organise your thought process.</li>
<li>
  All questions have only one appropriate response.
</li>
<li>
  There is no negative marking. You may select your response with wisdom.
</li>
<li>
  Each section has 20 questions. You may answer in any order.
</li>
<li>
  After completion of your exam and all sections, you will be able to see your score.<br/>
  <b style="color: #322F5D;">"All The Best"</b> 
</li>
</ul>

<center>
  <button value="submit" type="submit" class="btn submit-btn mb-4" style="border-radius: 0;">Submit</button>
</center>

</div>
</form>
@endsection