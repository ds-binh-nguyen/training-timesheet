<?php

namespace App\Repositories;

use App\Models\Timesheet;
use App\Repositories\IRepository\TimesheetRepository;

class TimesheetRepositoryEloquent extends BaseRepository implements TimesheetRepository
{
    protected $model;

    public function __construct(Timesheet $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function create($timesheetData)
    {
        return $this->model->create($timesheetData);
    }
}
