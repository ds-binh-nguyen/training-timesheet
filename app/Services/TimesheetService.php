<?php

namespace App\Services;

use App\Models\Timesheet;
use App\Services\Interfaces\TimesheetServiceInterface;

class TimesheetService extends BaseService implements TimesheetServiceInterface
{
    public function getAll()
    {
        return Timesheet::where('user_id', auth()->user()->id)
            ->with('tasks')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function create(array $data)
    {
        $timesheet = Timesheet::create($data);
        $timesheet->tasks()->createMany($data['tasks']);

        return $timesheet;
    }

    public function getByIdWithTasks(int $id)
    {
        return Timesheet::with('tasks')->find($id);
    }

    public function getById(int $id)
    {
        return Timesheet::find($id);
    }

    public function update(int $id, array $data)
    {
        $timesheet = $this->getById($id);
        $timesheet->update($data);

        $timesheet->tasks()->delete();
        $tasks = array_filter($data['tasks'], function($task) {
            return !empty(array_filter($task));
        });
        if (!empty($tasks)) {
            $timesheet->tasks()->createMany($tasks);
        }

        return $timesheet;
    }

    public function destroy(int $id)
    {
        return $this->getById($id)->delete();
    }
}
