<?php

class ModuleController {
    public function index() {
        global $db;

        $modules = Module::getAllModules($db);
        

        $view = ViewController::getInstance();
        $view->set('modules', $modules);
        $view->set('db', $db);
        $view->set('disable_scroll', false);
        $view->set('title', 'Modules');
        $view->render('moduleList');
    }

    public function show() {
        global $db;

        $uri_array = explode('/', $_SERVER['REQUEST_URI']);

        $module_id = end($uri_array);
        $module_data = Module::getModuleById($db, $module_id);

        $posts_of_module = Module::getAllPostById($db, $module_id);

        // add  post's information status
        if ($posts_of_module && isLoggedIn()) {
            foreach ($posts_of_module as &$post) {
                $user_vote = Vote::checkVote($db, $_SESSION['account_id'], $post['post_id']);
                $post['is_voted'] = !empty($user_vote) ? $user_vote['vote_type'] : 0;

                $user_bookmark = Post::checkBookmarked($db, $post['post_id']);
                $post['is_bookmarked'] = !empty($user_bookmark) ? 1 : 0;
            } 
        } else {
            foreach ($posts_of_module as &$post) {
                $post['is_voted'] = 0;
                $post['is_bookmarked'] = 0;
            }
        }

        $view = ViewController::getInstance();
        $view->set('posts_of_module', $posts_of_module);
        $view->set('disable_scroll', false);
        $view->set('title', 'Viewing posts in ' . $module_data['module_name']);
        $view->render('modulePosts');
    }

    public function showPost() {
        global $db;

        $uri_array = explode('/', $_SERVER['REQUEST_URI']); 

        $post_id = end($uri_array);

        $post_content = Post::getPostById($db, $post_id);

        $view = ViewController::getInstance();
        $view->set('post_content', $post_content);
        $view->set('disable_scroll', false);
        $view->set('title', 'Viewing '. $post_content['title']);
        $view->render('modulePostView');
    }

}

?>