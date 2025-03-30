<?php

class HomeController {
    public function index() {       
        global $db;
        $posts = Post::getAllPosts($db);

        // add user vote status
        if ($posts && isLoggedIn()) {
            foreach ($posts as &$post) {
                $user_vote = Vote::checkVote($db, $_SESSION['account_id'], $post['post_id']);
                $post['is_voted'] = !empty($user_vote) ? $user_vote['vote_type'] : 0;
            } 
        } else {
            foreach ($posts as &$post) {
                $post['is_voted'] = 0;
            } 
        }

        // sendJson(['content' => $posts]);

        $view = ViewController::getInstance();
        $view->set('title', 'Home Page');
        $view->set('disable_scroll', false);
        $view->set('posts', $posts);
        $view->render('home');
    }
}

?>