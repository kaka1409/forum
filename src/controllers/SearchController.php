<?php

class SearchController {
    public function index() {
        global $db;

        $search_option = $_GET['option'];
        $search_query = $_GET['query'];

        $view = ViewController::getInstance();
        $view->set('disable_scroll', false);

        switch($search_option) {
            case 'post': {

                $posts = Post::searchPost($db, $search_query);

                // add post's information status
                if ($posts && isLoggedIn()) {
                    foreach ($posts as &$post) {
                        $user_vote = Vote::checkVote($db, $_SESSION['account_id'], $post['post_id']);
                        $post['is_voted'] = !empty($user_vote) ? $user_vote['vote_type'] : 0;
        
                        $user_bookmark = Post::checkBookmarked($db, $post['post_id']);
                        $post['is_bookmarked'] = !empty($user_bookmark) ? 1 : 0;
                    } 
                } else {
                    foreach ($posts as &$post) {
                        $post['is_voted'] = 0;
                        $post['is_bookmarked'] = 0;
                    } 
                }

                $view->set('title', 'Searching' . $search_query);
                $view->set('posts', $posts);
                $view->render('searchPost');
            }

            case 'user': {
                $view->set('title', 'Searching ' . $search_query);
                // $view->set()
                $view->render('searchUser');
            }
        }


    }   
}

?>