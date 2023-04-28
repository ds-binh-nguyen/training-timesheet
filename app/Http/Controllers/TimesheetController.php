<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\TimesheetServiceInterface;
use Illuminate\Http\Request;

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
        $timesheets = $this->timesheetService->getAll();

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
    public function store(Request $request)
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $timesheet = $this->timesheetService->getByIdWithTasks($id);

        return view('timesheets.edit', compact('timesheet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $params = $request->only([
            'time_check_in',
            'time_check_out',
            'difficult',
            'planning',
            'tasks',
        ]);

        $this->timesheetService->update($id, $params);

        return redirect()->route('timesheets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->timesheetService->destroy($id);

        return redirect()->route('timesheets.index');
    }
}
