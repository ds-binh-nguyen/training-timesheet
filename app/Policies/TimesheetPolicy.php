<?php

namespace App\Policies;

use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TimesheetPolicy
{
    use HandlesAuthorization;

    public function viewList(User $user)
    {
        return $user->isAdmin() || $user->isManager();
    }

    public function view(User $user, Timesheet $timesheet)
    {
        return $user->isAdmin() || $user->id === $timesheet->user->manager_id || $user->id === $timesheet->id;
    }

    public function approve(User $user, Timesheet $timesheet)
    {
        return $user->isAdmin() || $user->id === $timesheet->user->manager_id;
    }

    public function export(User $user)
    {
        return $user->isAdmin();
    }
}
