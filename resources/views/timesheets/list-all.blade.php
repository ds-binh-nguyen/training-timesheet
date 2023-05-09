@extends('layouts.app-master')

@section('content')
    <div class="row justify-content-center p-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Timesheet Management</li>
            </ol>
        </nav>

        <div class="col-md-11">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start mb-3">
                <form class="w-50 me-lg-auto mb-2 justify-content-center mb-md-0">
                  <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
                </form>
                <div class="text-end">
                    @can('export', App\Timesheet::class)
                        <a href="{{ route('timesheet-management.export') }}" class="btn btn-primary">{{ __('Export all Timesheets') }}</a>
                    @endcan
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Timesheet Records') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Task') }}</th>
                                <th>{{ __('Difficult') }}</th>
                                <th>{{ __('Planning') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($timesheets as $timesheet)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $timesheet->time_check_in }}</td>
                                <td>{{ $timesheet->user->username }}</td>
                                <td>
                                    @foreach($timesheet->tasks as $task)
                                    <div>
                                        <strong>ID: </strong> : {{ $task->task_id }}
                                        <br>
                                        <strong>What you do: </strong> : <div> {!! nl2br(e($task->content)) !!} </div>
                                        <strong>Spent time: </strong> : {{ $task->spent_time }} Hrs
                                    </div>
                                    @if ($loop->iteration !== count($timesheet->tasks))
                                        <hr>                                        
                                    @endif
                                    @endforeach
                                </td>
                                <td>{!! nl2br(e($timesheet->difficult)) !!}</td>
                                <td>{!! nl2br(e($timesheet->planning)) !!}</td>
                                <td>
                                    @can('approve', $timesheet)
                                        <form method="POST" action="{{ route('timesheet-management.approve', ['timesheet' => $timesheet->id]) }}" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">{{ __('Approve') }}</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $timesheets->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
