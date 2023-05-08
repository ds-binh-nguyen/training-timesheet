@extends('layouts.auth-master')

@section('content')
    <div class="container my-5">
        <div class="card text-center">
            <div class="card-header">
                {{ __('403 - Forbidden') }}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ __('You are not authorized to access this page.') }}</h5>
                <p class="card-text">{{ __('Please contact your administrator if you believe this is an error.') }}</p>
                <a href="{{ url('/') }}" class="btn btn-primary">{{ __('Go to Home') }}</a>
            </div>
        </div>
    </div>
@endsection
