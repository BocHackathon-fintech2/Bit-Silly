@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Actions</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <a href="{{route('actions.lend')}}" class="btn btn-info">Lend</a>
                            <a href="{{ route('actions.borrow') }}" class="btn btn-info">Borrow</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
