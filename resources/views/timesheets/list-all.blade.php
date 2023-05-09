@extends('layouts.app-master')

@section('content')
Manage Timesheet Users

@can('export', App\Timesheet::class)
    <a href="{{ route('timesheet-management.export') }}" class="btn btn-primary">{{ __('Export all Timesheets') }}</a>
@endcan
@endsection
