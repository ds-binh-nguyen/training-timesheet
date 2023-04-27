@extends('layouts.app-master')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Timesheet Records') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Check-In Time') }}</th>
                                <th>{{ __('Check-Out Time') }}</th>
                                <th>{{ __('Total Hours') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            BODY
                            {{-- @foreach($timesheets as $timesheet)
                                <tr>
                                    <td>{{ $timesheet->date }}</td>
                                    <td>{{ $timesheet->checkin_time }}</td>
                                    <td>{{ $timesheet->checkout_time }}</td>
                                    <td>{{ $timesheet->total_hours }}</td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
