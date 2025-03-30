<?php

class Admin {
    public static function createUser($db = null) {
        $role_id = trim($_POST['role_id']);
        $account_name = trim($_POST['account_name']);
        $account_avatar = trim($_POST['account_avatar']) ?? 'uploads/account/default.jpg';
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = trim($_POST['email']);


        $sql = "INSERT INTO `account`
                (role_id, account_name, account_avatar, password_hash, email, created_at)
                VALUES (:role_id, :account_name, :account_avatar, :password_hash, :email, NOW())";

        $stmt = $db->query($sql, [
            ':role_id' => $role_id,
            ':account_name' => $account_name,
            ':account_avatar' => $account_avatar,
            ':role_id' => $password_hash,
            ':email' => $email,
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateUser($db = null, $account_id) {
        $role_id = trim($_POST['role_id']);
        $account_name = trim($_POST['account_name']);
        $account_avatar = trim($_POST['account_avatar']) ?? 'uploads/account/default.jpg';
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = trim($_POST['email']);


        $sql = "UPDATE `account`
                SET role_id = :role_id, account_name = :account_name, 
                account_avatar = :account_avatar, password_hash, email
                WHERE account_id = :account_id;";

        $stmt = $db->query($sql, [
            ':role_id' => $role_id,
            ':account_name' => $account_name,
            ':account_avatar' => $account_avatar,
            ':role_id' => $password_hash,
            ':email' => $email,
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteUser($db = null, $account_id = null) {
        $sql = "DELETE FROM `account` WHERE account_id = :account_id";

        $stmt = $db->query($sql, [
            ':account_id' => $account_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function createModule($db = null) {
        $sql = "INSERT INTO `module`
                (module_name, teacher, description)
                VALUES (:module_name, :teacher, :description)";

        $stmt = $db->query($sql, [
            ':module_name' => $module_name,
            ':teacher' => $teacher,
            ':description' => $description,
        ]);

        return $stmt;
    }

    public static function updateModule($db = null, $module_id = null) {
        $sql = "UPDATE `module`
                SET module_name = :module_name, teacher = :teacher,
                description = :description
                WHERE module_id = :module_id;";

        $stmt = $db->query($sql, [
            ':module_name' => $module_name,
            ':teacher' => $teacher,
            ':description' => $description,
            ':module_id' => $module_id,
        ]);

        return $stmt;
    }

    public static function deleteModule($db = null, $module_id = null) {
        $sql = "DELETE FROM `module` WHERE module_id = :module_id";

        $stmt = $db->query($sql, [
            ':module_id' => $module_id
        ]);

        return $stmt;
    }

 

    public static function replyMessage($db = null) {
        $sql = "";
    }

    public static function updateMessage($db = null, $message_id = null) {
        $sql = "UPDATE `message`
                SET title = :title, content = :content, updated_at = NOW()
                WHERE message_id = :message_id";

        $stmt = $db->query($sql, [
            ':title' => $title,
            ':content' => $content,
        ]);

        return $stmt;
    }

    public static function deleteMessage($db = null, $message_id = null) {
        $sql = "DELETE FROM `module` WHERE message_id = :message_id";

        $stmt = $db->query($sql, [
            ':message_id' => $message_id
        ]);

        return $stmt;
    }
}

?>