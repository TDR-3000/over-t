<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface Writetable
{
    public function store(Request $request): array;

    public function delete(int $id);
}