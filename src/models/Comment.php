<?php

class Comment {
    public static function getAllComments($db = null, $post_id = null) {
        $sql = "SELECT * FROM `comment` WHERE post_id = :post_id;";

        $stmt = $db->query($sql, [
            'post_id' => $post_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function createComment($db = null, $post_id = null, $content) {
        $sql = "INSERT INTO `comment` (account_id, post_id, content, updated_at, commented_at, vote, depth_level)
                VALUES (:account_id, :post_id, :content, NOW(), NOW(), 0, 0);";

        $stmt = $db->query($sql, [
            ':account_id' => $_SESSION['account_id'],
            ':post_id' => $post_id,
            ':content' => $content
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateComment($db = null, $comment_id = null) {
        $sql = "UPDATE `comment`
                SET content = :content, updated_at = NOW()
                WHERE comment_id = : comment_id;";

        $stmt = $db->query($sql, [
            ':content' => trim($_POST['comment_content']),
            ':comment_id' => $comment_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteComment($db = null, $comment_id = null) {
        $sql = "DELETE FROM `comment` WHERE comment_id = :comment_id";

        $stmt = $db->query($sql, [
            ':comment_id' => $comment_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function replyComment($db, $parent_comment_id, $depth_level) {
        $sql = "INSERT INTO `comment` (account_id, post_id, content, updated_at, commented_at, vote, depth_level)
        VALUES (:account_id, :post_id, :content, NOW(), NOW(), 0, 0);";

        $stmt = $db->query($sql, [
            ':account_id' => $_SESSION['account_id'],
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);  
    }
}

?>