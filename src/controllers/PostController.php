<?php

class PostController {
    public function create() {
        $view = new ViewController();
        $view->render('createPost');
    }
}
?>