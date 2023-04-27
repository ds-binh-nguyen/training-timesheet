<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\IRepository\TaskRepository;

class TaskRepositoryEloquent extends BaseRepository implements TaskRepository
{
    protected $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }
}
