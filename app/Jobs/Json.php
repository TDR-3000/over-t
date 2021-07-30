<?php
namespace App\Jobs;
interface Json
{
    public function jsonStructure(int $status, bool $error, string|array|null $response, ?array $dependencies): array;
}
