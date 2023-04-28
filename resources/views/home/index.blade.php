@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        <h1>Welcome {{ auth()->user()->username }}</h1>
        <p class="lead">Only authenticated users can access this section.</p>
    </div>
@endsection
