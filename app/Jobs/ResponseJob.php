<?php

namespace App\Jobs;
use App\Jobs\ResponseJobInterface;

class ResponseJob extends Job implements Json
{
    private $responseStrcuture;
    private $api;

    public function __construct()
    {
        $this->responseStrcuture = [];
        $this->api = $_ENV['API_ROUTE'];
    }

    public function jsonStructure(int $status, bool $error, string|array $response, ?array $dependencies): array
    {
        $response = $this->pushHateoas($response);
        return $this->responseStrcuture = [
            "status"      => $status,
            "error"       => $error,
            "message"     => $response,
            "current_url" => $this->api . $dependencies['current']
        ];
    }

    // PARTIAL //
    private function pushHateoas(array $response): array
    {
        
        return array_map(function ($v) {
            if (!empty($v['states'])) {
                $v['states']['url'] = $this->api . 'states' . '/' . $v['states']['id'];
            } else if (!empty($v['users'])) {
                foreach ($v['users'] as $key => $value) {
                    $v['users'][$key]['url'] = $this->api . 'users' . '/' . $v['users'][$key]['id'];
                }
            }
            return $v;
        }, $response);
    }
}
