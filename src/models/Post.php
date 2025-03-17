<?php

class Post {

    public function createPost($db = null) {
        // no account_id since I haven't implemented login system
        $sql = "INSERT INTO `post`( `module_id`, `title`, `content`, `post_at`, `vote`, `thumbnail_url`) 
                VALUES (:module_id, :title, :content, :CURDATE(), 0, :thumbnail_url);";
        $stmt = $db->query($sql, [
            
        ]);
    }

    public static function getAllPosts($db = null) {
        $sql = "SELECT post.title, post.content, post.post_at, post.vote, post.comments_count, post.thumbnail_url, account.account_name, module.module_name
        FROM `post`
        INNER JOIN `account` ON post.account_id = account.account_id
        INNER JOIN `module` ON post.module_id = module.module_id;";
        $stmt = $db->query($sql);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }
    
}

?>