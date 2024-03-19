@extends('layouts.master')
@section('content')

    <div class="container">
        <h1 class="d-flex justify-content-center">Results</h1>
        <table class="table table-primary text-dark" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Student Email</th>
                    <th scope="col">Student Phone Number</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Total Attempted</th>
                    <th scope="col">Total Right Ans</th>
                    <th scope="col">Total Wrong Ans</th>
                    <th scope="col">Score</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Suggestions</th>
                    <th scope="col" style="color:#6B51DF;">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewResult as $resultData)
                    <tr class="table-secondary">

                        <td>{{ $resultData->id }}</td>
                        <td>{{ $resultData->name }}</td>
                        <td>{{ $resultData->email }}</td>
                        <td>{{ $resultData->phoneNumber }}</td>
                        <td>
                            @foreach ($resultData->results as $studentResult)
                                <ul>
                                    <li>{{ $studentResult->Subject }}</li>
                                </ul>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($resultData->results as $studentResult)
                                <ul>
                                    <li>{{ $studentResult->totalAttempted }}</li>
                                </ul>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($resultData->results as $studentResult)
                                <ul>
                                    <li>{{ $studentResult->totalRightAns }}</li>
                                </ul>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($resultData->results as $studentResult)
                                <ul>
                                    <li>{{ $studentResult->totalWrongAns }}</li>
                                </ul>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($resultData->results as $studentResult)
                                <ul>
                                    <li>{{ $studentResult->Score }}</li>
                                </ul>
                            @endforeach
                        </td>
                        <td>
                            {{ $resultData->Comments }}
                        </td>
                        <td>
                            {{ $resultData->Suggestions }}
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <a type="button" data-bs-toggle="modal" data-bs-target="#editResult{{ $resultData->id }}">
                                <i class="fa-solid fa-pen-to-square" style="color:#343957;"></i>
                            </a>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>


        <!-- Modal -->
        @foreach ($viewResult as $resultData)
            <div class="modal fade" id="editResult{{ $resultData->id }}" tabindex="-1"
                aria-labelledby="editResultLabel{{ $resultData->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.resultsUpadte', $resultData->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editResultLabel{{ $resultData->id }}">Edit Result</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <h6><span class="text-secondary">Student Name: </span> {{ $resultData->name }}
                                    </h6>
                                </div>
                                <div class="mb-3">
                                    <h6><span class="text-secondary">Student Email: </span> {{ $resultData->email }}
                                    </h6>
                                </div>
                                <div class="mb-3">
                                    <label for="studentName{{ $resultData->id }}" class="form-label">Add Comment</label>
                                    <input type="text" name="Comments"
                                        value="{{ $resultData->Comments != 'noComments' ? $resultData->Comments : '' }}"
                                        class="form-control" id="studentName{{ $resultData->id }}">
                                </div>
                                <div class="mb-3">
                                    <label for="studentName{{ $resultData->id }}" class="form-label">Add
                                        Suggestions</label>
                                    <input type="text" name="Suggestions"
                                        value="{{ $resultData->Suggestions != 'noSuggestions' ? $resultData->Suggestions : '' }}"
                                        class="form-control" id="studentName{{ $resultData->id }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" value="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        
    @endsection
