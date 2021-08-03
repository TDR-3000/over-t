<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface Writetable
{
    public function store(Request $request): array;

    public function update(Request $request, int $id): array;

    public function delete(int $id): bool;
}