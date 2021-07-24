<?php

namespace App\Jobs;
use App\Jobs\ResponseJobInterface;

class ResponseJob extends Job implements ResponseJobInterface
{
    private $responseStrcuture;

    public function __construct()
    {
        $this->responseStrcuture = [];
    }

    public function jsonStructure(int $status, bool $error, string|array $response): array
    {
        return $this->responseStrcuture = [
            "status" => $status,
            "error"  => $error,
            "message"=> $response
        ];
    }
}
