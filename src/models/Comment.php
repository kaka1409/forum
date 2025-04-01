<?php

class Comment {
    public static function getAllComments($db = null, $post_id = null) {
        $sql = "SELECT comment.account_id , comment.parent_comment_id, comment.content,
                comment.updated_at, comment.commented_at, comment.vote, comment.depth_level,
                account.account_name, account.account_avatar
                FROM `comment`
                INNER JOIN `account` ON comment.account_id = account.account_id 
                WHERE comment.post_id = :post_id;";

        $stmt = $db->query($sql, [
            ':post_id' => $post_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createComment($db = null, $post_id = null, $content) {
        $sql = "INSERT INTO `comment` 
                (account_id, post_id, content, updated_at, commented_at, vote, depth_level)
                VALUES (:account_id, :post_id, :content, NOW(), NOW(), 0, 0);";

        $stmt = $db->query($sql, [
            ':account_id' => $_SESSION['account_id'],
            ':post_id' => $post_id,
            ':content' => $content
        ]);

        if ($stmt) {
            $data = self::getCommentCount($db, $post_id);
            self::updateCommentCount($db, $data['comments_count'], $post_id);
        }

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

        return $stmt;
    }

    public static function deleteComment($db = null, $comment_id = null) {
        $sql = "DELETE FROM `comment` WHERE comment_id = :comment_id";

        $stmt = $db->query($sql, [
            ':comment_id' => $comment_id
        ]);


        return $stmt;
    }

    public static function replyComment($db, $parent_comment_id, $depth_level) {
        $sql = "INSERT INTO `comment` (account_id, post_id, content, updated_at, commented_at, vote, depth_level)
        VALUES (:account_id, :post_id, :content, NOW(), NOW(), 0, 0);";

        $stmt = $db->query($sql, [
            ':account_id' => $_SESSION['account_id'],
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);  
    }

    public static function getCommentCount($db = null, $post_id) {
        $sql = "SELECT COUNT(*) AS comments_count 
                FROM comment
                WHERE post_id = :post_id;";

        $stmt = $db->query($sql,[
            ':post_id' => $post_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateCommentCount($db = null, $comments_count, $post_id) {
        $sql = "UPDATE `post`
                SET comments_count = :comments_count
                WHERE post_id = :post_id;";

        $stmt = $db->query($sql,[
            ':comments_count' => $comments_count,
            ':post_id' => $post_id
        ]);

        return $stmt;
    }

    public static function increaseCommentCount($db = null, $post_id = null) {
        $sql = "UPDATE `post`
                SET comments_count = comments_count + 1 
                WHERE post_id = :post_id;";

        $stmt = $db->query($sql, [
            ':post_id' => $post_id
        ]);

        return $stmt;
    }

    public static function decreaseCommentCount($db = null, $post_id = null) {
        $sql = "UPDATE `post`
                SET comments_count = comment_counts - 1 
                WHERE post_id = :post_id;";

        $stmt = $db->query($sql, [
            ':post_id' => $post_id
        ]);

        return $stmt;
    }
}

?>