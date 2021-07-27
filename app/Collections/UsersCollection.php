<?php

namespace App\Collections;

use App\Collections\Collection;

final class UsersCollection implements Collection
{
    
    private $structure;
    private $api;

    public function __construct()
    {
        $this->structure = [];
        $this->api = $_ENV['API_ROUTE'];
    }

    public function getAllCollection(int $status, bool $error, string|array $response, ?array $dependencies)
    {
        $this->$structure = [
            "status"      => $status,
            "error"       => $error,
            "message"     => $this->pushCurrentUrl($response, $dependencies),
            "current_url" => $this->api . 'users/'
        ];
    }

    private function pushCurrentUrl(array $response, ?array $dependencies): array
    {
        for ($i = 0; $i < count($response); $i++) {
            $response[$i]['url'] = $this->api . $dependencies['current'] .  $response[$i]['id'];
        }
        
        return $response;
    }
}