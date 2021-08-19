<?php

namespace App\Repositories;

use App\Repositories\Readable;

class TaskRepository implements Readable
{
    public function getAll(): array
    {
        return [];
    }

    public function getOne(int $id): array
    {
        return [];
    }
}