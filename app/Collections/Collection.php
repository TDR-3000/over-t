<?php

namespace App\Collections;

interface Collection
{
    public function responseCollection(int $status, bool $error, string|array $response, ?array $dependencies);
}