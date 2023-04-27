<?php

namespace App\Repositories\IRepository;

interface TaskRepository
{
    public function getAll();

    public function getById(int $id);

    public function createMany(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}
