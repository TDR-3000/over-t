<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface Auth
{
    public function login(Request $request): array;
}