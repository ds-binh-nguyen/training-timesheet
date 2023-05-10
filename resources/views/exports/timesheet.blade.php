<link href="{!! url('assets/css/app.css') !!}" rel="stylesheet">

<table>
    <thead>
    <tr>
        <th style="text-align: center; font-weight: bold;">User Name</th>
        <th style="text-align: center; font-weight: bold;">Date</th>
        <th style="text-align: center; font-weight: bold;">Difficult</th>
        <th style="text-align: center; font-weight: bold;">Planning</th>
    </tr>
    </thead>
    <tbody>
    @foreach($timesheets as $timesheet)
        <tr>
            <td>{{ $timesheet->user->username }}</td>
            <td>{{ $timesheet->time_check_in }}</td>
            <td>{!! nl2br(e($timesheet->difficult)) !!}</td>
            <td>{!! nl2br(e($timesheet->planning)) !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>
