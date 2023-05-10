<?php

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;

class UserService extends BaseService implements UserServiceInterface
{
    public function getAll()
    {
        return User::orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
