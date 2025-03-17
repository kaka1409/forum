<?php

class Router {
    private $routes = [];

    public function __construct() {
        $this->addRoute('GET', 'home', 'HomeController', 'index');
        $this->addRoute('GET', 'post/create', 'PostController', 'createForm');
        $this->addRoute('POST', 'post/create', 'PostController', 'create');
        
    }

    public function addRoute($method, $path, $controller, $action) {
        // add a new route value to the private $routes property

        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch($uriParts, $requestMethod) {
        $uri = implode('/', $uriParts);
        
        /*
        this->routes = [
            [
                'method' => 'GET',
                'path' => '',
                'controller' => 'HomeController',
                'action' => 'index'
            ],

            [
                'method' => 'GET',
                'path' => 'post/create',
                'controller' => 'PostController',
                'action' => 'create'
            ],
        ]
        */

        // going through each route of the routes array
        foreach ($this->routes as $route) {
            // Skip if method doesn't match
            if ($route['method'] !== $requestMethod) {
                continue;
            }
            
            // Check if route pattern matches
            $pattern = '#^' . $route['path'] . '$#';
            if (preg_match($pattern, $uri, $matches)) {
                // Remove the full match from the matches array
                array_shift($matches);
                
                // Create controller instance and call the action
                $controllerName = $route['controller'];
                $action = $route['action'];
                
                $controller = new $controllerName();
                call_user_func_array([$controller, $action], $matches);
                
                // Route was found and handled, stop processing
                return true;
            }
        }
        
        // No route match was found
        return false;
    }
}   

?>