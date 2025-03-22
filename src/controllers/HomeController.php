<?php

class HomeController {
    public function index() {       
        global $db;
        $posts = Post::getAllPosts($db);

        $view = ViewController::getInstance();
        $view->set('title', 'Home Page');
        $view->set('posts', $posts);
        $view->render('home');
    }
}

?>