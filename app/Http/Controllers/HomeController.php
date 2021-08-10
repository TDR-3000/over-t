<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Router;
use App\Http\Controllers\AppController as Controller;
use App\Helpers\{Json, RoutesHelper};

class HomeController extends Controller
{

    use RoutesHelper;

    private $response;
    private $router;

    public function __construct(Json $response, Router $router)
    {
        $this->response = $response;
        $this->router = $router;
    }

    public function __invoke()
    {
        return $this->response->jsonStructure(200, false, [
            "over" => "OVER API",
			"home" => "Bienvenido",
            "version" => "1.0.1",
            "hateoas" => self::routes($this->router->getRoutes())
        ], ['current' => '']);
    }
}
