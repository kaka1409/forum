<?php

class PostController {
    public function createForm() {
        $view = ViewController::getInstance();
        $view->set('title', 'New Post');
        $view->render('createPost');
    }

    public function create() {
        $view = ViewController::getInstance();
        $view->set('title', 'Home Page');
        $view->render('home');
    }
    
}
?>