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
        if (!empty($dependencies['dependencies'])) {
            $response = $this->pushDependencyUrl($response, $dependencies['dependencies']);
        }

        return $this->responseStrcuture = [
            "status"      => $status,
            "error"       => $error,
            "message"     => $this->pushCurrentUrl($response, $dependencies),
            "current_url" => $this->api . $dependencies['current']
        ];
    }

    private function pushCurrentUrl(array $response, ?array $dependencies): array
    {
        for ($i = 0; $i < count($response); $i++) {
            $response[$i]['url'] = $this->api . $dependencies['current'] .  $response[$i]['id'];
        }
        
        return $response;
    }

    private function pushDependencyUrl(array $response, ?array $dependencies): array
    {
        for ($i = 0; $i < count($response); $i++) {
            for ($j = 0; $j < count($dependencies); $j++) {
                if (!empty($response[$i][$dependencies[$j]])) {
                    //print_r($response[$i][$dependencies[$j]]);
                    //$response[$i][$dependencies[$j]]['url'] = $this->api . $dependencies[$j] .'/'. $response[$i][$dependencies[$j]]['id'];
                }
            }
        }
        return $response;
    }
}
