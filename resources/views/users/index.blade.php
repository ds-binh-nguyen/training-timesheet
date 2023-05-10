@extends('layouts.app-master')

@section('content')
    <div>
        @foreach($users as $user)
            {{ $user->username }}
        @endforeach
    </div>
@endsection
