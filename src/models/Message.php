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

    public static function replyMessage($db = null) {
        $sql = "";
    }

    public static function getAllmessages($db = null) {
        $sql = "SELECT message.message_id, message.title, message.content, message.sent_at,
                message.updated_at, message.status, account.account_name, account.account_avatar
                FROM `message` INNER JOIN `account` ON account.account_id = message.account_id;";
        $stmt = $db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllAccountMessages($db) {
        $account_id = $_SESSION['account_id'] ?? null;
        $sql = "SELECT * FROM `message` WHERE account_id = :account_id;";

        $stmt = $db->query($sql, [
            ':account_id' => $account_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUserMessage($db = null, $message_id = null) {
        $sql = "SELECT message.message_id, message.title, message.content, message.sent_at,
                message.updated_at, message.status, account.account_id,
                account.account_name, account.account_avatar
                FROM `message` 
                INNER JOIN `account` ON account.account_id = message.account_id
                WHERE message.message_id = :message_id; ";

        $stmt = $db->query($sql, [
            ':message_id' => $message_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getMessageCount($db = null) {
        $sql = "SELECT COUNT(*) AS message_count FROM `message`;";

        $stmt = $db->query($sql);

        return $stmt->fetch();
    }

    public static function updateMessage($db = null, $message_id = null) {
        $title = trim($_POST['email_title']);
        $content = trim($_POST['email_content']);

        $sql = "UPDATE `message`
                SET title = :title, content = :content, updated_at = NOW()
                WHERE message_id = :message_id";

        $stmt = $db->query($sql, [
            ':title' => $title,
            ':content' => $content,
            ':message_id' => $message_id
        ]);

        return $stmt;
    }

    public static function updateStatus($db = null, $status = '', $message_id = null) {
        $sql = "UPDATE `message`
                SET status = :status
                WHERE message_id = :message_id;";

        $stmt = $db->query($sql, [
            ':status' => $status,
            ':message_id' => $message_id
        ]);

        return $stmt;
    }

    public static function deleteMessage($db = null, $message_id = null) {
        $sql = "UPDATE `message`
                SET status = 'deleted', title = '---', content = '---'
                WHERE message_id = :message_id;";

        $stmt = $db->query($sql, [
            ':message_id' => $message_id
        ]);

        return $stmt;
    }
}

?>