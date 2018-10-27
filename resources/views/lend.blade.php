@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">                        Create a Lending Contract
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            {{--
                             $table->integer('user_id');
            $table->string('subscription_id')->nullable();
            $table->string('access_token')->nullable();
            $table->dateTime('from')->nullable();
            $table->dateTime('to')->nullable();
            $table->integer('amount')->default(1000)->nullable();
            $table->integer('rate')->nullable();
            $table->integer('suggested_rate')->nullable();
            $table->string('status')->nullable();
            $table->integer('accepted_by_borrower_id')->nullable();
            $table->timestamp('accepted_at')->nullable();
                            --}}

                            <form method="POST" action="{{ route('actions.lend.create') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="start_from" class="col-sm-4 col-form-label text-md-right">{{ __('From') }}</label>

                                    <div class="col-md-6">
                                        <input id="start_from" type="date" class="form-control{{ $errors->has('from') ? ' is-invalid' : '' }}" name="from" value="{{ old('from') }}" required autofocus>

                                        @if ($errors->has('from'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('from') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="finish_at" class="col-sm-4 col-form-label text-md-right">{{ __('To') }}</label>

                                    <div class="col-md-6">
                                        <input id="finish_at" type="date" class="form-control{{ $errors->has('to') ? ' is-invalid' : '' }}" name="to" value="{{ old('to') }}" required>

                                        @if ($errors->has('to'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('to') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="amount" class="col-sm-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                                    <div class="col-md-6">
                                        <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" required >

                                        @if ($errors->has('amount'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="wish_rate" class="col-sm-4 col-form-label text-md-right">{{ __('Wishful Rate') }}</label>

                                    <div class="col-md-6">
                                        <input id="wish_rate" type="number" class="form-control{{ $errors->has('rate') ? ' is-invalid' : '' }}" name="from" value="{{ old('rate') }}" required>

                                        @if ($errors->has('rate'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rate') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="suggested_rate" class="col-sm-4 col-form-label text-md-right">{{ __('Suggested Rate') }}</label>

                                    <div class="col-md-6">
                                        <input id="suggested_rate" type="number" class="form-control{{ $errors->has('suggested_rate') ? ' is-invalid' : '' }}" name="suggested_rate" value="{{ old('suggested_rate') }}" required>

                                        @if ($errors->has('suggested_rate'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('suggested_rate') }}</strong>
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
