<?php

class HomeController {
    public function index() {       
        global $db;
        $posts = Post::getAllPosts($db);

        // add user vote status
        if ($posts && isLoggedIn()) {
            foreach ($posts as &$post) {
                $userVote = Vote::checkVote($db, $_SESSION['account_id'], $post['post_id']);

                if (!empty($userVote)) {
                    $post['is_voted'] = $userVote['vote_type'];
                } else {
                    $post['is_voted'] = 0;
                }
            } 
        } else {
            foreach ($posts as &$post) {
                $post['is_voted'] = 0;
            } 
        }

        $view = ViewController::getInstance();
        $view->set('title', 'Home Page');
        $view->set('posts', $posts);
        $view->render('home');
    }
}

?>