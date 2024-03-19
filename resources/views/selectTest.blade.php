@extends('layouts.master')
@section('content')
    <div class="container">
        <center>
            @if ($message = Session::get('error'))
                <div class="alert alert-warning text-dark w-50" role="alert">
                    {{ $message }}
                </div>
            @endif
            <h3 class="text-secondary">Select  the Test you want to start:</h3>
            <form action="{{ route('storeSelectedData') }}" method="post">
                @csrf
                <div class="mb-3">
                    <select class="form-select form-select-lg w-50 mb-3" name="testName" aria-label="Large select example">
                        <option selected>Select test</option>
                        @foreach ($test as $testName)
                            <option value="{{ $testName->testName }}">{{ $testName->testName }}</option>
                        @endforeach

                    </select>
                    @if ($errors->has('testName'))
                        <span class="text-danger">{{ $errors->first('testName') }}</span>
                    @endif
                </div>
                <div class="mt-4">
                    <button type="submit" name="action" value="start" class="btn btn-outline-success">Start Test</button>
                    <button type="submit" name="action" value="stop" class="btn btn-outline-danger">Stop Test</button>
                </div>
            </form>

    </div>

    </center>
@endsection
