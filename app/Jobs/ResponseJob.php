<?php

namespace App\Jobs;
use App\Jobs\ResponseJobInterface;

class ResponseJob extends Job implements ResponseJobInterface
{
    private $responseStrcuture;
    private const API = 'http://localhost:8000/api/v1/';
    private const ENDPOINT = 'users/';

    public function __construct()
    {
        $this->responseStrcuture = [];
    }

    public function jsonStructure(int $status, bool $error, string|array $response): array
    {
        return $this->responseStrcuture = [
            "status"      => $status,
            "error"       => $error,
            "message"     => $this->pushUrl($response),
            "current_url" => self::API . self::ENDPOINT
        ];
    }

    private function pushUrl(array $response)
    {
        for ($i = 0; $i < count($response); $i++) {
            $response[$i]['url'] = self::API . self::ENDPOINT .  $response[$i]['id'];
        }
        
        return $response;
    }
}
