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
 
        // Get feed setting from URL parameter or use default
        $setting = $_GET['feed'] ?? 'new';

        switch($setting) {
            case 'new': 
                // Sort by newest first (default)
                usort($posts, function($a, $b) {
                    return strtotime($b['post_at']) - strtotime($a['post_at']);
                });
                break;

            case 'old': 
                // Sort by oldest first
                usort($posts, function($a, $b) {
                    return strtotime($a['post_at']) - strtotime($b['post_at']);
                });
                break;

            case 'top': 
                // sorting post using bubble sort (get top post)
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
                }

                break;

            case 'bottom': 
                // sorting post (get bottom post)
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
                }

                break;
            
            default:
                echo 'No setting choose';
        }

        // Set the sorted posts in the view
        $view->set('posts', $posts);
        $view->render('home');
    }

}

?>