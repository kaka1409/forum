<?php

class Post {

    public static function getAllPosts($db = null) {
        $sql = "SELECT post.title, post.content, post.post_at, post.vote, post.comments_count, account.account_name, module.module_name
        FROM `post`
        INNER JOIN `account` ON post.account_id = account.account_id
        INNER JOIN `module` ON post.module_id = module.module_id;";
        $stmt = $db->query($sql);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }
    
}

?>