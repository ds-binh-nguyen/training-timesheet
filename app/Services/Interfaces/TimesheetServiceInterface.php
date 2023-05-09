<?php

namespace App\Services\Interfaces;

interface TimesheetServiceInterface
{
    public function getByCurrentUser();
    public function create(array $data);
    public function getByIdWithTasks(int $id);
    public function update(int $id, array $data);
    public function getAll();
    public function export();
}
