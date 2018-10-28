@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> Create a Borrowing Contract
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('borrow.create') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="start_from"
                                       class="col-sm-4 col-form-label text-md-right">{{ __('From') }}</label>

                                <div class="col-md-6">
                                    <input id="start_from" type="date"
                                           class="form-control{{ $errors->has('from') ? ' is-invalid' : '' }}"
                                           name="from" value="{{ old('from') }}" required autofocus>

                                    @if ($errors->has('from'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('from') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="finish_at"
                                       class="col-sm-4 col-form-label text-md-right">{{ __('To') }}</label>

                                <div class="col-md-6">
                                    <input id="finish_at" type="date"
                                           class="form-control{{ $errors->has('to') ? ' is-invalid' : '' }}" name="to"
                                           value="{{ old('to') }}" required>

                                    @if ($errors->has('to'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('to') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount"
                                       class="col-sm-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                                <div class="col-md-6">
                                    <input id="amount" type="number"
                                           class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}"
                                           name="amount" value="{{ old('amount') }}" required>

                                    @if ($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>


                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
