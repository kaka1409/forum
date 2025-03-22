<?php

class Post {

    public static function createPost($db = null) {
        $module_id = $_POST['module'];
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $thumbnail_url = UPLOAD_FOLDER . $_POST['thumbnail'];

        // echo $module_id;
    
        $sql = "INSERT INTO `post`(`account_id`, `module_id`, `title`, `content`, `post_at`, `updated_at`, `vote`, `comments_count`, `thumbnail_url`) 
                VALUES (:account_id, :module_id, :title, :content, NOW(), NOW(), :vote, :comments_count, :thumbnail_url)";
        
        $stmt = $db->query($sql, [
            ':account_id' => $_SESSION['account_id'], // hard coded since I haven't implemented login system
            ':module_id' => $module_id,
            ':title' => $title,
            ':content' => $content,
            ':vote' => 0,
            ':comments_count' => 0,
            ':thumbnail_url' => $thumbnail_url,
        ]);
        
        return $stmt;
    }

    public static function getPostById($db, $post_id) {

        $sql = "SELECT post.post_id, post.account_id, post.title, post.content,
            post.post_at, post.vote, post.comments_count, post.thumbnail_url,
            account.account_name, account.account_avatar, module.module_id
            FROM `post` 
            INNER JOIN `account` ON post.account_id = account.account_id
            INNER JOIN `module` ON post.module_id = module.module_id
            WHERE post.post_id = :post_id;";

        $stmt = $db->query($sql, [
            ':post_id' => $post_id
        ]);

        $post_content = $stmt->FetchAll(PDO::FETCH_ASSOC);
        return $post_content[0];
    }

    public static function getAllPosts($db = null) {
        $sql = "SELECT post.post_id, post.account_id, post.title, post.content,
            post.post_at, post.vote, post.comments_count, post.thumbnail_url,
            account.account_name, account.account_avatar, module.module_name
            FROM `post`
            INNER JOIN `account` ON post.account_id = account.account_id
            INNER JOIN `module` ON post.module_id = module.module_id;";

        $stmt = $db->query($sql);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }
    
}

?>