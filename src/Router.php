<?php

class Router {
    private $routes = [];

    public function __construct() {

        // Home page
        $this->addRoute('GET', '', 'HomeController', 'index');
        $this->addRoute('GET', 'home', 'HomeController', 'index');

        // Create post form 
        $this->addRoute('GET', 'post/create', 'PostController', 'createForm');
        $this->addRoute('POST', 'post/create', 'PostController', 'create');
        
        // Show post
        $this->addRoute('GET', 'post/(\d+)', 'PostController', 'show');
        
        // Edit post
        $this->addRoute('GET', 'post/(\d+)/edit', 'PostController', 'editForm');
        $this->addRoute('POST', 'post/(\d+)/edit', 'PostController', 'edit');

        // List all modules
        $this->addRoute('GET', 'module', 'ModuleController', 'index');
        $this->addRoute('GET', 'module/(\d+)', 'ModuleController', 'show');
        $this->addRoute('GET', 'module/(\d+)/post/(\d+)', 'ModuleController', 'showPost');

        // Email admin
        $this->addRoute('GET', 'email', 'AdminController', 'message');

        // Profile
        $this->addRoute('GET', 'profile', 'AccountController', 'showProfile');

        // Logout
        $this->addRoute('GET', 'logout', 'AccountController', 'logout');

        // Admin dashboard
        $this->addRoute('GET', 'admin', 'AdminController', 'dashboard');
        
        // Login and register
        $this->addRoute('GET', 'login', 'AccountController', 'loginForm');
        $this->addRoute('POST', 'login', 'AccountController', 'login');
        $this->addRoute('GET', 'register', 'AccountController', 'registerForm');
        $this->addRoute('POST', 'register', 'AccountController', 'register');
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