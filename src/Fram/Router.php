<?php

namespace App\Fram;

class Router
{
    public function getRoutesJson(string $jsonPath)
    {
        $json = file_get_contents($jsonPath);
        if (!$json) {
            throw new \Exception("File not found");
        }

        $jsonArray = json_decode($json, true);
        $routes = $jsonArray['routes'];

        $path = $_GET['p'] ?? "/";
        foreach ($routes as $route) {
            if ($path === $route['path']) {
                $controllerName = '\\App\\Controller\\' . $route['controller'];
                [new $controllerName, $route['action']]();
                break;
            }
        }
    }
}
