@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{--<div class="card-header">Actions</div>--}}

                    {{--<div class="card-body">--}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="list-group">


                        <a href="{{ route('consent') }}" class="list-group-item list-group-item-action">
                            Login to Bank of Cyprus
                        </a>
                        @if(request()->user()->hasAccount())

                            @if(request()->user()->role == 'lender')
                                <a href="{{ route('actions.lend') }}"
                                   class="list-group-item list-group-item-action">
                                    Create Lending Intent
                                </a>
                            @endif
                            @if(request()->user()->role == 'borrower')
                                <a href="{{ route('borrow') }}" class="list-group-item list-group-item-action">
                                    Create Borrowing Request
                                </a>
                            @endif

                            <a href="#" class="list-group-item list-group-item-action">
                                Collateral (TODO)
                            </a>
                        @endif

                    </div>


                    {{--@include('oc')--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-lg-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(request()->user()->isLender())
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

                            @foreach(request()->user()->lendings as $lending)
                                <tr>
                                    <td>{{ $lending->from . ' - '. $lending->to }}</td>
                                    <td>{{ $lending->amount }}</td>
                                    <td>{{ $lending->rate }}</td>
                                    <td>{{ $lending->status }}</td>
                                    <td>
                                        <a href="{{route('matches',$lending)}}" class="btn btn-secondary btn-lg active"
                                           role="button" aria-pressed="true">Match</a></td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif

                @if(request()->user()->isBorrower())
                    <div id="borrower" class="card">

                        <div class="card-header">Published</div>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">From - to</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach(request()->user()->borrowings as $borrowing)
                                <tr>
                                    <td>{{ $borrowing->from . ' - '. $borrowing->to }}</td>
                                    <td>{{ $borrowing->amount }}</td>
                                    <td>{{ $borrowing->status }}</td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Company Details <span class="float-right">SCORE:
                            @if(request()->user()->hasAccount())
                                {{ request()->user()->score + rand(2,80) }}
                            @else
                                {{ request()->user()->score}}

                            @endif
                    </span></div>

                    <div class="card-body">


                        {{--@include('oc')--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
