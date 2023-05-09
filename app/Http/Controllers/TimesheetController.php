<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimesheetRequest;
use App\Http\Requests\UpdateTimesheetRequest;
use App\Models\Timesheet;
use App\Services\Interfaces\TimesheetServiceInterface;

class TimesheetController extends Controller
{
    protected $timesheetService;

    public function __construct(TimesheetServiceInterface $timesheetService)
    {
        $this->timesheetService = $timesheetService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timesheets = $this->timesheetService->getByCurrentUser();

        return view('timesheets.index', compact('timesheets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('timesheets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimesheetRequest $request)
    {
        $params = $request->only([
            'time_check_in',
            'time_check_out',
            'difficult',
            'planning',
            'tasks',
        ]);
        $params['user_id'] = auth()->user()->id;
        $this->timesheetService->create($params);

        return redirect()->route('timesheets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Timesheet $timesheet)
    {
        $this->authorize('view', $timesheet);

        $timesheet = $this->timesheetService->getByIdWithTasks($timesheet->id);

        return view('timesheets.show', compact('timesheet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Timesheet $timesheet)
    {
        $timesheet = $this->timesheetService->getByIdWithTasks($timesheet->id);

        return view('timesheets.edit', compact('timesheet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimesheetRequest $request, $id)
    {
        $params = $request->only([
            'time_check_out',
            'difficult',
            'planning',
            'tasks',
        ]);

        $this->timesheetService->update($id, $params);

        return redirect()->route('timesheets.index');
    }

    public function list()
    {
        $this->authorize('view-list', Timesheet::class);

        $timesheets = $this->timesheetService->getAll();

        return view('timesheets.list-all', compact('timesheets'));
    }

    public function export()
    {
        $this->authorize('export', Timesheet::class);

        return $this->timesheetService->export();
    }

    public function approve(Timesheet $timesheet)
    {
        $this->authorize('approve', $timesheet);

        // TODO handle function approve timesheet

        return 'approve';
    }
}
