<?php

class ModuleController {
    public function index() {
        $view = ViewController::getInstance();
        $view->set('title', 'Modules');
        $view->render('moduleList');
    }

    public function show() {
        $view = ViewController::getInstance();
        $view->set('title', 'Viewing posts in a module');
        $view->render('modulePosts');
    }

    public function showPost() {
        $view = ViewController::getInstance();
        $view->set('title', 'Viewing a post');
        $view->render('modulePostView');
    }

}

?>