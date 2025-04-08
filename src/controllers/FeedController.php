<?php

class FeedController {

    public static function setPostFeed($posts) {
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
        
        return $posts;
    }


}

?>