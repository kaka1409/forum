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
            ':account_id' => $_SESSION['account_id'],
            ':module_id' => $module_id,
            ':title' => $title,
            ':content' => $content,
            ':vote' => 0,
            ':comments_count' => 0,
            ':thumbnail_url' => $thumbnail_url,
        ]);
        
        return $stmt;
    }

    public static function getPostById($db = null, $post_id = null) {

        $sql = "SELECT post.post_id, post.account_id, post.title, post.content,
            post.post_at, post.updated_at, post.vote, post.comments_count, post.thumbnail_url,
            account.account_name, account.account_avatar, module.module_id
            FROM `post` 
            INNER JOIN `account` ON post.account_id = account.account_id
            INNER JOIN `module` ON post.module_id = module.module_id
            WHERE post.post_id = :post_id;";

        $stmt = $db->query($sql, [
            ':post_id' => $post_id
        ]);

        $post_content = $stmt->fetch(PDO::FETCH_ASSOC);

        // vote information
        if ($post_content) {
            $voteCounts = Vote::getVoteCount($db, $post_id);
            $post_content['upvotes'] = $voteCounts['upvotes'];
            $post_content['downvotes'] = $voteCounts['downvotes'];
            $post_content['votes'] = $voteCounts['votes'];
            
            // user's vote if logged in
            if (isLoggedIn()) {
                $userVote = Vote::checkVote($db, $_SESSION['account_id'], $post_id);
                $post_content['is_voted'] = $userVote ? $userVote['vote_type'] : 0;
            } else {
                $post_content['is_voted'] = 0;
            }
    }
        return $post_content;
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

    public static function updatePostById($db = null, $post_id = null) {
        $module_id = $_POST['module'];
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $thumbnail_url = UPLOAD_FOLDER . trim($_POST['thumbnail']);

        $sql = "UPDATE `post`
                SET module_id = :module_id, title = :title, content = :content,
                updated_at = NOW(), thumbnail_url = :thumbnail_url
                WHERE post_id = :post_id";

        $stmt = $db->query($sql, [
            ':module_id' => $module_id,
            ':title' => $title,
            ':content' => $content,
            ':thumbnail_url' => $thumbnail_url,
            ':post_id' => $post_id,
        ]);

        return $stmt;
    }

    public static function deletePostById($db = null, $post_id = null) {
        $sql = "DELETE FROM `post` WHERE post_id = :post_id";

        $stmt = $db->query($sql, [
            ':post_id' => $post_id
        ]);

        return $stmt;
    }

    public static function getPostCount($db = null) {
        $sql = "SELECT COUNT(*) AS post_count FROM `post`;";

        $stmt = $db->query($sql);

        return $stmt->fetch();
    }

}

?>