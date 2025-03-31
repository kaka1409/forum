<?php

class AdminController {
    public function dashboard() {
        global $db;

        $post_count = Post::getPostCount($db);
        $module_count = Module::getModuleount($db);
        $user_count = Account::getUserCount($db);
        $message_count = Message::getMessageCount($db);

        $view = ViewController::getInstance();
        $view->set('title', 'Admin dashboard');
        $view->set('disable_scroll', false);
        $view->set('post_count', $post_count);
        $view->set('module_count', $module_count);
        $view->set('user_count', $user_count);
        $view->set('message_count', $message_count);
        $view->render('admin_dashboard');
    }

    public function user() {
        global $db;

        // $posts = Post::getAllPosts($db);

        // print_r($posts);

        // sendJson(['posts' => $posts]);
    }

    public function post() {
        global $db;

        $posts = Post::getAllPosts($db);

        sendJson(['posts' => $posts]);
    }

}

?>