<?php

class PostController {
    public function createForm() {
        $view = ViewController::getInstance();
        $view->set('title', 'New Post');
        $view->render('createPost');
    }

    public function create() {
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