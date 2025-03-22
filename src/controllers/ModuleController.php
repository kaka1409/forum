<?php

class ModuleController {
    public function index() {
        global $db;

        $modules = Module::getAllModules($db);
        

        $view = ViewController::getInstance();
        $view->set('modules', $modules);
        $view->set('db', $db);
        $view->set('title', 'Modules');
        $view->render('moduleList');
    }

    public function show() {
        global $db;

        $uri_array = explode('/', $_SERVER['REQUEST_URI']);

        $module_id = end($uri_array);

        $posts_of_module = Module::getAllPostById($db, $module_id);

        $view = ViewController::getInstance();
        $view->set('posts_of_module', $posts_of_module);
        $view->set('title', 'Viewing posts in a module');
        $view->render('modulePosts');
    }

    public function showPost() {
        global $db;

        $uri_array = explode('/', $_SERVER['REQUEST_URI']); 

        $post_id = end($uri_array);

        $post_content = Post::getPostById($db, $post_id);

        $view = ViewController::getInstance();
        $view->set('post_content', $post_content);
        $view->set('title', 'Viewing a post in a module');
        $view->render('modulePostView');
    }

}

?>