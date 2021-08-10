<?php
namespace App\Helpers;

trait RoutesHelper
{
    public static function routes(array $listRoutes): array
    {
        $routes = [];
        $filter = "{id}";

		foreach ($listRoutes as $key => $value) {
			if ($value['method'] == 'GET') {
				array_push($routes, $_ENV["DOMAIN_ROUTE"] . $value['uri']);
			}
		}

		$routesTmp = array_filter($routes, function ($var) use ($filter) {
			return stristr($var, $filter);
		});

		foreach ($routesTmp as $key => $value) {
			unset($routes[$key]);
		}
		
        return array_values($routes);
    }
}