<?php

namespace App\Helpers;
use App\Helpers\ResponseJobInterface;

class ResponseHelper implements Json
{
    private $responseStrcuture;
    private $api;

    public function __construct()
    {
        $this->responseStrcuture = [];
        $this->api = $_ENV['API_ROUTE'];
    }

    public function jsonStructure(int $status, bool $error, string|array|null $response, ?array $dependencies): array
    {
        if (!empty($dependencies['dependencies'])) {
            $response = $this->pushHateoas($response, $dependencies['dependencies']);
        }
        
        return $this->responseStrcuture = [
            "status"      => $status,
            "error"       => $error,
            "message"     => $response,
            "current_url" => $this->api . $dependencies['current']
        ];
    }

    // PARTIAL //
    private function pushHateoas(array $response, array $dependencies): array
    {
        foreach ($dependencies as $value) {
            for ($index = 0; $index < count($response); $index++) {
                if (!empty($response[$index][$value])) {
                    if (isset($response[$index][$value][0])) {
                        for ($index = 0; $index < count($response); $index++) {
                            for ($i=0; $i < count($response[$index][$value]); $i++) { 
                                $response[$index][$value][$i]['url'] = $this->api . $value . '/' . $response[$index][$value][$i]['id'];
                            }
                        }
                    } else {
                        for ($index = 0; $index < count($response); $index++) {
                            $response[$index][$value]['url'] = $this->api . $value . '/' . $response[$index][$value]['id'];
                        }
                    }
                }
            }
        }
        return $response;
    }
}
