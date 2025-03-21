<?php

class PostController {
    public function createForm() {
        $session = new Session();
        $csrf_token = $session->generateCsrfToken();

        global $db;
        $modules = Module::getAllModules($db);

        $view = ViewController::getInstance();
        $view->set('csrf_token', $csrf_token);
        $view->set('modules', $modules);
        $view->set('title', 'New Post');
        $view->render('createPost');
    }

    public function create() {
        // validate csrf token
        $session = new Session();
        if (!$session->validateCsrfToken($_POST['csrf_token'])) {
            header('Location: ' . BASE_URL . 'post/create');
            exit;
        }

        global $db;

        if (isset($_POST['submit'])) {

            $result = Post::createPost($db);

            if ($result) {
                header('Location: ' . BASE_URL . 'home');
                exit;
            } else {
                header('Location: ' . BASE_URL . 'post/create');
                exit;
            }

        } else {
            header('Location: ' . BASE_URL . 'post/create');
            exit;
        }
    }

    public function show() {
        global $db;

        $uri_array = explode('/', $_SERVER['REQUEST_URI']); 

        $post_id = end($uri_array);

        $post_content = Post::getPostById($db, $post_id);

        $view = ViewController::getInstance();
        $view->set('post_content', $post_content);
        $view->set('title', 'Post');
        $view->render('post');
    }

    public function editForm() {
        global $db;

        $uri_array = explode('/', $_SERVER['REQUEST_URI']);

        $post_id = $uri_array[4];

        $post_data = Post::getPostById($db, $post_id);
        $modules = Module::getAllModules($db);

        $view = ViewController::getInstance();        
        $view->set('modules', $modules);
        $view->set('post_data', $post_data);
        // $view->set('post_id', $post_id);
        $view->set('title', 'Edit a post');
        $view->render('editPostForm');
    }

    public function edit() {

    }
    
}
?>