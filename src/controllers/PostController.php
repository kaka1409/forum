<?php

class PostController {
    public function createForm() {
        $session = new Session();
        $csrf_token = $session->generateCsrfToken();

        $view = ViewController::getInstance();
        $view->set('csrf_token', $csrf_token);
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
        $view = ViewController::getInstance();
        $view->set('title', 'Post');
        $view->render('post');
    }
    
}
?>