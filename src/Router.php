<?php

class Router {
    private $routes = [];

    public function __construct() {
        // Login and register
        $this->addRoute('GET', 'login', 'AccountController', 'loginForm');
        $this->addRoute('POST', 'login', 'AccountController', 'login');
        $this->addRoute('GET', 'register', 'AccountController', 'registerForm');
        $this->addRoute('POST', 'register', 'AccountController', 'register');
        
        // Logout
        $this->addRoute('GET', 'logout', 'AccountController', 'logout');

        // Home page
        $this->addRoute('GET', '', 'HomeController', 'index');
        $this->addRoute('GET', 'home', 'HomeController', 'index');
        $this->addRoute('POST', 'home', 'HomeController', 'index');

        // Search
        $this->addRoute('GET', 'search', 'SearchController', 'index');
        $this->addRoute('POST', 'search', 'SearchController', 'index');

        // Create post form 
        $this->addRoute('GET', 'post/create', 'PostController', 'createForm');
        $this->addRoute('POST', 'post/create', 'PostController', 'create');
        
        // Show post
        $this->addRoute('GET', 'post/(\d+)', 'PostController', 'show');
        
        // Edit post
        $this->addRoute('GET', 'post/(\d+)/edit', 'PostController', 'editForm');
        $this->addRoute('POST', 'post/(\d+)/edit', 'PostController', 'edit');

        // Delete post 
        $this->addRoute('POST', 'post/(\d+)/delete', 'PostController' , 'delete');

        // Post vote
        $this->addRoute('POST', 'post/upvote', 'VoteController', 'upvote');
        $this->addRoute('POST', 'post/downvote', 'VoteController', 'downvote');

        // Post comment
        $this->addRoute('POST', 'post/comment', 'CommentController', 'comment');
        $this->addRoute('POST', 'post/comment/upvote', 'CommentVoteController', 'upvote');
        $this->addRoute('POST', 'post/comment/downvote', 'CommentVoteController', 'downvote');
        $this->addRoute('POST', 'post/reply', 'CommentController', 'reply');

        // post bookmark
        $this->addRoute('GET', 'bookmarks', 'PostController', 'bookmarksView');
        $this->addRoute('POST', 'post/bookmark', 'PostController', 'bookmark');

        // List all modules
        $this->addRoute('GET', 'module', 'ModuleController', 'index');
        $this->addRoute('GET', 'module/(\d+)', 'ModuleController', 'show');

        // Email admin
        $this->addRoute('GET', 'email', 'MessageController', 'emailForm');
        $this->addRoute('POST', 'email', 'MessageController', 'create');
        $this->addRoute('GET', 'message/(\d+)', 'MessageController', 'show');
        $this->addRoute('POST', 'message/delete/(\d+)', 'MessageController', 'delete');

        // Profile
        $this->addRoute('GET', 'profile/(\d+)', 'AccountController', 'showProfile');

        // Admin dashboard
        $this->addRoute('GET', 'admin', 'AdminController', 'dashboard');

        // admin controls
        $this->addRoute('GET', 'admin/post', 'AdminController', 'post');
        $this->addRoute('GET', 'admin/post_list', 'AdminController', 'dashboard');
        $this->addRoute('POST', 'admin/post/delete/(\d+)', 'AdminController', 'deletePost');
        
        $this->addRoute('GET', 'admin/user', 'AdminController', 'user');
        $this->addRoute('GET', 'admin/user_list', 'AdminController', 'dashboard');
        $this->addRoute('GET', 'admin/user/create', 'AdminController', 'createUserForm');
        $this->addRoute('POST', 'admin/user/create', 'AdminController', 'createUser');
        $this->addRoute('GET', 'admin/user/edit/(\d+)', 'AdminController', 'userEditForm');
        $this->addRoute('POST', 'admin/user/edit/(\d+)', 'AdminController', 'editUser');
        $this->addRoute('POST', 'admin/user/delete/(\d+)', 'AdminController', 'deleteUser');
        
        $this->addRoute('GET', 'admin/module', 'AdminController', 'module');
        $this->addRoute('GET', 'admin/module_list', 'AdminController', 'dashboard');
        $this->addRoute('GET', 'admin/module/create', 'AdminController', 'createModuleForm');
        $this->addRoute('POST', 'admin/module/create', 'AdminController', 'createModule');
        $this->addRoute('GET', 'admin/module/edit/(\d+)', 'AdminController', 'moduleEditForm');
        $this->addRoute('POST', 'admin/module/edit/(\d+)', 'AdminController', 'editModule');
        $this->addRoute('POST', 'admin/module/delete/(\d+)', 'AdminController', 'deleteModule');

        $this->addRoute('GET', 'admin/message', 'AdminController', 'message');
        $this->addRoute('GET', 'admin/message_list', 'AdminController', 'dashboard');
        $this->addRoute('GET', 'admin/message/(\d+)', 'AdminController', 'showMessage');

        
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

            ...
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