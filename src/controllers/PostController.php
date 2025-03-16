<?php

class PostController {
    public function create() {
        $view = ViewController::getInstance();
        $view->set('title', 'New Post');
        $view->render('createPost');
    }

    
}
?>