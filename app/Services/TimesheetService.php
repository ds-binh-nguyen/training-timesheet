<?php

namespace App\Services;

use App\Repositories\IRepository\TaskRepository;
use App\Repositories\IRepository\TimesheetRepository;

class TimesheetService
{
    protected $timesheetRepo;
    protected $taskRepo;

    public function __construct(
        TimesheetRepository $timesheetRepo,
        TaskRepository $taskRepo
    )
    {
        $this->timesheetRepo = $timesheetRepo;
        $this->taskRepo = $taskRepo;
    }

    public function getAllTimesheets()
    {
        return $this->timesheetRepo->getAll();
    }

    public function createTimesheet($data)
    {
        $timesheet = $this->timesheetRepo->create($data);

        $tasks = [];

        foreach ($data['tasks'] as $task) {
            $tasks[] = [
                'timesheet_id' => $timesheet->id,
                'task_id' => $task['task_id'],
                'content' => $task['content'],
                'spent_time' => $task['spent_time']
            ];
        }

        $this->taskRepo->createMany($tasks);

        return $timesheet;
    }
}
