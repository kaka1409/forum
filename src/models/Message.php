<?php

class Message {
    public static function createMessage($db) {
        $account_id = $_SESSION['account_id'] ?? null;
        $title = trim($_POST['email_title']);
        $content = trim($_POST['email_content']);

        $sql = "INSERT INTO `message` (account_id, title, content, updated_at, sent_at, status)
                VALUES (:account_id, :title, :content, NOW(), NOW(), 'unread');";

        $stmt = $db->query($sql, [
           ':account_id' => $account_id,
           ':title' => $title,
           ':content' => $content,
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAllMessages($db) {
        $account_id = $_SESSION['account_id'] ?? null;
        $sql = "SELECT * FROM `message` WHERE account_id = :account_id;";

        $stmt = $db->query($sql, [
            ':account_id' => $account_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMessageCount($db = null) {
        $sql = "SELECT COUNT(*) AS message_count FROM `message`;";

        $stmt = $db->query($sql);

        return $stmt->fetch();
    }
}

?>