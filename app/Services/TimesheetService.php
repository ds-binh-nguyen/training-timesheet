<?php

namespace App\Services;

use App\Exports\TimesheetExport;
use App\Models\Timesheet;
use App\Services\Interfaces\TimesheetServiceInterface;
use Maatwebsite\Excel\Facades\Excel;

class TimesheetService extends BaseService implements TimesheetServiceInterface
{
    public function getByCurrentUser()
    {
        return Timesheet::where('user_id', auth()->id())
            ->with('tasks')
            ->latest()
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
        $tasks = array_filter($data['tasks'], fn($task) => !empty(array_filter($task)));
        if (!empty($tasks)) {
            $timesheet->tasks()->createMany($tasks);
        }

        return $timesheet;
    }

    public function getAll()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return $this->getByAdmin();
        }

        if ($user->isManager()) {
            return $this->getByManager($user->id);
        }

        return null;
    }

    private function getByManager(int $userId)
    {
        return Timesheet::with('tasks', 'user')
            ->managedBy($userId)
            ->latest()
            ->paginate(10);
    }

    private function getByAdmin()
    {
        return Timesheet::with('tasks')
            ->latest()
            ->paginate(10);
    }

    public function export()
    {
        $data = Timesheet::with('user')->get();

        return Excel::download(new TimesheetExport($data), 'timesheet.xlsx');
    }
}
