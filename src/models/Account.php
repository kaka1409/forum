<?php

class Account {

    public static function login($db, $email, $password) {
        $sql = "SELECT * FROM `account` WHERE email = :email;";
        $stmt = $db->query($sql, [
            ':email' => $email
        ]);

        if ($stmt.rowCount() > 0) {
            $account = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $account['password'])) {
                return $account;
            }
        }

        return false;
    }

    public static function register($db) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $sql = "INSERT INTO `account`(`user_id`, `role_id`, `account_name`, `password_hash`, `email`, `create_at`) 
                VALUES (:user_id, :role_id, :username, :password_hash, :email, NOW())";

        $stmt = $db->query($sql, [
            ':user_id' => 2,
            ':role_id' => 1,
            ':username' => $username,
            ':password_hash' => password_hash($password, PASSWORD_BCRYPT),
            ':email' => $email,
        ]);

        return $stmt;
    
    }
}

?>