<?php

class HomeController {
    public function index() {       
        global $db;
        $posts = Post::getAllPosts($db);

        $view = ViewController::getInstance();
        $view->set('title', 'Home Page');
        $view->set('disable_scroll', false);

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


        // new feed setting
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            // feed setting type
            $data = file_get_contents('php://input');
            $setting = json_decode($data, true)['feedSetting'] ?? 'new'; // feed setting 'new' is default
        } else {
            $setting = 'new';
        }

        echo $setting;

        switch($setting) {
            case 'new': 

                break;

            case 'old': 

                break;

            case 'top': 
                // sorting post (get top post)
                $length = count($posts);
        
                if ($length > 1) {
                    for ($i = 0; $i < $length; $i++) {
                        for ($j = $i + 1; $j < $length; $j++) {
                            $cur_post = &$posts[$i];
                            $next_post = &$posts[$j];
        
                            $cur_vote = intval($cur_post['vote']);
                            $next_vote = intval($next_post['vote']);
        
                            if ($cur_vote < $next_vote) {
                                $temp = $cur_post;
                                $cur_post = $next_post;
                                $next_post = $temp;
                            }
                        }
                    }

                    $view->set('posts', $posts);
                }


                break;

            case 'bottom': 
                // sorting post (get top post)
                $length = count($posts);
        
                if ($length > 1) {
                    for ($i = 0; $i < $length; $i++) {
                        for ($j = $i + 1; $j < $length; $j++) {
                            $cur_post = &$posts[$i];
                            $next_post = &$posts[$j];
        
                            $cur_vote = intval($cur_post['vote']);
                            $next_vote = intval($next_post['vote']);
        
                            if ($cur_vote > $next_vote) {
                                $temp = $cur_post;
                                $cur_post = $next_post;
                                $next_post = $temp;
                            }
                        }
                    }

                    $view->set('posts', $posts);
                }

                break;
            
            default:
                echo 'No setting choose';
        }

        $view->render('home');
    }

}

?>