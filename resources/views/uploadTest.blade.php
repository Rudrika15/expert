@extends('layouts.master')
@section('content')

<div class="container ps-4">
   <div class="d-flex justify-content-between mb-4">
    <h2>Welcome</h2>
   </div>
    <h4>Upload Test</h4>
    <form action="{{route('saveTest')}}" method="post" class="mt-4" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label text-dark">Test Name:-</label>
            {{-- <input type="text" name="testName" class="form-control w-25 " placeholder="Enter TestName"> --}}
            <select name="testName" id=""  class="form-select w-25" aria-label="Default select example">
                <option value="Career">Career</option>
                <option value="Gk-1">Gk-1</option>
                <option value="Gk-2">Gk-2</option>
                <option value="Heritage">Heritage</option>
                <option value="Personal">Personal</option>
                <option value="Quantitative-1">Quantitative-1</option>
                <option value="Quantitative-2">Quantitative-2</option>
                <option value="Reasoning-1">Reasoning-1</option>
                <option value="Reasoning-2">Reasoning-2</option>
                <option value="Situational">Situational</option>
                <option value="Verbal-1">Verbal-1</option>
                <option value="Verbal-2">Verbal-2</option>
            </select>
        </div>
        
        <div class="row">
            <div class="col">
                <input type="file"  name="file">
            </div>
            <div class="col">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
    
</div>


@endsection