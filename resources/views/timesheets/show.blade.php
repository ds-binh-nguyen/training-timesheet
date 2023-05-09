@extends('layouts.app-master')

@section('content')
    <div class="container p-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="/timesheets">Timesheet</a></li>
              <li class="breadcrumb-item active" aria-current="page">Show</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Timesheet Management') }}</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-8">
                                {{-- fake date for time_check_in --}}
                                <input id="date" type="date" class="form-control" disabled
                                    name="time_check_in" value="{{ \Carbon\Carbon::parse($timesheet->time_check_in)->format('Y-m-d') }}">
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

                            @if (count($timesheet->tasks) === 0)
                                <div class="text-center fw-bold">
                                    No tasks in here
                                </div>
                            @else
                                @foreach($timesheet->tasks as $index => $task)
                                    <div class="row mt-2">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" disabled
                                                name="tasks[{{$index}}][task_id]" value="{{ $task->task_id }}">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" disabled
                                                name="tasks[{{$index}}][spent_time]" value="{{ $task->spent_time }}" disabled>
                                        </div>
                                        <div class="col-md-7">
                                            <textarea class="form-control" disabled
                                                name="tasks[{{$index}}][content]" rows="2">{{ $task->content }}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        {{-- <div class="form-group row">
                            <label for="checkin_time" class="col-md-4 col-form-label text-md-right">{{ __('Check-In Time') }}</label>

                            <div class="col-md-8">
                                <input id="checkin_time" type="time" class="form-control @error('checkin_time') is-invalid @enderror" name="checkin_time">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="checkout_time" class="col-md-4 col-form-label text-md-right">{{ __('Check-Out Time') }}</label>

                            <div class="col-md-8">
                                <input id="checkout_time" type="time" class="form-control @error('checkout_time') is-invalid @enderror" name="checkout_time">
                            </div>
                        </div> --}}

                        <div class="form-group row mt-3">
                            <label for="difficult" class="col-md-4 col-form-label text-md-right">{{ __('Difficult') }}</label>

                            <div class="col-md-8">
                                <textarea id="difficult" class="form-control" disabled
                                    name="difficult" rows="5">{{ $timesheet->difficult }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="planning" class="col-md-4 col-form-label text-md-right">{{ __('Planning') }}</label>

                            <div class="col-md-8">
                                <textarea id="planning" class="form-control" disabled
                                    name="planning" rows="5">{{ $timesheet->planning }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mt-3 mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href="{{ route('timesheets.edit', $timesheet->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                @can('approve', $timesheet)
                                    <form method="POST" action="{{ route('timesheet-management.approve', ['timesheet' => $timesheet->id]) }}" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">{{ __('Approve') }}</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

