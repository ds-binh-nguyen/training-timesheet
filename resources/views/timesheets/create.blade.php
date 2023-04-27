@extends('layouts.app-master')

@section('content')
    <div class="container p-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="/timesheets">Timesheet</a></li>
              <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Timesheet Management') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('timesheets.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                                <div class="col-md-8">
                                    {{-- fake date for time_check_in --}}
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="time_check_in">

                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group" id="dynamicAddRemove">
                                <label for="task" class="col-form-label text-md-right">{{ __('Tasks') }}</label>

                                <div class="row">
                                    <span class="col-md-1"></span>
                                    <div class="col-md-2">
                                        <label for="task_id" class="col-form-label text-md-right">{{ __('ID') }}</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="spent_time" class="col-form-label text-md-right">{{ __('Spent Time') }}</label>
                                    </div>
                                    <div class="col-md-7">
                                        <label for="content" class="col-form-label text-md-right">{{ __('What I do') }}</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <span id="dynamic-ar" class="col-md-1 mt-2 ps-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                    </span>
                                    <div class="col-md-2">
                                        <input id="task_id" type="text" class="form-control @error('task_id') is-invalid @enderror" name="tasks[0][task_id]">
                                    </div>
                                    <div class="col-md-2">
                                        <input id="spent_time" type="text" class="form-control @error('spent_time') is-invalid @enderror" name="tasks[0][spent_time]">    
                                    </div>
                                    <div class="col-md-7">
                                        <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="tasks[0][content]" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <label for="checkin_time" class="col-md-4 col-form-label text-md-right">{{ __('Check-In Time') }}</label>

                                <div class="col-md-8">
                                    <input id="checkin_time" type="time" class="form-control @error('checkin_time') is-invalid @enderror" name="checkin_time">

                                    @error('checkin_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="checkout_time" class="col-md-4 col-form-label text-md-right">{{ __('Check-Out Time') }}</label>

                                <div class="col-md-8">
                                    <input id="checkout_time" type="time" class="form-control @error('checkout_time') is-invalid @enderror" name="checkout_time">

                                    @error('checkout_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="form-group row mt-3">
                                <label for="difficult" class="col-md-4 col-form-label text-md-right">{{ __('Difficult') }}</label>

                                <div class="col-md-8">
                                    <textarea id="difficult" class="form-control @error('difficult') is-invalid @enderror" name="difficult" rows="5"></textarea>

                                    @error('difficult')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="planning" class="col-md-4 col-form-label text-md-right">{{ __('Planning') }}</label>

                                <div class="col-md-8">
                                    <textarea id="planning" class="form-control @error('planning') is-invalid @enderror" name="planning" rows="5"></textarea>

                                    @error('planning')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<div class="row mt-2"><button type="button" class="remove-input-field col-md-1 btn btn-danger" style="height: 38px">Delete</button>' +
                '<div class="col-md-2"><input type="text" class="form-control" name="tasks['+i+'][task_id]"></div>' + 
                '<div class="col-md-2"><input type="text" class="form-control" name="tasks['+i+'][spent_time]"></div>' + 
                '<div class="col-md-7"><textarea class="form-control" name="tasks['+i+'][content]" rows="2"></textarea></div></div>');
        });
        $(document).on('click', '.remove-input-field', function (e) {
            e.currentTarget.parentNode.remove();
        });
    </script>
@endsection

