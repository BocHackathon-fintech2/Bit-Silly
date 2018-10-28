@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">

            <div class="col-12">

                <div id="lendings" class="card">


                    <div class="card-header">Published Lendings</div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">From - to</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $lending->from . ' - '. $lending->to }}</td>
                            <td>{{ $lending->amount }}</td>
                            <td>{{ $lending->rate }}</td>
                            <td>{{ $lending->status }}</td>
                            <td>
                                <a href="{{route('matches',$lending)}}" class="btn btn-secondary btn-lg active"
                                   role="button"
                                   aria-pressed="true">Match</a></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>


            <div class="col-12">

                <div id="borrowings" class="card">


                    <div class="card-header">Matching Borrowings</div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Score</th>
                            <th scope="col">KYC Info</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($borrowings as $borrowing)
                            <tr>
                                <td><a href="{{route('kyc',$borrowing->user)}}">{{ $borrowing->user->name }}</a></td>
                                <td>{{ $borrowing->amount }}</td>
                                <td>{{ $borrowing->user->score }}</td>
                                <td>{{ $borrowing->status }}</td>
                                <td>
                                    <a href="{{route('accept')}}" class="btn btn-secondary btn-lg active"
                                       role="button"
                                       aria-pressed="true">Accept</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection
