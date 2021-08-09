<?php
namespace App\Helpers;
interface Json
{
    public function jsonStructure(int $status, bool $error, string|array|null $response, ?array $dependencies): array;
}
