<?php
namespace App\Jobs;
interface ResponseJobInterface
{
    public function jsonStructure(int $status, bool $error, string|array $response): array;
}
